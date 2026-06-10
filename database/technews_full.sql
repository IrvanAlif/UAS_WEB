-- =========================================================
-- TechNews - Portal Berita Teknologi
-- SQL Import untuk Hosting (phpMyAdmin)
-- =========================================================
-- PENTING: Sebelum import ke production, ganti password hash
-- di bawah dengan hash baru menggunakan:
--   php artisan tinker
--   >>> \Hash::make('password_baru_kamu')
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

-- FIX: Hash di bawah ini adalah PLACEHOLDER.
-- WAJIB diganti sebelum production dengan:
--   php artisan tinker → \Hash::make('password_baru')
-- Hash default '$2y$12$92IXUNpkjO0...' adalah hash publik yang diketahui semua developer Laravel!
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin TechNews', 'admin@technews.com', NOW(), 'GANTI_DENGAN_HASH_BARU', 'admin', NOW(), NOW());

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
'<p>Bagaimana integrasi model bahasa besar dan visi komputer mulai mengubah cara kita bekerja, berinteraksi, dan memecahkan masalah kompleks setiap hari.</p><h2>Era Baru Kecerdasan Buatan</h2><p>Kecerdasan buatan telah berkembang jauh melampaui ekspektasi para peneliti dekade lalu.</p>',
DATE_SUB(NOW(), INTERVAL 12 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY)),
(2, 1, 2, 'Review Gadget Terbaru: Flagship yang Mengubah Standar Kamera', 'review-gadget-terbaru-flagship-yang-mengubah-standar-kamera', NULL,
'<p>Smartphone flagship tahun ini hadir dengan sensor kamera yang belum pernah ada sebelumnya.</p>',
DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY)),
(3, 1, 3, 'Tips Programming 2024: Framework yang Wajib Dikuasai', 'tips-programming-2024-framework-yang-wajib-dikuasai', NULL,
'<p>Dunia pemrograman terus berkembang dengan cepat.</p>',
DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY)),
(4, 1, 4, 'Ancaman Siber Baru Menargetkan Infrastruktur Cloud Global', 'ancaman-siber-baru-menargetkan-infrastruktur-cloud-global', NULL,
'<p>Para peneliti keamanan siber telah mengidentifikasi serangkaian serangan canggih.</p>',
DATE_SUB(NOW(), INTERVAL 6 DAY), DATE_SUB(NOW(), INTERVAL 6 DAY)),
(5, 1, 5, 'Optimasi Software: Mengurangi Latensi hingga 40%', 'optimasi-software-mengurangi-latensi-hingga-40-persen', NULL,
'<p>Tim engineering berbagi strategi yang terbukti efektif mengurangi latensi aplikasi.</p>',
DATE_SUB(NOW(), INTERVAL 4 DAY), DATE_SUB(NOW(), INTERVAL 4 DAY)),
(6, 1, 1, 'Kolaborasi Manusia dan Mesin di Era Industri 5.0', 'kolaborasi-manusia-dan-mesin-di-era-industri-5-0', NULL,
'<p>Industri 5.0 membawa paradigma baru tentang sinergi manusia dan mesin.</p>',
DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),
(7, 1, 2, 'Teknologi Audio Spasial Terbaru: Pengalaman Imersif Tanpa Batas', 'teknologi-audio-spasial-terbaru-pengalaman-imersif-tanpa-batas', NULL,
'<p>Teknologi audio spasial mencapai tingkat kecanggihan baru yang benar-benar imersif.</p>',
DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY));

-- Migrations records
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000000_create_users_table', 1),
('2024_01_01_000001_create_categories_table', 1),
('2024_01_01_000002_create_articles_table', 1),
('2024_01_01_000003_create_cache_table', 1);

COMMIT;