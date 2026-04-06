<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GNewsService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gnews.api_key');
        $this->baseUrl = config('services.gnews.base_url');
    }

    public function getTopHeadlines(string $category = 'general', string $lang = 'ar', int $max = 10): array
    {
        $cacheKey = "headlines_{$category}_{$lang}_{$max}";

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($category, $lang, $max) {
            $response = Http::get("{$this->baseUrl}/top-headlines", [
                'apikey' => $this->apiKey,
                'category' => $category,
                'lang' => $lang,
                'max' => $max,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return ['totalArticles' => 0, 'articles' => []];
        });
    }

    public function search(string $query, string $lang = 'ar', int $max = 10): array
    {
        $cacheKey = "search_" . md5($query) . "_{$lang}_{$max}";

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($query, $lang, $max) {
            $response = Http::get("{$this->baseUrl}/search", [
                'apikey' => $this->apiKey,
                'q' => $query,
                'lang' => $lang,
                'max' => $max,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return ['totalArticles' => 0, 'articles' => []];
        });
    }

    public function getCategories(): array
    {
        return [
            'general' => ['name' => 'عام', 'icon' => 'bi-globe2'],
            'world' => ['name' => 'دولي', 'icon' => 'bi-globe'],
            'nation' => ['name' => 'محلي', 'icon' => 'bi-flag'],
            'business' => ['name' => 'أعمال', 'icon' => 'bi-briefcase'],
            'technology' => ['name' => 'تكنولوجيا', 'icon' => 'bi-cpu'],
            'entertainment' => ['name' => 'ترفيه', 'icon' => 'bi-film'],
            'sports' => ['name' => 'رياضة', 'icon' => 'bi-trophy'],
            'science' => ['name' => 'علوم', 'icon' => 'bi-rocket-takeoff'],
            'health' => ['name' => 'صحة', 'icon' => 'bi-heart-pulse'],
        ];
    }
}
