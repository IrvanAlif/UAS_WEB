@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

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

    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label class="form-label">Judul Artikel <span style="color:#dc2626;">*</span></label>
            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                   value="{{ old('title', $article->title) }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Kategori <span style="color:#dc2626;">*</span></label>
            <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Gambar</label>
            @if($article->image)
            <div style="margin-bottom: 10px;">
                <img src="{{ $article->image_url }}" style="max-width:200px; max-height:120px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;">
                <div style="font-size:12px; color:#6b7280; margin-top:4px;">Gambar saat ini</div>
            </div>
            @endif
            <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                   accept="image/*" onchange="previewImage(this)">
            <div class="form-hint">Kosongkan jika tidak ingin mengganti gambar.</div>
            <img id="imgPreview" class="img-preview">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Konten Artikel <span style="color:#dc2626;">*</span></label>
            <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                      rows="12" required>{{ old('content', $article->content) }}</textarea>
            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary">Batal</a>
            <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="btn-secondary">
                <i class="fas fa-eye"></i> Lihat
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
