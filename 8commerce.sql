-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2018 at 06:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `8commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `commentable_id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `url`, `user_id`, `commentable_id`, `commentable_type`, `created_at`, `updated_at`) VALUES
(1, 'test komen', 'google.com', 1, 1, 'App\\Project', '2018-01-12 08:17:00', '2018-01-12 08:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '8commerce', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, '2017-12-06 01:26:11', '2017-12-11 20:32:09'),
(2, 'Wonderfully Made', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, '2017-12-06 01:27:44', '2017-12-11 20:33:36'),
(3, 'Minimal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, '2017-12-06 01:28:08', '2017-12-11 20:33:18'),
(4, 'Bibia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, '2017-12-06 01:28:31', '2017-12-11 20:32:35'),
(5, 'Bose', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, '2017-12-06 01:29:13', '2017-12-11 20:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2017_11_14_162433_create_companies_table', 1),
(15, '2017_11_14_163015_create_projects_table', 1),
(16, '2017_11_14_163603_create_tasks_table', 1),
(17, '2017_11_14_164948_create_comments_table', 1),
(18, '2017_11_14_170206_create_roles_table', 1),
(19, '2017_11_14_171012_create_project_user_table', 1),
(20, '2017_11_14_171337_create_task_user_table', 1),
(21, '2017_11_30_050025_create_presences_table', 1),
(22, '2017_11_30_050234_create_presence_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `days` int(10) UNSIGNED DEFAULT NULL,
  `max_days` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presences`
--

INSERT INTO `presences` (`id`, `name`, `month`, `year`, `user_id`, `days`, `max_days`, `created_at`, `updated_at`) VALUES
(1, 'January2017', 'January', '2017', 1, 21, 24, '2017-12-06 01:31:48', '2017-12-06 01:31:48'),
(2, 'January2017', 'January', '2017', 2, 22, 24, '2017-12-06 01:31:48', '2017-12-06 01:31:48'),
(3, 'January2018', 'January', '2018', 1, 21, 23, '2017-12-06 01:34:46', '2017-12-06 01:34:46'),
(4, 'January2018', 'January', '2018', 2, 22, 23, '2017-12-06 01:34:46', '2017-12-06 01:34:46'),
(5, 'November2018', 'November', '2018', 1, 21, 23, '2017-12-06 02:44:33', '2017-12-06 02:44:33'),
(6, 'November2018', 'November', '2018', 2, 22, 23, '2017-12-06 02:44:33', '2017-12-06 02:44:33'),
(7, 'February2017', 'February', '2017', 1, 25, 26, '2017-12-06 03:44:44', '2017-12-06 03:44:44'),
(8, 'February2017', 'February', '2017', 2, 24, 26, '2017-12-06 03:44:44', '2017-12-06 03:44:44'),
(9, 'November2017', 'November', '2017', 1, 24, 25, '2017-12-10 20:30:07', '2017-12-10 20:30:07'),
(10, 'November2017', 'November', '2017', 2, 20, 25, '2017-12-10 20:30:07', '2017-12-10 20:30:07'),
(11, 'December2018', 'December', '2018', 1, 25, 26, '2018-01-02 23:50:23', '2018-01-02 23:50:23'),
(12, 'December2018', 'December', '2018', 2, 22, 26, '2018-01-02 23:50:23', '2018-01-02 23:50:23'),
(13, 'December2017', 'December', '2017', 1, 24, 25, '2018-01-02 23:51:44', '2018-01-02 23:51:44'),
(14, 'December2017', 'December', '2017', 2, 22, 25, '2018-01-02 23:51:45', '2018-01-02 23:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `presence_user`
--

CREATE TABLE `presence_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `presence_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `project_nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `days` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `project_nickname`, `company_id`, `user_id`, `days`, `created_at`, `updated_at`) VALUES
(1, 'Order Management System', NULL, 'oms', 1, 1, NULL, '2017-12-06 01:26:28', '2017-12-06 01:26:28'),
(2, 'Linc Website', NULL, 'linc', 1, 1, NULL, '2017-12-06 01:26:51', '2017-12-06 01:26:51'),
(3, '8commerce Website', NULL, '8commerce', 1, 1, NULL, '2017-12-06 01:27:13', '2017-12-06 01:27:13'),
(4, 'Market Place Management', NULL, 'marketplace', 1, 1, NULL, '2017-12-06 01:27:27', '2017-12-06 01:27:27'),
(5, 'Wondefully Made website', NULL, 'wonderfullymade', 2, 1, NULL, '2017-12-06 01:27:54', '2017-12-06 01:27:54'),
(6, 'Minimal eCommerce Website', NULL, 'minimal', 3, 1, NULL, '2017-12-06 01:28:18', '2017-12-06 01:28:18'),
(7, 'Bibia.com', NULL, 'bibia', 4, 1, NULL, '2017-12-06 01:28:55', '2017-12-06 01:28:55'),
(8, 'Bose Website', NULL, 'bose', 5, 1, NULL, '2017-12-06 01:29:23', '2017-12-06 01:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Project Manager', '2018-01-11 17:00:00', NULL),
(2, 'Programmer', '2018-01-11 17:00:00', NULL),
(3, 'Client', '2018-01-11 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `project_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `days` int(10) UNSIGNED DEFAULT NULL,
  `points` int(10) UNSIGNED NOT NULL,
  `is_closed` tinyint(1) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `project_id`, `company_id`, `user_id`, `days`, `points`, `is_closed`, `status`, `finished_at`, `created_at`, `updated_at`) VALUES
(13, 'Shopee Integration', 'Integrate with Shopee API', 1, 1, 1, NULL, 7, 1, 'Done', '2017-12-09 23:16:00', '2017-12-04 20:16:43', '2017-12-09 23:16:00'),
(17, 'So Good Top 10 Sales Report', 'So Good Top 10 Sales Report', 1, 1, 1, NULL, 2, 1, 'Done', '2017-12-07 00:09:36', '2017-12-04 21:33:42', '2017-12-07 00:09:36'),
(19, 'Wonderfullymade demo pages', 'Wonderfullymade demo pages', 5, 2, 1, NULL, 6, 0, 'In progress', NULL, '2017-12-04 23:44:11', '2017-12-05 21:53:29'),
(20, 'create tampilan harga cicilan bulanan', NULL, 6, 3, 1, NULL, 3, 1, 'Done', '2017-12-07 18:46:47', '2017-12-04 23:54:48', '2017-12-07 18:46:47'),
(28, 'Lincgroup Online Apply Job', 'Lincgroup Online Apply Job', 2, 1, 1, NULL, 4, 1, 'Done', '2017-12-10 20:00:25', '2017-12-05 00:39:01', '2017-12-10 20:00:25'),
(37, 'Add check status order feature on header', NULL, 7, 4, 1, NULL, 1, 1, 'Done', '2017-12-08 01:17:32', '2017-12-05 01:02:55', '2017-12-08 01:17:32'),
(39, 'Order Management and Report', NULL, 8, 5, 1, NULL, 1, 1, 'Done', '2017-12-06 23:19:43', '2017-12-05 01:04:28', '2017-12-06 23:19:43'),
(41, 'Discount for subscriber', NULL, 7, 4, 1, NULL, 1, 0, 'In progress', NULL, '2017-12-05 01:06:05', '2017-12-06 23:19:43'),
(45, 'digitalmarketing editing content', NULL, 3, 1, 1, NULL, 1, 1, 'Done', '2017-12-06 23:19:43', '2017-12-05 01:23:01', '2017-12-06 23:19:43'),
(47, 'list kerjaan marketplace yosua', NULL, 4, 1, 2, NULL, 5, 1, 'Done', '2017-12-06 23:19:43', '2017-12-05 01:28:20', '2017-12-06 23:19:43'),
(54, 'modifikasi footer', NULL, 6, 3, 1, NULL, 1, 1, 'Done', '2017-12-07 18:46:44', '2017-12-05 01:41:32', '2017-12-07 18:46:44'),
(56, 'Rekap data issue so good', NULL, 4, 1, 1, NULL, 3, 1, 'Done', '2017-12-10 20:25:51', '2017-12-05 01:47:19', '2017-12-10 20:25:51'),
(60, 'update promo harga untuk Alibi.', NULL, 4, 1, 1, NULL, 3, 1, 'Done', '2017-12-10 20:26:22', '2017-12-05 02:03:25', '2017-12-10 20:26:22'),
(63, 'Magento initial', NULL, 7, 4, 1, NULL, 3, 1, 'Done', '2017-12-06 20:24:18', '2017-12-05 20:12:13', '2017-12-06 20:24:18'),
(64, 'Static pages', NULL, 6, 3, 1, NULL, 2, 1, 'Done', '2017-12-10 02:21:28', '2017-12-05 23:29:35', '2017-12-10 02:21:28'),
(71, 'Category page backend', NULL, 6, 3, 2, NULL, 6, 1, 'Done', '2017-12-08 21:39:53', '2017-12-05 23:50:19', '2017-12-08 21:39:53'),
(72, 'Category page front end', NULL, 6, 3, 1, NULL, 10, 0, 'New', NULL, '2017-12-05 23:52:11', '2017-12-09 00:15:47'),
(73, 'Product detail page back end', NULL, 6, 3, 1, NULL, 4, 1, 'Done', '2017-12-17 21:12:20', '2017-12-05 23:58:30', '2017-12-17 21:12:20'),
(74, 'Product detail page front end', NULL, 6, 3, 1, NULL, 8, 0, 'New', NULL, '2017-12-05 23:58:40', '2017-12-06 00:16:48'),
(75, 'Checkout page back end', NULL, 6, 3, 1, NULL, 4, 0, 'New', NULL, '2017-12-05 23:58:56', '2017-12-07 21:13:29'),
(76, 'Checkout page front end', NULL, 6, 3, 1, NULL, 10, 0, 'New', NULL, '2017-12-05 23:59:20', '2017-12-07 21:40:48'),
(77, 'Account page front end', NULL, 6, 3, 1, NULL, 10, 0, 'New', NULL, '2017-12-06 00:00:59', '2017-12-14 21:59:33'),
(78, 'Register page front end', NULL, 6, 3, 1, NULL, 1, 0, 'New', NULL, '2017-12-06 00:01:25', '2017-12-07 21:14:32'),
(79, 'Search result page back end', NULL, 6, 3, 1, NULL, 1, 0, 'New', NULL, '2017-12-06 00:03:40', '2017-12-07 21:14:57'),
(80, 'Search result page front end', NULL, 6, 3, 1, NULL, 2, 0, 'New', NULL, '2017-12-06 00:03:48', '2017-12-07 21:15:15'),
(82, 'quick view front end', NULL, 6, 3, 1, NULL, 1, 0, 'New', NULL, '2017-12-06 00:04:13', '2017-12-12 19:26:15'),
(91, 'Header back end', NULL, 6, 3, 1, NULL, 2, 1, 'Done', '2017-12-12 21:38:40', '2017-12-06 20:48:49', '2017-12-12 21:38:40'),
(92, 'Header front end', NULL, 6, 3, 1, NULL, 8, 0, 'In progress', NULL, '2017-12-06 20:48:49', '2017-12-16 18:25:26'),
(93, 'Footer front end', NULL, 6, 3, 1, NULL, 1, 0, 'New', NULL, '2017-12-06 20:48:49', '2017-12-11 20:03:17'),
(105, 'Linc excel reporting horizontal', NULL, 2, 1, 1, NULL, 4, 0, 'New', NULL, '2017-12-06 20:48:49', '2017-12-18 00:29:58'),
(118, 'Tambahan kolom order_amount di OrderHeader', 'Improvement untuk order amount di order header, karena ada kemungkinan amount di marketplace berbeda dengan penjumlahan amount order detail, terutama utk SKU KIT.\n\n•	Saya sudah buatkan column baru di tbl_order_header —> order_amount\n•	Column ini sudah ada data-nya, diisi dari manual rekon, jadi jangan di hapus\n•	Column ini belum di code ke model orderHeader\n\n\nJadi perubahan-nya:\n•	Tambahkan code di model orderHeader untuk column ini\n•	Tampilkan di view orderHeader detail dan admin (list)\n\nUntuk manual order entry\n•	Setiap kali penambahan atau penghapusan order item, tambah dan kurang order_amount di tbl_order_header\n\nUntuk API dari marketplace\n•	Ambil paid amount dari marketplace dan masukkan ke column order_amount\n\nUntuk API dari online store\n•	Setelah orderDetail selesai dimasukkan semua, hitung ulang order amount dan update ke order_amount', 1, 1, 1, NULL, 4, 1, 'Done', '2017-12-17 18:49:09', '2017-12-10 20:19:36', '2017-12-17 18:49:09'),
(132, 'Grafik report so good', NULL, 1, 1, 1, NULL, 0, 1, 'Done', '2017-12-11 20:22:57', '2017-12-10 20:19:36', '2017-12-11 20:22:57'),
(135, '7 Juli 2017', 'Jumat, 7 Juli 2017 :\n•	Update Stock Product Sophie - Qoo10\n•	Update Stock Product Sophie - Elevenia\n•	Update Stock Product Alibi - Qoo10\n•	Update Stock Product Alibi - Elevenia\n\n\nTotal product nearly 1.000 products.', 4, 1, 1, NULL, 4, 1, 'Done', '2017-12-11 19:20:48', '2017-12-10 20:19:36', '2017-12-11 19:20:48'),
(138, 'Update footer 8commerce.com', NULL, 3, 1, 1, NULL, 3, 1, 'Done', '2017-12-12 18:49:37', '2017-12-10 20:19:36', '2017-12-12 18:49:37'),
(141, 'Banners refreshment', NULL, 3, 1, 1, NULL, 0, 1, 'Done', '2017-12-15 01:32:41', '2017-12-10 20:19:36', '2017-12-15 01:32:41'),
(146, 'Product Detail - related product & mix and match (cross sell)', NULL, 6, 3, 1, NULL, 1, 1, 'Done', '2017-12-12 21:38:59', '2017-12-10 20:19:36', '2017-12-12 21:38:59'),
(149, 'apply job version 1 revisi', NULL, 2, 1, 1, NULL, 1, 1, 'Done', '2017-12-17 19:48:07', '2017-12-10 20:19:36', '2017-12-17 19:48:07'),
(151, 'report so good tambahkan filter status', NULL, 1, 1, 1, NULL, 0, 1, 'Done', '2017-12-17 18:57:41', '2017-12-10 20:19:36', '2017-12-17 18:57:41'),
(158, 'Data Transport Report', 'Tlg dibuatkan menu khusus billing (under report —> billing) hanya bisa diakses oleh user role finance. Report pertama adalah data transport:\n\nReport name: data transport\nFilter: order date (from, to)\nDisplay: data grid\nExport: excel\nQuery: \n\nselect o.company_id, t.create_time as shipped_date, o.order_no, o.dest_name, o.dest_address1, o.courier_id, o.awb_no, o.order_source, o.status\nfrom tbl_order_header o left join tbl_order_status_tracking t on t.order_header_id=o.order_header_id\nwhere o.status in (\'shipped\',\'delivered\',\'return\',\'return-reject\')', 1, 1, 1, NULL, 2, 1, 'Done', '2017-12-19 19:59:35', '2017-12-10 20:19:36', '2017-12-19 19:59:35'),
(167, 'Marketplace Detail Settlement Report', 'Tlg dibuatkan menu khusus billing (under report —> billing) hanya bisa diakses oleh user role finance. Report pertama adalah data transport:\n\nReport name: marketplace detail settlement\nFilter: order_no (text area, separate by enter)\nDisplay: data grid\nExport: excel\n\nQuery:\n\nselect o.company_id, o.order_no, o.status, o.order_source, o.order_date, o.dest_name, o.dest_province, o.dest_city, o.dest_area, o.dest_sub_area, d.sku_code, d.sku_description, d.qty_order, d.remarks from tbl_order_header o left join tbl_order_detail d on d.order_header_id=o.order_header_id\nwhere o.status not in (\'cancelled\',\'draft\') and o.company_id not like \'%TEST’', 1, 1, 1, NULL, 2, 1, 'Done', '2017-12-19 19:59:42', '2017-12-10 20:19:36', '2017-12-19 19:59:42'),
(173, 'Tokopedia Integration', 'Integrate with Tokopedia API', 1, 1, 1, NULL, 7, 0, 'New', NULL, '2017-12-10 20:19:36', '2017-12-18 01:58:49'),
(186, 'Revisi go live', NULL, 6, 3, 1, NULL, 3, 0, 'New', NULL, '2017-12-19 20:05:43', '2017-12-23 20:06:32'),
(189, 'Display foto dari mobile app', 'Data foto yang diambil dari mobile app tlg di display di trip detail —> view, untuk detail format dan teknis bisa konsultasi dengan Yosua dan Yoga', 1, 1, 2, NULL, 0, 1, 'Done', '2017-12-27 18:50:45', '2017-12-19 20:05:43', '2017-12-27 18:50:45'),
(191, 'create function orderDelivered di API blibli', 'create function orderDelivered di API blibli', 1, 1, 2, NULL, 0, 1, 'Done', '2017-12-27 18:50:55', '2017-12-19 20:05:43', '2017-12-27 18:50:55'),
(193, 'Home Page Revision', NULL, 6, 3, 1, NULL, 3, 0, 'In progress', NULL, '2017-12-19 20:05:43', '2017-12-25 23:28:58'),
(198, 'migrate home page assets to cloudinary', NULL, 6, 3, 1, NULL, 0, 0, 'New', NULL, '2017-12-19 20:05:43', '2017-12-26 02:32:51'),
(200, 'New report: Report empty stock with draft order', 'Tlg dibuatkan report baru (under report —> operation) \n\nReport name: Draft order empty stock\nFilter: (pakai text field filter standard yii)\nDisplay: data grid\nExport: excel\nQuery: \n\nselect * from vw_item_order_check where status=\'draft\' and stock_available=0', 1, 1, 1, NULL, 1, 1, 'Done', '2017-12-23 18:51:11', '2017-12-19 20:05:43', '2017-12-23 18:51:11'),
(203, 'Integrasi Order', NULL, 6, 3, 1, NULL, 2, 1, 'Done', '2017-12-22 21:39:27', '2017-12-19 20:05:43', '2017-12-22 21:39:27'),
(209, 'Integrasi J&T', 'contact lexi 0817363868 ya', 1, 1, 2, NULL, 3, 1, 'Done', '2017-12-09 23:16:46', '2017-12-02 21:16:11', '2017-12-09 23:16:46'),
(215, 'marketplace settlement revisi filter', NULL, 1, 1, 1, NULL, 1, 1, 'Done', '2017-12-07 18:51:21', '2017-12-02 22:14:55', '2017-12-07 18:51:21'),
(217, 'SEO', NULL, 3, 1, 1, NULL, 7, 0, 'New', NULL, '2017-12-03 00:17:25', '2017-12-06 00:18:04'),
(219, 'US untuk issue2', '# US untuk issue-isue berikut #208 #207 #206 #205 #197 #184 #183 #163 #161 #157 #136 #112 jadi, kalo ngerjain issue supaya dapet point, issue nya di buat US juga', 1, 1, 1, NULL, 5, 1, 'Done', '2017-12-11 19:18:38', '2017-12-06 20:48:49', '2017-12-11 19:18:38'),
(220, 'Create model sku_problem', 'a', 1, 1, 1, NULL, 0, 1, 'Done', '2017-12-10 00:09:49', '2017-12-06 20:48:49', '2017-12-10 00:09:49'),
(226, 'Perbaikan konten dinamis dan mobile', NULL, 6, 3, 1, NULL, 2, 0, 'New', NULL, '2017-12-06 20:48:49', '2017-12-10 00:49:00'),
(229, 'fix sogood report query', NULL, 1, 1, 1, NULL, 0, 0, 'New', NULL, '2017-12-06 20:48:49', '2017-12-10 01:49:35'),
(231, 'create script auto fill sku_parent', NULL, 1, 1, 2, NULL, 0, 1, 'Done', '2017-12-14 21:58:11', '2017-12-10 20:19:36', '2017-12-14 21:58:11'),
(233, 'cek Order ECJET', NULL, 1, 1, 1, NULL, 0, 0, 'New', NULL, '2017-12-10 20:19:36', '2017-12-13 20:40:06'),
(235, 'implement field order_price in product detail', NULL, 1, 1, 1, NULL, 1, 0, 'New', NULL, '2017-12-10 20:19:36', '2017-12-14 21:57:38'),
(237, 'fix telegram issue', NULL, 1, 1, 1, NULL, 0, 0, 'New', NULL, '2017-12-10 20:19:36', '2017-12-14 21:58:53'),
(239, 'Kit Double SKU Report', 'Tlg dibuatkan report baru (under report —> operation) \n\nReport name: Kit Double SKU\nFilter: (pakai text field filter standard yii)\nDisplay: data grid\nExport: excel\nQuery: \n\nselect company_id, sku_kit_id, sku_component_id, count(sku_kit_component_id) from `tbl_sku_kit_component` group by company_id, sku_kit_id, sku_component_id having count(sku_kit_component_id) > 1', 1, 1, 1, NULL, 1, 0, 'New', NULL, '2017-12-10 20:19:36', '2017-12-15 20:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 209, 2, '2018-01-02 23:49:17', '2018-01-02 23:49:17'),
(2, 215, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(3, 217, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(4, 13, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(5, 17, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(6, 19, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(7, 20, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(8, 28, 1, '2018-01-02 23:49:18', '2018-01-02 23:49:18'),
(9, 37, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(10, 39, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(11, 41, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(12, 45, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(13, 47, 2, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(14, 54, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(15, 56, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(16, 60, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(17, 63, 1, '2018-01-02 23:49:19', '2018-01-02 23:49:19'),
(18, 64, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(19, 71, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(20, 72, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(21, 73, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(22, 74, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(23, 75, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(24, 76, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(25, 77, 1, '2018-01-02 23:49:20', '2018-01-02 23:49:20'),
(26, 78, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(27, 79, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(28, 80, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(29, 82, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(30, 91, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(31, 92, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(32, 93, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(33, 219, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(34, 220, 1, '2018-01-02 23:49:21', '2018-01-02 23:49:21'),
(35, 105, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(36, 226, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(37, 229, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(38, 118, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(39, 132, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(40, 231, 2, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(41, 135, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(42, 138, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(43, 141, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(44, 146, 1, '2018-01-02 23:49:22', '2018-01-02 23:49:22'),
(45, 149, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(46, 151, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(47, 233, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(48, 235, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(49, 237, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(50, 239, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(51, 158, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(52, 167, 1, '2018-01-02 23:49:23', '2018-01-02 23:49:23'),
(53, 173, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(54, 186, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(55, 189, 2, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(56, 191, 2, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(57, 193, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(58, 198, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(59, 200, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(60, 203, 1, '2018-01-02 23:49:24', '2018-01-02 23:49:24'),
(61, 71, 2, '2018-01-02 23:49:20', '2018-01-02 23:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '3',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `position`, `description`, `avatar`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Imam Prastio', 'mulerrr', 'Front End Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem fugit dignissimos culpa suscipit alias necessitatibus id ex molestiae nulla aut.', '/images/avatar/imam-prastio.jpg', 'imam.prastio@gmail.com', '$2y$10$YLy3pY3YPnG2ZLpl4NgLIumBzRCKcvUtEoPopC5nqJxbXTJaQCAby', 3, 'bE0ue3B4Iu1qQc5fXa7tykpymWfnJsl8fKNmn0MG9PbTyRB84nrIBljzsMgS', '2017-12-06 01:25:23', '2017-12-08 00:59:25'),
(2, 'Cumi Bakar', 'cumicumi', 'Back End Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem fugit dignissimos culpa suscipit alias necessitatibus id ex molestiae nulla aut.', '/images/avatar/cumi-bakar.jpg', 'cumicumi@gmail.com', '$2y$10$e3Jz6YrxFQWz..xokoP8Y.B5HBpqYvkF2jmFhjWWqysr5zpc99neK', 3, 'J9KQhqZ1FyJuuI1mOOWKKUyH1bTcHTNCWO4bLX5Z9pCq2IZC3BicUiFDgSYr', '2017-12-06 01:30:51', '2017-12-07 01:21:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_user_id_foreign` (`user_id`);

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
-- Indexes for table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presences_user_id_foreign` (`user_id`);

--
-- Indexes for table `presence_user`
--
ALTER TABLE `presence_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presence_user_user_id_foreign` (`user_id`),
  ADD KEY `presence_user_presence_id_foreign` (`presence_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`),
  ADD KEY `projects_company_id_foreign` (`company_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`),
  ADD KEY `project_user_project_id_foreign` (`project_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`),
  ADD KEY `tasks_company_id_foreign` (`company_id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_user_user_id_foreign` (`user_id`),
  ADD KEY `task_user_task_id_foreign` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `presence_user`
--
ALTER TABLE `presence_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `presence_user`
--
ALTER TABLE `presence_user`
  ADD CONSTRAINT `presence_user_presence_id_foreign` FOREIGN KEY (`presence_id`) REFERENCES `presences` (`id`),
  ADD CONSTRAINT `presence_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
