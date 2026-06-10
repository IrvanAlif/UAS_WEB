@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')

@section('topbar-action')
<a href="{{ route('admin.articles.create') }}" class="btn-new">
    <i class="fas fa-plus"></i> Tambah Artikel
</a>
@endsection

@section('content')

{{-- Stats --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px;">
    <div style="background:white; border:1px solid #e5e7eb; border-radius:10px; padding:20px;">
        <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#6b7280; margin-bottom:6px;">Total Published</div>
        <div style="font-size:28px; font-weight:800;">{{ $articles->total() }}</div>
    </div>
    <div style="background:white; border:1px solid #e5e7eb; border-radius:10px; padding:20px;">
        <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#f97316; margin-bottom:6px;">Artikel Hari Ini</div>
        <div style="font-size:28px; font-weight:800;">{{ \App\Models\Article::whereDate('created_at', today())->count() }}</div>
    </div>
    <div style="background:white; border:1px solid #e5e7eb; border-radius:10px; padding:20px;">
        <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; color:#10b981; margin-bottom:6px;">Growth Rate</div>
        <div style="font-size:28px; font-weight:800; color:#10b981;">+12%</div>
    </div>
</div>

{{-- Search alert -- letakkan DI SINI, di atas tabel --}}
@if(request('search'))
<div class="alert alert-success" style="margin-bottom: 16px;">
    <i class="fas fa-search"></i>
    Hasil pencarian "<strong>{{ request('search') }}</strong>" —
    {{ $articles->total() }} artikel ditemukan.
    <a href="{{ route('admin.articles.index') }}" style="margin-left: 8px; color: #065f46; font-weight: 600;">
        × Hapus filter
    </a>
</div>
@endif

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width:50px;"></th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th style="width:100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr>
                <td>
                    @if($article->image)
                    <img src="{{ $article->image_url }}" style="width:44px; height:44px; object-fit:cover; border-radius:6px;">
                    @else
                    <div style="width:44px; height:44px; background:#dbeafe; border-radius:6px; display:flex; align-items:center; justify-content:center; color:#2563eb;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600; font-size:14px;">{{ \Str::limit($article->title, 60) }}</div>
                    <div style="font-size:12px; color:#9ca3af; margin-top:2px;">By {{ $article->user->name }}</div>
                </td>
                <td>
                    <span class="badge" style="background:#dbeafe; color:#1d4ed8;">{{ $article->category->name }}</span>
                </td>
                <td style="font-size:13px; color:#6b7280;">
                    {{ \Carbon\Carbon::parse($article->created_at)->isoFormat('DD MMM YYYY') }}
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}"
                            onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:48px; color:#9ca3af;">
                    <i class="fas fa-newspaper" style="font-size:32px; display:block; margin-bottom:12px;"></i>
                    @if(request('search'))
                    Tidak ada artikel dengan kata kunci "{{ request('search') }}".
                    @else
                    Belum ada artikel. <a href="{{ route('admin.articles.create') }}" style="color:#2563eb;">Tambah sekarang</a>
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($articles->hasPages())
    <div style="padding: 16px 24px; border-top: 1px solid #e5e7eb;">
        <div style="display:flex; justify-content:space-between; align-items:center; font-size:13px; color:#6b7280;">
            <span>Menampilkan {{ $articles->firstItem() }}-{{ $articles->lastItem() }} dari {{ $articles->total() }} artikel</span>
            {{ $articles->links() }}
        </div>
    </div>
    @endif
</div>
@endsection