<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::with(['category', 'user'])->where('slug', $slug)->firstOrFail();
        $related = Article::with(['category', 'user'])
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()->take(3)->get();
        $categories = Category::withCount('articles')->get();

        return view('public.show', compact('article', 'related', 'categories'));
    }
}
