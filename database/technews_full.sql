-- =========================================================
-- TechNews - Portal Berita Teknologi
-- SQL Import untuk Hosting (phpMyAdmin)
-- =========================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";
SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Tabel: migrations
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: password_reset_tokens
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: sessions
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: cache
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: categories
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: articles
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_user_id_foreign` (`user_id`),
  KEY `articles_category_id_foreign` (`category_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- DATA AWAL
-- =========================================================

-- Admin user (password: password)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin TechNews', 'admin@technews.com', NOW(), '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW());

-- Kategori
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Artificial Intelligence', 'artificial-intelligence', NOW(), NOW()),
(2, 'Gadget', 'gadget', NOW(), NOW()),
(3, 'Programming', 'programming', NOW(), NOW()),
(4, 'Cyber Security', 'cyber-security', NOW(), NOW()),
(5, 'Software', 'software', NOW(), NOW());

-- Artikel sample
INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `slug`, `image`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Revolusi AI dalam Kehidupan Sehari-hari', 'revolusi-ai-dalam-kehidupan-sehari-hari', NULL,
'<p>Bagaimana integrasi model bahasa besar dan visi komputer mulai mengubah cara kita bekerja, berinteraksi, dan memecahkan masalah kompleks setiap hari.</p><h2>Era Baru Kecerdasan Buatan</h2><p>Kecerdasan buatan telah berkembang jauh melampaui ekspektasi para peneliti dekade lalu. Model-model bahasa besar seperti GPT, Claude, dan Gemini kini mampu memahami konteks percakapan yang kompleks, menghasilkan konten berkualitas tinggi, dan bahkan membantu dalam pengambilan keputusan strategis bisnis.</p><p>Di bidang kesehatan, AI telah membantu dokter dalam mendiagnosis penyakit dengan akurasi yang lebih tinggi. Di sektor keuangan, algoritma machine learning mendeteksi penipuan dalam hitungan milidetik. Bahkan di dunia seni, AI generatif menciptakan karya visual dan musik yang mengesankan.</p><h2>Tantangan yang Dihadapi</h2><p>Namun, revolusi ini tidak tanpa tantangan. Isu etika seputar privasi data, bias algoritmik, dan dampak terhadap lapangan kerja menjadi perdebatan hangat di berbagai forum global. Regulasi AI yang komprehensif masih terus dikembangkan oleh berbagai negara.</p>',
DATE_SUB(NOW(), INTERVAL 12 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY)),

(2, 1, 2, 'Review Gadget Terbaru: Flagship yang Mengubah Standar Kamera', 'review-gadget-terbaru-flagship-yang-mengubah-standar-kamera', NULL,
'<p>Smartphone flagship tahun ini hadir dengan sensor kamera yang belum pernah ada sebelumnya, menghadirkan kualitas foto setara kamera profesional di genggaman tangan.</p><h2>Spesifikasi Kamera Revolusioner</h2><p>Dengan sensor 1-inch yang dilengkapi teknologi computational photography terbaru, smartphone ini mampu menghasilkan foto dengan dynamic range yang luar biasa bahkan dalam kondisi cahaya rendah. Fitur zoom periskop 10x memberikan detail yang tajam dari jarak jauh tanpa distorsi.</p><p>Video 8K dengan stabilisasi optis generasi keempat memastikan setiap momen terekam dengan sempurna. Mode sinematik yang ditingkatkan memungkinkan pengguna menciptakan karya videografi berkualitas profesional hanya dengan sentuhan jari.</p>',
DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY)),

(3, 1, 3, 'Tips Programming 2024: Framework yang Wajib Dikuasai', 'tips-programming-2024-framework-yang-wajib-dikuasai', NULL,
'<p>Dunia pemrograman terus berkembang dengan cepat. Berikut adalah framework dan teknologi yang wajib dikuasai oleh setiap developer di tahun 2024 untuk tetap relevan di industri.</p><h2>Frontend: React vs Vue vs Svelte</h2><p>React masih mendominasi pasar dengan ekosistem yang matang dan komunitas yang besar. Namun, Vue terus menunjukkan pertumbuhan yang signifikan, terutama di Asia Tenggara. Svelte muncul sebagai alternatif yang menarik dengan pendekatan compile-time yang inovatif.</p><h2>Backend: Laravel dan Node.js</h2><p>Laravel tetap menjadi pilihan utama untuk pengembangan web dengan PHP. Framework ini menawarkan ekosistem yang lengkap mulai dari ORM Eloquent, sistem antrian, hingga real-time broadcasting. Di sisi lain, Node.js dengan Express dan NestJS semakin populer untuk membangun API yang scalable.</p>',
DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY)),

