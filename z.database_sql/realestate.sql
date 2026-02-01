-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2026 at 12:53 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenitis_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `amenities_amenitis_name_unique` (`amenitis_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenitis_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amenities 1', 'active', NULL, NULL),
(2, 'Amenities 2', 'active', '2026-01-13 07:20:37', '2026-01-13 08:19:41'),
(3, 'Amenities 3', 'active', '2026-01-13 07:36:06', '2026-01-13 07:36:18'),
(4, 'Amenities 4', 'active', '2026-01-13 08:09:15', '2026-01-14 00:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `facility_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `property_id`, `facility_name`, `distance`, `status`, `created_at`, `updated_at`) VALUES
(39, 9, 'Railways', '5', 'active', '2026-01-28 07:35:04', '2026-01-28 07:35:04'),
(33, 1, 'Airport', '3', 'active', '2026-01-28 05:46:57', '2026-01-28 05:46:57'),
(32, 1, 'Hospital', '1', 'active', '2026-01-28 05:46:57', '2026-01-28 05:46:57'),
(31, 1, 'School', '3', 'active', '2026-01-28 05:46:57', '2026-01-28 05:46:57'),
(38, 9, 'Airport', '2', 'active', '2026-01-28 07:35:04', '2026-01-28 07:35:04'),
(37, 9, 'School', '1', 'active', '2026-01-28 07:35:04', '2026-01-28 07:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_01_12_062646_create_property_types_table', 2),
(9, '2026_01_15_084257_create_properties_table', 4),
(8, '2026_01_13_102734_create_amenities_table', 3),
(10, '2026_01_15_104856_create_multi_images_table', 4),
(11, '2026_01_15_104931_create_facilities_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

DROP TABLE IF EXISTS `multi_images`;
CREATE TABLE IF NOT EXISTS `multi_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `photo_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `property_id`, `photo_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'upload/property/multi-image/1855019226778161.jpg', 'active', '2026-01-22 06:16:33', NULL),
(4, 1, 'upload/property/multi-image/1855467109296146.jpg', 'active', '2026-01-27 04:55:27', NULL),
(5, 1, 'upload/property/multi-image/1855467139724115.jpg', 'active', '2026-01-27 04:55:56', NULL),
(8, 7, 'upload/property/multi-image/1855566680755432.jpg', 'active', '2026-01-28 07:18:05', NULL),
(9, 7, 'upload/property/multi-image/1855566680887720.jpg', 'active', '2026-01-28 07:18:06', NULL),
(15, 9, 'upload/property/multi-image/1855567749157903.png', 'active', '2026-01-28 07:35:04', NULL),
(14, 9, 'upload/property/multi-image/1855567749079489.png', 'active', '2026-01-28 07:35:04', NULL),
(13, 9, 'upload/property/multi-image/1855567748988530.png', 'active', '2026-01-28 07:35:04', NULL),
(16, 9, 'upload/property/multi-image/1855567749235060.png', 'active', '2026-01-28 07:35:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ptype_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lowest_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_thambnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_descp` text COLLATE utf8mb4_unicode_ci,
  `long_descp` text COLLATE utf8mb4_unicode_ci,
  `bedrooms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathrooms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenitis_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `ptype_id`, `amenities_id`, `property_name`, `property_slug`, `property_code`, `property_status`, `lowest_price`, `max_price`, `property_thambnail`, `short_descp`, `long_descp`, `bedrooms`, `bathrooms`, `garage`, `garage_size`, `amenitis_name`, `property_size`, `property_video`, `address`, `city`, `state`, `postal_code`, `neighborhood`, `latitude`, `longitude`, `featured`, `hot`, `agent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '10', '2,1', 'Vnv dike', 'vnv-dike', 'PC004', 'rent', '11', '999', 'upload/property/thambnail/1855559938478017.png', 'Short Description', 'ltr', '4', '2', '4', '1000', NULL, '3000', 'bkba', 'dhaka', 'dhaka', 'dhaka', '1205', 'rohim', '11', '111', '1', '1', 2, 'active', '2026-01-22 05:31:17', '2026-01-28 05:42:17'),
