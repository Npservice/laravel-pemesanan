-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 12:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(10) UNSIGNED NOT NULL,
  `nama_driver` varchar(20) NOT NULL,
  `kode_driver` varchar(255) NOT NULL,
  `status_driver` enum('dipesan','booking','siap') NOT NULL,
  `keterangan_driver` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id_driver`, `nama_driver`, `kode_driver`, `status_driver`, `keterangan_driver`, `created_at`, `updated_at`) VALUES
(1, 'parman', 'DRIV0001', 'booking', 'lama', NULL, '2023-02-05 01:37:54'),
(2, 'sutrisno', 'DRIV0002', 'siap', 'baru', NULL, '2023-02-05 01:35:53'),
(3, 'juliano', 'DRIV0003', 'siap', 'baru', NULL, NULL),
(4, 'yulianto', 'DRIV0004', 'siap', 'baru', NULL, NULL),
(5, 'andi', 'DRIV0005', 'booking', 'lama', NULL, NULL),
(6, 'ridlo', 'DRIV0006', 'dipesan', 'Baru', NULL, '2023-02-05 01:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(10) UNSIGNED NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `no_pol` varchar(20) NOT NULL,
  `status_kendaraan` enum('dipesan','booking','siap') NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `total_pakai` int(11) NOT NULL,
  `keterangan_kendaraan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `nama_kendaraan`, `no_pol`, `status_kendaraan`, `jenis_kendaraan`, `total_pakai`, `keterangan_kendaraan`, `created_at`, `updated_at`) VALUES
(1, 'xenia', 'AG 1 K', 'booking', 'mobil', 10, 'baru', NULL, NULL),
(2, 'avansa', 'AG 2 RBE', 'dipesan', 'mobil', 51, 'lama', NULL, '2023-02-05 01:50:42'),
(3, 'HINO 500', 'AG 1 RBG', 'siap', 'mobil', 41, 'baru', NULL, '2023-02-05 01:35:40'),
(4, 'isuzu elf', 'N 1111 BG', 'siap', 'Mini Bus', 30, 'lama', NULL, '2023-02-05 01:37:07'),
(5, 'kijang inova', 'N 1112 BG', 'booking', 'mobil', 20, 'baru', NULL, NULL),
(6, 'FUSO 4x6', 'N 1132 BG', 'siap', 'Truck', 100, 'lama', NULL, '2023-02-05 01:37:24');

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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(33, '2023_02_03_032939_kendaraan', 1),
(34, '2023_02_03_033327_driver', 1),
(35, '2023_02_03_033351_pemesanan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `kendaraan_id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `nama_pemesan` varchar(20) NOT NULL,
  `jabatan_pemesan` varchar(20) NOT NULL,
  `setuju_1` enum('setuju','tidak setuju') DEFAULT NULL,
  `setuju_2` enum('setuju','tidak setuju') DEFAULT NULL,
  `keterangan_pemesanan` enum('menungu','gagal','berhasil') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kendaraan_id`, `driver_id`, `tanggal_pemesanan`, `nama_pemesan`, `jabatan_pemesan`, `setuju_1`, `setuju_2`, `keterangan_pemesanan`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2023-02-05', 'hariyanto', 'Staff', 'tidak setuju', 'tidak setuju', 'gagal', NULL, '2023-02-05 01:35:53'),
(3, 5, 5, '2023-02-05', 'wulan', 'Karyawan', 'setuju', 'tidak setuju', 'gagal', NULL, '2023-02-04 19:39:51'),
(4, 2, 6, '2023-02-05', 'nanda', 'Staff', 'setuju', 'setuju', 'berhasil', NULL, '2023-02-05 01:50:42');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','atasan') NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$k/C74osbKfLkSu1Zrb5Z9OHdG5LtQB/K1QOW9PTc0jP7SRhc7LeR6', 'admin', 'admin', NULL, NULL),
(2, 'manager', 'manager', '$2y$10$kLDePu1FjJzTdZLncClVOuB8kv8EgxBxO89ItQ5kJR9BqEFUyMuhS', 'atasan', 'manager', NULL, NULL),
(3, 'human', 'human', '$2y$10$/R/vxWPfst7Kf3TBsvW02ep4Lx.d/rRZbF677j0rBpApIo/wJUCPK', 'atasan', 'human', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`),
  ADD UNIQUE KEY `driver_kode_driver_unique` (`kode_driver`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `kendaraan_no_pol_unique` (`no_pol`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `pemesanan_kendaraan_id_foreign` (`kendaraan_id`),
  ADD KEY `pemesanan_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id_driver`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
