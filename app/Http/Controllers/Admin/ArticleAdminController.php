<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ArticleAdminController extends Controller
{
    public function index()
    {
        $search = request('search');

        $articles = Article::with(['category', 'user'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        $todayCount = Article::whereDate('created_at', today())->count();

        // FIX: growth rate dihitung nyata
        $thisMonth = Article::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)->count();
        $lastMonth = Article::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth > 0) {
            $growthRate = round((($thisMonth - $lastMonth) / $lastMonth) * 100);
        } elseif ($thisMonth > 0) {
            $growthRate = 100;
        } else {
            $growthRate = 0;
        }
        $growthLabel = ($growthRate >= 0 ? '+' : '') . $growthRate . '%';
        $growthColor = $growthRate >= 0 ? '#10b981' : '#dc2626';

        return view('admin.articles.index', compact(
            'articles',
            'search',
            'todayCount',
            'growthLabel',
            'growthColor'
        ));
    }

    public function create(): \Illuminate\View\View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->input('category_id'),
            'title'       => $request->input('title'),
            'slug'        => $this->generateUniqueSlug($request->input('title')),
            'image'       => $imagePath,
            'content'     => Article::sanitizeContent($request->input('content')),
        ]);

        Cache::forget('nav_categories');

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(int $id): \Illuminate\View\View
    {
        $article    = Article::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $article->image;

        // FIX #7: fitur hapus gambar tanpa upload baru
        if ($request->boolean('remove_image') && $imagePath) {
            Storage::disk('public')->delete($imagePath);
            $imagePath = null;
        }

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $newSlug = $article->title !== $request->input('title')
            ? $this->generateUniqueSlug($request->input('title'), $article->id)
            : $article->slug;

        $article->update([
            'category_id' => $request->input('category_id'),
            'title'       => $request->input('title'),
            'slug'        => $newSlug,
            'image'       => $imagePath,
            'content'     => Article::sanitizeContent($request->input('content')),
        ]);

        Cache::forget('nav_categories');

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $article = Article::findOrFail($id);
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        Cache::forget('nav_categories');

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    private function generateUniqueSlug(string $title, ?int $exceptId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 1;

        while (
            Article::where('slug', $slug)
            ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
            ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
