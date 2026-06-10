<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'image', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/placeholder.svg');
    }

    public function getExcerptAttribute(): string
    {
        return \Str::limit(strip_tags($this->content), 120);
    }

    /**
     * FIX: str_word_count tidak akurat untuk bahasa Indonesia
     * (hanya hitung ASCII words). Ganti dengan mb_str_word_count sederhana.
     */
    public function getReadTimeAttribute(): int
    {
        $text      = strip_tags($this->content);
        // Hitung kata dengan split whitespace — lebih akurat untuk bahasa Indonesia
        $wordCount = count(preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY));
        return max(1, (int) ceil($wordCount / 200));
    }

    /**
     * FIX: Sanitasi konten HTML sebelum disimpan untuk mencegah XSS.
     * Gunakan ini di controller sebelum save/update jika tidak pakai HTMLPurifier.
     * Tag yang diizinkan: heading, paragraf, list, blockquote, bold, italic, link, gambar.
     */
    public static function sanitizeContent(string $content): string
    {
        $allowed = '<h2><h3><p><strong><em><b><i><u><ul><ol><li><blockquote><a><img><br><hr>';
        $clean   = strip_tags($content, $allowed);

        // Hapus atribut berbahaya (onclick, onerror, javascript:, dsb)
        $clean = preg_replace('/\s*on\w+\s*=\s*"[^"]*"/i', '', $clean);
        $clean = preg_replace('/\s*on\w+\s*=\s*\'[^\']*\'/i', '', $clean);
        $clean = preg_replace('/javascript\s*:/i', '', $clean);

        return $clean;
    }
}
