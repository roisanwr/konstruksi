-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 12:55 PM
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
-- Database: `jaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_pekerja` int(11) NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_mandor` int(11) NOT NULL COMMENT 'Mandor yang mencatat absensi ini',
  `tanggal` date NOT NULL,
  `status_hadir` tinyint(1) NOT NULL COMMENT '1=Hadir, 0=Tidak Hadir',
  `lembur` tinyint(1) NOT NULL COMMENT '1=Ya, 0=Tidak',
  `keterangan` varchar(255) DEFAULT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Waktu data terakhir diubah'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pekerja`, `id_projek`, `id_mandor`, `tanggal`, `status_hadir`, `lembur`, `keterangan`, `waktu_update`) VALUES
(1, 12, 2, 9, '2025-06-09', 1, 1, '', '2025-06-09 15:13:56'),
(2, 14, 2, 9, '2025-06-09', 0, 0, '', '2025-06-09 15:10:35'),
(3, 10, 2, 9, '2025-06-09', 0, 0, '', '2025-06-09 15:13:56'),
(6, 9, 2, 9, '2025-06-09', 1, 0, '', '2025-06-09 15:10:35'),
(14, 12, 2, 9, '2025-06-08', 1, 0, '', '2025-06-09 16:07:19'),
(15, 14, 2, 9, '2025-06-08', 0, 0, '', '2025-06-09 16:15:31'),
(16, 10, 2, 9, '2025-06-08', 1, 1, 'Lembur finishing', '2025-06-09 15:33:36'),
(17, 9, 2, 9, '2025-06-08', 1, 0, '', '2025-06-09 16:07:19'),
(18, 12, 2, 9, '2025-06-07', 1, 0, '', '2025-06-09 16:07:45'),
(19, 14, 2, 9, '2025-06-07', 1, 0, 'Sakit', '2025-06-09 16:15:50'),
(20, 10, 2, 9, '2025-06-07', 1, 0, '', '2025-06-09 16:07:45'),
(21, 9, 2, 9, '2025-06-07', 1, 1, 'Pengawasan lembur', '2025-06-09 15:33:36'),
(22, 12, 2, 9, '2025-06-06', 1, 0, NULL, '2025-06-09 15:33:36'),
(23, 14, 2, 9, '2025-06-06', 1, 0, NULL, '2025-06-09 15:33:36'),
(24, 10, 2, 9, '2025-06-06', 1, 0, NULL, '2025-06-09 15:33:36'),
(25, 9, 2, 9, '2025-06-06', 1, 0, NULL, '2025-06-09 15:33:36'),
(26, 12, 2, 9, '2025-06-05', 0, 0, 'Izin keluarga', '2025-06-09 15:33:36'),
(27, 14, 2, 9, '2025-06-05', 1, 1, 'Pasang keramik', '2025-06-09 15:33:36'),
(28, 10, 2, 9, '2025-06-05', 1, 1, 'Pasang keramik', '2025-06-09 15:33:36'),
(29, 9, 2, 9, '2025-06-05', 1, 0, NULL, '2025-06-09 15:33:36'),
(30, 12, 2, 9, '2025-06-04', 1, 0, NULL, '2025-06-09 15:33:36'),
(31, 14, 2, 9, '2025-06-04', 1, 0, NULL, '2025-06-09 15:33:36'),
(32, 10, 2, 9, '2025-06-04', 1, 0, NULL, '2025-06-09 15:33:36'),
(33, 9, 2, 9, '2025-06-04', 1, 0, NULL, '2025-06-09 15:33:36'),
(34, 12, 2, 9, '2025-06-03', 1, 0, NULL, '2025-06-09 15:33:36'),
(35, 14, 2, 9, '2025-06-03', 1, 0, NULL, '2025-06-09 15:33:36'),
(36, 10, 2, 9, '2025-06-03', 0, 0, 'Sakit gigi', '2025-06-09 15:33:36'),
(37, 9, 2, 9, '2025-06-03', 1, 0, NULL, '2025-06-09 15:33:36'),
(38, 12, 2, 9, '2025-06-02', 1, 1, 'Pengecoran', '2025-06-09 15:33:36'),
(39, 14, 2, 9, '2025-06-02', 1, 1, 'Pengecoran', '2025-06-09 15:33:36'),
(40, 10, 2, 9, '2025-06-02', 1, 1, 'Pengecoran', '2025-06-09 15:33:36'),
(41, 9, 2, 9, '2025-06-02', 1, 1, 'Pengawasan cor', '2025-06-09 15:33:36'),
(42, 12, 2, 9, '2025-06-01', 1, 0, NULL, '2025-06-09 15:33:36'),
(43, 14, 2, 9, '2025-06-01', 1, 0, NULL, '2025-06-09 15:33:36'),
(44, 10, 2, 9, '2025-06-01', 1, 0, NULL, '2025-06-09 15:33:36'),
(45, 9, 2, 9, '2025-06-01', 1, 0, NULL, '2025-06-09 15:33:36'),
(46, 12, 2, 9, '2025-05-31', 1, 0, NULL, '2025-06-09 15:33:36'),
(47, 14, 2, 9, '2025-05-31', 0, 0, 'Izin', '2025-06-09 15:33:36'),
(48, 10, 2, 9, '2025-05-31', 1, 0, NULL, '2025-06-09 15:33:36'),
(49, 9, 2, 9, '2025-05-31', 1, 0, NULL, '2025-06-09 15:33:36'),
(50, 12, 2, 9, '2025-05-30', 1, 0, NULL, '2025-06-09 15:33:36'),
(51, 14, 2, 9, '2025-05-30', 1, 0, NULL, '2025-06-09 15:33:36'),
(52, 10, 2, 9, '2025-05-30', 1, 0, NULL, '2025-06-09 15:33:36'),
(53, 9, 2, 9, '2025-05-30', 1, 0, NULL, '2025-06-09 15:33:36'),
(54, 11, 2, 9, '2025-06-08', 0, 0, '', '2025-06-09 16:07:18'),
(58, 11, 2, 9, '2025-06-07', 1, 0, 'bolos', '2025-06-09 16:16:09'),
(65, 13, 4, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:36:18'),
(66, 9, 4, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:36:18'),
(67, 4, 4, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:36:18'),
(68, 12, 2, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:39:33'),
(69, 14, 2, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:39:33'),
(70, 9, 2, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:39:33'),
(71, 10, 2, 9, '2025-06-10', 1, 0, '', '2025-06-10 03:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_pekerja` int(11) NOT NULL,
  `periode_start` date NOT NULL,
  `periode_end` date NOT NULL,
  `total_hari_hadir` int(11) NOT NULL,
  `total_lembur` int(11) NOT NULL,
  `gaji_pokok_bayar` decimal(10,2) NOT NULL,
  `lembur_pay` decimal(10,2) NOT NULL,
  `tunjangan_transport_manual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tunjangan_kesehatan_manual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tunjangan_rumah_manual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_pendapatan_bruto` decimal(10,2) NOT NULL,
  `total_potongan_manual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_gaji_netto` decimal(10,2) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_pekerja`, `periode_start`, `periode_end`, `total_hari_hadir`, `total_lembur`, `gaji_pokok_bayar`, `lembur_pay`, `tunjangan_transport_manual`, `tunjangan_kesehatan_manual`, `tunjangan_rumah_manual`, `total_pendapatan_bruto`, `total_potongan_manual`, `total_gaji_netto`, `tanggal_bayar`) VALUES
(1, 11, '2025-06-02', '2025-06-08', 1, 0, 50000.00, 0.00, 20000.00, 0.00, 0.00, 70000.00, 0.00, 70000.00, '2025-06-10'),
(2, 12, '2025-06-02', '2025-06-08', 6, 1, 600000.00, 50000.00, 0.00, 0.00, 0.00, 650000.00, 0.00, 650000.00, '2025-06-10'),
(3, 14, '2025-06-02', '2025-06-08', 6, 2, 300000.00, 70000.00, 0.00, 0.00, 0.00, 370000.00, 0.00, 370000.00, '2025-06-10'),
(4, 9, '2025-06-02', '2025-06-08', 7, 2, 1050000.00, 400000.00, 0.00, 0.00, 0.00, 1450000.00, 0.00, 1450000.00, '2025-06-10'),
(5, 10, '2025-06-02', '2025-06-08', 6, 3, 600000.00, 150000.00, 0.00, 0.00, 0.00, 750000.00, 0.00, 750000.00, '2025-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `namajabatan` varchar(50) NOT NULL,
  `gajipokok` decimal(10,2) NOT NULL COMMENT 'Gaji pokok per hari',
  `tunjangan_lembur` decimal(10,2) NOT NULL COMMENT 'Tunjangan lembur per hari'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `namajabatan`, `gajipokok`, `tunjangan_lembur`) VALUES
(1, 'mandor', 150000.00, 200000.00),
(2, 'tukang gali kubur', 50000.00, 500000.00),
(4, 'helper', 50000.00, 35000.00),
(5, 'tukang las', 100000.00, 50000.00),
(6, 'Tukang batu', 75000.00, 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nama_klien` varchar(100) NOT NULL,
  `alamat_klien` text DEFAULT NULL,
  `no_telp_klien` varchar(20) DEFAULT NULL,
  `email_klien` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `nama_klien`, `alamat_klien`, `no_telp_klien`, `email_klien`, `created_at`, `updated_at`) VALUES
(1, 'Luthfi', 'Matraman', '00000', 'luthfi@gmail.com', '2025-06-03 08:58:02', '2025-06-03 09:03:29'),
(3, 'aryo', 'bekasi', NULL, NULL, '2025-06-04 04:43:48', '2025-06-04 04:43:48'),
(4, 'winrat', 'batukarang', NULL, NULL, '2025-06-04 05:24:47', '2025-06-04 05:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id_pekerja` int(11) NOT NULL,
  `namapekerja` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `no_rek` varchar(30) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id_pekerja`, `namapekerja`, `id_jabatan`, `no_hp`, `no_rek`, `is_active`) VALUES
(4, 'naren', 4, 'haha', '', 1),
(6, 'syamil', 1, '000', '', 1),
(7, 'hadi', 1, '', '', 1),
(8, 'budi', 4, '', '', 1),
(9, 'julian', 1, '', '', 1),
(10, 'ucup', 5, '', '', 1),
(11, 'aang', 2, '', '', 1),
(12, 'asep', 5, '', '', 1),
(13, 'Joni', 4, '', '', 1),
(14, 'bahar', 4, '', '', 1),
(15, 'Ibnu', 2, '123456789', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projek`
--

CREATE TABLE `projek` (
  `id_projek` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `namaprojek` varchar(150) NOT NULL,
  `id_mandor_pekerja` int(11) NOT NULL COMMENT 'FK ke id_pekerja, mandor utama proyek ini',
  `jenisprojek` varchar(100) DEFAULT NULL,
  `status` enum('planning','active','completed') NOT NULL,
  `lokasi` text DEFAULT NULL,
  `tanggal_mulai_projek` date DEFAULT NULL,
  `tanggal_selesai_projek` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projek`
--

INSERT INTO `projek` (`id_projek`, `id_klien`, `namaprojek`, `id_mandor_pekerja`, `jenisprojek`, `status`, `lokasi`, `tanggal_mulai_projek`, `tanggal_selesai_projek`) VALUES
(2, 3, 'STMI lantai 100', 9, 'renovasi rumah', 'active', 'Cempaka tengah jakarta pusat', '2029-06-04', '2043-12-18'),
(3, 4, 'Bangun gedung SCBD', 7, NULL, 'active', NULL, NULL, NULL),
(4, 4, 'gorong gorong', 9, 'renovasi lubang', 'completed', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proyek_pekerja`
--

CREATE TABLE `proyek_pekerja` (
  `id_penugasan` int(11) NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_pekerja` int(11) NOT NULL,
  `tanggal_mulai_penugasan` date NOT NULL,
  `tanggal_akhir_penugasan` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by_mandor_id` int(11) DEFAULT NULL COMMENT 'Mandor yang menugaskan pekerja ini',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proyek_pekerja`
--

INSERT INTO `proyek_pekerja` (`id_penugasan`, `id_projek`, `id_pekerja`, `tanggal_mulai_penugasan`, `tanggal_akhir_penugasan`, `is_active`, `created_by_mandor_id`, `created_at`) VALUES
(25, 3, 11, '2025-06-09', '2025-06-10', 0, 7, '2025-06-09 06:50:43'),
(26, 2, 11, '2025-06-03', '2025-06-12', 0, 9, '2025-06-09 07:25:07'),
(27, 3, 8, '2025-06-09', NULL, 1, NULL, '2025-06-09 07:46:11'),
(28, 3, 4, '2025-06-09', NULL, 0, NULL, '2025-06-09 07:46:11'),
(29, 2, 12, '2025-06-03', NULL, 1, NULL, '2025-06-09 13:53:36'),
(30, 2, 14, '2025-06-03', NULL, 1, NULL, '2025-06-09 13:53:36'),
(31, 2, 10, '2025-06-03', NULL, 1, NULL, '2025-06-09 13:54:10'),
(32, 4, 13, '2025-06-09', NULL, 1, NULL, '2025-06-09 13:55:04'),
(33, 4, 4, '2025-06-09', NULL, 1, NULL, '2025-06-09 13:55:04'),
(34, 4, 15, '2025-06-10', '2025-06-11', 1, 9, '2025-06-10 03:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin','mandor') NOT NULL,
  `id_pekerja_ref` int(11) DEFAULT NULL COMMENT 'FK ke id_pekerja jika role mandor, null jika admin/super_admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `id_pekerja_ref`, `is_active`, `last_login`) VALUES
(1002, 'adminaja', '$2y$10$/1hNuFwKvGlDwr7tNeyJaeI0n2s0153UwsX1qYz2hrAhHvOljRtt.', 'admin', NULL, 1, '2025-06-02 14:52:08'),
(1003, 'mandor', '$2y$10$uMmWylw4OPmGl2AjwcGGw.9keXTw3c07OPz3e5YListWyLC13aR6q', 'mandor', 9, 1, '2025-06-04 07:53:39'),
(10001, 'admin', '$2y$10$/1hNuFwKvGlDwr7tNeyJaeI0n2s0153UwsX1qYz2hrAhHvOljRtt.', 'super_admin', NULL, 1, '2025-06-02 14:51:27'),
(10004, 'hadi', '$2y$10$aeU/5rEYo2LIAEb.ajOgr.gzwUNxmbrMdi9Y0240E00JounRfrp6a', 'mandor', 7, 1, '2025-06-05 15:46:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD UNIQUE KEY `uk_absensi_per_hari` (`id_pekerja`,`id_projek`,`tanggal`),
  ADD KEY `fk_absensi_projek` (`id_projek`),
  ADD KEY `fk_absensi_mandor` (`id_mandor`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD UNIQUE KEY `uk_gaji_per_periode` (`id_pekerja`,`periode_start`,`periode_end`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id_pekerja`),
  ADD KEY `fk_pekerja_jabatan` (`id_jabatan`);

--
-- Indexes for table `projek`
--
ALTER TABLE `projek`
  ADD PRIMARY KEY (`id_projek`),
  ADD KEY `fk_projek_klien` (`id_klien`),
  ADD KEY `fk_projek_mandor` (`id_mandor_pekerja`);

--
-- Indexes for table `proyek_pekerja`
--
ALTER TABLE `proyek_pekerja`
  ADD PRIMARY KEY (`id_penugasan`),
  ADD UNIQUE KEY `uk_proyek_pekerja` (`id_projek`,`id_pekerja`,`tanggal_mulai_penugasan`),
  ADD KEY `fk_proyek_pekerja_pekerja` (`id_pekerja`),
  ADD KEY `fk_proyek_pekerja_created_by` (`created_by_mandor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_pekerja` (`id_pekerja_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id_pekerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projek`
--
ALTER TABLE `projek`
  MODIFY `id_projek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proyek_pekerja`
--
ALTER TABLE `proyek_pekerja`
  MODIFY `id_penugasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_mandor` FOREIGN KEY (`id_mandor`) REFERENCES `pekerja` (`id_pekerja`),
  ADD CONSTRAINT `fk_absensi_pekerja` FOREIGN KEY (`id_pekerja`) REFERENCES `pekerja` (`id_pekerja`),
  ADD CONSTRAINT `fk_absensi_projek` FOREIGN KEY (`id_projek`) REFERENCES `projek` (`id_projek`);

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `fk_gaji_pekerja` FOREIGN KEY (`id_pekerja`) REFERENCES `pekerja` (`id_pekerja`);

--
-- Constraints for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD CONSTRAINT `fk_pekerja_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `projek`
--
ALTER TABLE `projek`
  ADD CONSTRAINT `fk_projek_klien` FOREIGN KEY (`id_klien`) REFERENCES `klien` (`id_klien`),
  ADD CONSTRAINT `fk_projek_mandor` FOREIGN KEY (`id_mandor_pekerja`) REFERENCES `pekerja` (`id_pekerja`);

--
-- Constraints for table `proyek_pekerja`
--
ALTER TABLE `proyek_pekerja`
  ADD CONSTRAINT `fk_proyek_pekerja_created_by` FOREIGN KEY (`created_by_mandor_id`) REFERENCES `pekerja` (`id_pekerja`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyek_pekerja_pekerja` FOREIGN KEY (`id_pekerja`) REFERENCES `pekerja` (`id_pekerja`),
  ADD CONSTRAINT `fk_proyek_pekerja_projek` FOREIGN KEY (`id_projek`) REFERENCES `projek` (`id_projek`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_pekerja` FOREIGN KEY (`id_pekerja_ref`) REFERENCES `pekerja` (`id_pekerja`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
