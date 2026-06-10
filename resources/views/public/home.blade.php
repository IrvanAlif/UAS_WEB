@extends('layouts.public')

@section('title', 'TechNews - Portal Berita Teknologi Terkini')

@section('content')

{{-- CAROUSEL --}}
<section class="carousel-section">
    <div class="carousel">
        <div class="carousel-track">
            @forelse($carouselArticles as $slide)
            <div class="carousel-slide">
                @if($slide->image)
                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}">
                @else
                    <div class="carousel-slide-placeholder"></div>
                @endif
                <div class="carousel-content">
                    <span class="carousel-badge">{{ $slide->category->name }}</span>
                    <h2 class="carousel-title">
                        <a href="{{ route('article.show', $slide->slug) }}" style="color:inherit;">
                            {{ $slide->title }}
                        </a>
                    </h2>
                    <p class="carousel-excerpt">{{ $slide->excerpt }}</p>
                </div>
            </div>
            @empty
            <div class="carousel-slide">
                <div class="carousel-slide-placeholder"></div>
                <div class="carousel-content">
                    <h2 class="carousel-title">Selamat Datang di TechNews</h2>
                    <p class="carousel-excerpt">Portal berita teknologi terkini untuk Anda.</p>
                </div>
            </div>
            @endforelse
        </div>

        <button class="carousel-btn prev"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-btn next"><i class="fas fa-chevron-right"></i></button>

        <div class="carousel-dots">
            @foreach($carouselArticles as $i => $slide)
            <div class="carousel-dot {{ $i === 0 ? 'active' : '' }}"></div>
            @endforeach
        </div>
    </div>
</section>

{{-- CATEGORY PILLS --}}
<div class="category-pills">
    <span class="pill-label">Populer:</span>
    @foreach($categories as $cat)
    <a href="{{ route('category', $cat->slug) }}" class="pill">{{ $cat->name }}</a>
    @endforeach
</div>

{{-- LATEST ARTICLES --}}
<div class="container" style="padding-top: 8px; padding-bottom: 64px;">
    <div class="section-header">
        <h2 class="section-title">Berita Terbaru</h2>
        <a href="{{ route('search', ['q' => '']) }}" class="link-more">Lihat Semua <i class="fas fa-arrow-right"></i></a>
    </div>

    <div class="articles-grid">
        @forelse($articles as $article)
        <article class="article-card">
            <a href="{{ route('article.show', $article->slug) }}">
                @if($article->image)
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-card-img">
                @else
                    <div class="article-card-img-placeholder">
                        <i class="fas fa-newspaper"></i>
                    </div>
                @endif
            </a>
            <div class="article-card-body">
                <a href="{{ route('category', $article->category->slug) }}" class="article-card-badge"
                   style="background: {{ ['#2563eb','#7c3aed','#059669','#dc2626','#d97706'][($article->category_id - 1) % 5] }}">
                    {{ $article->category->name }}
                </a>
                <div class="article-card-date">
                    {{ \Carbon\Carbon::parse($article->created_at)->isoFormat('DD MMM YYYY') }}
                </div>
                <h3 class="article-card-title">
                    <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                </h3>
                <p class="article-card-excerpt">{{ $article->excerpt }}</p>
            </div>
        </article>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:48px; color: #6b7280;">
            <i class="fas fa-newspaper" style="font-size:48px; margin-bottom:16px; display:block;"></i>
            Belum ada artikel. <a href="{{ route('admin.articles.create') }}" style="color:#2563eb;">Tambah artikel pertama</a>
        </div>
        @endforelse
    </div>
</div>

@endsection
