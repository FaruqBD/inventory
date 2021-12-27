-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 11:11 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A', '2021-05-28 15:18:23', '2021-05-28 15:18:23'),
(9, 'B', '2021-05-30 12:14:55', '2021-05-30 12:14:55'),
(10, 'C', '2021-05-30 12:15:00', '2021-05-30 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ABC LTD', '2021-05-28 15:19:12', '2021-05-28 15:19:12'),
(2, 'Feedex', '2021-05-28 15:19:22', '2021-05-28 15:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `crms`
--

CREATE TABLE `crms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `assigned_to` smallint(6) NOT NULL,
  `issue` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dead_line` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sla` timestamp NULL DEFAULT NULL,
  `remarks` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crms`
--

INSERT INTO `crms` (`id`, `customer`, `status`, `assigned_to`, `issue`, `dead_line`, `sla`, `remarks`, `created_at`, `updated_at`) VALUES
(15, 'Me', '2', 15, 'Tempor qui sit maio', '2021-06-19 10:11:34', '2021-06-19 10:17:01', 'Do tenetur deleniti', '2021-06-18 10:26:30', '2021-06-19 10:17:01'),
(16, 'Sed quia delectus a', '3', 15, 'Dolorem omnis at qua', '2021-06-19 23:49:00', '2021-06-19 11:10:18', 'Impedit perspiciati', '2021-06-18 16:30:01', '2021-06-19 11:10:18'),
(18, 'Eos nulla necessita', '3', 15, 'Repudiandae molestia', '2021-06-19 10:11:38', '2021-06-19 09:58:48', 'Est id tempor amet', '2021-06-18 16:44:04', '2021-06-19 09:58:48'),
(19, 'Rerum obcaecati simi', '3', 15, 'Dolor quasi molestia', '1991-03-16 04:12:00', '2021-06-19 11:27:01', 'Voluptates nisi ut a', '2021-06-19 10:01:56', '2021-06-19 11:27:01'),
(20, 'Ullam nostrum quod e', '3', 9, 'Magna eu eum deserun', '2021-06-19 11:12:00', '2021-06-19 11:37:29', 'Voluptatibus assumen', '2021-06-19 09:02:18', '2021-06-19 11:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `crm_remarks`
--

CREATE TABLE `crm_remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crm_id` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_remarks`
--

INSERT INTO `crm_remarks` (`id`, `crm_id`, `details`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 11, 'sgsgsgsg', 1, '2021-06-16 12:00:56', '2021-06-16 12:00:56'),
(2, 11, 'New comments', 15, '2021-06-16 12:15:16', '2021-06-16 12:15:16'),
(3, 12, 'Will be finished tomorrow', 15, '2021-06-16 12:19:40', '2021-06-16 12:19:40'),
(4, 12, 'This is another update', 1, '2021-06-16 12:20:10', '2021-06-16 12:20:10'),
(5, 12, 'New update', 1, '2021-06-16 12:43:46', '2021-06-16 12:43:46'),
(6, 16, 'sgsgsfdg', 1, '2021-12-27 09:57:39', '2021-12-27 09:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `godowns`
--

CREATE TABLE `godowns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `godowns`
--

INSERT INTO `godowns` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'Godown 1', '2021-05-29 06:56:03', '2021-05-29 08:57:20'),
(6, 'Godown 2', '2021-05-29 06:56:10', '2021-05-29 08:57:16'),
(7, 'Godown 3', '2021-05-29 06:56:15', '2021-05-29 08:57:09'),
(8, 'Godown 4', '2021-05-29 06:56:20', '2021-05-29 08:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `menifests`
--

CREATE TABLE `menifests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menifests`
--

INSERT INTO `menifests` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Menifest 2', '2021-06-04 13:35:14', '2021-06-04 13:35:14'),
(3, 'Menifest 3', '2021-06-04 13:37:32', '2021-06-04 13:37:32'),
(4, 'Menifest 4', '2021-06-04 13:38:59', '2021-06-04 13:38:59');

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
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2021_05_26_085004_create_products_table', 1),
(16, '2021_05_26_085042_create_godowns_table', 1),
(17, '2021_05_26_085128_create_couriers_table', 1),
(18, '2021_05_26_085149_create_shipments_table', 1),
(19, '2021_05_26_085343_create_categories_table', 1),
(20, '2021_05_26_090013_create_shipment_types_table', 1),
(21, '2021_05_26_160055_create_customers_table', 1),
(22, '2021_05_28_190127_create_packlists_table', 1),
(23, '2021_05_29_140222_create_product_names_table', 2),
(24, '2021_06_04_163517_create_single_packlist_table', 3),
(25, '2021_06_04_180344_create_menifest_table', 3),
(26, '2021_06_04_163517_create_single_packlists_table', 4),
(27, '2021_06_04_180344_create_menifests_table', 5),
(28, '2021_06_11_183820_create_roles_table', 6),
(29, '2021_06_14_171732_create_crms_table', 7),
(30, '2021_06_16_174654_create_crm_remarks_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `packlists`
--

CREATE TABLE `packlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `godown` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `godown_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name_id`, `quantity`, `godown_id`, `category_id`, `remarks`, `created_at`, `updated_at`) VALUES
(113, '6', '200', '5', '9', NULL, '2021-06-10 21:00:25', '2021-06-10 21:00:25'),
(114, '14', '200', '6', '1', NULL, '2021-12-27 03:51:52', '2021-12-27 10:00:36'),
(115, '14', '100', '7', '9', 'Voluptatibus assumen', '2021-12-27 03:52:15', '2021-12-27 03:52:15'),
(116, '9', '200', '6', '9', 'fdgsdfg', '2021-12-27 09:59:58', '2021-12-27 09:59:58'),
(117, '14', '80', '8', '10', 'sgsdfg', '2021-12-27 10:00:56', '2021-12-27 10:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_names`
--

CREATE TABLE `product_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_names`
--

INSERT INTO `product_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Premium Luxury High Chair (Blue)', '2021-05-29 08:21:31', '2021-05-29 11:17:41'),
(2, 'Octa Baby Foldable Single Post High Chair', '2021-05-29 08:30:32', '2021-05-29 11:19:10'),
(3, 'Royal Baby Eating Chair / Booster Seat Adjustable', '2021-05-29 08:30:43', '2021-05-29 11:19:38'),
(5, 'Comfort Baby High Chair (With Wheels & Cushion) (D', '2021-05-29 08:31:07', '2021-05-29 11:19:54'),
(6, 'Microfiber 360° Flat Mop – Revolutionary Ultimate', '2021-05-29 08:45:19', '2021-05-29 11:21:15'),
(8, 'Kids Study Table', '2021-05-29 08:50:29', '2021-05-29 11:21:42'),
(9, 'StarAndDaisy Balancing Kids Bike cum Trike – Green', '2021-05-29 08:53:12', '2021-05-29 11:22:24'),
(10, 'StarAndDaisy Dinesmart Multi-Adjustable Folding, B', '2021-05-29 11:28:05', '2021-05-29 11:28:05'),
(11, 'StarAndDaisy Classy Kids Pushtype Stroller cum Tricycle/Cycle (Red)', '2021-05-29 11:28:27', '2021-05-29 11:28:27'),
(12, 'StarAndDaisy Classy Kids Pushtype Stroller cum Tricycle/Cycle (White)', '2021-05-29 11:28:52', '2021-05-29 11:28:52'),
(13, 'UPC Modular Design Easy Clean Spin Mop with SS Rod and Stainer', '2021-05-29 11:29:11', '2021-05-29 11:29:11'),
(14, 'UPC Spray Mop with Dust Collector with 2 Super Absorbent Microfiber pad – 510 ml Dispenser', '2021-05-29 11:29:34', '2021-05-29 11:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipment_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `executive` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menifest_id` smallint(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `shipment_type_id`, `courier_id`, `tracking_number`, `remarks`, `vehicle`, `executive`, `menifest_id`, `created_at`, `updated_at`) VALUES
(2, '2', '1', '54646', 'Ut et sed sint quaer', '', '', 2, '2021-05-29 07:24:19', '2021-05-29 07:24:19'),
(3, '4', '2', '12345678', 'Ut et sed sint quaer', '', '', 2, '2021-05-29 07:24:32', '2021-05-29 07:24:32'),
(5, '2', '1', '4646', 'New', '', '', 4, '2021-05-31 14:51:11', '2021-05-31 14:51:11'),
(47, '2', '1', '1', 'New', '', '', 4, '2021-06-02 08:48:28', '2021-06-02 08:48:28'),
(66, '4', '1', '5552275', NULL, 'f', 'Masud', 4, '2021-06-10 03:41:52', '2021-06-10 03:41:52'),
(67, '4', '2', '5485', NULL, 'Truck', 'Masud', 4, '2021-06-17 21:51:14', '2021-06-17 21:51:14'),
(68, '4', '2', '52852', NULL, 'Truck', 'Masud', 4, '2021-06-17 21:52:31', '2021-06-17 21:52:31'),
(74, '4', '2', '8555', NULL, 'cfasff', 'ccgsdfg', 4, '2021-06-21 17:46:41', '2021-06-21 17:46:41'),
(75, '4', '2', '58555', NULL, 'gsg', 'ff', 4, '2021-06-21 17:50:05', '2021-06-21 17:50:05'),
(76, '4', '2', '85566', NULL, 'f', 'dfg', 4, '2021-06-21 17:51:18', '2021-06-21 17:51:18'),
(77, '4', '2', '51114', NULL, 'ggg', 'gsg', 4, '2021-06-21 17:52:29', '2021-06-21 17:52:29'),
(78, '4', '2', '445', NULL, 'ggg', 'gsg', 4, '2021-06-21 17:52:51', '2021-06-21 17:52:51'),
(79, '4', '2', '41145', NULL, 'sgsfg', 'dgsdfg', 4, '2021-06-21 17:54:47', '2021-06-21 17:54:47'),
(80, '4', '2', '65555', NULL, 'sgsfg', 'dgsdfg', 4, '2021-06-21 17:54:55', '2021-06-21 17:54:55'),
(81, '4', '2', '55255', NULL, 'sgsfg', 'dgsdfg', 4, '2021-06-21 17:55:15', '2021-06-21 17:55:15'),
(82, '4', '2', '885', NULL, 'gg', 'fff', 4, '2021-06-21 17:55:58', '2021-06-21 17:55:58'),
(83, '4', '2', '541', NULL, 'fsdfaf', 'ccbxcv', 4, '2021-06-21 17:56:51', '2021-06-21 17:56:51'),
(84, '4', '2', '9895', NULL, 'fsdfaf', 'ccbxcv', 4, '2021-06-21 17:57:29', '2021-06-21 17:57:29'),
(85, '4', '2', '69888', NULL, 'mmmm', 'mmm', 4, '2021-06-21 17:59:04', '2021-06-21 17:59:04'),
(86, '4', '2', '11112', NULL, 'mmmm', 'mmm', 4, '2021-06-21 17:59:24', '2021-06-21 17:59:24'),
(87, '4', '2', '3366', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:00:32', '2021-06-21 18:00:32'),
(88, '4', '2', '666', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:00:42', '2021-06-21 18:00:42'),
(89, '4', '2', '33', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:00:50', '2021-06-21 18:00:50'),
(90, '4', '2', '555', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:00:57', '2021-06-21 18:00:57'),
(91, '4', '2', '5555', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:01:04', '2021-06-21 18:01:04'),
(92, '4', '2', '8888', NULL, 'mmm', 'mmm', 4, '2021-06-21 18:05:43', '2021-06-21 18:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_types`
--

CREATE TABLE `shipment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_types`
--

INSERT INTO `shipment_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Outward', '2021-05-28 15:19:48', '2021-05-28 15:19:48'),
(4, 'Inward', '2021-05-28 15:42:03', '2021-05-28 15:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `single_packlists`
--

CREATE TABLE `single_packlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `godown` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `single_packlists`
--

INSERT INTO `single_packlists` (`id`, `product_id`, `godown`, `available_qty`, `required_qty`, `created_at`, `updated_at`) VALUES
(1, '100', 'Godown 4', '380', '12', '2021-06-04 12:33:01', '2021-06-04 12:33:01'),
(2, '101', 'Godown 2', '280', '100', '2021-06-09 12:09:33', '2021-06-09 12:09:33'),
(3, '97', 'Godown 4', '190', '100', '2021-06-09 12:10:06', '2021-06-09 12:10:06'),
(4, '112', 'Godown 1', '200', '48', '2021-06-18 00:26:09', '2021-06-18 00:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 1, NULL, '$2y$10$zrRzUqVDefz0jqOM8g9VHuquksTGy/q14JwrVYNUupEdBtVTdCBxW', 'tb5sIjAy86l00xWazdPersqThJomNdC1F0tUtAmzzwjsIJmX3vVyG4Nq7QAU', '2021-05-28 15:17:33', '2021-05-28 15:17:33'),
(9, 'Staff', 'staff@staff.com', 2, NULL, '$2y$10$msImtMBCdBOi1WgStb3n3.624hJeCXxfTPXQKBhBd5Aig6pjN.OwG', NULL, '2021-06-13 22:21:55', '2021-06-14 00:54:49'),
(14, 'Jony', 'kybopyj@mailinator.com', 0, NULL, '$2y$10$cSuLTqHade5u2idlgnCjj.XnHPwsCFKddezLPFBBD8qDLy2x7756W', NULL, '2021-06-14 01:46:08', '2021-06-14 01:48:14'),
(15, 'Omar Faruq', 'tigaje@mailinator.net', 2, NULL, '$2y$10$XC2HZjuT54pCHI7akda3jO5d5ntoPMF.1yGg71sL0lm16RVz86L5.', NULL, '2021-06-14 12:57:16', '2021-06-14 12:57:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crms`
--
ALTER TABLE `crms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_remarks`
--
ALTER TABLE `crm_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `godowns`
--
ALTER TABLE `godowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menifests`
--
ALTER TABLE `menifests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packlists`
--
ALTER TABLE `packlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_names`
--
ALTER TABLE `product_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_types`
--
ALTER TABLE `shipment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_packlists`
--
ALTER TABLE `single_packlists`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crms`
--
ALTER TABLE `crms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `crm_remarks`
--
ALTER TABLE `crm_remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `godowns`
--
ALTER TABLE `godowns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menifests`
--
ALTER TABLE `menifests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `packlists`
--
ALTER TABLE `packlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `product_names`
--
ALTER TABLE `product_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `shipment_types`
--
ALTER TABLE `shipment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `single_packlists`
--
ALTER TABLE `single_packlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
