<?php

namespace App\Http\Controllers;

use App\Services\GNewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected GNewsService $newsService;

    public function __construct(GNewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        $headlines = $this->newsService->getTopHeadlines('general', 'ar', 10);
        $techNews = $this->newsService->getTopHeadlines('technology', 'ar', 5);
        $sportsNews = $this->newsService->getTopHeadlines('sports', 'ar', 5);
        $businessNews = $this->newsService->getTopHeadlines('business', 'ar', 5);
        $categories = $this->newsService->getCategories();

        return view('news.index', compact('headlines', 'techNews', 'sportsNews', 'businessNews', 'categories'));
    }

    public function category(string $category)
    {
        $categories = $this->newsService->getCategories();

        if (!array_key_exists($category, $categories)) {
            abort(404);
        }

        $news = $this->newsService->getTopHeadlines($category, 'ar', 10);
        $categoryName = $categories[$category]['name'];
        $categoryIcon = $categories[$category]['icon'];

        return view('news.category', compact('news', 'category', 'categoryName', 'categoryIcon', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categories = $this->newsService->getCategories();
        $results = ['totalArticles' => 0, 'articles' => []];

        if ($query) {
            $results = $this->newsService->search($query, 'ar', 10);
        }

        return view('news.search', compact('results', 'query', 'categories'));
    }

    public function show(Request $request)
    {
        $url = $request->input('url');
        $title = $request->input('title', 'مقال إخباري');
        $categories = $this->newsService->getCategories();

        if (!$url) {
            abort(404);
        }

        return view('news.show', compact('url', 'title', 'categories'));
    }
}
