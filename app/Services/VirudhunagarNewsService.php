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
     * Google News RSS Search Feed URLs for Virudhunagar
     */
    protected string $tamilFeedUrl = 'https://news.google.com/rss/search?q=Virudhunagar+விருதுநகர்&hl=ta&gl=IN&ceid=IN:ta';
    protected string $englishFeedUrl = 'https://news.google.com/rss/search?q=Virudhunagar&hl=en-IN&gl=IN&ceid=IN:en';

    /**
     * Synchronize latest Virudhunagar news into public_updates table.
     * Throttled with a 30-minute cache lock to ensure high performance.
     */
    public function syncLatestNews(bool $force = false, int $limit = 25): int
    {
        $cacheKey = 'virudhunagar_news_last_sync_time';

        if (!$force && Cache::has($cacheKey) && PublicUpdate::count() > 0) {
            return 0; // Already synced recently
        }

        $items = $this->fetchFromRss($this->tamilFeedUrl, 'ta', $limit);
        
        // Also fetch English items if needed
        $enItems = $this->fetchFromRss($this->englishFeedUrl, 'en', 10);
        $allItems = array_merge($items, $enItems);

        $savedCount = 0;

        foreach ($allItems as $item) {
            if (empty($item['title']) || empty($item['link'])) {
                continue;
            }

            // Check if article with this link or title already exists
            $existing = PublicUpdate::where('source_url', $item['link'])
                ->orWhere('title_ta', $item['title'])
                ->orWhere('title_en', $item['title'])
                ->first();

            $category = $this->detectCategory($item['title'] . ' ' . $item['description']);

            if (!$existing) {
                PublicUpdate::create([
                    'title_en' => $item['lang'] === 'en' ? $item['title'] : ($item['title'] . ' (' . ($item['source'] ?? 'Virudhunagar News') . ')'),
                    'title_ta' => $item['lang'] === 'ta' ? $item['title'] : $item['title'],
                    'content_en' => !empty($item['description']) ? $item['description'] : 'Latest news update reported from Virudhunagar District via ' . ($item['source'] ?? 'News Media') . '.',
                    'content_ta' => !empty($item['description']) ? $item['description'] : 'விருதுநகர் மாவட்டத்தில் இருந்து ' . ($item['source'] ?? 'செய்தி ஊடகம்') . ' வெளியிட்ட சமீபத்திய தகவல்.',
                    'category' => $category,
                    'source_name' => $item['source'] ?? 'News Portal',
                    'source_url' => $item['link'],
                    'published_at' => $item['pubDate'],
                    'is_active' => true,
                ]);
                $savedCount++;
            }
        }

        // Cache sync time for 30 minutes
        Cache::put($cacheKey, now()->toDateTimeString(), 1800);

        return $savedCount;
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

            // Disable libxml errors display, handle internally
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

                // Source extraction: Google News titles often end with " - SourceName"
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

        if (str_contains($text, 'விவசாய') || str_contains($text, 'உழவர்') || str_contains($text, 'மழை') || str_contains($text, 'பயிர்') || str_contains($text, 'farmer') || str_contains($text, 'agriculture')) {
            return 'Agriculture';
        }
        if (str_contains($text, 'குடிநீர்') || str_contains($text, 'சாலை') || str_contains($text, 'மின்சாரம்') || str_contains($text, 'கால்வாய்') || str_contains($text, 'water') || str_contains($text, 'road')) {
            return 'Infrastructure';
        }
        if (str_contains($text, 'ஆட்சியர்') || str_contains($text, 'கலெக்டர்') || str_contains($text, 'அரசு') || str_contains($text, 'திட்டம்') || str_contains($text, 'collector') || str_contains($text, 'scheme')) {
            return 'Civic Welfare';
        }
        if (str_contains($text, 'பட்டாசு') || str_contains($text, 'தீப்பெட்டி') || str_contains($text, 'வணிக') || str_contains($text, 'தொழில்') || str_contains($text, 'industry') || str_contains($text, 'business')) {
            return 'Industry & Trade';
        }

        return 'General News';
    }
}
