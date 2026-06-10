@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('topbar-action')
    <a href="{{ route('admin.categories.create') }}" class="btn-new">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
@endsection

@section('content')
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Jumlah Artikel</th>
                <th>Dibuat</th>
                <th style="width:100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $i => $category)
            <tr>
                <td style="color:#9ca3af; font-size:13px;">{{ $i + 1 }}</td>
                <td>
                    <div style="font-weight:600;">{{ $category->name }}</div>
                </td>
                <td style="font-size:13px; color:#6b7280; font-family:monospace;">{{ $category->slug }}</td>
                <td>
                    <span class="badge" style="background:#d1fae5; color:#065f46;">{{ $category->articles_count }} artikel</span>
                </td>
                <td style="font-size:13px; color:#6b7280;">
                    {{ \Carbon\Carbon::parse($category->created_at)->isoFormat('DD MMM YYYY') }}
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                              onsubmit="return confirm('Hapus kategori ini? Semua artikel di kategori ini juga akan terhapus!')">
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
                <td colspan="6" style="text-align:center; padding:48px; color:#9ca3af;">
                    Belum ada kategori. <a href="{{ route('admin.categories.create') }}" style="color:#2563eb;">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
