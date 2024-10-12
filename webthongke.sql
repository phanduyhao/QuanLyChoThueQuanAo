-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2024 lúc 08:28 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webthongke`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('omurr2313ay@example.com|127.0.0.1', 'i:1;', 1726911299),
('omurr2313ay@example.com|127.0.0.1:timer', 'i:1726911299;', 1726911299);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `cate_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `cate_name`, `desc`, `Xoa`, `created_at`, `updated_at`) VALUES
(1, 'Đồ uống', 'test', NULL, '2024-09-22 23:17:21', '2024-09-22 23:17:21'),
(2, 'Đồ uống', 'test', 1, '2024-09-22 23:17:21', '2024-09-22 23:19:20'),
(3, 'Đồ uống', 'test', 1, '2024-09-22 23:17:36', '2024-09-22 23:19:05'),
(4, 'Đồ uống', 'test', 1, '2024-09-22 23:17:36', '2024-09-22 23:19:00'),
(5, 'Đồ uống2', 'test', NULL, '2024-09-22 23:19:33', '2024-09-22 23:19:33'),
(6, 'fdf', 'dg', NULL, '2024-09-23 08:41:21', '2024-09-23 08:41:21'),
(7, 'fdfu65', 'dg', NULL, '2024-09-23 09:15:41', '2024-09-23 09:15:41'),
(8, 'fdfu65', 'dg', 1, '2024-09-23 09:15:41', '2024-09-23 09:25:22'),
(9, 'fdfu65123123', 'dg', NULL, '2024-09-23 09:25:27', '2024-09-23 09:25:27'),
(10, 'fdfu65123123', 'dg', NULL, '2024-09-23 09:25:27', '2024-09-23 09:25:27'),
(11, 'fdfu65123123dfsdf', 'dg', NULL, '2024-09-23 09:32:31', '2024-09-23 09:32:31'),
(12, 'fdfu65123123dfsdfưeewf', 'dg', NULL, '2024-09-23 09:33:33', '2024-09-23 09:33:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chothues`
--

CREATE TABLE `chothues` (
  `id` bigint UNSIGNED NOT NULL,
  `id_customer` bigint UNSIGNED DEFAULT NULL,
  `id_product` bigint UNSIGNED DEFAULT NULL,
  `id_kho` bigint UNSIGNED DEFAULT NULL,
  `soluongconlai` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `so_ngay_thue` int DEFAULT NULL,
  `thanh_tien` decimal(10,2) DEFAULT NULL,
  `khach_coc` decimal(10,2) DEFAULT NULL,
  `id_nhanvien` bigint UNSIGNED DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `trangthai` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chothues`
--

INSERT INTO `chothues` (`id`, `id_customer`, `id_product`, `id_kho`, `soluongconlai`, `quantity`, `so_ngay_thue`, `thanh_tien`, `khach_coc`, `id_nhanvien`, `Xoa`, `trangthai`, `created_at`, `updated_at`) VALUES
(29, 19, 1, 2, 0, 2, 3, 60000.00, 30000.00, 1, NULL, 0, '2024-10-11 09:12:19', '2024-10-11 10:22:37'),
(30, 19, 1, 2, 0, 1, 3, 30000.00, 20000.00, 1, NULL, 0, '2024-10-11 09:15:17', '2024-10-11 10:22:33'),
(31, 19, 1, 6, 2, 2, 3, 60000.00, 20000.00, 1, NULL, 1, '2024-10-11 09:29:41', '2024-10-11 10:19:08'),
(32, 19, 1, 6, -1, 1, 3, 30000.00, 20000.00, 1, NULL, 1, '2024-10-11 19:16:43', '2024-10-11 19:16:43'),
(33, 19, 6, 8, -4, 4, 3, 678.00, 500.00, 1, 1, 1, '2024-10-12 00:54:23', '2024-10-12 01:28:18'),
(34, 19, 1, 6, -1, 1, 3, 30000.00, 15000.00, 1, NULL, 1, '2024-10-12 00:56:48', '2024-10-12 00:56:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chothue_products`
--

CREATE TABLE `chothue_products` (
  `id` bigint UNSIGNED NOT NULL,
  `id_chothue` bigint UNSIGNED DEFAULT NULL,
  `id_product_theokho` bigint UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `thanh_tien` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `Xoa`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Jasper VonRueden II', 'yortiz@example.com', '+1-323-596-9087', NULL, NULL, NULL),
(2, 'Elaina Mann', 'zulauf.darryl@example.com', '912.871.6755', NULL, NULL, NULL),
(3, 'Kyleigh Hand IV', 'emmerich.nicholaus@example.net', '1-938-752-3657', NULL, NULL, NULL),
(4, 'Yazmin Streich', 'harris.meda@example.net', '+1-283-282-0576', NULL, NULL, NULL),
(5, 'Bradley Keebler Jr.', 'destini.batz@example.com', '(303) 417-1235', NULL, NULL, NULL),
(6, 'Keegan Kirlin DVM', 'csmith@example.net', '1-267-421-5282', NULL, NULL, NULL),
(7, 'Mrs. Agnes Wisoky Sr.', 'zokuneva@example.org', '1-541-291-6008', 1, NULL, '2024-09-22 10:26:31'),
(8, 'Vallie Ernser', 'madyson89@example.com', '772.282.0910', NULL, NULL, NULL),
(9, 'Americo Hoppe', 'dietrich.althea@example.org', '757-930-9558', NULL, NULL, NULL),
(10, 'Prof. Nedra Batz III', 'rosinski@example.net', '+1.986.944.5871', NULL, NULL, NULL),
(11, 'Delia Harvey', 'brandyn62@example.com', '1-813-962-4389', NULL, NULL, NULL),
(12, 'Margarita Brown II', 'lkozey@example.org', '+18562308543', NULL, NULL, NULL),
(13, 'Dr. Pablo Yundt', 'schoen.verna@example.net', '352-673-6032', NULL, NULL, NULL),
(14, 'Skye Hackett', 'zleuschke@example.org', '+19703551408', NULL, NULL, NULL),
(15, 'Prof. Hillard McDermott I', 'maiya.hand@example.org', '+1-650-453-2789', 1, NULL, '2024-09-22 10:26:32'),
(16, 'Phan Duy Hào132', 'test@example.com', '0904848855', NULL, '2024-09-22 10:24:28', '2024-09-22 10:24:28'),
(17, 'Phan Duy Hào2', NULL, '1234567890', NULL, '2024-09-27 08:45:22', '2024-09-27 08:45:22'),
(18, 'Phan Duy Hào123123', NULL, '0344848855', NULL, '2024-09-30 11:22:33', '2024-09-30 11:22:33'),
(19, 'Phan Duy Hào', NULL, '0855840100', NULL, '2024-10-07 21:39:40', '2024-10-07 21:39:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanhthus`
--

CREATE TABLE `doanhthus` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kho` bigint UNSIGNED DEFAULT NULL,
  `id_chothue` bigint UNSIGNED DEFAULT NULL,
  `doanh_thu_thuc_te` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doanh_thu_du_kien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `doanhthus`
--

INSERT INTO `doanhthus` (`id`, `id_kho`, `id_chothue`, `doanh_thu_thuc_te`, `doanh_thu_du_kien`, `created_at`, `updated_at`) VALUES
(18, 2, 29, '60000.00', '60000.00', '2024-09-11 09:12:19', '2024-10-11 10:21:28'),
(19, 2, 30, '30000.00', '30000.00', '2024-10-11 09:15:17', '2024-10-11 10:22:32'),
(20, 6, 31, '20000.00', '60000.00', '2024-10-11 09:29:41', '2024-10-11 09:33:57'),
(21, 6, 32, '20000', '30000.00', '2024-10-11 19:16:43', '2024-10-11 19:16:43'),
(22, 8, 33, '500', '678.00', '2024-10-12 00:54:23', '2024-10-12 00:54:23'),
(23, 6, 34, '15000', '30000.00', '2024-10-12 00:56:49', '2024-10-12 00:56:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khos`
--

CREATE TABLE `khos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_product` bigint UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khos`
--

INSERT INTO `khos` (`id`, `title`, `id_product`, `quantity`, `desc`, `Xoa`, `created_at`, `updated_at`) VALUES
(2, 'Kho 1', 1, 3, NULL, NULL, '2024-09-24 09:20:15', '2024-09-24 09:20:15'),
(3, 'Kho 2', 1, 3, NULL, 1, '2024-09-24 09:22:16', '2024-09-24 09:30:17'),
(4, 'Kho 2', 1, 5, NULL, 1, '2024-09-24 09:31:40', '2024-10-04 08:11:53'),
(5, 'kho 1', 1, 3, NULL, 1, '2024-10-04 06:36:53', '2024-10-04 06:37:01'),
(6, 'kho 2', 1, 4, NULL, NULL, '2024-10-04 18:51:38', '2024-10-04 18:51:38'),
(7, 'Kho 1', 2, 10, NULL, NULL, '2024-10-11 09:42:45', '2024-10-11 09:42:45'),
(8, 'Kho 2', 6, 5, NULL, NULL, '2024-10-11 09:52:19', '2024-10-11 09:52:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_19_153824_create_role', 2),
(5, '2024_09_19_153244_update_user', 3),
(6, '2024_09_19_155705_update_user', 4),
(7, '2024_09_19_163433_create_categories', 5),
(8, '2024_09_19_185835_create_products', 6),
(9, '2024_09_20_143607_create_khos_table', 7),
(10, '2024_09_20_150750_create_customers_table', 8),
(11, '2024_09_20_144312_create_chothues_table', 9),
(12, '2024_09_20_151628_create_nhapkhos_table', 10),
(13, '2024_09_20_162153_create_doanhthus_table', 10),
(14, '2024_09_22_090750_update_user', 11),
(15, '2024_09_24_155915_update_kho', 12),
(16, '2024_09_26_161205_update_kho', 13),
(17, '2024_09_27_154615_create_chothue__products_table', 14),
(18, '2024_10_03_172335_chothue__product__update', 15),
(19, '2024_10_03_181353_chothue__product__update', 16),
(20, '2024_10_11_135939_update_kho', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap_khos`
--

CREATE TABLE `nhap_khos` (
  `id` bigint UNSIGNED NOT NULL,
  `id_thue` bigint UNSIGNED DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT NULL,
  `id_nhanvien` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cate_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `price_1_day` decimal(8,2) DEFAULT NULL,
  `quantity_origin` int DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `cate_id`, `size`, `image`, `price_1_day`, `quantity_origin`, `Xoa`, `created_at`, `updated_at`) VALUES
(1, 'natus', 5, 'XL', 'https://via.placeholder.com/640x480.png/00ff88?text=products+aspernatur', 10000.00, 11, NULL, NULL, '2024-09-29 00:56:59'),
(2, 'et', 5, 'M', 'https://via.placeholder.com/640x480.png/00bb22?text=products+id', 36.85, 38, NULL, NULL, NULL),
(3, 'adipisci', 5, 'S', 'https://via.placeholder.com/640x480.png/000000?text=products+neque', 42.84, 32, 1, NULL, '2024-09-24 11:14:33'),
(4, 'sequi', 5, 'M', 'https://via.placeholder.com/640x480.png/00dd00?text=products+vero', 88.25, 5, NULL, NULL, NULL),
(5, 'aperiam', 5, 'S', 'https://via.placeholder.com/640x480.png/007777?text=products+vitae', 62.49, 13, NULL, NULL, NULL),
(6, 'officiis', 5, 'S', 'https://via.placeholder.com/640x480.png/007722?text=products+quos', 56.50, 69, NULL, NULL, NULL),
(7, 'vel', 5, 'S', 'https://via.placeholder.com/640x480.png/00ff33?text=products+voluptate', 87.19, 10, NULL, NULL, NULL),
(8, 'rerum', 5, 'M', 'https://via.placeholder.com/640x480.png/00bbff?text=products+voluptatibus', 47.36, 87, NULL, NULL, NULL),
(9, 'est', 5, 'M', 'https://via.placeholder.com/640x480.png/00bbee?text=products+maiores', 73.01, 81, NULL, NULL, NULL),
(10, 'perspiciatis', 5, 'XL', 'https://via.placeholder.com/640x480.png/0066dd?text=products+iure', 62.73, 72, NULL, NULL, NULL),
(11, 'sp test', NULL, 'xl', NULL, 50000.00, 4, NULL, '2024-09-23 08:05:04', '2024-09-23 08:05:04'),
(12, 'sp testsfddsf', NULL, 'xl', NULL, 50000.00, 4, 1, '2024-09-23 08:06:10', '2024-09-23 10:28:14'),
(13, 'sp test123', NULL, 'xl', NULL, 132.00, 12, 1, '2024-09-23 08:06:42', '2024-09-23 09:55:42'),
(14, 'sp test123', NULL, 'xl', NULL, 132.00, 12, 1, '2024-09-23 08:06:42', '2024-09-23 09:55:39'),
(15, 'sp test123sfd', NULL, 'xl', NULL, 132.00, 12, 1, '2024-09-23 09:34:19', '2024-09-23 09:55:35'),
(16, 'sp testsfddsf12', NULL, 'xl', NULL, 132.00, 23, 1, '2024-09-23 09:41:35', '2024-09-23 09:55:31'),
(17, 'sp1test', 1, 'xl', 'sp1test.jpg', 132.00, 23, NULL, '2024-09-23 09:43:44', '2024-09-23 10:25:58'),
(18, 'sp121111111', NULL, 'xl', 'sp12.jpg', 132.00, 23, NULL, '2024-09-23 09:59:36', '2024-09-23 10:12:39'),
(19, 'sp123453', 5, 'xl', 'sp123453.jpg', 132.00, 23, NULL, '2024-09-23 10:03:06', '2024-09-23 10:03:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Quản trị viên', NULL, NULL),
(2, 'CTV342', 'Cộng tác viêndsfds', NULL, '2024-09-21 20:01:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('12AU7zUnORgVf9a3WABj6oo6jI1AE9ktyw7QIpqt', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSzYwaWkwT2d6RXM5Uktsa29zZ205a2lhMzRQTzVtS0gwR2p1NEpuUCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vd2Vic2l0ZXRob25na2UudGVzdDo4MDgwL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1728721705),
('4dCkCv0yZATKCdzZzKsHqrWV8nZMryRk4Je4S0xY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHFTR25FZkptcWRwWEx5THljcFZRQmhyeG1oOEFYNTZxdkJiaFVobSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vd2Vic2l0ZXRob25na2UudGVzdDo4MDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1728721195);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Xoa` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `Xoa`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Brigitte Mraz', 'omurray@example.com', '505-702-5320', NULL, '$2y$12$PNgOgmiAhzdEfTWQf6HYV.5qoAdff.8x41I7wjle55td28/vR15ji', 1, 'PFX4TNXFCqPodo8kwvcNAAMaue9MdjBhsTcJj9Ocyt4dIS7zuKCg2N9u14m5', NULL, '2024-09-22 09:40:12', 1),
(2, 'Mr. Keshaun Fay', 'nabernathy@example.com', '1-231-273-7445', NULL, '$2y$12$k94b569L75x0bVqd6miNku2meGRE3Zg.XXrG8BvdTyrcFoZkMdU3a', NULL, NULL, NULL, NULL, 1),
(3, 'Brennon Kulas', 'sipes.coralie@example.com', '(360) 698-4090', NULL, '$2y$12$/wlwMAKrtP2MOIFYqb4jEOkRw.lVKIolNPEeyCdHZ7IpqRvgaeImG', 1, NULL, NULL, '2024-09-22 09:40:11', NULL),
(4, 'Viva Hills', 'garrick21@example.com', '714.865.7276', NULL, '$2y$12$N814w7Dni6Llyh/pipYLPeA//zgU85WbkscmQf5Mrhn8RvQdysbFC', NULL, NULL, NULL, NULL, NULL),
(5, 'Dr. Una Will V', 'gilberto48@example.net', '1-979-876-6730', NULL, '$2y$12$w7QPaIasd7LCkuoaT1a5HOZhfxZxe7p5tQMk5K8hInr7G7gug7vXa', NULL, NULL, NULL, NULL, NULL),
(6, 'Alessandro Schowalter', 'yharris@example.com', '+1.629.844.2761', NULL, '$2y$12$ADcewBtYZPAm9iNTqiNKJeb7KS5WQx/GgjYUBwmSTr0KcO9ovfNte', NULL, NULL, NULL, NULL, NULL),
(7, 'Janie Halvorson', 'dmarquardt@example.com', '930-599-5042', NULL, '$2y$12$cunTqjuq6sN4AqLxno6xd.a95VigTQaqBGSt7.Ome6z9j/uE/6nCG', NULL, NULL, NULL, NULL, NULL),
(8, 'Dr. Mayra Hickle PhD', 'blaise.padberg@example.com', '617-545-4132', NULL, '$2y$12$0Gf9mI6gEz1YAHZ7lpsbLOGIxChKVZLfWPl0HJ6h36sLoFQYe9eZi', NULL, NULL, NULL, NULL, NULL),
(9, 'Dr. Jamison Tromp', 'clindgren@example.com', '559.977.7106', NULL, '$2y$12$l3t0Tlp9eE6gkNCLgVWHauCpkjxDw4JqqOTlxV4MEg0tXkI0lpnAa', 1, NULL, NULL, '2024-09-22 09:40:19', NULL),
(10, 'Gustave Rohan DVM', 'kabshire@example.com', '620.935.8373', NULL, '$2y$12$fpWffkWbLrTZgB43sMcvfubc/dGblI39eeVAGx3guBmRPro3hP0Xy', NULL, NULL, NULL, NULL, NULL),
(11, 'Phan Duy Hào132', 'hao@example.com', '0904848855', NULL, '$2y$12$IhlmxX3G7iY4G2nItsCidupEbwbGBCYR7AdchgeqGlrDEOaxINUOa', NULL, NULL, '2024-09-22 09:16:30', '2024-09-22 09:35:45', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chothues`
--
ALTER TABLE `chothues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chothues_id_product_foreign` (`id_product`),
  ADD KEY `chothues_id_nhanvien_foreign` (`id_nhanvien`),
  ADD KEY `chothues_id_customer_foreign` (`id_customer`),
  ADD KEY `chothues_id_kho_foreign` (`id_kho`);

--
-- Chỉ mục cho bảng `chothue_products`
--
ALTER TABLE `chothue_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chothue_products_id_product_theokho_foreign` (`id_product_theokho`),
  ADD KEY `chothue_products_id_chothue_foreign` (`id_chothue`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`);

--
-- Chỉ mục cho bảng `doanhthus`
--
ALTER TABLE `doanhthus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doanhthus_id_kho_foreign` (`id_kho`),
  ADD KEY `doanhthus_id_chothue_foreign` (`id_chothue`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khos`
--
ALTER TABLE `khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products` (`id_product`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhap_khos`
--
ALTER TABLE `nhap_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhap_khos_id_nhanvien_foreign` (`id_nhanvien`),
  ADD KEY `nhap_khos_id_thue_foreign` (`id_thue`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_cate_id_foreign` (`cate_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `chothues`
--
ALTER TABLE `chothues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `chothue_products`
--
ALTER TABLE `chothue_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `doanhthus`
--
ALTER TABLE `doanhthus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khos`
--
ALTER TABLE `khos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `nhap_khos`
--
ALTER TABLE `nhap_khos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chothues`
--
ALTER TABLE `chothues`
  ADD CONSTRAINT `chothues_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chothues_id_kho_foreign` FOREIGN KEY (`id_kho`) REFERENCES `khos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chothues_id_nhanvien_foreign` FOREIGN KEY (`id_nhanvien`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chothues_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `chothue_products`
--
ALTER TABLE `chothue_products`
  ADD CONSTRAINT `chothue_products_id_chothue_foreign` FOREIGN KEY (`id_chothue`) REFERENCES `chothues` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chothue_products_id_product_theokho_foreign` FOREIGN KEY (`id_product_theokho`) REFERENCES `khos` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `doanhthus`
--
ALTER TABLE `doanhthus`
  ADD CONSTRAINT `doanhthus_id_chothue_foreign` FOREIGN KEY (`id_chothue`) REFERENCES `chothues` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `doanhthus_id_kho_foreign` FOREIGN KEY (`id_kho`) REFERENCES `khos` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `khos`
--
ALTER TABLE `khos`
  ADD CONSTRAINT `khos_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nhap_khos`
--
ALTER TABLE `nhap_khos`
  ADD CONSTRAINT `nhap_khos_id_nhanvien_foreign` FOREIGN KEY (`id_nhanvien`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `nhap_khos_id_thue_foreign` FOREIGN KEY (`id_thue`) REFERENCES `chothues` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
