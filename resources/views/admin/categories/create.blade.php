@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="form-card" style="max-width: 480px;">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Kategori <span style="color:#dc2626;">*</span></label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name') }}" placeholder="cth: Artificial Intelligence" required autofocus>
            <div class="form-hint">Slug akan dibuat otomatis dari nama kategori.</div>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
