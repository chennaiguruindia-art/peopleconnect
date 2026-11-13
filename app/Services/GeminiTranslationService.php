<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiTranslationService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
        $this->model = config('services.gemini.model', env('GEMINI_MODEL', 'gemini-3.1-flash-lite'));
    }

    /**
     * Translate a single text string using Gemini API.
     * Caches result forever to avoid redundant API hits.
     */
    public function translate(string $text, string $targetLang = 'en', string $sourceLang = 'ta'): string
    {
        $text = trim($text);
        if (empty($text) || $targetLang === $sourceLang) {
            return $text;
        }

        $cacheKey = "gemini_trans_{$sourceLang}_{$targetLang}_" . md5($text);

        return Cache::rememberForever($cacheKey, function () use ($text, $targetLang, $sourceLang) {
            return $this->callGeminiApi($text, $targetLang, $sourceLang);
        });
    }

    /**
     * Translate a batch of text strings in a single Gemini API call.
     */
    public function translateBatch(array $texts, string $targetLang = 'en', string $sourceLang = 'ta'): array
    {
        if (empty($texts) || $targetLang === $sourceLang) {
            return $texts;
        }

        $results = [];
        $uncached = [];
        $uncachedKeys = [];

        foreach ($texts as $key => $text) {
            $trimmed = trim((string) $text);
            if ($trimmed === '') {
                $results[$key] = $text;
                continue;
            }

            $cacheKey = "gemini_trans_{$sourceLang}_{$targetLang}_" . md5($trimmed);
            if (Cache::has($cacheKey)) {
                $results[$key] = Cache::get($cacheKey);
            } else {
                $uncached[$key] = $trimmed;
                $uncachedKeys[$key] = $cacheKey;
            }
        }

        if (empty($uncached)) {
            return $results;
        }

        // Call Gemini for uncached items
        try {
            $langNames = ['ta' => 'Tamil', 'en' => 'English', 'hi' => 'Hindi', 'te' => 'Telugu'];
            $srcName = $langNames[$sourceLang] ?? $sourceLang;
            $tgtName = $langNames[$targetLang] ?? $targetLang;

            $jsonInput = json_encode(array_values($uncached), JSON_UNESCAPED_UNICODE);
            $prompt = "You are a high accuracy translator for an Indian civic grievance portal. Translate each item in the following JSON array from {$srcName} to {$tgtName}. Return ONLY a valid JSON array of translated strings with the exact same count and order. No markdown, no commentary, no backticks.\nInput: {$jsonInput}";

            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::timeout(15)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $raw = $response->json('candidates.0.content.parts.0.text');
                $cleaned = trim($raw);
                // Strip possible markdown fences
                if (str_starts_with($cleaned, '```json')) {
                    $cleaned = substr($cleaned, 7);
                } elseif (str_starts_with($cleaned, '```')) {
                    $cleaned = substr($cleaned, 3);
                }
                if (str_ends_with($cleaned, '```')) {
                    $cleaned = substr($cleaned, 0, -3);
                }
                $cleaned = trim($cleaned);

                $decoded = json_decode($cleaned, true);
                if (is_array($decoded) && count($decoded) === count($uncached)) {
                    $i = 0;
                    foreach ($uncached as $origKey => $origVal) {
                        $translated = $decoded[$i];
                        $results[$origKey] = $translated;
                        Cache::forever($uncachedKeys[$origKey], $translated);
                        $i++;
                    }
                    return $results;
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Gemini batch translation error: ' . $e->getMessage());
        }

        // Fallback: translate individually or return original
        foreach ($uncached as $origKey => $origVal) {
            $results[$origKey] = $this->translate($origVal, $targetLang, $sourceLang);
        }

        return $results;
    }

    /**
     * Direct API invocation.
     */
    protected function callGeminiApi(string $text, string $targetLang, string $sourceLang): string
    {
        try {
            $langNames = ['ta' => 'Tamil', 'en' => 'English', 'hi' => 'Hindi', 'te' => 'Telugu'];
            $srcName = $langNames[$sourceLang] ?? $sourceLang;
            $tgtName = $langNames[$targetLang] ?? $targetLang;

            $prompt = "You are a professional translator for a Tamil Nadu civic grievance platform. Translate the following text from {$srcName} to {$tgtName}. Keep the tone respectful, official and accurate. Output ONLY the translated text, no quotes, no extra explanations:\n\n{$text}";

            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::timeout(12)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $output = $response->json('candidates.0.content.parts.0.text');
                if (!empty($output)) {
                    return trim($output);
                }
            } else {
                Log::warning('Gemini API call returned non-200: ' . $response->status() . ' - ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::warning('Gemini API call failed: ' . $e->getMessage());
        }

        // If translation call fails, return original text safely
        return $text;
    }
}
