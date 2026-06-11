<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles    = Article::count();
        $totalCategories  = Category::count();
        $todayArticles    = Article::whereDate('created_at', today())->count();
        $latestArticles   = Article::with(['category', 'user'])->latest()->take(5)->get();
        $popularCategories = Category::withCount('articles')->orderByDesc('articles_count')->take(3)->get();

        // FIX: hitung growth rate artikel bulan ini vs bulan lalu
        $thisMonth  = Article::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        $lastMonth  = Article::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        if ($lastMonth > 0) {
            $growthRate = round((($thisMonth - $lastMonth) / $lastMonth) * 100);
        } elseif ($thisMonth > 0) {
            $growthRate = 100; // bulan lalu 0, bulan ini ada = 100%
        } else {
            $growthRate = 0;
        }

        $growthLabel = ($growthRate >= 0 ? '+' : '') . $growthRate . '%';
        $growthColor = $growthRate >= 0 ? '#065f46' : '#991b1b';
        $growthBg    = $growthRate >= 0 ? '#d1fae5' : '#fee2e2';

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalCategories',
            'todayArticles',
            'latestArticles',
            'popularCategories',
            'growthLabel',
            'growthColor',
            'growthBg'
        ));
    }
}
