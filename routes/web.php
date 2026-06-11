<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/kategori/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

// FIX: throttle login — max 5 percobaan per menit per IP
Route::post('/login', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes — FIX: tambah middleware 'admin' untuk role check
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Articles CRUD
    Route::get('/articles',             [ArticleAdminController::class, 'index'])->name('articles.index');
    Route::get('/articles/create',      [ArticleAdminController::class, 'create'])->name('articles.create');
    Route::post('/articles',            [ArticleAdminController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit',   [ArticleAdminController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}',        [ArticleAdminController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}',     [ArticleAdminController::class, 'destroy'])->name('articles.destroy');

    // Categories CRUD
    Route::get('/categories',           [CategoryAdminController::class, 'index'])->name('categories.index');
    Route::get('/categories/create',    [CategoryAdminController::class, 'create'])->name('categories.create');
    Route::post('/categories',          [CategoryAdminController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryAdminController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}',      [CategoryAdminController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}',   [CategoryAdminController::class, 'destroy'])->name('categories.destroy');
});
