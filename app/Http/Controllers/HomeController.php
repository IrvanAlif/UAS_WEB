<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured        = Article::with(['category', 'user'])->latest()->first();
        $carouselArticles = Article::with(['category', 'user'])->latest()->take(5)->get();
        // skip artikel yang sudah ada di carousel agar tidak duplikat di grid
        $carouselIds     = $carouselArticles->pluck('id');
        $articles        = Article::with(['category', 'user'])
            ->whereNotIn('id', $carouselIds)
            ->latest()->take(6)->get();
        $categories      = Category::withCount('articles')->get();

        return view('public.home', compact('featured', 'articles', 'categories', 'carouselArticles'));
    }

    public function category($slug)
    {
        $category  = Category::where('slug', $slug)->firstOrFail();
        $articles  = Article::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->latest()->paginate(9);
        $categories = Category::withCount('articles')->get();

        return view('public.category', compact('category', 'articles', 'categories'));
    }

    public function search(Request $request)
    {
        $q = trim($request->get('q', ''));

        $articles = Article::with(['category', 'user'])
            ->when($q !== '', function ($query) use ($q) {
                // FIX: wrap orWhere dalam closure agar tidak bocor ke kondisi lain
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(9);

        $categories = Category::withCount('articles')->get();

        return view('public.search', compact('articles', 'categories', 'q'));
    }
}
