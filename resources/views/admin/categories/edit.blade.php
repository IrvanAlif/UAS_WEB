@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="form-card" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Kategori <span style="color:#dc2626;">*</span></label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name', $category->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Slug saat ini</label>
            <input type="text" value="{{ $category->slug }}" class="form-control" disabled
                   style="background:#f9fafb; color:#6b7280;">
            <div class="form-hint">Slug akan diperbarui otomatis.</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
