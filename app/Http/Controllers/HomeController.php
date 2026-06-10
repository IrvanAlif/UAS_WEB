<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Article::with(['category', 'user'])->latest()->first();
        $articles = Article::with(['category', 'user'])->latest()->skip(1)->take(6)->get();
        $categories = Category::withCount('articles')->get();
        $carouselArticles = Article::with(['category', 'user'])->latest()->take(5)->get();

        return view('public.home', compact('featured', 'articles', 'categories', 'carouselArticles'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->latest()->paginate(9);
        $categories = Category::withCount('articles')->get();

        return view('public.category', compact('category', 'articles', 'categories'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q', '');
        $articles = Article::with(['category', 'user'])
            ->where('title', 'like', "%$q%")
            ->orWhere('content', 'like', "%$q%")
            ->latest()->paginate(9);
        $categories = Category::withCount('articles')->get();

        return view('public.search', compact('articles', 'categories', 'q'));
    }
}