(4, 1, 4, 'Ancaman Siber Baru Menargetkan Infrastruktur Cloud Global', 'ancaman-siber-baru-menargetkan-infrastruktur-cloud-global', NULL,
'<p>Para peneliti keamanan siber telah mengidentifikasi serangkaian serangan canggih yang menargetkan infrastruktur cloud dari berbagai penyedia layanan besar di seluruh dunia.</p><h2>Modus Operandi Penyerang</h2><p>Serangan ini menggunakan teknik supply chain attack yang memanfaatkan kerentanan dalam dependensi pihak ketiga. Dengan menyisipkan kode berbahaya ke dalam library yang banyak digunakan, penyerang berhasil mendapatkan akses ke ribuan sistem sekaligus.</p><p>Teknik lateral movement yang digunakan sangat canggih, memungkinkan penyerang bergerak diam-diam dalam jaringan selama berbulan-bulan tanpa terdeteksi oleh sistem keamanan konvensional.</p>',
DATE_SUB(NOW(), INTERVAL 6 DAY), DATE_SUB(NOW(), INTERVAL 6 DAY)),

(5, 1, 5, 'Optimasi Software: Mengurangi Latensi hingga 40%', 'optimasi-software-mengurangi-latensi-hingga-40-persen', NULL,
'<p>Tim engineering dari beberapa perusahaan teknologi terkemuka berbagi strategi dan teknik yang telah terbukti efektif dalam mengurangi latensi aplikasi secara signifikan.</p><h2>Database Query Optimization</h2><p>Salah satu penyebab utama latensi tinggi adalah query database yang tidak optimal. Penggunaan indeks yang tepat, query caching, dan teknik denormalisasi yang bijak dapat mengurangi waktu respons database hingga 60%.</p><h2>Caching Strategy</h2><p>Implementasi strategi caching berlapis menggunakan Redis untuk in-memory caching dan CDN untuk static assets telah terbukti mengurangi beban server secara drastis. Teknik cache warming dan cache invalidation yang cerdas memastikan data selalu fresh tanpa mengorbankan performa.</p>',
DATE_SUB(NOW(), INTERVAL 4 DAY), DATE_SUB(NOW(), INTERVAL 4 DAY)),

(6, 1, 1, 'Kolaborasi Manusia dan Mesin di Era Industri 5.0', 'kolaborasi-manusia-dan-mesin-di-era-industri-5-0', NULL,
'<p>Industri 5.0 membawa paradigma baru: bukan lagi tentang menggantikan manusia dengan mesin, melainkan menciptakan sinergi yang menghasilkan output lebih baik dari keduanya.</p><h2>Human-Centric Automation</h2><p>Berbeda dengan Industri 4.0 yang berfokus pada otomasi penuh, Industri 5.0 menempatkan manusia sebagai pusat dari proses produksi. Robot kolaboratif atau cobot dirancang untuk bekerja berdampingan dengan pekerja manusia, mengambil alih tugas-tugas yang repetitif dan berbahaya.</p><p>Dengan pendekatan ini, kreativitas dan kemampuan pemecahan masalah manusia dapat dipadukan dengan kecepatan dan presisi mesin, menghasilkan produktivitas yang jauh melebihi kemampuan keduanya secara terpisah.</p>',
DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),

(7, 1, 2, 'Teknologi Audio Spasial Terbaru: Pengalaman Imersif Tanpa Batas', 'teknologi-audio-spasial-terbaru-pengalaman-imersif-tanpa-batas', NULL,
'<p>Teknologi audio spasial telah mencapai tingkat kecanggihan baru yang menghadirkan pengalaman mendengarkan yang benar-benar imersif, seolah suara hadir di sekitar kita.</p><h2>Head-Related Transfer Function (HRTF)</h2><p>Teknologi HRTF yang dipersonalisasi menggunakan data dari bentuk telinga unik setiap pengguna menciptakan pengalaman audio 3D yang jauh lebih akurat dan natural dibandingkan generasi sebelumnya.</p><h2>Aplikasi di Berbagai Bidang</h2><p>Teknologi ini tidak hanya relevan untuk hiburan. Di bidang medis, audio spasial digunakan untuk terapi gangguan pendengaran. Dalam gaming, menciptakan immersion yang belum pernah ada sebelumnya. Di dunia pendidikan, memungkinkan simulasi lingkungan belajar yang lebih efektif.</p>',
DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY));

-- Migrations records
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000000_create_users_table', 1),
('2024_01_01_000001_create_categories_table', 1),
('2024_01_01_000002_create_articles_table', 1),
('2024_01_01_000003_create_cache_table', 1);

COMMIT;
