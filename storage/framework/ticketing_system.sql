-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_leader_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `group_leader_id`, `image`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'میوه فروشان', 6, 'uploads\\group\\2023\\09\\12\\1694540493.png', NULL, '2023-09-10 06:53:23', '2023-09-12 17:41:33', NULL),
(3, 'پشتیبان سایت', 3, 'uploads\\group\\2023\\10\\04\\1696412400.png', NULL, '2023-09-10 13:16:02', '2023-10-04 09:40:00', NULL),
(4, 'تیم بررسی تیکت', 3, 'uploads\\group\\2023\\10\\04\\1696412169.png', 3, '2023-09-10 17:20:09', '2023-10-04 09:36:10', NULL),
(7, 'طباخان برتر', 8, 'uploads\\group\\2023\\09\\19\\1695110023.jpg', NULL, '2023-09-19 07:53:44', '2023-09-19 07:53:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`user_id`, `group_id`, `created_at`) VALUES
(3, 4, '2023-09-10 17:20:09'),
(5, 3, '2023-09-10 13:16:02'),
(5, 4, '2023-09-10 17:20:09'),
(6, 1, '2023-09-12 17:41:33'),
(6, 7, '2023-09-19 07:53:44'),
(8, 1, '2023-09-16 07:50:00'),
(8, 7, '2023-09-19 07:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` text NOT NULL,
  `mediable_id` int(11) NOT NULL,
  `mediable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`) VALUES
(13, 'uploads/project/images/8nnxyPUk6VhqXQZ2o23xETn5SYAOpMB79JAmxgxf.jpg', 4, 'App\\Models\\Project\\Project', '2023-09-19 13:33:09', '2023-09-19 13:33:09'),
(14, 'uploads/project/images/fzNBVqfWhxdVkA11vjB7RK6i6jUEQkPg6ai0B8oj.jpg', 4, 'App\\Models\\Project\\Project', '2023-09-19 13:33:09', '2023-09-19 13:33:09'),
(19, 'uploads/project/images/xj1IhlGqhAGj67Cv4XAntrGmy9mpKrvlWcId5b6r.jpg', 5, 'App\\Models\\Project\\Project', '2023-09-19 14:12:05', '2023-09-19 14:12:05'),
(20, 'uploads/project/images/qv548KGZhXqQt8QBbMGyUudhBxHTdIjo1RIN5cgF.jpg', 5, 'App\\Models\\Project\\Project', '2023-09-19 14:12:05', '2023-09-19 14:12:05'),
(21, 'uploads/project/images/EqoA5kMkl5CYgYt3w5ElCWp9597PqsP95pxgwtz4.jpg', 5, 'App\\Models\\Project\\Project', '2023-09-19 14:16:57', '2023-09-19 14:16:57'),
(25, 'uploads/project/images/cNpp7lDmrBurbmZ9c32ZC8oSSHeqFp8XFsIYMqk5.jpg', 4, 'App\\Models\\Project\\Project', '2023-09-19 14:41:09', '2023-09-19 14:41:09'),
(41, 'uploads/tasks/files/uxH2Ky9nn8ud4dYzAvq0PhTyuBrcPhj1uE046LBf.pdf', 7, 'App\\Models\\tasks\\Task', '2023-09-30 14:03:18', '2023-09-30 14:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_31_190942_create_groups_table', 1),
(6, '2023_09_01_053045_create_group_user_table', 1),
(9, '2023_09_12_213507_create_roles_table', 2),
(10, '2023_09_12_213710_create_role_user_table', 2),
(11, '2023_09_13_091809_create_permissions_table', 3),
(12, '2023_09_13_092119_create_permission_role_table', 3),
(13, '2023_09_13_092127_create_permission_user_table', 3),
(15, '2023_09_16_134245_create_task_access_types_table', 4),
(16, '2023_09_16_134335_create_task_statuses_table', 4),
(34, '2023_09_16_141357_create_tasks_table', 5),
(35, '2023_09_16_141459_create_task_details_table', 5),
(36, '2023_09_16_141530_create_task_user_table', 5),
(37, '2023_09_17_103712_create_projects_table', 6),
(38, '2023_09_17_111901_create_media_table', 6),
(39, '2023_09_18_155721_add_deleted_at_to_projects_table', 7),
(40, '2023_09_26_101701_add_description_to_tasks_table', 8),
(43, '2023_09_15_133308_create_statuses_table', 9),
(48, '2023_09_30_150000_add_foreign_key_to_tasks_table', 10),
(49, '2023_09_30_152232_add_foreign_key_to_projects_table', 11),
(50, '2023_10_04_111817_change_group_leader_to_group_leader_id_in_groups_table', 12),
(51, '2023_10_05_144659_create_otps_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp_code` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => email, 1 => mobile Number',
  `used` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not used, 1 => used',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `token`, `user_id`, `otp_code`, `type`, `used`, `created_at`, `updated_at`) VALUES
(3, 'm0iBSrGHPKVraW2QkjW5Gf1M4SGbghdwm4Av9fMReWsJypKLBQ7HYBOQrpn1', 12, '738332', 0, 1, '2023-10-05 13:05:17', '2023-10-05 13:06:09'),
(11, 'agFmotdEz0ibM0GrYMF0DOkibF9LOJyNTM2VQpFkrrTI1og4OI36aXncDs1I', 19, '311107', 0, 1, '2023-10-05 19:06:29', '2023-10-05 19:07:42'),
(12, 'vdyoR4mNCUTqElb9wWoodVNw3EEYo3WY5glITb8iTvSHHdVeSQoBMgUppVf3', 19, '123557', 0, 0, '2023-10-06 06:42:34', '2023-10-06 06:42:34'),
(13, '1dv21E9fHbrpvgnYbeP8mypGZEkBRzWi81eOfH8TDlD2vIBKBbnUlbYP3Pym', 19, '380536', 0, 1, '2023-10-06 06:50:00', '2023-10-06 06:51:58'),
(14, 'LjsnTfK3G592jqaU5GPPvWqGCTV92I8PKjDufSTvtK1gCD7sVUOYAQ45oK2q', 19, '680211', 0, 1, '2023-10-06 07:03:42', '2023-10-06 07:04:16'),
(15, 'Nc30bUhkEwI8lLJWknXBEi7jx8kSpFZBrFTxyDDGyHLDV9oDml1dw7IFJRJF', 19, '832348', 0, 0, '2023-10-06 08:22:02', '2023-10-06 08:22:02'),
(16, 'iz47LKXOxtTl02cmoAHovxZjS4KOpOqXjO1YfgNRUQMAL2Xzh0mHZR7MfnIJ', 12, '699948', 0, 1, '2023-10-06 08:23:04', '2023-10-06 08:23:37'),
(17, 'onviHQ3xuMBX6UXr0jp5R4AKRSBe1AgE52v5bGCuR0vNc4LkXNKR2uSsF8Jm', 3, '612947', 0, 1, '2023-10-06 08:25:22', '2023-10-06 08:25:54'),
(18, '9dw6FMMUtecP9LPhCqswqjS4CUlc7qgCxO4aSKfzxyRutK13iaieox8cCnfL', 5, '535496', 0, 1, '2023-10-06 09:02:09', '2023-10-06 09:02:59'),
(19, 'D0nAYlmTU7CtniI6aA9az6L5NfnczvDbCtKOpYpHV7ngXrXvBvmL21Yh7XWi', 5, '365063', 0, 1, '2023-10-06 09:29:53', '2023-10-06 09:30:39'),
(20, 'gdirIaX40n4VqiF3hFR5Iv5sMGoWddqEsvwPY2cmoXZaUzMKlzJQ7XWCOECM', 3, '197929', 0, 1, '2023-10-06 10:35:08', '2023-10-06 10:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `persian_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `persian_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'show-user', 'مشاهده کاربران', 'میتواند لیست کاربران را تماشا کند.', 1, '2023-09-13 11:33:59', '2023-09-13 17:29:16'),
(2, 'delete-user', 'حذف کاربران', 'میتواند کاربران را  حذف کند', 1, '2023-09-13 11:36:08', '2023-09-13 11:44:49'),
(3, 'update-user', 'ویرایش کاربران', 'میتواند کاربران را ویرایش کند', 1, '2023-09-13 12:19:28', '2023-09-13 12:19:28'),
(4, 'create-user', 'ایجاد کاربران', 'میتواند یک کاربر جدید اضافه کند.', 1, '2023-09-13 17:29:58', '2023-10-05 06:17:49'),
(5, 'show-tasks', 'مشاهده تسک ها', 'میتواند تسک ها را تماشا کند.', 1, '2023-09-15 18:46:23', '2023-09-15 18:46:23'),
(6, 'delete-tasks', 'حذف  تسک ها', 'میتواند تسک ها را حذف کند.', 1, '2023-09-15 18:47:04', '2023-09-16 09:06:03'),
(7, 'update-tasks', 'ویرایش تسک ها', 'میتواند تسک ها را ویرایش کند.', 1, '2023-09-15 18:47:24', '2023-09-15 18:47:24'),
(8, 'create-tasks', 'ایجاد  تسک ها', 'میتواند تسک ها را ایجاد کند.', 1, '2023-09-15 18:47:52', '2023-09-15 18:47:52'),
(9, 'show-groups', 'مشاهده گروه ها', 'میتواند گروه ها را تماشا کند', 1, '2023-09-16 09:08:16', '2023-09-16 09:08:16'),
(10, 'delete-groups', 'حذف گروه ها', 'میتواند گروه ها را حذف کند', 1, '2023-09-16 09:08:40', '2023-09-16 09:08:40'),
(11, 'update-groups', 'ویرایش گروه ها', 'میتواند گروه ها را ویرایش کند', 1, '2023-09-16 09:08:57', '2023-09-16 09:08:57'),
(12, 'create-groups', 'ایجاد گروه ها', 'میتواند گروه ها را ایجاد کند', 1, '2023-09-16 09:09:14', '2023-10-03 10:33:17'),
(13, 'show-permissions', 'مشاهده سطوح دسترسی', 'میتواند لیست سطوح دسترسی را مشاهده کند.', 1, '2023-10-03 11:40:27', '2023-10-03 11:40:27'),
(14, 'delete-permissions', 'حذف  سطوح دسترسی', 'میتواند سطوح دسترسی را حذف کند.', 1, '2023-10-03 11:41:01', '2023-10-03 11:41:01'),
(15, 'update-permissions', 'ویرایش سطوح دسترسی', 'میتواند سطوح دسترسی را ویرایش کند.', 1, '2023-10-03 11:41:16', '2023-10-03 11:41:16'),
(16, 'create-permissions', 'ایجاد سطوح دسترسی', 'میتواند سطوح دسترسی را ایجاد کند.', 1, '2023-10-03 11:41:49', '2023-10-03 11:41:49'),
(17, 'show-roles', 'مشاهده نقش ها', 'میتواند نقش ها را مشاهده کند.', 1, '2023-10-03 18:09:10', '2023-10-03 18:09:10'),
(18, 'delete-roles', 'حذف  نقش ها', 'میتواند نقش ها را حذف کند.', 1, '2023-10-03 18:09:32', '2023-10-03 18:09:32'),
(19, 'update-roles', 'ویرایش  نقش ها', 'میتواند نقش ها را ویرایش کند.', 1, '2023-10-03 18:09:48', '2023-10-03 18:09:48'),
(20, 'create-roles', 'ایجاد  نقش ها', 'میتواند نقش ها را ایجاد کند.', 1, '2023-10-03 18:10:14', '2023-10-03 18:10:14'),
(21, 'show-projects', 'مشاهده پروژه ها', 'میتواند لیست پروژه ها را مشاهده کند.', 1, '2023-10-04 13:44:45', '2023-10-04 13:44:45'),
(22, 'delete-projects', 'حذف پروژه ها', 'میتواند پروژه ها را حذف کند.', 1, '2023-10-04 13:45:06', '2023-10-04 13:46:25'),
(23, 'update-projects', 'ویرایش پروژه ها', 'میتواند پروژه ها را ویرایش کند.', 1, '2023-10-04 13:45:23', '2023-10-04 13:46:36'),
(24, 'create-projects', 'ایجاد پروژه ها', 'میتواند پروژه جدید ایجاد کند.', 1, '2023-10-04 13:46:09', '2023-10-04 13:46:09'),
(25, 'show-admin-dashboard', 'مشاهده داشبورد ادمین', 'میتواند داشبورد ادمین را مشاهده کند', 1, '2023-10-06 09:31:46', '2023-10-06 09:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`) VALUES
(1, 1, '2023-09-13 16:58:09'),
(1, 10, '2023-09-15 11:26:02'),
(1, 45, '2023-10-03 17:45:26'),
(2, 1, '2023-09-13 17:02:03'),
(2, 10, '2023-10-03 17:45:00'),
(2, 45, '2023-10-03 17:45:26'),
(3, 1, '2023-10-03 17:19:04'),
(3, 10, '2023-09-15 11:26:02'),
(3, 45, '2023-10-03 17:45:26'),
(4, 1, '2023-10-03 17:19:04'),
(4, 10, '2023-09-15 11:26:02'),
(4, 45, '2023-10-03 17:45:26'),
(5, 1, '2023-10-03 17:19:04'),
(5, 10, '2023-10-03 17:45:00'),
(5, 45, '2023-10-03 17:45:26'),
(6, 1, '2023-10-03 17:19:04'),
(6, 10, '2023-10-03 17:45:00'),
(6, 45, '2023-10-03 17:45:26'),
(7, 1, '2023-10-03 17:19:04'),
(7, 10, '2023-10-03 17:45:00'),
(7, 45, '2023-10-03 17:45:26'),
(8, 1, '2023-10-03 17:19:04'),
(8, 10, '2023-10-03 17:45:00'),
(8, 45, '2023-10-03 17:45:26'),
(9, 1, '2023-10-03 17:19:04'),
(9, 10, '2023-10-03 17:45:00'),
(9, 45, '2023-10-03 17:45:26'),
(10, 1, '2023-10-03 17:19:04'),
(10, 10, '2023-10-03 17:45:00'),
(10, 45, '2023-10-03 17:45:26'),
(11, 1, '2023-10-03 17:19:04'),
(11, 10, '2023-10-03 17:45:00'),
(11, 45, '2023-10-03 17:45:26'),
(12, 1, '2023-10-03 17:19:04'),
(12, 10, '2023-10-03 17:45:00'),
(12, 45, '2023-10-03 17:45:26'),
(13, 45, '2023-10-03 11:42:35'),
(14, 45, '2023-10-03 11:42:35'),
(15, 45, '2023-10-03 11:42:35'),
(16, 45, '2023-10-03 11:42:35'),
(17, 10, '2023-10-03 18:10:45'),
(17, 45, '2023-10-03 18:10:51'),
(18, 10, '2023-10-03 18:10:45'),
(18, 45, '2023-10-03 18:10:51'),
(19, 10, '2023-10-03 18:10:45'),
(19, 45, '2023-10-03 18:10:51'),
(20, 10, '2023-10-03 18:10:45'),
(20, 45, '2023-10-03 18:10:51'),
(21, 1, '2023-10-04 13:47:03'),
(21, 10, '2023-10-04 13:47:12'),
(21, 45, '2023-10-04 13:47:19'),
(22, 1, '2023-10-04 13:47:03'),
(22, 10, '2023-10-04 13:47:12'),
(22, 45, '2023-10-04 13:47:19'),
(23, 1, '2023-10-04 13:47:03'),
(23, 10, '2023-10-04 13:47:12'),
(23, 45, '2023-10-04 13:47:19'),
(24, 1, '2023-10-04 13:47:03'),
(24, 10, '2023-10-04 13:47:12'),
(24, 45, '2023-10-04 13:47:19'),
(25, 1, '2023-10-06 09:31:57'),
(25, 10, '2023-10-06 09:32:03'),
(25, 45, '2023-10-06 09:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 5,
  `priority` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'صفر ==>عادی  یک ==>فوری  دو ==>زمان دار',
  `logo` text DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `client`, `description`, `price`, `group_id`, `status_id`, `priority`, `logo`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'پروژه طراحی لندینگ', 'کاظم آقاجانی', 'پروژه طراحی صفحه اصلی میوه فروشی برادران اصغر بغیر از اصغر...', 3500000, 1, 6, 1, 'uploads\\project\\logo\\2023\\09\\19\\1695111233.jpg', '2023-11-10 20:30:00', '2023-09-18 11:49:39', '2023-10-04 14:57:55', NULL),
(5, 'سایت طباخان برتر', 'امین آقا فرزانه', 'امین آقا فرزانه میخواد یدونه طباخی بزنه \nیه سایت خفن با تکنولوژي لاراول و قیمت لحظه ای کله پاچه رو نشون بده', 6850000, 7, 5, 1, 'uploads\\project\\logo\\2023\\09\\19\\1695110944.jpg', '2023-12-09 20:30:00', '2023-09-19 07:58:01', '2023-10-01 19:27:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `persian_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => inactive, 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `persian_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'operator', 'اپراتور سایت', 'اپراتور سایت دسترسی کامل به قسمت  های ( تسک , پروژه, کاربران و مجموعه کاربران ) دارد.', 1, '2023-09-12 18:18:36', '2023-10-04 13:46:47'),
(10, 'super-admin', 'مدیر سایت', 'همه کاره سایت', 1, '2023-09-15 11:26:02', '2023-10-03 10:27:03'),
(45, 'programmer', 'توسعه دهنده', 'خالق سایت و توسعه دهنده سایت', 1, '2023-10-03 11:42:35', '2023-10-03 11:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`) VALUES
(3, 10, '2023-09-26 06:07:46'),
(5, 45, '2023-10-03 11:43:02'),
(6, 1, '2023-09-21 05:33:45'),
(8, 1, '2023-09-16 07:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => for Task, 1 => for Project'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `title`, `type`) VALUES
(1, 'در انتظار بررسی', 0),
(2, 'بررسی شده', 0),
(3, 'عدم تایید', 0),
(4, 'بایگانی', 0),
(5, 'درحال انجام', 1),
(6, 'انجام شده', 1),
(7, 'منقضی شده', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'صفر ==>نامه  و یک ==>تسک',
  `priority` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'صفر ==>عادی  یک ==>لحظه ای  دو ==>آنی',
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `due_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `subject`, `description`, `type`, `priority`, `status_id`, `due_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'نوشتن سطح دسترسی برای تکمیل سایت', 'سلام برنامه نویس.\nسایت تا اینجا عالی شده و تنها چیزی ک کمداره یه سطح دسترسی عه انشالله ببینم چیکار میکنی؟', 1, 0, 2, '2023-10-05 20:30:00', '2023-09-30 14:03:18', '2023-10-06 08:40:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_access_types`
--

CREATE TABLE `task_access_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_statuses`
--

CREATE TABLE `task_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => tasks, 1 => Projects',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `is_owner` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => Task Assigned To, 1 => Owner',
  `access` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => no Access, 1 => has Access',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`user_id`, `task_id`, `is_owner`, `access`, `created_at`) VALUES
(3, 7, 0, 0, '2023-09-30 14:03:18'),
(6, 7, 1, 0, '2023-09-30 14:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fName` varchar(255) NOT NULL,
  `lName` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL COMMENT 'سِمَت کاربر',
  `profile` text DEFAULT NULL,
  `signature_image` text DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => user , 1 => admin , 2 => super admin',
  `is_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not verified , 1 => verified',
  `gender` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => men , 1 => women',
  `connection` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => dont send connection email , 1 => send connection email',
  `mail_authority` varchar(255) DEFAULT NULL COMMENT '0 => start , 1 => Initial review , 2 => returned',
  `task_authority` varchar(255) DEFAULT NULL COMMENT '0 => start , 1 => Initial review , 2 => complete, 3 => finish , 4 => ended , 5 => canceled',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fName`, `lName`, `username`, `email`, `email_verified_at`, `password`, `mobile`, `birth`, `position`, `profile`, `signature_image`, `user_type`, `is_verified`, `gender`, `connection`, `mail_authority`, `task_authority`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'دانیال', 'مبینی', NULL, 'danial.mobini12@gmail.com', '2023-10-06 10:35:31', '$2y$10$2jAfa8uWbfq1bKApWcKN9OKmYsxV0qmcK9FjQKNs4iWff2I/sQTI.', '9126843921', '1382-08-17', 'مدیر سایت', 'uploads\\users\\profile\\2023\\09\\28\\1695927030.jpg', 'uploads\\users\\signature\\2023\\09\\01\\1693591414.png', 2, 1, 0, 1, '0,1,2', '0,2,4,5', NULL, '2023-09-01 18:03:34', '2023-10-06 10:35:31', NULL),
(5, 'مهناز', 'کریمی', NULL, 'danialmobini110@gmail.com', '2023-10-06 09:30:40', '$2y$10$cvbrNRXYU86rjO4AofoQ/uPSv06Z/ADHlFVtUR5JHaloKaOL0cod6', '9168949296', '1371-07-15', 'برنامه نویس', NULL, NULL, 1, 1, 1, 0, '', '0,1,2,3,4,5', 'kyOJak8fNIHJYwceU5cIcq67O070jOuBraH6ndLGVvwmnekhT4gsyZkcGrSt', '2023-09-09 07:56:02', '2023-10-06 09:30:40', NULL),
(6, 'اصغر', 'احمدی', NULL, 'asghar@gmail.com', NULL, '$2y$10$IvSeyPECwjHNvXb6LOv8qexk7sm4aVSQOVdZ6f0joS81M69V4tOa6', '9368946781', '1373-11-15', 'دکتر', 'uploads\\users\\profile\\2023\\09\\21\\1695274424.png', NULL, 1, 0, 0, 1, '0,1', '4,5,0,2', NULL, '2023-09-09 13:25:53', '2023-09-21 10:53:41', NULL),
(8, 'کریم', 'قنبری', NULL, 'karim@gmail.com', NULL, '$2y$10$u.zsKB4ZzMnM9wW6EkU7feJ..X8JDun0.Tie.LHtqPjfRWk0ENVya', '9336795681', '1365-10-14', 'کانتر میوه فروش', NULL, NULL, 1, 0, 0, 0, NULL, NULL, NULL, '2023-09-16 07:50:00', '2023-10-03 16:49:31', NULL),
(9, 'زهرا', 'قربان زاده', NULL, 'zahra@yahoo.com', NULL, '$2y$10$T00zNlUth5UMSrPfuVX.2uQzhNKLw67Gf9kz6GLQtEmVEGJ86R8le', '9216974681', '1380-11-09', 'کاربر ساده', 'uploads\\users\\profile\\2023\\10\\03\\1696355430.png', 'uploads\\users\\signature\\2023\\10\\05\\1696491618.png', 0, 0, 1, 1, '0', '1,5,3', NULL, '2023-10-03 17:50:30', '2023-10-05 07:40:19', NULL),
(12, 'نعیم', 'غلامی', NULL, 'dilan70734@klanze.com', '2023-10-06 08:23:37', '$2y$10$ruMfcc710D8GkmM1nnU3runzK7ZghOjF5KcUakEzL3/v3snhIAs66', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 1, NULL, NULL, 'AK12MNW6H5L7IleK4SO87HxTIL37y0JW5AAuGzpKtOsktqafobnKJQsNomYl', '2023-10-05 13:05:17', '2023-10-06 08:23:37', NULL),
(19, 'ساناز', 'محمودی', NULL, 'aqyvh@any.pink', '2023-10-06 07:04:16', '$2y$10$I8F2d7C3xASPdYRpw2hJb.RfeLX9MCAZn7LbDpB4XopQTFVLXNqnq', '9195379248', '1383-07-22', 'آرایشگر', 'uploads\\users\\profile\\2023\\10\\06\\1696575373.png', 'uploads\\users\\signature\\2023\\10\\06\\1696575574.jpg', 0, 1, 1, 0, NULL, NULL, 'c98LT7nJhjknnvALTxxPnmVPTaZQxvyJPgxpkItqMtiKASYg6VybG0q38GBd', '2023-10-05 19:06:29', '2023-10-06 07:04:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_parent_id_foreign` (`parent_id`),
  ADD KEY `groups_group_leader_id_foreign` (`group_leader_id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `group_user_group_id_foreign` (`group_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_title_unique` (`title`),
  ADD UNIQUE KEY `permissions_persian_name_unique` (`persian_name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`permission_id`,`user_id`),
  ADD KEY `permission_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_group_id_foreign` (`group_id`),
  ADD KEY `projects_status_id_foreign` (`status_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_title_unique` (`title`),
  ADD UNIQUE KEY `roles_persian_name_unique` (`persian_name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_status_id_foreign` (`status_id`);

--
-- Indexes for table `task_access_types`
--
ALTER TABLE `task_access_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_statuses`
--
ALTER TABLE `task_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`user_id`,`task_id`),
  ADD KEY `task_user_task_id_foreign` (`task_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_access_types`
--
ALTER TABLE `task_access_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_statuses`
--
ALTER TABLE `task_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_group_leader_id_foreign` FOREIGN KEY (`group_leader_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
