@extends('layouts.public')

@section('title', $category->name . ' - TechNews')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 64px;">
    <div style="margin-bottom: 32px;">
        <div style="font-size:12px; color:#9ca3af; margin-bottom:8px;">
            <a href="{{ route('home') }}">Home</a> / Kategori / {{ $category->name }}
        </div>
        <h1 style="font-size:30px; font-weight:800;">{{ $category->name }}</h1>
        <p style="color:#6b7280; margin-top:6px;">{{ $articles->total() }} artikel ditemukan</p>
    </div>

    <div class="articles-grid">
        @forelse($articles as $article)
        <article class="article-card">
            <a href="{{ route('article.show', $article->slug) }}">
                @if($article->image)
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-card-img">
                @else
                    <div class="article-card-img-placeholder"><i class="fas fa-newspaper"></i></div>
                @endif
            </a>
            <div class="article-card-body">
                <div class="article-card-date">{{ \Carbon\Carbon::parse($article->created_at)->isoFormat('DD MMM YYYY') }}</div>
                <h3 class="article-card-title">
                    <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                </h3>
                <p class="article-card-excerpt">{{ $article->excerpt }}</p>
            </div>
        </article>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:64px; color:#9ca3af;">
            <i class="fas fa-newspaper" style="font-size:48px; display:block; margin-bottom:16px;"></i>
            Belum ada artikel di kategori ini.
        </div>
        @endforelse
    </div>

    {{ $articles->links() }}
</div>
@endsection
