@extends('layouts.public')

@section('title', $article->title . ' - TechNews')
@section('description', $article->excerpt)

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 64px;">
    <div class="article-detail-grid">
        <article>
            {{-- Breadcrumb & meta --}}
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px; font-size:13px; color:#6b7280;">
                <a href="{{ route('category', $article->category->slug) }}"
                   style="background:#dbeafe; color:#2563eb; padding:3px 10px; border-radius:4px; font-weight:600; font-size:12px;">
                    {{ $article->category->name }}
                </a>
                <span>•</span>
                <span>{{ $article->read_time }} MIN READ</span>
            </div>

            <h1 style="font-size:36px; font-weight:800; line-height:1.2; color:#0f172a; margin-bottom:20px;">
                {{ $article->title }}
            </h1>

            {{-- Author --}}
            <div style="display:flex; align-items:center; gap:12px; padding:16px 0; border-top:1px solid #e5e7eb; border-bottom:1px solid #e5e7eb; margin-bottom:28px;">
                <div style="width:40px; height:40px; border-radius:50%; background:#2563eb; display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:16px; flex-shrink:0;">
                    {{ strtoupper(substr($article->user->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight:600; font-size:14px;">{{ $article->user->name }}</div>
                    <div style="font-size:13px; color:#6b7280;">
                        {{ \Carbon\Carbon::parse($article->created_at)->isoFormat('DD MMMM YYYY') }}
                    </div>
                </div>
            </div>

            {{-- Featured image --}}
            @if($article->image)
            <div style="margin-bottom:28px; border-radius:12px; overflow:hidden;">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                     style="width:100%; max-height:480px; object-fit:cover;">
            </div>
            @endif

            {{-- Content --}}
            <div class="article-content">
                {!! $article->content !!}
            </div>

            {{-- Share bar --}}
            <div style="display:flex; align-items:center; gap:12px; margin-top:40px; padding:20px 0; border-top:1px solid #e5e7eb; border-bottom:1px solid #e5e7eb;">
                <span style="font-size:13px; color:#6b7280; font-weight:500;">Bagikan:</span>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                   target="_blank"
                   style="display:flex; align-items:center; gap:6px; padding:8px 16px; border-radius:6px; background:#1da1f2; color:white; font-size:13px; font-weight:500;">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                   target="_blank"
                   style="display:flex; align-items:center; gap:6px; padding:8px 16px; border-radius:6px; background:#1877f2; color:white; font-size:13px; font-weight:500;">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
            </div>
        </article>

        {{-- Sidebar --}}
        <aside style="position: sticky; top: 80px;">
            {{-- Berita Terkait --}}
            <div style="background:#f9fafb; border-radius:12px; padding:24px;">
                <h3 style="font-size:16px; font-weight:700; margin-bottom:20px; padding-bottom:12px; border-bottom:2px solid #e5e7eb;">
                    Berita Terkait
                </h3>
                @forelse($related as $rel)
                <div style="display:flex; gap:12px; margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #e5e7eb;">
                    @if($rel->image)
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}"
                             style="width:80px; height:60px; object-fit:cover; border-radius:6px; flex-shrink:0;">
                    @else
                        <div style="width:80px; height:60px; background:#dbeafe; border-radius:6px; flex-shrink:0; display:flex; align-items:center; justify-content:center; color:#2563eb;">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    @endif
                    <div>
                        <span style="font-size:10px; font-weight:600; color:#2563eb; text-transform:uppercase; letter-spacing:.5px;">{{ $rel->category->name }}</span>
                        <h4 style="font-size:13px; font-weight:600; line-height:1.4; margin-top:2px;">
                            <a href="{{ route('article.show', $rel->slug) }}" style="color:#0f172a;">{{ $rel->title }}</a>
                        </h4>
                        <span style="font-size:11px; color:#9ca3af;">
                            {{ \Carbon\Carbon::parse($rel->created_at)->isoFormat('DD MMM YYYY') }}
                        </span>
                    </div>
                </div>
                @empty
                <p style="font-size:13px; color:#9ca3af;">Tidak ada berita terkait.</p>
                @endforelse
            </div>
        </aside>
    </div>
</div>

@push('styles')
<style>
.article-detail-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 48px;
    align-items: start;
}
.article-content { font-size: 16px; line-height: 1.8; color: #1f2937; }
.article-content h2 { font-size: 22px; font-weight: 700; margin: 28px 0 12px; color: #0f172a; }
.article-content h3 { font-size: 18px; font-weight: 600; margin: 24px 0 10px; }
.article-content p { margin-bottom: 16px; }
.article-content blockquote {
    border-left: 4px solid #2563eb; padding: 16px 20px; background: #eff6ff;
    border-radius: 0 8px 8px 0; margin: 24px 0; font-style: italic; color: #374151;
}
.article-content ul, .article-content ol { padding-left: 24px; margin-bottom: 16px; }
.article-content li { margin-bottom: 6px; }
.article-content img { border-radius: 8px; margin: 16px 0; }
@media(max-width:768px) {
    .article-detail-grid { grid-template-columns: 1fr; }
    h1[style*="36px"] { font-size: 24px !important; }
}
</style>
@endpush
@endsection
