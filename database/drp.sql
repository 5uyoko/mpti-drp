-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 01:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraduit`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `updated_at`, `created_at`) VALUES
(1, 'Banjarmasin', '2025-07-05 23:06:25', NULL),
(2, 'Bontang', '2025-07-05 23:07:07', NULL),
(5, 'Jakarta', '2025-07-05 02:05:14', '2025-07-05 02:05:14'),
(7, 'Bima', '2025-07-05 23:05:56', '2025-07-05 02:55:44'),
(8, 'Cirebon', '2025-07-05 23:07:22', '2025-07-05 23:07:22'),
(9, 'Surabaya', '2025-07-05 23:07:33', '2025-07-05 23:07:33'),
(10, 'Buton', '2025-07-05 23:07:47', '2025-07-05 23:07:47'),
(11, 'Labuan Bajo', '2025-07-05 23:08:00', '2025-07-05 23:08:00'),
(12, 'Larantuka', '2025-07-05 23:08:10', '2025-07-05 23:08:10'),
(13, 'Ende', '2025-07-05 23:08:21', '2025-07-05 23:08:21'),
(14, 'Maumere', '2025-07-05 23:08:40', '2025-07-05 23:08:40');

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
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `income_id` int(11) NOT NULL,
  `ship_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `load_id` int(11) DEFAULT NULL,
  `city_from_id` int(11) DEFAULT NULL,
  `city_to_id` int(11) DEFAULT NULL,
  `total_rental` int(11) DEFAULT NULL,
  `total_spending` int(11) DEFAULT NULL,
  `total_income` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`income_id`, `ship_id`, `date`, `load_id`, `city_from_id`, `city_to_id`, `total_rental`, `total_spending`, `total_income`) VALUES
