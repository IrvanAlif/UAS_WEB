# TechNews - Portal Berita Teknologi

Portal berita teknologi berbasis Laravel dengan fitur carousel, login admin, dan CRUD artikel & kategori.

---

## 🚀 Cara Install & Jalankan (Lokal)

### Prasyarat
- PHP >= 8.2
- MySQL / MariaDB
- Composer
- Node.js (opsional, untuk build assets)

### Langkah Instalasi

**1. Clone atau extract project ini ke folder htdocs/www**
```bash
# Jika dari git
git clone <repo_url> technews
cd technews
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Copy file .env**
```bash
cp .env.example .env
```

**4. Generate App Key**
```bash
php artisan key:generate
```

**5. Konfigurasi Database**
Buka file `.env` dan sesuaikan:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=berita_teknologi
DB_USERNAME=root
DB_PASSWORD=
```

**6. Buat database & import struktur**
```bash
# Buat database di phpMyAdmin atau via MySQL:
mysql -u root -p -e "CREATE DATABASE berita_teknologi;"

# Jalankan migrasi
php artisan migrate

# Atau import SQL dari file berita_teknologi.sql
# mysql -u root -p berita_teknologi < berita_teknologi.sql
```

**7. Jalankan seeder (data sample)**
```bash
php artisan db:seed
```

**8. Buat symlink storage**
```bash
php artisan storage:link
```

**9. Jalankan server**
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 🔑 Akun Default
| Email | Password | Role |
|-------|----------|------|
| admin@technews.com | password | Admin |

---

## 🌐 Cara Deploy ke Hosting (cPanel / DirectAdmin)

### 1. Upload Files
- Upload **semua file project** ke `public_html/` (atau subfolder, cth: `public_html/technews/`)
- Pastikan folder `public/` Laravel ada di dalam folder web root

### 2. Konfigurasi Document Root
Di cPanel → **Domains / Subdomains** → arahkan document root ke folder `public/` project Laravel:
```
/home/username/public_html/technews/public
```

Atau jika tidak bisa, pindahkan isi folder `public/` ke `public_html/` dan edit `index.php`:
```php
// Ubah path ini di public/index.php
require __DIR__.'/../vendor/autoload.php';
// Jika public/ dipindah ke root, sesuaikan path ke ..
```

### 3. Buat Database di Hosting
- Masuk cPanel → **MySQL Databases**
- Buat database: `berita_teknologi`
- Buat user MySQL dan assign ke database
- Import file `berita_teknologi.sql` via phpMyAdmin

### 4. Konfigurasi .env di Hosting
Edit file `.env`:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainanda.com

DB_HOST=localhost
DB_DATABASE=username_beritateknologi
DB_USERNAME=username_dbuser
DB_PASSWORD=password_db
```

### 5. Jalankan Artisan Commands
Via SSH atau Terminal di cPanel:
```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Permission Folder
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 644 .env
```

---

## 📁 Struktur Halaman

### Public
| URL | Halaman |
|-----|---------|
| `/` | Home dengan carousel |
| `/artikel/{slug}` | Detail berita |
| `/kategori/{slug}` | Berita per kategori |
| `/search?q=keyword` | Pencarian |

### Admin (Login required)
| URL | Halaman |
|-----|---------|
| `/login` | Halaman login |
| `/admin/dashboard` | Dashboard overview |
| `/admin/articles` | Kelola artikel (CRUD) |
| `/admin/categories` | Kelola kategori (CRUD) |

---

## ✨ Fitur
- ✅ Carousel/slider berita utama (5 slide, auto-rotate)
- ✅ Login admin dengan session
- ✅ CRUD Artikel (tambah, edit, hapus, list)
- ✅ CRUD Kategori
- ✅ Upload gambar artikel
- ✅ Filter berita per kategori
- ✅ Pencarian artikel
- ✅ Halaman detail artikel dengan berita terkait
- ✅ Responsive design
- ✅ Pagination
- ✅ 7 artikel & 5 kategori sample

---

## 🛠 Tech Stack
- **Laravel 12** (PHP Framework)
- **MySQL** (Database)
- **Blade Templates** (View engine)
- **Vanilla CSS** (Styling, no framework)
- **Font Awesome 6** (Icons)
- **Google Fonts Inter** (Typography)