(9, '1', '2,1', 'PIyash', 'piyash', 'PC008', 'rent', '2500', '250000', 'upload/property/thambnail/1855567748833564.jpg', 'fsdfgsdg', '<p>dzfvxdzbvfdxz&nbsp;</p>', '2', '1', '0', '0', NULL, '10', '10', 'sonirakhra', 'dhaka', 'dhaka', '1250', 'rohim khan', '100', '250', '1', '1', 2, 'active', '2026-01-28 07:35:04', NULL),
(7, '10', '2,1', 'khan villa', 'khan-villa', 'PC007', 'rent', '99', '9999', 'upload/property/thambnail/1855566680692681.jpg', 'abcd abcd', '<p>abcd abcd abcd abcd</p>', '4', '2', '1', '1000', NULL, '3000', 'abcd', 'dhaka1', 'dhaka1', 'dhaka1', '1250', 'rohim223', '99', '999', '1', '1', 2, 'active', '2026-01-28 07:18:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

DROP TABLE IF EXISTS `property_types`;
CREATE TABLE IF NOT EXISTS `property_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type_name`, `type_icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Appertment villa', 'Icon-1', 'active', NULL, '2026-01-12 06:13:10'),
(2, 'Office', 'Icon-2', 'active', NULL, NULL),
(3, 'Residential', 'Icon-3', 'inactive', NULL, '2026-01-13 07:38:59'),
(4, 'Commercial', 'Icon-4', 'inactive', NULL, '2026-01-12 05:59:07'),
(5, 'Duplex', 'Icon-5', 'active', NULL, NULL),
(6, 'Floor', 'Icon-6', 'active', NULL, '2026-01-12 05:02:24'),
(7, 'Building Code', 'Icon-7', 'inactive', NULL, NULL),
(8, 'Industrial', 'Icon-8', 'inactive', NULL, '2026-01-14 00:27:25'),
(9, 'Warehouse', 'Icon-9', 'inactive', NULL, '2026-01-14 00:19:37'),
(10, 'Building Rent', 'Icon-10', 'active', '2026-01-13 03:20:22', '2026-01-13 03:20:22'),
(11, 'Shared Office', 'Icon-11', 'active', '2026-01-13 06:32:23', '2026-01-13 06:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('admin','agent','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '2025-12-30 12:45:48', '$2y$12$7UV58N3clfzAkk13Qmp5U.b.EGnL72AdSqv6apF.GBcycrOg2bl2O', '2026011208421.jpg', '01611856477', 'Tejgoan,Dhaka-1215', 'admin', 'active', NULL, NULL, '2026-01-12 02:42:11'),
(2, 'agent', 'agent', 'agent @gmail.com', NULL, '$2y$12$h5w/HcMXXxSKEMtT5wazUefhbkNdbBlc6bY904dr5WGnJGSIvcEQ2', NULL, '01724575773', NULL, 'agent', 'active', NULL, NULL, NULL),
(3, 'user2', 'user 2', 'user2@gmail.com', NULL, '$2y$12$ANhRLJH8uvxTBw4HS.dI4ub5D43ZeAWUKnEyDOEZCI5KdU4f1W1HG', '2026010812021.jpg', '01611856477', 'motijheel', 'user', 'active', NULL, NULL, '2026-01-11 06:32:38'),
(4, 'khan', 'khan', 'khan@gmail.com', NULL, '$2y$12$JvhZZ07MRNMdk2XHhff6auO6cxWabCPK1yJHeNRe3GFZm8Z5IQh1K', NULL, '01712345678', 'lalmatia', 'user', 'active', NULL, '2026-01-08 03:09:30', '2026-01-08 03:09:30'),
(5, 'zizzle_tech', 'zizzle_tech', 'zizzle@gmail.com', NULL, '$2y$12$bPtanwf/TzaV6N5wZ2RJXujmExE3dvZGgAUDjWXWmkAZMFKkYKNMO', '202602011249avatar-5.png', '01611856477', 'dhaka', 'agent', 'inactive', NULL, '2026-02-01 03:10:45', '2026-02-01 06:49:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
