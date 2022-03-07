-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2022 at 11:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Technology', '2022-02-25 02:03:15', '2022-02-25 02:03:15'),
(2, 'Digital', '2022-02-25 02:03:19', '2022-02-25 02:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `coupon`, `value`, `created_at`, `updated_at`) VALUES
(1, 'test', 20, '2022-02-25 14:21:46', '2022-02-25 14:21:46'),
(3, 'COUPON2', 50, '2022-02-25 20:48:55', '2022-02-25 20:48:55');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `point`, `created_at`, `updated_at`) VALUES
(1, 1, 6798, '2022-02-25 02:39:20', '2022-03-07 03:46:55'),
(3, 3, 570, '2022-02-25 20:43:49', '2022-02-28 00:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `member_exchanges`
--

CREATE TABLE `member_exchanges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `point_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_exchanges`
--

INSERT INTO `member_exchanges` (`id`, `member_product_id`, `user_id`, `qty`, `point_total`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2, 20, '2022-02-25 07:49:17', '2022-02-25 07:49:17'),
(2, 3, 1, 2, 20, '2022-02-25 08:05:21', '2022-02-25 08:05:21'),
(3, 1, 1, 3, 63, '2022-02-25 08:06:32', '2022-02-25 08:06:32'),
(4, 3, 1, 2, 20, '2022-02-25 09:15:49', '2022-02-25 09:15:49'),
(5, 3, 1, 1, 10, '2022-02-25 11:46:40', '2022-02-25 11:46:40'),
(6, 3, 1, 1, 10, '2022-02-25 12:07:39', '2022-02-25 12:07:39'),
(7, 3, 1, 1, 10, '2022-02-25 12:07:51', '2022-02-25 12:07:51'),
(8, 3, 1, 1, 10, '2022-02-25 12:08:17', '2022-02-25 12:08:17'),
(9, 3, 1, 1, 10, '2022-02-25 12:24:28', '2022-02-25 12:24:28'),
(10, 3, 1, 1, 10, '2022-02-25 12:24:49', '2022-02-25 12:24:49'),
(11, 3, 1, 1, 10, '2022-02-25 12:25:17', '2022-02-25 12:25:17'),
(12, 1, 1, 19, 399, '2022-02-25 13:43:21', '2022-02-25 13:43:21'),
(13, 3, 3, 10, 100, '2022-02-25 20:51:07', '2022-02-25 20:51:07'),
(14, 3, 3, 1, 10, '2022-02-28 00:31:04', '2022-02-28 00:31:04'),
(15, 3, 1, 1, 10, '2022-02-28 00:43:56', '2022-02-28 00:43:56'),
(16, 3, 1, 1, 10, '2022-02-28 00:44:02', '2022-02-28 00:44:02'),
(17, 3, 3, 3, 30, '2022-02-28 00:46:28', '2022-02-28 00:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `member_products`
--

CREATE TABLE `member_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_products`
--

INSERT INTO `member_products` (`id`, `product_name`, `image`, `product_description`, `stock`, `point`, `created_at`, `updated_at`) VALUES
(1, 'Product 1 member edit', 'images/OYB3mWsVIPkKEn3LSnb2LRySoxvyUiKInqeMZ4KU.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis metus a dolor pretium lacinia. Pellentesque tortor augue, scelerisque id tortor non, ornare maximus lectus. Aenean ac tortor suscipit, ullamcorper lacus sit amet, volutpat urna. Phasellus pellentesque mauris a nulla fringilla condimentum.', 21, 21, '2022-02-25 03:48:17', '2022-02-25 04:54:15'),
(3, 'product 2 member', 'images/Kf8gYjHPrBQFVmH1BcjGAgni78RKBpFIMVSY0GVh.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis metus a dolor pretium lacinia. Pellentesque tortor augue, scelerisque id tortor non, ornare maximus lectus. Aenean ac tortor suscipit, ullamcorper lacus sit amet, volutpat urna. Phasellus pellentesque mauris a nulla fringilla condimentum.', 42, 10, '2022-02-25 05:47:17', '2022-02-25 05:47:17');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_17_085528_create_products_table', 1),
(6, '2022_02_17_085550_create_categories_table', 1),
(7, '2022_02_22_010915_create_orders_table', 1),
(8, '2022_02_22_011838_create_transactions_table', 1),
(9, '2022_02_23_144051_create_modals_table', 1),
(10, '2022_02_24_133506_create_members_table', 1),
(11, '2022_02_25_102309_create_member_products_table', 2),
(12, '2022_02_25_141315_create_member_exchanges_table', 3),
(13, '2022_02_25_210558_create_discounts_table', 4),
(14, '2022_03_05_125506_create_carts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `modals`
--

CREATE TABLE `modals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modals`
--

INSERT INTO `modals` (`id`, `product_id`, `stock`, `cost`, `created_at`, `updated_at`) VALUES
(3, 3, 20, 800000, '2022-02-09 13:41:57', '2022-02-25 13:41:57'),
(4, 4, 10, 1900000, '2022-02-25 13:51:12', '2022-02-25 13:51:12'),
(5, 4, 3, 570000, '2022-02-25 13:59:30', '2022-02-25 13:59:30'),
(6, 4, 50, 9500000, '2022-02-10 15:31:19', '2022-02-25 15:31:19'),
(7, 3, 20, 800000, '2022-02-25 20:53:35', '2022-02-25 20:53:35'),
(8, 5, 20, 7600000, '2022-03-01 20:54:31', '2022-02-25 20:54:31'),
(9, 7, 20, 1600000, '2022-03-05 23:43:21', '2022-03-05 23:43:21'),
(10, 8, 20, 3600000, '2022-03-05 23:47:12', '2022-03-05 23:47:12'),
(11, 9, 20, 1600000, '2022-03-05 23:48:39', '2022-03-05 23:48:39'),
(12, 10, 20, 1600000, '2022-03-05 23:56:17', '2022-03-05 23:56:17'),
(13, 11, 20, 1600000, '2022-03-06 00:20:37', '2022-03-06 00:20:37'),
(14, 12, 20, 3800000, '2022-03-07 03:43:36', '2022-03-07 03:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `transaction_id`, `qty`, `cost`, `created_at`, `updated_at`) VALUES
(86, 4, 49, 3, 600000, '2022-02-25 15:13:48', '2022-02-25 15:13:48'),
(87, 4, 50, 4, 800000, '2022-02-25 15:19:20', '2022-02-25 15:19:20'),
(88, 4, 51, 6, 1200000, '2022-02-25 15:26:16', '2022-02-25 15:26:16'),
(89, 3, 52, 5, 250000, '2022-02-25 15:29:19', '2022-02-25 15:29:19'),
(90, 3, 53, 5, 250000, '2022-02-25 15:30:13', '2022-02-25 15:30:13'),
(91, 3, 55, 7, 350000, '2022-02-25 20:46:54', '2022-02-25 20:46:54'),
(92, 4, 55, 11, 2200000, '2022-02-25 20:46:54', '2022-02-25 20:46:54'),
(93, 3, 56, 3, 150000, '2022-02-25 20:49:41', '2022-02-25 20:49:41'),
(94, 4, 56, 4, 800000, '2022-02-25 20:49:41', '2022-02-25 20:49:41'),
(95, 3, 57, 5, 250000, '2022-02-25 21:11:03', '2022-02-25 21:11:03'),
(96, 4, 57, 5, 1000000, '2022-02-25 21:11:03', '2022-02-25 21:11:03'),
(97, 5, 57, 5, 2000000, '2022-02-25 21:11:03', '2022-02-25 21:11:03'),
(98, 3, 58, 1, 50000, '2022-02-25 21:11:35', '2022-02-25 21:11:35'),
(99, 3, 59, 1, 50000, '2022-02-25 21:18:24', '2022-02-25 21:18:24'),
(100, 4, 60, 1, 200000, '2022-02-25 21:18:58', '2022-02-25 21:18:58'),
(101, 3, 61, 1, 50000, '2022-02-25 21:20:56', '2022-02-25 21:20:56'),
(102, 3, 62, 1, 50000, '2022-02-25 21:21:44', '2022-02-25 21:21:44'),
(103, 3, 63, 1, 50000, '2022-02-25 21:22:43', '2022-02-25 21:22:43'),
(104, 3, 64, 1, 50000, '2022-02-25 21:23:11', '2022-02-25 21:23:11'),
(105, 3, 65, 1, 50000, '2022-02-25 21:24:34', '2022-02-25 21:24:34'),
(106, 4, 66, 1, 200000, '2022-02-25 21:25:42', '2022-02-25 21:25:42'),
(107, 4, 67, 2, 400000, '2022-02-25 21:26:01', '2022-02-25 21:26:01'),
(108, 4, 68, 1, 200000, '2022-02-25 21:27:54', '2022-02-25 21:27:54'),
(109, 4, 69, 1, 200000, '2022-02-26 08:42:43', '2022-02-26 08:42:43'),
(110, 5, 70, 1, 400000, '2022-02-26 08:47:14', '2022-02-26 08:47:14'),
(111, 5, 71, 1, 400000, '2022-02-26 08:52:17', '2022-02-26 08:52:17'),
(112, 5, 72, 1, 400000, '2022-02-26 08:53:43', '2022-02-26 08:53:43'),
(113, 5, 73, 1, 400000, '2022-02-26 08:56:53', '2022-02-26 08:56:53'),
(114, 4, 74, 1, 200000, '2022-02-26 08:57:34', '2022-02-26 08:57:34'),
(115, 3, 75, 1, 50000, '2022-02-26 08:58:09', '2022-02-26 08:58:09'),
(116, 4, 76, 1, 200000, '2022-02-27 00:56:14', '2022-02-27 00:56:14'),
(117, 3, 77, 1, 50000, '2022-02-27 00:57:27', '2022-02-27 00:57:27'),
(118, 4, 78, 1, 200000, '2022-02-27 01:43:43', '2022-02-27 01:43:43'),
(119, 3, 78, 1, 50000, '2022-02-27 01:43:43', '2022-02-27 01:43:43'),
(120, 5, 78, 1, 400000, '2022-02-27 01:43:43', '2022-02-27 01:43:43'),
(121, 3, 79, 1, 50000, '2022-02-27 01:47:24', '2022-02-27 01:47:24'),
(122, 4, 80, 2, 400000, '2022-02-27 01:59:53', '2022-02-27 01:59:53'),
(123, 4, 81, 1, 200000, '2022-02-27 23:55:27', '2022-02-27 23:55:27'),
(124, 3, 82, 1, 50000, '2022-02-27 23:56:37', '2022-02-27 23:56:37'),
(125, 4, 83, 1, 200000, '2022-02-27 23:57:23', '2022-02-27 23:57:23'),
(126, 3, 84, 1, 50000, '2022-02-27 23:58:48', '2022-02-27 23:58:48'),
(127, 4, 85, 1, 200000, '2022-02-28 00:03:09', '2022-02-28 00:03:09'),
(128, 3, 86, 2, 100000, '2022-02-28 00:03:51', '2022-02-28 00:03:51'),
(129, 4, 87, 1, 200000, '2022-02-28 00:04:53', '2022-02-28 00:04:53'),
(130, 5, 88, 1, 400000, '2022-02-28 00:05:42', '2022-02-28 00:05:42'),
(131, 5, 89, 1, 400000, '2022-02-28 00:06:51', '2022-02-28 00:06:51'),
(132, 4, 89, 1, 200000, '2022-02-28 00:06:51', '2022-02-28 00:06:51'),
(133, 4, 90, 1, 200000, '2022-02-28 00:08:14', '2022-02-28 00:08:14'),
(134, 4, 91, 1, 200000, '2022-02-28 00:09:34', '2022-02-28 00:09:34'),
(135, 5, 92, 2, 800000, '2022-02-28 00:10:17', '2022-02-28 00:10:17'),
(136, 4, 92, 2, 400000, '2022-02-28 00:10:18', '2022-02-28 00:10:18'),
(137, 4, 93, 3, 600000, '2022-02-28 00:46:08', '2022-02-28 00:46:08'),
(138, 5, 93, 3, 1200000, '2022-02-28 00:46:08', '2022-02-28 00:46:08'),
(139, 4, 94, 4, 800000, '2022-03-02 08:27:51', '2022-03-02 08:27:51'),
(140, 5, 94, 3, 1200000, '2022-03-02 08:27:51', '2022-03-02 08:27:51'),
(141, 11, 100, 1, 100000, '2022-03-07 03:41:31', '2022-03-07 03:41:31'),
(142, 11, 101, 1, 100000, '2022-03-07 03:44:21', '2022-03-07 03:44:21'),
(143, 12, 101, 11, 2200000, '2022-03-07 03:44:21', '2022-03-07 03:44:21'),
(144, 11, 102, 1, 100000, '2022-03-07 03:46:11', '2022-03-07 03:46:11'),
(145, 12, 102, 1, 2200000, '2022-03-07 03:46:11', '2022-03-07 03:46:11'),
(146, 11, 103, 1, 100000, '2022-03-07 03:46:55', '2022-03-07 03:46:55'),
(147, 12, 103, 1, 2200000, '2022-03-07 03:46:55', '2022-03-07 03:46:55');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `member_point` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `image`, `product_description`, `stock`, `price`, `profit`, `member_point`, `created_at`, `updated_at`) VALUES
(11, 1, 'product api 2', 'images/U6kAkRbfp7DTTjXeWrGd8Jo8kmcxyHeYz7oUO7Mg.png', 'test description', 16, 100000, 20000, 10, '2022-03-06 00:20:37', '2022-03-07 03:46:55'),
(12, 1, 'Product 2 api', 'images/imMIHJjYOD3wBHe2i9D4xc7CNo2eSb38yDMH7UKi.png', 'test description', 7, 200000, 10000, 10, '2022-03-07 03:43:36', '2022-03-07 03:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_cost` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `total_cost`, `profit`, `address`, `created_at`, `updated_at`) VALUES
(49, 1, 600000, 30000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 15:13:48', '2022-02-25 15:13:48'),
(50, 1, 800000, 40000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 15:19:20', '2022-02-25 15:19:20'),
(51, 1, 960000, 60000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 15:26:16', '2022-02-25 15:26:16'),
(52, 1, 200000, 50000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 15:29:19', '2022-02-25 15:29:19'),
(53, 1, 200000, 50000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 15:30:13', '2022-02-25 15:30:13'),
(54, 3, 150000, 150000, 'somewhere', '2022-02-25 20:43:49', '2022-02-25 20:43:49'),
(55, 3, 2550000, 180000, 'somewhere', '2022-02-25 20:46:54', '2022-02-25 20:46:54'),
(56, 3, 475000, 70000, 'somewhere', '2022-02-25 20:49:41', '2022-02-25 20:49:41'),
(57, 1, 1625000, 200000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:11:02', '2022-02-25 21:11:02'),
(58, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:11:35', '2022-02-25 21:11:35'),
(59, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:18:24', '2022-02-25 21:18:24'),
(60, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:18:58', '2022-02-25 21:18:58'),
(61, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:20:55', '2022-02-25 21:20:55'),
(62, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:21:44', '2022-02-25 21:21:44'),
(63, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:22:43', '2022-02-25 21:22:43'),
(64, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:23:11', '2022-02-25 21:23:11'),
(65, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:24:34', '2022-02-25 21:24:34'),
(66, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:25:41', '2022-02-25 21:25:41'),
(67, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:26:01', '2022-02-25 21:26:01'),
(68, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-25 21:27:54', '2022-02-25 21:27:54'),
(69, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:42:42', '2022-02-26 08:42:42'),
(70, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:47:14', '2022-02-26 08:47:14'),
(71, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:52:17', '2022-02-26 08:52:17'),
(72, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:53:43', '2022-02-26 08:53:43'),
(73, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:56:53', '2022-02-26 08:56:53'),
(74, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:57:34', '2022-02-26 08:57:34'),
(75, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-26 08:58:09', '2022-02-26 08:58:09'),
(76, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 00:56:14', '2022-02-27 00:56:14'),
(77, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 00:57:27', '2022-02-27 00:57:27'),
(78, 1, 650000, 40000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 01:43:43', '2022-02-27 01:43:43'),
(79, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 01:47:24', '2022-02-27 01:47:24'),
(80, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 01:59:53', '2022-02-27 01:59:53'),
(81, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 23:55:27', '2022-02-27 23:55:27'),
(82, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 23:56:37', '2022-02-27 23:56:37'),
(83, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 23:57:23', '2022-02-27 23:57:23'),
(84, 1, 50000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-27 23:58:48', '2022-02-27 23:58:48'),
(85, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:03:09', '2022-02-28 00:03:09'),
(86, 1, 100000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:03:51', '2022-02-28 00:03:51'),
(87, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:04:53', '2022-02-28 00:04:53'),
(88, 1, 400000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:05:42', '2022-02-28 00:05:42'),
(89, 1, 600000, 30000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:06:51', '2022-02-28 00:06:51'),
(90, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:08:14', '2022-02-28 00:08:14'),
(91, 1, 200000, 10000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:09:34', '2022-02-28 00:09:34'),
(92, 1, 960000, 60000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-02-28 00:10:17', '2022-02-28 00:10:17'),
(93, 3, 1800000, 90000, 'somewhere', '2022-02-28 00:46:08', '2022-02-28 00:46:08'),
(94, 1, 2000000, 100000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-02 08:27:51', '2022-03-02 08:27:51'),
(95, 1, 50000, 20000, 'somewhere', '2022-03-03 00:39:10', '2022-03-03 00:39:10'),
(96, 1, 0, 0, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:35:40', '2022-03-07 03:35:40'),
(97, 1, 0, 0, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:36:42', '2022-03-07 03:36:42'),
(98, 1, 0, 0, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:37:35', '2022-03-07 03:37:35'),
(99, 1, 0, 0, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:39:31', '2022-03-07 03:39:31'),
(100, 1, 100000, 20000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:41:31', '2022-03-07 03:41:31'),
(101, 1, 2300000, 130000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:44:21', '2022-03-07 03:44:21'),
(102, 1, 2300000, 30000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:46:11', '2022-03-07 03:46:11'),
(103, 1, 2300000, 30000, 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', '2022-03-07 03:46:55', '2022-03-07 03:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `money` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `is_admin`, `money`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$OaFFtaVpI84f18Ftci3nd.erhEseIq/yT2DohancmKhwmUhr6Rq6q', 'gedawang permai 3 blog f/11 semarang, jawa tengah, indonesia', 1, 29485000, '2022-02-25 02:01:45', '2022-03-07 03:46:55'),
(2, 'guest', 'guest@gmail.com', '$2y$10$Pmf9ewCRzeevFN8UKU4rJOv1CJwjwTMWSEiaZXteBB1uoLHxa3Vma', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis metus a dolor pretium lacinia. Pellentesque tortor augue, scelerisque id tortor non, ornare maximus lectus. Aenean ac tortor suscipit, ullamcorper lacus sit amet, volutpat urna. Phasellus pellentesque mauris a nulla fringilla condimentum.', 0, 0, '2022-02-25 06:12:37', '2022-02-25 06:12:37'),
(3, 'admin2', 'admin2@gmail.com', '$2y$10$.DYFsFbFCKnpW9075qpbCe9ZI0.dSyhfQMAeivoHzM1BAJzL92dDW', 'somewhere', 0, 15025000, '2022-02-25 20:40:27', '2022-02-28 00:46:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `member_exchanges`
--
ALTER TABLE `member_exchanges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_products`
--
ALTER TABLE `member_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modals`
--
ALTER TABLE `modals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member_exchanges`
--
ALTER TABLE `member_exchanges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member_products`
--
ALTER TABLE `member_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modals`
--
ALTER TABLE `modals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
