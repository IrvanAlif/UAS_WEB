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
            {{-- FIX #7: tampilkan gambar saat ini + opsi hapus --}}
            <div id="currentImageBox" style="margin-bottom: 12px; padding: 12px; background:#f9fafb; border-radius:8px; border:1px solid #e5e7eb;">
                <div style="font-size:12px; color:#6b7280; margin-bottom:8px; font-weight:600;">GAMBAR SAAT INI</div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <img src="{{ $article->image_url }}"
                        style="width:100px; height:70px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
                    <div>
                        <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:13px; color:#dc2626; font-weight:500;">
                            <input type="checkbox" name="remove_image" id="removeImage" value="1"
                                {{ old('remove_image') ? 'checked' : '' }}
                                onchange="toggleRemoveImage(this)">
                            Hapus gambar ini
                        </label>
                        <div style="font-size:11px; color:#9ca3af; margin-top:4px;">
                            Centang untuk menghapus gambar tanpa menggantinya.
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div id="uploadBox">
                <input type="file" name="image" id="imageInput"
                    class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                    onchange="previewImage(this)">
                <div class="form-hint">
                    @if($article->image)
                    Upload gambar baru untuk mengganti. Kosongkan jika tidak ingin mengubah.
                    @else
                    Format: JPG, PNG, WebP. Maksimal 2MB.
                    @endif
                </div>
                <img id="imgPreview" class="img-preview">
            </div>

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
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // FIX: kalau centang "hapus gambar", disable input upload
    function toggleRemoveImage(checkbox) {
        const uploadBox = document.getElementById('uploadBox');
        const imageInput = document.getElementById('imageInput');
        const imgPreview = document.getElementById('imgPreview');

        if (checkbox.checked) {
            imageInput.disabled = true;
            imageInput.value = '';
            imgPreview.style.display = 'none';
            uploadBox.style.opacity = '0.4';
            uploadBox.style.pointerEvents = 'none';
        } else {
            imageInput.disabled = false;
            uploadBox.style.opacity = '1';
            uploadBox.style.pointerEvents = 'auto';
        }
    }

    // Jalankan saat load kalau old('remove_image') tercentang
    document.addEventListener('DOMContentLoaded', function() {
        const cb = document.getElementById('removeImage');
        if (cb && cb.checked) toggleRemoveImage(cb);
    });
</script>
@endpush
@endsection