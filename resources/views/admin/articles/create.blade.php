@extends('layouts.admin')

@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel Baru')

@section('content')
<div class="form-card">
    @if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0; padding-left:16px;">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Judul Artikel <span style="color:#dc2626;">*</span></label>
            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                   value="{{ old('title') }}" placeholder="Masukkan judul artikel...">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Kategori <span style="color:#dc2626;">*</span></label>
            <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                   accept="image/*" onchange="previewImage(this)">
            <div class="form-hint">Format: JPG, PNG, WebP. Maksimal 2MB.</div>
            <img id="imgPreview" class="img-preview">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Konten Artikel <span style="color:#dc2626;">*</span></label>
            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                      rows="12" placeholder="Tulis konten artikel di sini... (HTML diperbolehkan)">{{ old('content') }}</textarea>
            <div class="form-hint">Anda bisa menggunakan tag HTML: &lt;h2&gt;, &lt;p&gt;, &lt;strong&gt;, &lt;blockquote&gt;, &lt;ul&gt;, &lt;ol&gt;</div>
            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Artikel
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
