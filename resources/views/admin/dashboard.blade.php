@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Overview Dashboard')

@section('topbar-action')
    <a href="{{ route('admin.articles.create') }}" class="btn-new">
        <i class="fas fa-plus"></i> <span>New Post</span>
    </a>
@endsection

@section('content')

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:#dbeafe; color:#2563eb;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <div class="stat-label">Total Artikel</div>
            <div class="stat-value">{{ $totalArticles }}</div>
            <span class="stat-badge" style="background:#d1fae5; color:#065f46;">+12%</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f3e8ff; color:#7c3aed;">
            <i class="fas fa-tags"></i>
        </div>
        <div>
            <div class="stat-label">Total Kategori</div>
            <div class="stat-value">{{ $totalCategories }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7; color:#d97706;">
            <i class="fas fa-star"></i>
        </div>
        <div>
            <div class="stat-label">Artikel Baru</div>
            <div class="stat-value">{{ $todayArticles }}</div>
            <span class="stat-badge" style="background:#fef3c7; color:#92400e;">Hari ini</span>
        </div>
    </div>
</div>

{{-- Dashboard Grid: tabel + popular categories --}}
<div class="dashboard-grid">
    {{-- Latest articles --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">Artikel Terbaru</div>
            <a href="{{ route('admin.articles.index') }}" style="font-size:14px; color:#2563eb; font-weight:500;">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestArticles as $article)
                    <tr>
                        <td>
                            <a href="{{ route('article.show', $article->slug) }}" target="_blank"
                               style="font-weight:600; color:#111827; font-size:14px;">
                                {{ \Str::limit($article->title, 45) }}
                            </a>
                        </td>
                        <td>
                            <span class="badge" style="background:#dbeafe; color:#1d4ed8;">{{ $article->category->name }}</span>
                        </td>
                        <td style="color:#6b7280; font-size:13px;">
                            {{ \Carbon\Carbon::parse($article->created_at)->isoFormat('DD MMM YYYY') }}
                        </td>
                    </tr>
                    @endforeach
                    @if($latestArticles->isEmpty())
                    <tr>
                        <td colspan="3" style="text-align:center; color:#9ca3af; padding:32px;">Belum ada artikel</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Popular categories --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">Kategori Populer</div>
        </div>
        <div style="padding: 16px;">
            @foreach($popularCategories as $i => $cat)
            <div style="display:flex; align-items:center; gap:12px; padding:12px; border-radius:8px; {{ $i === 0 ? 'background:#eff6ff;' : '' }} margin-bottom:4px;">
                <span style="font-weight:700; color:#6b7280; width:24px; font-size:14px;">#{{ $i + 1 }}</span>
                <div style="flex:1;">
                    <div style="font-size:15px; font-weight:600;">{{ $cat->name }}</div>
                    <div style="font-size:12px; color:#9ca3af;">{{ $cat->articles_count }} Artikel</div>
                </div>
            </div>
            @endforeach

            <a href="{{ route('admin.categories.index') }}"
               style="display:block; text-align:center; margin-top:16px; padding:10px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; font-weight:500; color:#374151;">
                Kelola Semua Kategori
            </a>
        </div>
    </div>
</div>

@endsection
