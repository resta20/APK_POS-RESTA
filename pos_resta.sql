-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.8.8-MariaDB - MariaDB Server
-- Server OS:                    Win64
-- HeidiSQL Version:             12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos_resta
CREATE DATABASE IF NOT EXISTS `pos_resta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `pos_resta`;

-- Dumping structure for table pos_resta.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.cache: ~0 rows (approximately)

-- Dumping structure for table pos_resta.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos_resta.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos_resta.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.item_penjualan: ~4 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(2, 2, 1, 1, 50000, 50000, '2026-09-10 19:05:18', '2026-09-10 19:05:18'),
	(3, 3, 1, 1, 50000, 50000, '2026-09-10 19:42:43', '2026-09-10 19:42:43'),
	(4, 4, 1, 1, 50000, 50000, '2026-09-10 19:43:55', '2026-09-10 19:43:55'),
	(5, 5, 1, 2, 50000, 100000, '2026-09-10 19:51:17', '2026-09-10 19:51:21');

-- Dumping structure for table pos_resta.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_user_id_foreign` (`user_id`),
  CONSTRAINT `jenis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.jenis: ~2 rows (approximately)
INSERT INTO `jenis` (`id`, `user_id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Celana', '2026-09-10 19:01:57', '2026-09-10 23:13:25'),
	(2, 1, 'Baju', '2026-09-10 23:41:43', '2026-09-11 22:31:31');

-- Dumping structure for table pos_resta.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos_resta.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.jobs: ~0 rows (approximately)

-- Dumping structure for table pos_resta.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.migrations: ~11 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_04_19_000003_create_jenis_table', 1),
	(6, '2026_04_20_073452_create_produk_table', 1),
	(7, '2026_04_20_074544_create_penjualan_table', 1),
	(8, '2026_04_21_010558_create_item_penjualan_table', 1),
	(9, '2026_07_31_041732_add_soft_deletes_to_produk_table', 1),
	(10, '2026_09_11_000000_add_uang_diterima_kolom_to_penjualan_table', 2),
	(11, '2026_09_11_060714_add_is_active_to_produk_table', 3);

