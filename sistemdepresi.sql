-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2025 at 04:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemdepresi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '5dfac2b1e5d71309ec8a6b445c5cc515', '2025-03-03 03:19:55'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', '5dfac2b1e5d71309ec8a6b445c5cc515', '2025-03-03 03:28:27'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'ba0bdb3a1ca95d3baf41d32a6336671e', '2025-03-10 05:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'administrator who can manage the system'),
(2, 'user', 'users only can access and use the system');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 4),
(2, 2),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'minhyung', 2, '2025-01-28 04:07:13', 0),
(2, '::1', 'minhyung', NULL, '2025-01-28 04:12:43', 0),
(3, '::1', 'canadianspidermark@gmail.com', 2, '2025-01-28 04:12:54', 1),
(4, '::1', 'canadianspidermark@gmail.com', 2, '2025-01-28 07:57:40', 1),
(5, '::1', 'canadianspidermark@gmail.com', 2, '2025-01-28 08:18:47', 1),
(6, '::1', 'canadianspidermark@gmail.com', 2, '2025-01-30 07:08:31', 1),
(7, '::1', 'canadianspidermark@gmail.com', 2, '2025-01-31 07:43:10', 1),
(8, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-04 11:40:10', 1),
(9, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-08 04:08:24', 1),
(10, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-12 02:14:14', 1),
(11, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-12 03:08:35', 1),
(12, '::1', 'admin', NULL, '2025-02-13 04:42:38', 0),
(13, '::1', 'admin', NULL, '2025-02-13 04:43:54', 0),
(14, '::1', 'admin@admin.com', 4, '2025-02-13 04:50:09', 1),
(15, '::1', 'admin@admin.com', 4, '2025-02-14 02:46:36', 1),
(16, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-14 08:39:48', 1),
(17, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-17 06:01:37', 1),
(18, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-17 06:47:26', 1),
(19, '::1', 'admin@admin.com', 4, '2025-02-17 07:52:46', 1),
(20, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-20 13:50:45', 1),
(21, '::1', 'admin@admin.com', 4, '2025-02-20 13:51:02', 1),
(22, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-21 12:12:15', 1),
(23, '::1', 'admin@admin.com', 4, '2025-02-21 13:45:18', 1),
(24, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-21 13:46:57', 1),
(25, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-21 13:53:00', 1),
(26, '::1', 'admin@admin.com', 4, '2025-02-21 13:53:15', 1),
(27, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-22 05:51:38', 1),
(28, '::1', 'canadianspidermark@gmail.com', 2, '2025-02-22 09:13:43', 1),
(29, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-02 07:09:31', 1),
(30, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-03 00:58:21', 1),
(31, '::1', 'admin@admin.com', 4, '2025-03-03 02:26:38', 1),
(32, '::1', 'buatbelajaralvi@gmail.com', 5, '2025-03-03 03:20:22', 1),
(33, '::1', 'buatbelajaralvi@gmail.com', 5, '2025-03-03 03:20:54', 1),
(34, '::1', 'buatbelajaralvi@gmail.com', 5, '2025-03-03 03:23:41', 1),
(35, '::1', 'admin', NULL, '2025-03-03 05:36:37', 0),
(36, '::1', 'admin@admin.com', 4, '2025-03-03 05:37:14', 1),
(37, '::1', 'admin@admin.com', 4, '2025-03-03 05:41:32', 1),
(38, '::1', 'admin@admin.com', 4, '2025-03-05 03:08:08', 1),
(39, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-06 12:53:10', 1),
(40, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-07 00:25:42', 1),
(41, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-07 00:58:28', 1),
(42, '::1', 'admin@admin.com', 4, '2025-03-07 01:12:03', 1),
(43, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-07 03:47:20', 1),
(44, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-07 06:34:48', 1),
(45, '::1', 'admin@admin.com', 4, '2025-03-07 06:40:14', 1),
(46, '::1', 'admin@admin.com', 4, '2025-03-07 14:08:52', 1),
(47, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-08 13:06:42', 1),
(48, '::1', 'admin@admin.com', 4, '2025-03-08 13:08:30', 1),
(49, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-08 13:56:50', 1),
(50, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-10 02:07:06', 1),
(51, '::1', 'admin@admin.com', 4, '2025-03-10 03:35:58', 1),
(52, '::1', 'buatbelajaralvi@gmail.com', 6, '2025-03-10 05:06:07', 1),
(53, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-11 13:25:33', 1),
(54, '::1', 'buatbelajaralvi@gmail.com', 6, '2025-03-14 06:36:35', 1),
(55, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-16 03:01:33', 1),
(56, '::1', 'admin@admin.com', 4, '2025-03-16 03:02:00', 1),
(57, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-16 03:03:34', 1),
(58, '::1', 'admin@admin.com', 4, '2025-03-16 06:28:38', 1),
(59, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-16 06:30:09', 1),
(60, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-17 12:18:16', 1),
(61, '::1', 'admin@admin.com', 4, '2025-03-17 13:04:51', 1),
(62, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-18 03:41:38', 1),
(63, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-18 11:52:29', 1),
(64, '::1', 'admin@admin.com', 4, '2025-03-18 15:05:33', 1),
(65, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-18 16:03:50', 1),
(66, '::1', 'canadianspidermark@gmail.com', 2, '2025-03-19 07:32:37', 1),
(67, '::1', 'admin@admin.com', 4, '2025-03-19 13:33:53', 1),
(68, '::1', 'canadianspidermark@gmail.com', 2, '2025-10-08 12:47:53', 1),
(69, '::1', 'canadianspidermark@gmail.com', 2, '2025-10-08 15:52:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Depresi Ringan'),
(2, 'Depresi Sedang'),
(3, 'Depresi Berat'),
(4, 'Terindikasi Gangguan Depresif'),
(5, 'Baik-baik saja');

-- --------------------------------------------------------

--
-- Table structure for table `checked_question`
--

CREATE TABLE `checked_question` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `test_id` int DEFAULT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `test_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checked_question`
--

INSERT INTO `checked_question` (`id`, `user_id`, `test_id`, `question_id`, `test_date`) VALUES
(192, 2, 51, 21, '2025-03-18 12:08:19'),
(193, 2, 51, 25, '2025-03-18 12:08:19'),
(194, 2, 54, 1, '2025-03-18 12:11:31'),
(195, 2, 54, 3, '2025-03-18 12:11:31'),
(196, 2, 54, 5, '2025-03-18 12:11:31'),
(197, 2, 56, 1, '2025-03-18 12:20:09'),
(198, 2, 56, 3, '2025-03-18 12:20:09'),
(199, 2, 56, 5, '2025-03-18 12:20:09'),
(200, 2, 58, 1, '2025-03-18 12:21:30'),
(201, 2, 58, 3, '2025-03-18 12:21:30'),
(202, 2, 58, 5, '2025-03-18 12:21:30'),
(203, 2, 59, 1, '2025-03-18 12:26:03'),
(204, 2, 59, 3, '2025-03-18 12:26:03'),
(205, 2, 59, 5, '2025-03-18 12:26:03'),
(206, 2, 60, 8, '2025-03-19 07:33:12'),
(207, 2, 60, 26, '2025-03-19 07:33:12'),
(208, 2, 60, 27, '2025-03-19 07:33:12'),
(209, 2, 61, 11, '2025-10-08 19:54:38'),
(210, 2, 61, 2, '2025-10-08 19:54:38'),
(211, 2, 61, 4, '2025-10-08 19:54:38'),
(212, 2, 61, 12, '2025-10-08 19:54:38'),
(213, 2, 61, 5, '2025-10-08 19:54:38'),
(214, 2, 62, 5, '2025-10-08 22:53:00'),
(215, 2, 62, 11, '2025-10-08 22:53:00'),
(216, 2, 62, 4, '2025-10-08 22:53:00'),
(217, 2, 62, 2, '2025-10-08 22:53:00'),
(218, 2, 62, 12, '2025-10-08 22:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1738026947, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int UNSIGNED NOT NULL,
  `soal` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `soal`) VALUES
(1, 'Konsentrasi dan perhatian berkurang'),
(2, 'Harga diri dan kepercayaan diri berkurang'),
(3, 'Perasaan merasa bersalah '),
(4, 'Perasaan tidak berguna'),
(5, 'Perasaan pesimistis'),
(6, 'Melakukan tindakan yang membahayakan diri'),
(7, 'Tidur terganggu'),
(8, 'Nafsu makan berkurang'),
(9, 'Perasaan mood yang kacau berkepanjangan'),
(10, 'Kehilangan minat untuk bersenang senang'),
(11, 'Mudah menjadi lelah'),
(12, 'Kegelisahaan yang nyata'),
(13, 'Tidak mampu bersosialisasi/ melakukan kegiatan sosial');

-- --------------------------------------------------------

--
-- Table structure for table `saran_penanganan`
--

CREATE TABLE `saran_penanganan` (
  `id` int NOT NULL,
  `kategori` int DEFAULT NULL,
  `penanganan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saran_penanganan`
--

INSERT INTO `saran_penanganan` (`id`, `kategori`, `penanganan`) VALUES
(1, 1, 'Mulailah mengikuti kegiatan yang berhubungan dengan hobi, hal ini dapat membantumu memulihkan minat dan meningkatkan energi'),
(2, 1, 'Lakukan olahraga ringan seperti senam, yoga, atau bersepeda, dan meditasi terpandu (aplikasi mindfullness)'),
(3, 1, 'Tulis jurnal emosi tanpa sensor, ini akan membantu membuka ruang ekspresi untuk kamu'),
(4, 1, 'Menyusun \"daftar hal kecil yang membuat senang\" setiap hari akan membantu menjaga keseimbangan mood kamu'),
(5, 2, 'Lakukan olahraga rutin minimal 3x seminggu selama kurang lebih 30 menit, ini akan membantu menstabilkan mood kamu'),
(6, 2, 'Buatlah tujuan yang realistis dan terukur untuk diri sendiri. Ini dapat membantu memberikan rasa pencapaian dan tujuanitas harian sederhana untuk menjaga produktifitas'),
(7, 2, 'Buat daftar masalah yang kamu hadapi, dan pecah masalah tersebut untuk menemukan solusi-solusi kecil'),
(8, 2, 'Untuk langkah yang lebih baik, lakukan konsultasi awal dengan psikolog/konselor'),
(9, 3, 'Kondisi yang kamu alami sudah berada pada level berat, sebaiknya segera hubungi tenaga profesional untuk penanganan yang lebih terpercaya'),
(10, 4, 'Berjalan kaki di ruang terbuka(taman, sawah, dll) sambil mendengarkan playlist favorit akan membantumu mengurangi stress'),
(11, 4, 'Sebaiknya kurangi mengonsumsi berita negatif dan mulailah untuk melihat tontonan yang positif'),
(12, 4, 'Tidur yang cukup yaa'),
(13, 5, 'Lakukan journaling harian dan olahraga ringan untuk menjaga keseimbangan emosimu'),
(14, 5, 'Lakukan meditasi/latihan pernapasan 5-10 menit per hari untuk relaksasi'),
(15, 5, 'Membaca buku inspiratif atau fiksi ringan akan membantu kamu mencegah burnout'),
(16, 5, 'Jangan lupa untuk beristirahat dengan cukup');

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `test_date` datetime NOT NULL,
  `jumlah_checked` int NOT NULL,
  `total_pertanyaan` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`id`, `user_id`, `test_date`, `jumlah_checked`, `total_pertanyaan`, `kategori`) VALUES
(51, 2, '2025-03-18 12:08:19', 2, 29, ''),
(54, 2, '2025-03-18 12:11:31', 3, 29, ''),
(55, 2, '2025-03-18 12:19:49', 3, 29, ''),
(56, 2, '2025-03-18 12:20:09', 3, 29, ''),
(57, 2, '2025-03-18 12:21:21', 3, 29, ''),
(58, 2, '2025-03-18 12:21:30', 3, 29, ''),
(59, 2, '2025-03-18 12:26:03', 3, 29, ''),
(60, 2, '2025-03-19 07:33:12', 3, 29, ''),
(61, 2, '2025-10-08 19:54:38', 5, 13, ''),
(62, 2, '2025-10-08 22:53:00', 5, 13, '');

-- --------------------------------------------------------

--
-- Table structure for table `test_result_categories`
--

CREATE TABLE `test_result_categories` (
  `test_result_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_result_categories`
--

INSERT INTO `test_result_categories` (`test_result_id`, `category_id`) VALUES
(51, 2),
(51, 4),
(60, 4),
(61, 4),
(62, 4),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(58, 5),
(59, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `user_profile` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `birthday`, `user_profile`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'canadianspidermark@gmail.com', 'minhyung', 'Mark Lee', '1999-08-02', 'default.svg', '$2y$10$b4yKDSAQkdElXqhBNOoIzOgu16gzvUL58Sxyglc1jfj0Yc8ABZCf.', NULL, NULL, NULL, 'd1d7bb6cd9c404712524f2f3cf91d4d7', NULL, NULL, 1, 0, '2025-01-28 04:03:40', '2025-01-28 04:03:40', NULL),
(4, 'admin@admin.com', 'admin', 'Administrator', '2000-06-06', 'default.svg', '$2y$10$u9.SC3R.72QwNx/2N2DkQue4C4Y4z6KCs9JGBG/AZ9HajwcO1Gw5O', NULL, NULL, NULL, 'bf2046acf1619f61dbf041167921989e', NULL, NULL, 1, 0, '2025-02-13 04:48:02', '2025-02-13 04:48:02', NULL),
(6, 'buatbelajaralvi@gmail.com', 'cuyalova', 'Dazai Osamu', '2010-06-09', 'default.svg', '$2y$10$AXrz4xLPKKErIw/hdcKKPu7Hmi5LW43VbkEtYkqu8XHZQ7yx9HJ/G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-03-10 05:05:26', '2025-03-10 05:05:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checked_question`
--
ALTER TABLE `checked_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `fk_test_id` (`test_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saran_penanganan`
--
ALTER TABLE `saran_penanganan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_result_categories`
--
ALTER TABLE `test_result_categories`
  ADD PRIMARY KEY (`test_result_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `checked_question`
--
ALTER TABLE `checked_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `saran_penanganan`
--
ALTER TABLE `saran_penanganan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `checked_question`
--
ALTER TABLE `checked_question`
  ADD CONSTRAINT `checked_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `checked_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `pertanyaan` (`id`),
  ADD CONSTRAINT `fk_test_id` FOREIGN KEY (`test_id`) REFERENCES `test_result` (`id`);

--
-- Constraints for table `test_result_categories`
--
ALTER TABLE `test_result_categories`
  ADD CONSTRAINT `test_result_categories_ibfk_1` FOREIGN KEY (`test_result_id`) REFERENCES `test_result` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_result_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