(18, 11, '2025-07-06', 19, 1, 2, 2500000, 2000000, 500000),
(21, 11, '2025-07-08', 22, 7, 7, 12075, 345, 11730),
(22, 12, '2025-07-08', 23, 7, 11, 20060000, 230000, 19830000),
(25, 11, '2025-07-08', 26, 7, 9, 54756, 234, 54522);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Tidak Berkategori', '2023-03-21 10:07:29', '2023-03-21 10:07:29'),
(2, 'xx', '2023-03-21 10:08:04', '2023-03-21 10:08:04'),
(4, 'c', '2025-07-05 02:47:09', '2025-07-05 02:52:49'),
(5, 'x', '2025-07-05 03:16:12', '2025-07-05 03:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `loads`
--

CREATE TABLE `loads` (
  `load_id` int(11) NOT NULL,
  `load_amount` int(11) DEFAULT NULL,
  `rental_price` int(11) DEFAULT NULL,
  `load_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`load_id`, `load_amount`, `rental_price`, `load_category_id`) VALUES
(6, 10, 123123, 1),
(7, 10, 1288, 2),
(9, 123, 123123, 2),
(10, 222, 222, 1),
(11, 12, 12, 1),
(12, 1, 1, 1),
(14, 123, 123, 2),
(18, 1000, 350000, 2),
(19, 10, 250000, 1),
(22, 345, 35, 2),
(23, 59, 340000, 7),
(26, 234, 234, 8);

-- --------------------------------------------------------

--
-- Table structure for table `loads_category`
--

CREATE TABLE `loads_category` (
  `load_category_id` int(11) NOT NULL,
  `load_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loads_category`
--

INSERT INTO `loads_category` (`load_category_id`, `load_name`, `created_at`, `updated_at`) VALUES
(1, 'Jagung', NULL, '2025-07-05 23:03:59'),
(2, 'Semen', NULL, '2025-07-05 23:04:10'),
(7, 'Pupuk', '2025-07-05 23:04:21', '2025-07-05 23:04:21'),
(8, 'Beras', '2025-07-05 23:04:38', '2025-07-05 23:04:38'),
(9, 'Bawang,Garam,Sapi', '2025-07-05 23:05:14', '2025-07-05 23:05:14'),
(10, 'Barang Pecahan', '2025-07-05 23:05:29', '2025-07-05 23:05:29');

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_04_17_053928_create_kategoris_table', 2),
(7, '2020_04_17_053941_create_transaksis_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `income_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `ship_amount` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `income_id`, `year`, `month`, `total`, `ship_amount`, `date_create`) VALUES
(8, 18, 2025, 7, 0, 10, '2025-07-06'),
(9, 21, 2025, 7, 11730, 345, '2025-07-08'),
(10, 22, 2025, 7, 19830000, 59, '2025-07-08'),
(13, 25, 2025, 7, 54522, 234, '2025-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `ship_id` int(11) NOT NULL,
  `shipname` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `captain_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`ship_id`, `shipname`, `capacity`, `created_at`, `updated_at`, `captain_id`) VALUES
(11, 'KLM Moch Ihsan Ramadhani 02', NULL, '2025-07-05 01:51:49', '2025-07-05 23:03:06', NULL),
(12, 'KLM Al-fatah', NULL, '2025-07-05 02:36:57', '2025-07-05 23:03:24', NULL),
(17, 'KLM Moh Ihsan Ramadhani', NULL, '2025-07-05 02:55:17', '2025-07-05 23:02:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spendings`
--

CREATE TABLE `spendings` (
  `spending_id` int(11) NOT NULL,
  `income_id` int(11) DEFAULT NULL,
  `spending_name` varchar(100) DEFAULT NULL,
  `spending_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spendings`
--

INSERT INTO `spendings` (`spending_id`, `income_id`, `spending_name`, `spending_amount`) VALUES
(30, 18, 'Solar', 500000),
(31, 18, 'Duar meledak', 1500000),
(34, 21, 'sdf', 345),
(35, 22, 'BBM', 230000),
(38, 25, 'BBM', 234);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `jenis`, `kategori_id`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '2023-03-01', 'Pemasukan', 2, 1000000, NULL, '2023-03-21 10:09:06', '2023-03-21 10:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `role` enum('admin','captain') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`, `username`, `position`, `role`) VALUES
(1, 'Rafi Mahrizky Yunanto Putra', 'admin@admin.com', NULL, '$2y$10$85cw2xAfSU.Pz67QYMLBfuObK6Wyc8k2PDqdziF5woBDdXE9qPmC6', '1751780969_We Heart It.jpeg', 'wbH67BlrymiNiKfv7q5XhfnTOXCBguLOuGpovfJkQJwlCDyr8ZXH6Hibov06', '2023-03-21 08:41:52', '2025-07-05 22:52:00', NULL, NULL, 'admin'),
(4, 'kapten raka', 'raka@gmail.com', NULL, '$2y$10$nOnzyoYIzECxinPQBGTjfefnIAbGe0dfo72nme9tQ1Pid7C3g2R56', '', NULL, '2025-07-08 01:48:01', '2025-07-08 01:48:01', NULL, NULL, 'captain'),
(5, 'Sehu', 'Sehu@ganteng.com', NULL, '$2y$10$2b3s.FMAZ7GSX1unOnjco.VcGHhg42DsTBvh0dMU.3KjiYy1Tfo4i', '1751964992_jawa.png', NULL, '2025-07-08 01:56:32', '2025-07-08 01:56:32', NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_drp`
--

CREATE TABLE `users_drp` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_drp`
--

INSERT INTO `users_drp` (`user_id`, `username`, `password`, `name`, `position`, `role`) VALUES
(1, 'ANJAYANI', 'ANJAYANI', 'ANJAY ANI', 'SWEEPER', 'SWEEPER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `ship_id` (`ship_id`),
  ADD KEY `load_id` (`load_id`),
  ADD KEY `fk_incomes_city_from` (`city_from_id`),
  ADD KEY `fk_incomes_city_to` (`city_to_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`load_id`),
  ADD KEY `fk_load_category` (`load_category_id`);

--
-- Indexes for table `loads_category`
--
ALTER TABLE `loads_category`
  ADD PRIMARY KEY (`load_category_id`),
  ADD UNIQUE KEY `load_name` (`load_name`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `income_id` (`income_id`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`ship_id`),
  ADD UNIQUE KEY `shipname` (`shipname`),
  ADD KEY `captain_user_id_fk` (`captain_id`);

--
-- Indexes for table `spendings`
--
ALTER TABLE `spendings`
  ADD PRIMARY KEY (`spending_id`),
  ADD KEY `income_id` (`income_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_drp`
--
ALTER TABLE `users_drp`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `loads_category`
--
ALTER TABLE `loads_category`
  MODIFY `load_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `spendings`
--
ALTER TABLE `spendings`
  MODIFY `spending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_drp`
--
ALTER TABLE `users_drp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `fk_incomes_city_from` FOREIGN KEY (`city_from_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incomes_city_to` FOREIGN KEY (`city_to_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incomes_ibfk_1` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`ship_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incomes_ibfk_2` FOREIGN KEY (`load_id`) REFERENCES `loads` (`load_id`) ON DELETE CASCADE;

--
-- Constraints for table `loads`
--
ALTER TABLE `loads`
  ADD CONSTRAINT `fk_load_category` FOREIGN KEY (`load_category_id`) REFERENCES `loads_category` (`load_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`income_id`) ON DELETE CASCADE;

--
-- Constraints for table `ships`
--
ALTER TABLE `ships`
  ADD CONSTRAINT `captain_user_id_fk` FOREIGN KEY (`captain_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spendings`
--
ALTER TABLE `spendings`
  ADD CONSTRAINT `spendings_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`income_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
