<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalCategories = Category::count();
        $todayArticles = Article::whereDate('created_at', today())->count();
        $latestArticles = Article::with(['category', 'user'])->latest()->take(5)->get();
        $popularCategories = Category::withCount('articles')->orderByDesc('articles_count')->take(3)->get();

        return view('admin.dashboard', compact(
            'totalArticles', 'totalCategories', 'todayArticles',
            'latestArticles', 'popularCategories'
        ));
    }
}
