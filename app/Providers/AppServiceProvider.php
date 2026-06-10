<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useTailwind();

        // FIX: cache navCategories 1 jam agar tidak query tiap request
        View::composer('layouts.public', function ($view) {
            $navCategories = Cache::remember('nav_categories', 3600, function () {
                return Category::orderBy('name')->get();
            });
            $view->with('navCategories', $navCategories);
        });
    }
}
