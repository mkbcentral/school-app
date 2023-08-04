-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 06:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masomo`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_links`
--

CREATE TABLE `app_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_links`
--

INSERT INTO `app_links` (`id`, `name`, `icon`, `color`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Secretariat', 'fa-folder-open', 'bg-primary', 'dashboard.main', '2023-08-04 03:32:09', '2023-08-04 03:32:09'),
(2, 'Finance', 'fa-hands-usd', 'bgs', 'dashboard.main', '2023-08-04 03:33:02', '2023-08-04 03:33:02'),
(3, 'Administration', 'fa-cog', 'bg-primary', 'dashboard.main', '2023-08-04 03:33:51', '2023-08-04 03:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `app_link_user`
--

CREATE TABLE `app_link_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `app_link_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_link_user`
--

INSERT INTO `app_link_user` (`id`, `user_id`, `app_link_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sidebar_collapse` tinyint(1) NOT NULL DEFAULT 0,
  `is_dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `app_name`, `is_sidebar_collapse`, `is_dark_mode`, `created_at`, `updated_at`) VALUES
(1, 'Schoola', 0, 1, '2023-08-04 03:23:06', '2023-08-04 12:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `classe_option_id`, `created_at`, `updated_at`) VALUES
(1, '1ere', 1, '2023-08-04 10:48:34', '2023-08-04 10:48:34'),
(2, '2eme', 1, '2023-08-04 10:48:41', '2023-08-04 10:48:41'),
(3, '3eme', 1, '2023-08-04 10:48:50', '2023-08-04 10:48:50'),
(4, '1ere', 3, '2023-08-04 10:49:02', '2023-08-04 10:49:02'),
(5, '2eme', 3, '2023-08-04 10:49:08', '2023-08-04 10:49:08'),
(6, '3eme', 3, '2023-08-04 10:49:16', '2023-08-04 10:49:16'),
(7, '4eme', 3, '2023-08-04 10:49:23', '2023-08-04 10:49:23'),
(8, '5eme', 3, '2023-08-04 10:49:32', '2023-08-04 10:49:32'),
(9, '6eme', 3, '2023-08-04 10:49:43', '2023-08-04 10:49:43'),
(10, '7eme', 2, '2023-08-04 10:49:56', '2023-08-04 10:49:56'),
(11, '8eme', 2, '2023-08-04 10:50:02', '2023-08-04 10:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `classe_options`
--

CREATE TABLE `classe_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classe_options`
--

INSERT INTO `classe_options` (`id`, `name`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'Maternelle', 1, '2023-08-04 10:46:06', '2023-08-04 10:46:51'),
(2, 'Education de base', 3, '2023-08-04 10:46:14', '2023-08-04 10:47:15'),
(3, 'Primaire', 1, '2023-08-04 10:46:22', '2023-08-04 10:48:19'),
(4, 'HP', 3, '2023-08-04 10:47:31', '2023-08-04 10:47:31'),
(5, 'Commerciale', 3, '2023-08-04 10:47:44', '2023-08-04 10:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `cost_generals`
--

CREATE TABLE `cost_generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `type_other_cost_id` bigint(20) UNSIGNED NOT NULL,
  `classe_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_generals`
--

INSERT INTO `cost_generals` (`id`, `name`, `amount`, `active`, `type_other_cost_id`, `classe_option_id`, `created_at`, `updated_at`) VALUES
(1, 'Minerval meternelle', 25, 1, 1, 1, '2023-08-04 10:51:30', '2023-08-04 10:51:30'),
(2, 'Menerval primaire', 30, 1, 1, 3, '2023-08-04 10:51:51', '2023-08-04 10:51:51'),
(3, 'Minerval 7eme educationde base', 40, 1, 1, 2, '2023-08-04 10:52:22', '2023-08-04 10:52:22'),
(4, 'Minerval 8eme EB', 40, 1, 1, 2, '2023-08-04 10:52:42', '2023-08-04 10:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `cost_inscriptions`
--

CREATE TABLE `cost_inscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `scolary_year_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_inscriptions`
--

INSERT INTO `cost_inscriptions` (`id`, `name`, `amount`, `active`, `school_id`, `scolary_year_id`, `created_at`, `updated_at`) VALUES
(1, 'Inscription', 1, 1, 1, 2, '2023-08-04 10:35:43', '2023-08-04 10:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'CDF', 1, '2023-08-04 09:51:18', '2023-08-04 09:51:18'),
(2, 'USD', 1, '2023-08-04 09:51:26', '2023-08-04 09:51:26');

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
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Masculin', 'M', '2023-08-04 10:39:49', '2023-08-04 10:39:49'),
(2, 'Féminin', 'F', '2023-08-04 10:39:55', '2023-08-04 10:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number_paiment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `scolary_year_id` bigint(20) UNSIGNED NOT NULL,
  `cost_inscription_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate_id` bigint(20) UNSIGNED NOT NULL,
  `is_paied` tinyint(1) NOT NULL DEFAULT 1,
  `is_old_student` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `number_paiment`, `school_id`, `classe_id`, `scolary_year_id`, `cost_inscription_id`, `student_id`, `user_id`, `rate_id`, `is_paied`, `is_old_student`, `created_at`, `updated_at`) VALUES
(1, 'AQ-9720-M-024-ISC', 1, 1, 2, 1, 2, 4, 1, 1, 0, '2023-08-04 12:46:42', '2023-08-04 12:46:42'),
(2, 'AQ-8742-M-024-ISC', 1, 1, 2, 1, 3, 4, 1, 1, 0, '2023-08-04 12:48:13', '2023-08-04 13:44:16');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_07_01_081431_create_schools_table', 1),
(3, '2022_07_10_115200_create_currencies_table', 1),
(4, '2022_07_10_120140_create_rates_table', 1),
(5, '2022_07_27_100138_create_scolary_years_table', 1),
(6, '2022_07_27_100138_create_sections_table', 1),
(7, '2022_07_27_100138_create_users_table', 1),
(8, '2022_07_28_155118_create_type_other_costs_table', 1),
(9, '2022_08_27_100138_create_classe_options_table', 1),
(10, '2022_08_27_100138_create_classes_table', 1),
(11, '2022_08_27_100138_create_cost_generals_table', 1),
(12, '2022_08_27_100138_create_cost_inscriptions_table', 1),
(13, '2022_08_27_100138_create_failed_jobs_table', 1),
(14, '2022_08_27_100138_create_inscriptions_table', 1),
(15, '2022_08_27_100138_create_password_resets_table', 1),
(16, '2022_08_27_100138_create_payments_table', 1),
(17, '2022_08_27_100138_create_student_responsables_table', 1),
(18, '2022_08_27_100138_create_students_table', 1),
(19, '2022_09_03_082606_create_app_settings_table', 1),
(20, '2023_07_03_123247_create_app_links_table', 1),
(21, '2023_07_03_135656_create_sub_app_links_table', 1),
(22, '2023_07_04_145629_create_app_link_user_table', 1),
(23, '2023_07_04_145719_create_sub_app_link_user_table', 1),
(24, '2023_07_05_151422_create_genders_table', 1),
(25, '2023_07_18_082827_create_permission_tables', 1),
(26, '2023_08_04_094848_add_username_and_phone_on_users_table', 2),
(27, '2023_08_04_113330_add_school_id_on_scolary_years_table', 3),
(28, '2023_08_04_134306_add_school_id_on_student_responsables_table', 4),
(29, '2023_08_04_144430_add_classe_id_on_inscriptions_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inscription_id` bigint(20) UNSIGNED NOT NULL,
  `cost_general_id` bigint(20) UNSIGNED NOT NULL,
  `rate_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `is_printed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `number_payment`, `month_name`, `inscription_id`, `cost_general_id`, `rate_id`, `user_id`, `is_paid`, `is_printed`, `created_at`, `updated_at`) VALUES
(1, NULL, '08', 1, 1, 1, 3, 0, 0, '2023-08-04 14:15:40', '2023-08-04 14:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rate`, `status`, `school_id`, `created_at`, `updated_at`) VALUES
(1, '2500', 1, 1, '2023-08-04 09:51:45', '2023-08-04 09:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'App-Admin', 'web', '2023-08-04 03:23:06', '2023-08-04 03:23:06'),
(2, 'Super-Admin', 'web', '2023-08-04 03:23:06', '2023-08-04 03:23:06'),
(3, 'Finance', 'web', '2023-08-04 09:58:21', '2023-08-04 09:58:21'),
(4, 'Secretary', 'web', '2023-08-04 09:58:27', '2023-08-04 10:33:29'),
(5, 'Coordinator', 'web', '2023-08-04 09:59:21', '2023-08-04 09:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `phone`, `email`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'AQUILA', '+243971330007', 'aquila@aquila.app', 'qhtYgUJOIarPiiLu9MRW9FtaIcmADw-metaMTIwMHB4LUxhcmF2ZWwucG5n-.png', '2023-08-04 09:12:51', '2023-08-04 10:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `scolary_years`
--

CREATE TABLE `scolary_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_last_year` tinyint(1) NOT NULL DEFAULT 0,
  `is_old_year` tinyint(1) NOT NULL DEFAULT 0,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scolary_years`
--

INSERT INTO `scolary_years` (`id`, `name`, `active`, `is_last_year`, `is_old_year`, `school_id`, `created_at`, `updated_at`) VALUES
(1, '2022-2023', 0, 1, 0, 1, '2023-08-04 09:38:00', '2023-08-04 10:10:51'),
(2, '2023-2024', 1, 0, 0, 1, '2023-08-04 09:38:11', '2023-08-04 10:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Maternelle', 1, '2023-08-04 10:45:33', '2023-08-04 10:45:33'),
(2, 'Primaire', 1, '2023-08-04 10:45:39', '2023-08-04 10:45:39'),
(3, 'Secondaire', 1, '2023-08-04 10:45:47', '2023-08-04 10:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_responsable_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `scolary_year_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `code`, `name`, `gender`, `place_of_birth`, `date_of_birth`, `student_responsable_id`, `school_id`, `scolary_year_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 'KAPINGA KASONGA JULES', 'M', 'Lubumbashi', '2020-08-04', 3, 1, 2, '2023-08-04 12:46:42', '2023-08-04 12:46:42'),
(3, NULL, 'MUTOMBO KAPINGA JULIE', 'M', NULL, '2022-08-04', 3, 1, 2, '2023-08-04 12:48:13', '2023-08-04 12:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `student_responsables`
--

CREATE TABLE `student_responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_responsables`
--

INSERT INTO `student_responsables` (`id`, `name_responsable`, `phone`, `other_phone`, `email`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'ILUNGA MAMBWE JEAN', '+243971330007', NULL, NULL, 1, '2023-08-04 11:36:31', '2023-08-04 11:36:31'),
(2, 'KABWE KALENGA JEAN', '+243371330007', NULL, NULL, 1, '2023-08-04 12:23:16', '2023-08-04 12:23:16'),
(3, 'KAPINGA SARAH', '+2438337696', NULL, NULL, 1, '2023-08-04 12:25:08', '2023-08-04 12:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `sub_app_links`
--

CREATE TABLE `sub_app_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_app_links`
--

INSERT INTO `sub_app_links` (`id`, `name`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'fa-chart', 'dashboard.main', '2023-08-04 03:34:48', '2023-08-04 03:34:48'),
(2, 'Nouvelle Inscription', 'fa-folder', 'inscription.new', '2023-08-04 03:34:53', '2023-08-04 03:35:34'),
(3, 'Nouvelle Reinscription', 'fa-folder-open', 'reinscription.new', '2023-08-04 03:36:07', '2023-08-04 03:36:07'),
(4, 'Paiement inscription', 'fa-folders', 'inscription.payment.valide', '2023-08-04 03:36:33', '2023-08-04 03:36:33'),
(5, 'Paiement frais scolaire', 'fa fa-folder', 'payment.other.cost', '2023-08-04 03:42:43', '2023-08-04 03:42:43'),
(6, 'Control paiments', 'fa-folder-open', 'payment.control', '2023-08-04 03:43:22', '2023-08-04 03:43:22'),
(7, 'Rapport par section', 'fa fa-folder', 'rapport.inscription.by.classe', '2023-08-04 03:44:04', '2023-08-04 03:44:04'),
(8, 'Rapport périodique', 'fa fa-folder', 'rapport.payments', '2023-08-04 03:44:24', '2023-08-04 03:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `sub_app_link_user`
--

CREATE TABLE `sub_app_link_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sub_app_link_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_app_link_user`
--

INSERT INTO `sub_app_link_user` (`id`, `user_id`, `sub_app_link_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 3, 4, NULL, NULL),
(3, 3, 5, NULL, NULL),
(4, 3, 6, NULL, NULL),
(5, 3, 7, NULL, NULL),
(6, 3, 8, NULL, NULL),
(7, 4, 1, NULL, NULL),
(8, 4, 2, NULL, NULL),
(9, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_other_costs`
--

CREATE TABLE `type_other_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_by_tranch` tinyint(1) NOT NULL DEFAULT 0,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `scolary_year_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_other_costs`
--

INSERT INTO `type_other_costs` (`id`, `name`, `active`, `is_by_tranch`, `school_id`, `scolary_year_id`, `created_at`, `updated_at`) VALUES
(1, 'Frais scolare', 1, 0, 1, 2, '2023-08-04 10:42:15', '2023-08-04 10:42:37'),
(2, 'Frais bus', 1, 0, 1, 2, '2023-08-04 10:42:23', '2023-08-04 10:42:39'),
(3, 'Frais de l\'état', 1, 1, 1, 2, '2023-08-04 10:42:31', '2023-08-04 10:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `avatar`, `email`, `phone`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `school_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Schoola', NULL, NULL, 'app-admin@school-app.app', NULL, '2023-08-04 03:23:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'axNJNpYzscbuu1ZU1hbppLN4uxSb66f7DAh2wZRax8QFZ0Y9ruAmGCLzb5Ap', '2023-08-04 03:23:06', '2023-08-04 03:23:06'),
(2, 'Super Admin', NULL, 'iFkglhOjqBS4N1Mlxy8VsbCc3HN30G-metac2Vydi5wbmc=-.png', 'superadmin@school-app.app', NULL, '2023-08-04 03:23:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 1, 'gmEd08YmGAY9vxKiUVwLmVsZSP6Fn3oxHiTFGJstEJ9IHYdddgxb2uDCuHbD', '2023-08-04 03:23:06', '2023-08-04 10:05:48'),
(3, 'fintest', NULL, 'ZgxisGnUDytEM89qz4ieDPxwZVul2M-metadXNlcl9tb25pdG9yLnBuZw==-.png', 'fintest@aquila.app', NULL, NULL, '$2y$10$3zea.NnMhJmYWWqP6DGJxO4RH1YiX3qVwewfs2kFuzIznBbRWEVCa', NULL, NULL, NULL, 1, NULL, '2023-08-04 10:05:11', '2023-08-04 10:05:11'),
(4, 'sec ', NULL, 'gdTBrMaZJA5I8MK36hq7jTkh0B9yTd-metadXNlcl9tb25pdG9yLnBuZw==-.png', 'sectest@aquila.app', NULL, NULL, '$2y$10$blDUE.5VnvnYD0KyIeNKA.LmQM6tH99MDSD25exoWxLlPbhT3mA1q', NULL, NULL, NULL, 1, NULL, '2023-08-04 10:07:24', '2023-08-04 10:07:24'),
(5, 'Cordo', NULL, '6TZh6tV07CipHF7Qilj7sgvOZjgyK6-metadXNlcl9tb25pdG9yLnBuZw==-.png', 'cordo@aquila.app', NULL, NULL, '$2y$10$wsjUuMzHY1791CwYObk/I.Nk74Tu7beCdob/yIVbEqe1btebELMIi', NULL, NULL, NULL, 1, NULL, '2023-08-04 10:07:58', '2023-08-04 10:07:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_links`
--
ALTER TABLE `app_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_link_user`
--
ALTER TABLE `app_link_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_link_user_user_id_foreign` (`user_id`),
  ADD KEY `app_link_user_app_link_id_foreign` (`app_link_id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classe_options`
--
ALTER TABLE `classe_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_generals`
--
ALTER TABLE `cost_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_inscriptions`
--
ALTER TABLE `cost_inscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scolary_years`
--
ALTER TABLE `scolary_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_responsables`
--
ALTER TABLE `student_responsables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_app_links`
--
ALTER TABLE `sub_app_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_app_link_user`
--
ALTER TABLE `sub_app_link_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_app_link_user_user_id_foreign` (`user_id`),
  ADD KEY `sub_app_link_user_sub_app_link_id_foreign` (`sub_app_link_id`);

--
-- Indexes for table `type_other_costs`
--
ALTER TABLE `type_other_costs`
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
-- AUTO_INCREMENT for table `app_links`
--
ALTER TABLE `app_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_link_user`
--
ALTER TABLE `app_link_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classe_options`
--
ALTER TABLE `classe_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cost_generals`
--
ALTER TABLE `cost_generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cost_inscriptions`
--
ALTER TABLE `cost_inscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scolary_years`
--
ALTER TABLE `scolary_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_responsables`
--
ALTER TABLE `student_responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_app_links`
--
ALTER TABLE `sub_app_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_app_link_user`
--
ALTER TABLE `sub_app_link_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type_other_costs`
--
ALTER TABLE `type_other_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_link_user`
--
ALTER TABLE `app_link_user`
  ADD CONSTRAINT `app_link_user_app_link_id_foreign` FOREIGN KEY (`app_link_id`) REFERENCES `app_links` (`id`),
  ADD CONSTRAINT `app_link_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_app_link_user`
--
ALTER TABLE `sub_app_link_user`
  ADD CONSTRAINT `sub_app_link_user_sub_app_link_id_foreign` FOREIGN KEY (`sub_app_link_id`) REFERENCES `sub_app_links` (`id`),
  ADD CONSTRAINT `sub_app_link_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
