-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 10:34 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-fajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Handphone', '2022-04-11 02:47:22', '2022-04-11 02:47:22'),
(2, 'Laptop', '2022-04-10 20:10:24', '2022-04-11 08:53:35'),
(3, 'Aksesoris', '2022-04-10 20:17:28', '2022-04-10 20:17:28'),
(4, 'Jam Tangan', '2022-04-10 20:19:03', '2022-04-10 20:19:03'),
(5, 'Sandal', '2022-04-11 07:37:30', '2022-04-11 07:37:30'),
(11, 'Sepatu', '2022-04-11 12:22:38', '2022-04-11 12:22:38'),
(12, 'Baju', '2022-04-11 12:22:47', '2022-04-11 12:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_code`, `name`, `address`, `phone`, `poin`, `created_at`, `updated_at`) VALUES
(13, 'M000013', 'Zeronine09', 'Mallengkeri', '6285757493227', 80, '2022-04-14 01:13:36', '2022-04-25 19:59:57'),
(14, 'M000014', 'Fajarnet', 'Mallengkeri', '085757493227', 0, '2022-04-14 01:21:17', '2022-04-25 16:19:37'),
(15, 'M000015', 'Jauz', 'Tabaria', '0112222', 0, '2022-04-14 02:58:24', '2022-04-14 02:58:24'),
(16, 'M000016', 'Amar', 'Tabaria', '0101011', 0, '2022-04-14 03:00:14', '2022-04-14 03:00:14'),
(17, 'M000017', 'Deno', 'Tabaria', '0001111', 0, '2022-04-14 08:37:54', '2022-04-14 08:37:54'),
(18, 'M000018', 'Abid', 'Dg Tata', '0212121', 0, '2022-04-14 08:46:37', '2022-04-14 08:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(32, '2014_10_12_000000_create_users_table', 1),
(33, '2014_10_12_100000_create_password_resets_table', 1),
(34, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(35, '2019_08_19_000000_create_failed_jobs_table', 1),
(36, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(37, '2022_04_09_023054_create_categories_table', 1),
(38, '2022_04_09_023139_create_products_table', 1),
(39, '2022_04_09_023158_create_members_table', 1),
(40, '2022_04_09_023303_create_spends_table', 1),
(41, '2022_04_09_023524_create_purchases_table', 1),
(42, '2022_04_09_025204_create_suppliers_table', 1),
(43, '2022_04_09_025253_create_sales_table', 1),
(44, '2022_04_09_025340_create_settings_table', 1),
(45, '2022_04_09_025408_create_purchase_details_table', 1),
(46, '2022_04_09_025439_create_sale_details_table', 1),
(47, '2022_04_11_022205_create_sessions_table', 1),
(48, '2022_04_11_165638_add_foreign_key_to_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `product_name`, `product_code`, `thumbnail`, `brand`, `purchase_price`, `sale_price`, `discount`, `stock`, `created_at`, `updated_at`) VALUES
(1, 2, 'ROG', 'P000001', NULL, 'asus', 2000, 5000, 0, 110, '2022-04-13 08:31:37', '2022-04-25 15:54:30'),
(2, 3, 'Casing', 'P000002', NULL, 'Xiaomi', 1000, 2000, 50, 106, '2022-04-13 08:55:05', '2022-04-25 17:20:21'),
(4, 4, 'Rolex', 'P000004', NULL, 'Murah bnget', 9999, 999, 9, 9988, '2022-04-13 09:00:35', '2022-04-25 11:45:58'),
(5, 1, 'Gucci', 'P000005', NULL, 'Murah bnget', 20202, 22002, 8, 229, '2022-04-13 10:37:52', '2022-04-22 02:14:40'),
(6, 2, 'Lenovo Thinkpad', 'P000006', NULL, 'Lenove', 2000000, 200000, 3, 22, '2022-04-13 10:44:59', '2022-04-25 11:45:58'),
(11, 11, 'Yeezy', 'P000007', NULL, 'yeezy', 999999, 999999, 9, 94, '2022-04-14 00:50:28', '2022-04-25 19:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `pay` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `id_supplier`, `total_item`, `total_price`, `discount`, `pay`, `created_at`, `updated_at`) VALUES
(22, 1, 1, 9999, 0, 9999, '2022-04-19 01:09:14', '2022-04-19 01:09:39'),
(23, 4, 8, 3101007, 20, 2480806, '2022-04-19 01:40:00', '2022-04-19 02:57:18'),
(25, 4, 5, 8000, 10, 7200, '2022-04-19 09:27:47', '2022-04-19 09:28:34'),
(28, 4, 5, 4006000, 10, 3605400, '2022-04-19 12:40:38', '2022-04-19 12:58:28'),
(29, 5, 3, 1003999, 5, 953799, '2022-04-19 17:38:36', '2022-04-19 17:39:37'),
(30, 5, 6, 1009999, 0, 1009999, '2022-04-20 05:36:43', '2022-04-20 06:01:54'),
(33, 1, 1, 1000, 2, 980, '2022-04-22 02:14:46', '2022-04-22 02:14:58'),
(34, 4, 4, 4000, 10, 3600, '2022-04-25 03:38:22', '2022-04-25 03:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price_purchase` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `id_purchase`, `id_product`, `price_purchase`, `amount`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 2000, 1, 2000, '2022-04-17 19:15:07', '2022-04-17 19:15:07'),
(2, 9, 11, 999999, 1, 999999, '2022-04-17 19:23:13', '2022-04-17 19:23:13'),
(4, 10, 11, 999999, 1, 999999, '2022-04-17 19:43:21', '2022-04-17 19:43:21'),
(5, 10, 6, 2000000, 1, 2000000, '2022-04-17 19:43:26', '2022-04-17 19:43:26'),
(6, 12, 1, 2000, 1, 2000, '2022-04-17 21:48:41', '2022-04-17 21:48:41'),
(8, 12, 1, 2000, 1, 2000, '2022-04-17 21:53:11', '2022-04-17 21:53:11'),
(9, 12, 4, 9999, 1, 9999, '2022-04-17 21:57:26', '2022-04-17 21:57:26'),
(10, 12, 1, 2000, 1, 2000, '2022-04-17 22:24:13', '2022-04-17 22:24:13'),
(11, 12, 6, 2000000, 1, 2000000, '2022-04-17 22:24:17', '2022-04-17 22:24:17'),
(12, 12, 2, 1000, 1, 1000, '2022-04-17 22:27:55', '2022-04-17 22:27:55'),
(13, 13, 1, 2000, 150, 300000, '2022-04-17 22:42:43', '2022-04-18 01:43:19'),
(14, 13, 6, 2000000, 100, 200000000, '2022-04-17 22:44:59', '2022-04-18 01:43:44'),
(17, 13, 11, 999999, 1, 999999, '2022-04-18 01:08:47', '2022-04-18 01:49:13'),
(18, 13, 1, 2000, 50, 100000, '2022-04-18 01:15:27', '2022-04-18 01:31:22'),
(19, 13, 5, 20202, 900, 18181800, '2022-04-18 01:48:41', '2022-04-18 01:48:53'),
(20, 14, 1, 2000, 30, 60000, '2022-04-18 02:20:35', '2022-04-18 05:27:34'),
(21, 14, 11, 999999, 31, 30999969, '2022-04-18 02:20:38', '2022-04-18 05:27:37'),
(22, 15, 1, 2000, 2, 4000, '2022-04-18 07:56:59', '2022-04-18 07:57:07'),
(23, 15, 6, 2000000, 1, 2000000, '2022-04-18 07:57:03', '2022-04-18 07:57:03'),
(24, 16, 1, 2000, 1, 2000, '2022-04-18 08:20:24', '2022-04-18 10:12:00'),
(25, 16, 11, 999999, 2, 1999998, '2022-04-18 08:20:29', '2022-04-18 10:12:04'),
(26, 16, 6, 2000000, 7, 14000000, '2022-04-18 09:12:56', '2022-04-18 10:13:30'),
(27, 17, 1, 2000, 5, 10000, '2022-04-18 11:52:59', '2022-04-18 13:51:04'),
(28, 17, 1, 2000, 3, 6000, '2022-04-18 11:53:17', '2022-04-18 14:30:00'),
(29, 17, 6, 2000000, 4, 8000000, '2022-04-18 13:41:17', '2022-04-18 14:07:15'),
(30, 17, 11, 999999, 2, 1999998, '2022-04-18 14:26:45', '2022-04-18 14:26:52'),
(31, 17, 4, 9999, 99, 989901, '2022-04-18 14:42:33', '2022-04-18 14:42:48'),
(32, 18, 1, 2000, 4, 8000, '2022-04-18 17:09:08', '2022-04-18 17:09:21'),
(33, 19, 1, 2000, 2, 4000, '2022-04-18 19:58:14', '2022-04-18 22:42:13'),
(38, 20, 1, 2000, 10, 20000, '2022-04-19 00:02:04', '2022-04-19 00:14:26'),
(39, 20, 11, 999999, 1, 999999, '2022-04-19 00:02:08', '2022-04-19 00:02:08'),
(42, 22, 4, 9999, 1, 9999, '2022-04-19 01:09:35', '2022-04-19 01:09:35'),
(43, 23, 5, 20202, 5, 101010, '2022-04-19 01:40:18', '2022-04-19 01:40:26'),
(44, 23, 11, 999999, 3, 2999997, '2022-04-19 01:40:35', '2022-04-19 02:57:08'),
(45, 24, 5, 20202, 99, 1999998, '2022-04-19 07:07:17', '2022-04-19 07:07:35'),
(46, 24, 6, 2000000, 5, 10000000, '2022-04-19 07:07:42', '2022-04-19 07:46:31'),
(47, 25, 1, 2000, 3, 6000, '2022-04-19 09:27:52', '2022-04-19 09:27:59'),
(48, 25, 2, 1000, 2, 2000, '2022-04-19 09:27:54', '2022-04-19 09:28:01'),
(51, 28, 1, 2000, 3, 6000, '2022-04-19 12:41:12', '2022-04-19 12:41:20'),
(52, 28, 6, 2000000, 2, 4000000, '2022-04-19 12:41:16', '2022-04-19 12:41:39'),
(53, 29, 1, 2000, 2, 4000, '2022-04-19 17:38:40', '2022-04-19 17:39:33'),
(54, 29, 11, 999999, 1, 999999, '2022-04-19 17:38:57', '2022-04-19 17:38:57'),
(55, 30, 1, 2000, 5, 10000, '2022-04-20 06:01:40', '2022-04-20 06:01:46'),
(56, 30, 11, 999999, 1, 999999, '2022-04-20 06:01:50', '2022-04-20 06:01:50'),
(59, 33, 2, 1000, 1, 1000, '2022-04-22 02:14:50', '2022-04-22 02:14:50'),
(60, 34, 2, 1000, 4, 4000, '2022-04-25 03:38:26', '2022-04-25 03:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` tinyint(4) DEFAULT NULL,
  `pay` int(11) NOT NULL,
  `accepted` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `id_member`, `id_user`, `total_item`, `total_price`, `discount`, `pay`, `accepted`, `created_at`, `updated_at`) VALUES
(15, 18, 2, 11, 34995, 5, 33245, 35000, '2022-04-25 02:39:31', '2022-04-25 04:48:46'),
(17, 17, 2, 1, 200000, 5, 190000, 200000, '2022-04-25 07:29:07', '2022-04-25 07:29:24'),
(19, NULL, 2, 1, 200000, 0, 200000, 200000, '2022-04-25 07:47:16', '2022-04-25 07:47:38'),
(21, NULL, 2, 2, 200999, 0, 200999, 299999, '2022-04-25 11:28:25', '2022-04-25 11:28:40'),
(24, 18, 2, 1, 999999, 5, 949999, 1000000, '2022-04-25 15:54:48', '2022-04-25 15:55:31'),
(25, 13, 2, 2, 1999998, 5, 1899998, 2500000, '2022-04-25 17:13:47', '2022-04-25 19:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price_sale` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `id_sale`, `id_product`, `price_sale`, `discount`, `amount`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 5000, 0, 1, 5000, '2022-04-20 09:59:20', '2022-04-20 09:59:20'),
(2, 8, 1, 5000, 0, 1, 5000, '2022-04-20 09:59:56', '2022-04-20 09:59:56'),
(3, 9, 1, 5000, 0, 1, 5000, '2022-04-20 10:04:32', '2022-04-20 10:04:32'),
(4, 8, 6, 200000, 0, 1, 200000, '2022-04-20 10:24:38', '2022-04-20 10:24:38'),
(5, 10, 1, 5000, 0, 1, 5000, '2022-04-20 10:33:56', '2022-04-20 10:33:56'),
(6, 10, 11, 999999, 0, 1, 999999, '2022-04-20 10:37:40', '2022-04-20 10:37:40'),
(7, 9, 1, 5000, 0, 1, 5000, '2022-04-20 10:45:57', '2022-04-20 10:45:57'),
(8, 9, 1, 5000, 0, 1, 5000, '2022-04-20 10:48:08', '2022-04-20 10:48:08'),
(9, 11, 1, 5000, 0, 1, 5000, '2022-04-20 10:49:56', '2022-04-20 10:49:56'),
(10, 11, 6, 200000, 0, 1, 200000, '2022-04-20 10:50:10', '2022-04-20 10:50:10'),
(11, 12, 1, 5000, 0, 1, 5000, '2022-04-20 11:14:58', '2022-04-20 11:14:58'),
(12, 12, 4, 999, 0, 1, 999, '2022-04-20 11:15:02', '2022-04-20 11:15:02'),
(13, 12, 1, 5000, 0, 1, 5000, '2022-04-20 11:24:16', '2022-04-20 11:24:16'),
(14, 12, 6, 200000, 0, 1, 200000, '2022-04-20 11:27:46', '2022-04-20 11:27:46'),
(15, 14, 1, 5000, 0, 1, 5000, '2022-04-22 01:34:51', '2022-04-22 01:34:51'),
(16, 14, 6, 200000, 0, 1, 200000, '2022-04-22 01:43:20', '2022-04-22 01:43:20'),
(17, 15, 1, 5000, 0, 6, 30000, '2022-04-25 02:39:37', '2022-04-25 04:48:35'),
(21, 15, 4, 999, 0, 5, 4995, '2022-04-25 04:29:25', '2022-04-25 04:30:10'),
(22, 16, 11, 999999, 0, 1, 999999, '2022-04-25 07:11:09', '2022-04-25 07:20:24'),
(23, 16, 2, 2000, 0, 1, 2000, '2022-04-25 07:11:13', '2022-04-25 07:11:13'),
(24, 16, 2, 2000, 0, 1, 2000, '2022-04-25 07:18:16', '2022-04-25 07:18:16'),
(25, 17, 6, 200000, 0, 1, 200000, '2022-04-25 07:29:16', '2022-04-25 07:29:16'),
(26, 18, 1, 5000, 0, 1, 5000, '2022-04-25 07:30:06', '2022-04-25 07:30:06'),
(27, 19, 6, 200000, 0, 1, 200000, '2022-04-25 07:47:21', '2022-04-25 07:47:21'),
(30, 20, 2, 2000, 0, 1, 2000, '2022-04-25 11:18:03', '2022-04-25 11:18:03'),
(32, 21, 6, 200000, 0, 1, 200000, '2022-04-25 11:28:29', '2022-04-25 11:28:29'),
(33, 21, 4, 999, 0, 1, 999, '2022-04-25 11:28:34', '2022-04-25 11:28:34'),
(35, 24, 11, 999999, 0, 1, 999999, '2022-04-25 15:55:22', '2022-04-25 15:55:22'),
(37, 25, 11, 999999, 0, 1, 999999, '2022-04-25 17:13:56', '2022-04-25 17:13:56'),
(38, 25, 11, 999999, 0, 1, 999999, '2022-04-25 17:17:09', '2022-04-25 17:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3AflN8eI9ZM1lj3dHkNmdn635TLUgrN3Z8OutiRV', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiM3JoclRLc1JneVJ4Wk5rQ3hVQ2pycjc4czB4eG5jSXJsSWxTNHl3RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly9sb2NhbGhvc3QvcG9zLXN5c3RlbS90b2tvLWZhamFybmV0L3B1YmxpYy90cmFuc2Frc2kvbm90YV9rZWNpbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkOTJJWFVOcGtqTzByT1E1YnlNaS5ZZTRvS29FYTNSbzlsbEMvLm9nL2F0Mi51aGVXRy9pZ2kiO3M6NzoiaWRfc2FsZSI7aToyNTt9', 1650917941),
('HGFOjnDdo7kcDZzWipubhIjE0JYuFRHAGwhbnm1v', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVE1MUThaMVNyVmQyWlltaU91UmFuOVNEVlMxRTlvT3doajJLZEthNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1650910487);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota_type` tinyint(4) NOT NULL,
  `discount` smallint(6) NOT NULL,
  `path_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `address`, `phone`, `nota_type`, `discount`, `path_logo`, `path_member`, `created_at`, `updated_at`) VALUES
(1, 'Top Celluler', 'Jl. Muchtar Lutfi No.24', '09090909', 1, 5, 'img/logo001.png', 'img/member.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spends`
--

CREATE TABLE `spends` (
  `id` int(10) UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spends`
--

INSERT INTO `spends` (`id`, `deskripsi`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'Beli PSU Deepcool 500W', 520000, '2022-04-17 08:13:27', '2022-04-22 01:26:21'),
(2, 'Belanja Pulsa - Fajar Cell', 300000, '2022-04-17 08:38:21', '2022-04-17 08:38:34'),
(4, 'Perbaiki Baterai Laptop + LCD', 1100000, '2022-04-18 14:57:51', '2022-04-22 01:27:07'),
(5, 'Servis Motor Suka Mogok', 200000, '2022-04-20 04:27:10', '2022-04-20 04:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Top Asia Phone', 'Pettarani 23', '099288112', '2022-04-14 09:22:35', '2022-04-15 02:40:59'),
(4, 'Kima', 'Urip', '01212112', '2022-04-17 16:05:14', '2022-04-17 16:05:14'),
(5, 'Jaus', 'Tabaria net', '69', '2022-04-19 17:38:28', '2022-04-19 17:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `foto`, `level`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Ms. Serenity Daniel', 'ygottlieb@example.net', '2022-04-10 20:40:47', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'Zeronine', 1, 'JlNV7hFQ5DDhNetaZrypwMatCF7jj1Ew1iH1NAhRXUh6oIE5lluDBuxH7sjH', NULL, NULL, '2022-04-10 20:40:47', '2022-04-10 20:40:47'),
(2, 'Zeronine', 'zeronine09@gmail.com', '2022-04-10 21:16:02', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'Zeronine', 0, '5mQEFqQskeDZkDUq7hMIqmCkmcUKY7660z9Cgi3YbxQVNYuXk9Np9c1DrKrR', NULL, NULL, '2022-04-10 21:16:02', '2022-04-10 21:16:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spends`
--
ALTER TABLE `spends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spends`
--
ALTER TABLE `spends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