-- Dumping structure for table pos_resta.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos_resta.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `uang_diterima` bigint(20) unsigned DEFAULT NULL,
  `kembalian` bigint(20) unsigned DEFAULT NULL,
  `status` enum('OPEN','COMPLETED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.penjualan: ~5 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `uang_diterima`, `kembalian`, `status`, `created_at`, `updated_at`) VALUES
	(2, 1, 50000, 'CASH', NULL, NULL, 'COMPLETED', '2026-09-10 19:05:15', '2026-09-10 19:06:03'),
	(3, 1, 50000, 'CASH', 100000, 50000, 'COMPLETED', '2026-09-10 19:40:31', '2026-09-10 19:43:17'),
	(4, 1, 50000, 'QRIS', NULL, NULL, 'COMPLETED', '2026-09-10 19:43:33', '2026-09-10 19:44:01'),
	(5, 1, 100000, 'QRIS', NULL, NULL, 'COMPLETED', '2026-09-10 19:44:19', '2026-09-10 19:51:37'),
	(14, 1, 0, 'CASH', NULL, NULL, 'OPEN', '2026-09-13 08:08:19', '2026-09-13 08:08:19');

-- Dumping structure for table pos_resta.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `jenis_id` bigint(20) unsigned DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_jenis_id_foreign` (`jenis_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.produk: ~10 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `jenis_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 'produk/aeC55zj7RBzSzOOxR3Ag4c65Elty9ImjyfpfrTt6.jpg', 'Celana Begy  Polkadot White', 50000, 75000, 5, 0, '2026-09-10 19:03:30', '2026-09-11 22:05:43', NULL),
	(4, 1, 1, 'produk/kyzARaaYCaunhseR7Zof6wIH4HUnAJPotlX5r73x.jpg', 'Celana Begy Polkadot Choco', 50000, 75000, 15, 1, '2026-09-10 23:34:56', '2026-09-11 22:06:54', NULL),
	(6, 1, 1, 'produk/LTd0J4ZFEZoVKA5DOoZJlYxTo7YQSXWHVizUYMSm.jpg', 'Celana Begy Bunga', 50000, 75000, 10, 1, '2026-09-10 23:37:55', '2026-09-13 07:57:47', NULL),
	(7, 1, 1, 'produk/QLpEbmB5y3VEeLQMVXiwmKKx2Ix1Qo2htWx2IxvA.jpg', 'Celana Begy Polkadot Pink', 50000, 75000, 10, 1, '2026-09-10 23:39:32', '2026-09-11 22:10:53', NULL),
	(8, 1, 1, 'produk/4XvyUvC0Ow30X4IeHrcukOYP9cEkdEB2iMAgmj5M.jpg', 'Celana Begy Panda', 50000, 75000, 10, 1, '2026-09-10 23:42:45', '2026-09-11 22:14:52', NULL),
	(9, 1, 2, 'produk/10zEgQhx592PJ4Hq39yWvB96YCNSi3cgtfuF5Sws.jpg', 'Cardigan Polkadot pink', 40000, 65000, 10, 1, '2026-09-10 23:48:57', '2026-09-11 22:17:08', NULL),
	(10, 1, 2, 'produk/jAfJ3YzEN0PmkYR1b1rmXlId7v6cwim8pA0e9XVy.jpg', 'Sweater Stripe Pink', 45000, 70000, 10, 1, '2026-09-10 23:53:15', '2026-09-11 22:18:38', NULL),
	(11, 1, 2, 'produk/slRuJSdsN27HMMZRpMgnmSLbFZJH5SJUSwR1GPyG.jpg', 'Kemeja Putih Rayon Motif', 65000, 85000, 6, 1, '2026-09-10 23:55:01', '2026-09-11 22:19:22', NULL),
	(12, 1, 2, 'produk/D5fVO8cHPA5WeAyRQNxRmkl2OOHstiGqDssEktXw.jpg', 'Sweater Pink Bunga', 45000, 68000, 7, 1, '2026-09-10 23:57:02', '2026-09-11 22:20:33', NULL),
	(14, 1, 2, 'produk/zv4NaIp1xtBvn4bA6pRse261RbZXrrI86lNcYlA1.jpg', 'Sweater Love', 45000, 65000, 10, 1, '2026-09-11 22:32:37', '2026-09-11 22:32:37', NULL);

-- Dumping structure for table pos_resta.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-09-10 19:00:19', '2026-09-10 19:00:19'),
	(2, 'kasir', '2026-09-10 19:00:19', '2026-09-10 19:00:19');

-- Dumping structure for table pos_resta.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Vk0TY83IAvL5PPr69UKkBflcgjtHPwOlqTV5eocZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHlsZUVWR0wwZDBmVm1uUWxNcUxvS0NCOXVhTTlDSURUYWlFaWpaUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1789312107);

-- Dumping structure for table pos_resta.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_resta.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Restadwilestari', 'restadwilestari0@gmail.com', '2026-09-10 19:00:19', '$2y$12$/0RNH5WtyZaHBd1LQKmnvOcSRnU0t9qcGUNS8aJnbQUi60vRjBP/u', 'hfJSXYcwK8LeZrpMr4lmFYpT9I2a5be8csznKV51ZuGUWt0i83ISIMG5vHNq', '2026-09-10 19:00:19', '2026-09-10 20:14:09'),
	(2, 2, 'nazwamaulida', 'nazwamaulida@gmail.com', '2026-09-10 19:00:19', '$2y$12$dux51H8uIOt/8CqKOfyEaeQBJeadqalxdtVlpQ4mt7IDvw7G8Hp6O', 'Xtx0jOUHi3fMcWNGXPN5Krg3PB6ZPcFBdT1KgMrDXXl5VQDtFCV06fCfCizr', '2026-09-10 19:00:19', '2026-09-11 22:30:57'),
	(6, 1, 'zahraafifah', 'zahraafifah@example.com', '2026-09-10 19:00:19', '$2y$12$LL5Z2QFZy80yuAJ/zAvNXupjRB/YdZuSOAPaAAbbOeCXJrG.IcfMS', 'hdnXD3Wzne', '2026-09-10 19:00:19', '2026-09-10 20:16:20');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
