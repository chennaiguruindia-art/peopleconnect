<?php

namespace App\Services;

use App\Models\PublicUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VirudhunagarNewsService
{
    /**
     * Google News RSS Search Feed URLs for Tamil Nadu State & Districts
     */
    protected array $feeds = [
        [
            'url' => 'https://news.google.com/rss/search?q=Tamil+Nadu+தமிழ்நாடு+செய்திகள்&hl=ta&gl=IN&ceid=IN:ta',
            'lang' => 'ta',
            'limit' => 20,
        ],
        [
            'url' => 'https://news.google.com/rss/search?q=தமிழ்நாடு+அரசு+திட்டம்+மக்கள்+நலம்&hl=ta&gl=IN&ceid=IN:ta',
            'lang' => 'ta',
            'limit' => 15,
        ],
        [
            'url' => 'https://news.google.com/rss/search?q=Tirunelveli+திருநெல்வேலி&hl=ta&gl=IN&ceid=IN:ta',
            'lang' => 'ta',
            'limit' => 10,
        ],
        [
            'url' => 'https://news.google.com/rss/search?q=Tamil+Nadu+civic+news+welfare&hl=en-IN&gl=IN&ceid=IN:en',
            'lang' => 'en',
            'limit' => 10,
        ],
    ];

    /**
     * Clean and sanitize news text:
     * - Strips HTML entities like &nbsp;, &#160;
     * - Strips hashtags (#Virudhunagar #PMMITRA etc.)
     * - Strips channel branding prefixes (BREAKING ||, ZEE Tamil News, etc.)
     * - Strips trailing publisher suffixes (- Dinamalar, - Facebook, etc.)
     * - Cleans up irregular whitespace and punctuation
     */
    public static function sanitizeText(string $text, string $sourceName = ''): string
    {
        if (empty($text)) {
            return '';
        }

        // 1. Decode HTML entities
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = str_replace(
            ['&nbsp;', '&#160;', '&amp;', '&quot;', '&#39;', '&lt;', '&gt;'],
            [' ', ' ', '&', '"', "'", '<', '>'],
            $text
        );

        // 2. Remove all social media hashtags (#Virudhunagar #PMMITRA etc.)
        $text = preg_replace('/#[\w\x{0B80}-\x{0BFF}]+/u', '', $text);

        // 3. Remove common news breaking prefixes (BREAKING ||, BREAKING NEWS, அதிர்ச்சி ||)
        $text = preg_replace('/^(BREAKING\s*\|\|?|BREAKING\s*NEWS\s*[:\-|\|]?|அதிர்ச்சி\s*\|\|?|பரபரப்பு\s*\|\|?)\s*/iu', '', $text);

        // 4. Remove leading media channel tags like "ZEE Tamil News. ." or "Thanthi TV -"
        $text = preg_replace('/^(ZEE Tamil News\s*[\.\-:]*|News18 Tamil Nadu\s*[\.\-:]*|Thanthi TV\s*[\.\-:]*|Puthiyathalaimurai\s*[\.\-:]*)\s*/iu', '', $text);

        // 5. Remove trailing source names (e.g. " - Dinamalar", " - Daily Thanthi", " - Facebook", " - Thanthi TV")
        if (!empty($sourceName)) {
            $escapedSource = preg_quote($sourceName, '/');
            $text = preg_replace('/\s*[-|:]\s*' . $escapedSource . '\s*$/iu', '', $text);
        }
        $commonSources = [
            'Dinamalar', 'Daily Thanthi', 'Dinamani', 'The Hindu', 'Thanthi TV', 
            'Polimer News', 'News18', 'Puthiyathalaimurai', 'Facebook', 'YouTube', 
            'ZigWheels\.com', 'CarDekho', 'Oneindia Tamil', 'News 18'
        ];
        foreach ($commonSources as $src) {
            $text = preg_replace('/\s*[-|:]\s*' . $src . '\s*$/iu', '', $text);
        }

        // 6. Clean multiple spaces, non-breaking whitespace chars, and trim edges
        $text = preg_replace('/[\s\x{00A0}\x{200B}]+/u', ' ', $text);
        $text = trim($text, " \t\n\r\0\x0B-|:.,");

        return $text;
    }

    /**
     * Synchronize latest Virudhunagar news into public_updates table.
     * Throttled with a 30-minute cache lock to ensure high performance.
     */
    public function syncLatestNews(bool $force = false, int $limit = 25): int
    {
        $cacheKey = 'virudhunagar_news_last_sync_time';

        try {
            if (!$force && Cache::has($cacheKey) && PublicUpdate::count() > 0) {
                return 0; // Already synced recently
            }
        } catch (\Throwable $e) {
            Log::warning('News sync cache check failed: ' . $e->getMessage());
        }

        $allItems = [];
        foreach ($this->feeds as $feedConfig) {
            $feedItems = $this->fetchFromRss($feedConfig['url'], $feedConfig['lang'], $feedConfig['limit']);
            $allItems = array_merge($allItems, $feedItems);
        }

        $savedCount = 0;

        foreach ($allItems as $item) {
            if (empty($item['title']) || empty($item['link'])) {
                continue;
            }

            // Skip commercial price spam like vehicle on-road prices
            if (str_contains($item['title'], 'On Road Price') || 
                str_contains($item['source'], 'ZigWheels') || 
                str_contains($item['source'], 'CarDekho')) {
                continue;
            }

            $sourceName = $item['source'] ?: 'Tamil Nadu News';
            $cleanTitle = self::sanitizeText($item['title'], $sourceName);
            $cleanDescription = self::sanitizeText($item['description'], $sourceName);

            if (empty($cleanTitle)) {
                continue;
            }

            // Check if article with this link or title already exists
            $existing = PublicUpdate::where('source_url', $item['link'])
                ->orWhere('title_ta', $cleanTitle)
                ->orWhere('title_en', $cleanTitle)
                ->first();

            $category = $this->detectCategory($cleanTitle . ' ' . $cleanDescription);

            $contentTa = !empty($cleanDescription) ? $cleanDescription : 'தமிழ்நாடு மாநில மக்கள் நல செய்தி அறிக்கை (' . $sourceName . ').';
            $contentEn = !empty($cleanDescription) ? $cleanDescription : 'Public welfare news report from Tamil Nadu via ' . $sourceName . '.';

            if (!$existing) {
                PublicUpdate::create([
                    'title_en' => $cleanTitle,
                    'title_ta' => $cleanTitle,
                    'content_en' => $contentEn,
                    'content_ta' => $contentTa,
                    'category' => $category,
                    'source_name' => $sourceName,
                    'source_url' => $item['link'],
                    'published_at' => $item['pubDate'],
                    'is_active' => true,
                ]);
                $savedCount++;
            } else {
                // Update existing record with sanitized content
                $existing->update([
                    'title_ta' => $cleanTitle,
                    'title_en' => $cleanTitle,
                    'content_ta' => $contentTa,
                    'content_en' => $contentEn,
                    'source_name' => $sourceName,
                ]);
            }
        }

        // Also clean up any lingering old dirty records
        $this->cleanExistingDatabaseRecords();

        // Cache sync time for 30 minutes
        try {
            Cache::put($cacheKey, now()->toDateTimeString(), 1800);
        } catch (\Throwable $e) {
            Log::warning('News sync cache put failed: ' . $e->getMessage());
        }

        return $savedCount;
    }

    /**
     * Clean and sanitize all existing records in public_updates table.
     */
    public function cleanExistingDatabaseRecords(): int
    {
        $records = PublicUpdate::all();
        $updated = 0;

        foreach ($records as $record) {
            // Delete commercial price spam
            if (str_contains($record->title_en, 'On Road Price') || 
                str_contains($record->title_ta, 'On Road Price') || 
                str_contains((string)$record->source_name, 'ZigWheels')) {
                $record->delete();
                continue;
            }

            $source = $record->source_name ?: '';
            $newTitleTa = self::sanitizeText($record->title_ta, $source);
            $newTitleEn = self::sanitizeText($record->title_en, $source);
            $newContentTa = self::sanitizeText($record->content_ta, $source);
            $newContentEn = self::sanitizeText($record->content_en, $source);

            $record->update([
                'title_ta' => $newTitleTa,
                'title_en' => $newTitleEn,
                'content_ta' => $newContentTa,
                'content_en' => $newContentEn,
            ]);
            $updated++;
        }

        return $updated;
    }

    /**
     * Fetch and parse RSS feed.
     */
    protected function fetchFromRss(string $url, string $lang, int $limit): array
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                ])
                ->get($url);

            if (!$response->successful()) {
                Log::warning("Failed to fetch RSS from {$url}: HTTP " . $response->status());
                return [];
            }

            $xmlString = $response->body();
            if (empty($xmlString)) {
                return [];
            }

            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);

            if ($xml === false || !isset($xml->channel->item)) {
                return [];
            }

            $parsed = [];
            $count = 0;

            foreach ($xml->channel->item as $item) {
                if ($count >= $limit) {
                    break;
                }

                $rawTitle = (string) $item->title;
                $link = (string) $item->link;
                $pubDateStr = (string) $item->pubDate;
                $description = strip_tags((string) $item->description);

                // Source extraction
                $sourceName = '';
                if (isset($item->source)) {
                    $sourceName = (string) $item->source;
                }
                
                $title = $rawTitle;
                if (empty($sourceName) && str_contains($rawTitle, ' - ')) {
                    $parts = explode(' - ', $rawTitle);
                    $sourceName = trim(array_pop($parts));
                    $title = trim(implode(' - ', $parts));
                }

                try {
                    $pubDate = !empty($pubDateStr) ? Carbon::parse($pubDateStr) : now();
                } catch (\Throwable $e) {
                    $pubDate = now();
                }

                $parsed[] = [
                    'title' => $title,
                    'link' => $link,
                    'pubDate' => $pubDate,
                    'source' => $sourceName ?: 'Virudhunagar News',
                    'description' => trim($description),
                    'lang' => $lang,
                ];

                $count++;
            }

            return $parsed;
        } catch (\Throwable $e) {
            Log::warning('Error parsing Virudhunagar RSS feed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Auto-detect category based on headline keywords
     */
    protected function detectCategory(string $text): string
    {
        $text = mb_strtolower($text);

        if (str_contains($text, 'விவசாய') || str_contains($text, 'உழவர்') || str_contains($text, 'மழை') || str_contains($text, 'பயிர்') || str_contains($text, 'farmer') || str_contains($text, 'agriculture') || str_contains($text, 'விவசாயி')) {
            return 'Agriculture';
        }
        if (str_contains($text, 'குடிநீர்') || str_contains($text, 'சாலை') || str_contains($text, 'மின்சாரம்') || str_contains($text, 'கால்வாய்') || str_contains($text, 'பாலம்') || str_contains($text, 'மெட்ரோ') || str_contains($text, 'ரயில்') || str_contains($text, 'water') || str_contains($text, 'road') || str_contains($text, 'துறை')) {
            return 'Infrastructure';
        }
        if (str_contains($text, 'ஆட்சியர்') || str_contains($text, 'கலெக்டர்') || str_contains($text, 'அரசு') || str_contains($text, 'திட்டம்') || str_contains($text, 'நலத்திட்டம்') || str_contains($text, 'collector') || str_contains($text, 'scheme') || str_contains($text, 'மனு') || str_contains($text, 'நிதி')) {
            return 'Civic Welfare';
        }
        if (str_contains($text, 'பட்டாசு') || str_contains($text, 'தீப்பெட்டி') || str_contains($text, 'வணிக') || str_contains($text, 'தொழில்') || str_contains($text, 'வேலைவாய்ப்பு') || str_contains($text, 'textile') || str_contains($text, 'industry') || str_contains($text, 'business') || str_contains($text, 'sipcot')) {
            return 'Industry & Trade';
        }
        if (str_contains($text, 'பள்ளி') || str_contains($text, 'கல்லூரி') || str_contains($text, 'மருத்துவ') || str_contains($text, 'ஆரோக்கிய') || str_contains($text, 'hospital') || str_contains($text, 'school') || str_contains($text, 'health')) {
            return 'Education & Health';
        }

        return 'General News';
    }
}
