-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2026 at 02:17 AM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen9`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int NOT NULL,
  `nomor_induk` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `absen` datetime DEFAULT NULL,
  `absen_maks` datetime DEFAULT NULL,
  `kategori` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=jam_masuk, 2=istirahat_mulai, 3=istirahat_selesai, 4=pulang',
  `idmesin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `nomor_induk`, `absen`, `absen_maks`, `kategori`, `idmesin`) VALUES
(1, '1', '2026-01-23 02:28:05', '2026-01-23 08:00:00', '1', '4cebd61f8e57'),
(2, '1', '2026-01-23 02:28:05', '2026-01-23 17:00:00', '4', '4cebd61f8e57'),
(3, '1', '2026-01-23 02:28:05', '2026-01-23 12:00:00', '2', '4cebd61f8e57'),
(4, '1', '2026-01-23 02:28:05', '2026-01-23 13:00:00', '3', '4cebd61f8e57'),
(5, '1', '2026-01-23 02:28:05', '2026-01-23 08:00:00', '', '4cebd61f8e57'),
(151, '12329252', '2026-01-23 02:28:05', '2026-01-23 08:00:00', '1', '4cebd61f8e57'),
(152, '12329252', '2026-01-23 02:28:05', '2026-01-23 08:00:00', '1', '4cebd61f8e57'),
(154, '1', '2026-01-31 06:34:22', '2026-01-31 08:00:00', '1', '4cebd61f8e57'),
(213, '12329252', '2026-02-02 03:40:02', NULL, '1', '4cebd61f8e57'),
(214, '12329252', '2026-02-02 03:43:53', NULL, '1', '4cebd61f8e57');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_backup_yyyymmdd`
--

CREATE TABLE `absensi_backup_yyyymmdd` (
  `id` int NOT NULL DEFAULT '0',
  `nomor_induk` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal_harian_id` bigint UNSIGNED DEFAULT NULL,
  `absen_at` timestamp NULL DEFAULT NULL,
  `kategori` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=jam_masuk, 2=istirahat_mulai, 3=istirahat_selesai, 4=pulang',
  `idmesin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi_backup_yyyymmdd`
--

INSERT INTO `absensi_backup_yyyymmdd` (`id`, `nomor_induk`, `jadwal_harian_id`, `absen_at`, `kategori`, `idmesin`, `updated_at`) VALUES
(1, '1', 1, '2026-01-22 19:28:05', '1', '1', '2026-01-22 19:28:05'),
(2, '1', 1, '2026-01-22 19:28:05', '4', '1', '2026-01-22 19:28:05'),
(3, '1', 1, '2026-01-22 19:28:05', '2', '1', '2026-01-22 19:28:05'),
(4, '1', 1, '2026-01-22 19:28:05', '3', '1', '2026-01-22 19:28:05'),
(5, '1', 1, '2026-01-22 19:28:05', '', '1', '2026-01-22 19:28:05'),
(151, '12329252', 1, '2026-01-22 19:28:05', '1', '1', '2026-01-22 19:28:05'),
(152, '12329252', 1, '2026-01-22 19:28:05', '1', '1', '2026-01-22 19:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `cabang_gedung`
--

CREATE TABLE `cabang_gedung` (
  `id` int UNSIGNED NOT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `istirahat_mulai` time NOT NULL,
  `istirahat_selesai` time NOT NULL,
  `hari_libur` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona_waktu` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabang_gedung`
--

INSERT INTO `cabang_gedung` (`id`, `lokasi`, `jam_masuk`, `jam_pulang`, `istirahat_mulai`, `istirahat_selesai`, `hari_libur`, `zona_waktu`, `aktif`) VALUES
(1, 'Cirebon', '07:30:00', '16:30:00', '11:30:00', '12:30:00', '0,6', '1', '1'),
(2, 'Jakarta', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '', '1', '1'),
(3, 'Ciamis', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '0,6', '1', '1'),
(5, 'Sholat Dhuhur', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '', '1', '1'),
(6, 'Sumsel', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '', '1', '1'),
(7, 'smkn 2 jamet', '07:30:00', '15:30:00', '12:30:00', '13:00:00', '0,6', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int NOT NULL,
  `nomor_induk` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bukti_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_persetujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `disetujui_oleh` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_keputusan` datetime DEFAULT NULL,
  `catatan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `nomor_induk`, `tanggal`, `tanggal_mulai`, `tanggal_selesai`, `kategori`, `alasan`, `bukti_file`, `status_persetujuan`, `disetujui_oleh`, `tanggal_keputusan`, `catatan_admin`) VALUES
(1, '1', '2024-11-18', '2024-11-18', '2024-11-18', NULL, NULL, NULL, 'Disetujui', NULL, NULL, NULL),
(2, '1234', '2024-11-19', '2024-11-19', '2024-11-19', NULL, NULL, NULL, 'Disetujui', NULL, NULL, NULL),
(3, '23456', '2024-11-19', '2024-11-19', '2024-11-19', NULL, NULL, NULL, 'Disetujui', NULL, NULL, NULL),
(5, '23456', '2026-01-21', '2026-01-21', '2026-01-21', NULL, NULL, NULL, 'Disetujui', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `denda_master`
--

CREATE TABLE `denda_master` (
  `id` int UNSIGNED NOT NULL,
  `prioritas` int NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `per_menit` int DEFAULT NULL,
  `rupiah_pertama` int DEFAULT NULL,
  `rupiah_selanjutnya` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `denda_master`
--

INSERT INTO `denda_master` (`id`, `prioritas`, `jenis`, `per_menit`, `rupiah_pertama`, `rupiah_selanjutnya`) VALUES
(1, 1, 'Terlambat', 5, 1000, 500),
(2, 5, 'Tidak Hadir', 0, 50000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int UNSIGNED NOT NULL,
  `hak` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `hak`) VALUES
(1, 'nusabot'),
(2, 'full'),
(3, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_status`
--

CREATE TABLE `jabatan_status` (
  `id` int UNSIGNED NOT NULL,
  `jabatan_status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak_akses` int UNSIGNED NOT NULL,
  `aktif` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan_status`
--

INSERT INTO `jabatan_status` (`id`, `jabatan_status`, `hak_akses`, `aktif`) VALUES
(1, 'Nusabot', 1, '1'),
(2, 'Full', 2, '1'),
(3, 'General', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libur_khusus`
--

CREATE TABLE `libur_khusus` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libur_khusus`
--

INSERT INTO `libur_khusus` (`id`, `tanggal`, `keterangan`) VALUES
(1, '2024-11-21', 'Bos sedaang istirahat dirumha'),
(3, '2026-01-21', 'lari'),
(4, '2026-01-19', 'jalan');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `id_mesin` int NOT NULL,
  `id_cabang_gedung` int UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idmesin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`id_mesin`, `id_cabang_gedung`, `keterangan`, `idmesin`) VALUES
(1, 1, 'Kesambi', '4cebd61f8e57'),
(9, 2, 'bagus', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '0001_01_01_000000_create_users_table', 1),
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(23, '2026_01_09_012259_create_jadwal_harian_table', 2),
(24, '2026_01_09_012619_migrate_jadwal_from_cabang_gedung', 2),
(25, '2026_01_12_020438_change_password_type_in_pengguna_table', 2),
(28, '2026_01_12_013913_alter_password_column_in_pengguna_table', 3),
(29, '2026_01_12_073747_add_fk_to_cuti_table', 3),
(30, '2026_01_22_065130_drop_old_columns_from_cabang_gedung', 4),
(32, '2026_01_22_073644_add_libur_column_to_jadwal_harian_table', 5),
(33, '2026_01_23_021411_change_jadwal_harian_id_to_nullable', 6),
(37, '2026_01_21_034021_update_pengguna_table_relations', 7),
(39, '2026_01_26_090000_standardize_fk_and_types', 8),
(40, '2026_01_26_101500_add_fk_absensi_jadwal_harian', 8),
(41, '2026_01_26_110000_create_absensi_jadwal_pivot', 9),
(42, '2026_01_23_022400_add_updated_at_column_to_absensi_table', 10),
(43, '2026_01_28_023731_update_pengguna_table_relations', 11),
(44, '2026_01_29_add_general_hak_akses', 11),
(45, '2026_01_29_fix_hak_akses_values', 11),
(46, '2026_01_29_update_hak_akses_values', 11),
(47, '2026_10_07_072837_add_details_to_cuti_table', 12),
(48, '2026_10_08_000000_add_approval_columns_to_cuti_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nomor_induk` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_status` int UNSIGNED NOT NULL,
  `cabang_gedung` int UNSIGNED NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nomor_induk`, `nama`, `tag`, `jabatan_status`, `cabang_gedung`, `password`, `aktif`) VALUES
('0', 'Nusabot.id', '', 1, 0, '$2y$12$MDwJSBNRR0b.8B3HIlsOB.ZGk5Bx9CU8yw6AY7g1VuA8T0lYMPAjW', '1'),
('0111111', 'Tegar', '11223344', 2, 3, '9549d400a68633435918290085f06293', '1'),
('0987654', 'putri', '0987654', 8, 2, '$2y$12$evEqBcOF3eHmzmRStOnX1O9Cmvei7BcTPNU18EeiEo4TmKYgFsLF.', '1'),
('1', 'pratama fahriel sanjaya', '73cba8aa', 2, 1, 'c4ca4238a0b923820dcc509a6f75849b', '1'),
('12228418', 'Muhammad Bintoro', '79603bd5', 2, 1, '2a372a408d5d7f2ddc30142b9fdc2563', '1'),
('123', 'hasta', '3755fe', 3, 1, '827ccb0eea8a706c4c34a16891f84e7b', '1'),
('12329252', 'Nuril Jannatii', 'accf6905', 3, 1, '7a7a52fcbfa494a96604d4b2ddba79ec', '1'),
('1234', 'Fauzan Azhiman', 'e3dbfbb6', 5, 1, '81dc9bdb52d04dc20036dbd8313ed055', '1'),
('12430139', 'Novvalino', '999999', 2, 3, '$2y$12$P8SZLcwwAeB7KIQkdugsT.cKFPHiTBshfh.QEjqVl6orjePDDfZcy', '1'),
('234556', 'riza', '234556', 7, 1, '$2y$12$Kf1NIljvltbfWTG6pZtGjO2kHJa1Encu7fGYjCS6r/lUndMTIK6aq', '1'),
('23456', 'Boya Rizky Agung', '98756fg', 7, 2, 'adcaec3805aa912c0d0b14a81bedb6ff', '1'),
('8888', 'Novvalino', 'admin', 2, 1, '$2y$12$ykgs8fCAGHvF8zADvZrZuuz5/6.bkaQIXN9K/vOkBL/1pJn9PJnmO', '1'),
('admin@sekolah.local', 'novval', '123', 2, 1, '$2y$12$.IC/88R..Fw0/Lo7mzh8ve9.QpaCVF.4AQio/jRzgxRPMemp.pT/m', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f1swGsWmWiWF3rSVyqiQStsJD09o4qpHtEUAykS3', 8888, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMzdldVFzeEZkeTVaWkUwSDFwSm0xeXFyRTY1ajY3Y2FaTGlBeFBKMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVuZ2d1bmEiO3M6NToicm91dGUiO3M6MTQ6InBlbmdndW5hLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6NDoiODg4OCI7fQ==', 1791425234),
('VQXLnbDtbCy0dviCxgLIZoK5n3XS0rqrKHngDnZ5', 8888, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVkhUNTMzUXdmWHhhQmxCR0JvaDl1d2dhM2lzaldXdE9HeTFHb0x1NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY3V0aSI7czo1OiJyb3V0ZSI7czoxMDoiY3V0aS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjQ6Ijg4ODgiO30=', 1791361415),
('woBgbOTzWK6wByuBb5Vurq2PbBEPu8QI3UjTN9vc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnRRR0VWSlBHVEdRZE43TjdaMzVJTEpNcjlXUEhXNktjOHRlYWxXNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1791425629);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_absensi_mesin` (`idmesin`),
  ADD KEY `absensi_nomor_induk_foreign` (`nomor_induk`);

--
-- Indexes for table `cabang_gedung`
--
ALTER TABLE `cabang_gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuti_nomor_induk_foreign` (`nomor_induk`),
  ADD KEY `cuti_disetujui_oleh_foreign` (`disetujui_oleh`),
  ADD KEY `cuti_status_persetujuan_index` (`status_persetujuan`);

--
-- Indexes for table `denda_master`
--
ALTER TABLE `denda_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prioritas` (`prioritas`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_status`
--
ALTER TABLE `jabatan_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_status_hak_akses_foreign` (`hak_akses`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libur_khusus`
--
ALTER TABLE `libur_khusus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`id_mesin`),
  ADD UNIQUE KEY `mesin_idmesin_unique` (`idmesin`),
  ADD UNIQUE KEY `idmesin` (`idmesin`),
  ADD KEY `mesin_id_cabang_gedung_foreign` (`id_cabang_gedung`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nomor_induk`),
  ADD KEY `pengguna_cabang_gedung_foreign` (`cabang_gedung`),
  ADD KEY `pengguna_jabatan_status_foreign` (`jabatan_status`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `denda_master`
--
ALTER TABLE `denda_master`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libur_khusus`
--
ALTER TABLE `libur_khusus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mesin`
--
ALTER TABLE `mesin`
  MODIFY `id_mesin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `pengguna` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absensi_mesin` FOREIGN KEY (`idmesin`) REFERENCES `mesin` (`idmesin`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `pengguna` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuti_disetujui_oleh_foreign` FOREIGN KEY (`disetujui_oleh`) REFERENCES `pengguna` (`nomor_induk`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jabatan_status`
--
ALTER TABLE `jabatan_status`
  ADD CONSTRAINT `jabatan_status_hak_akses_foreign` FOREIGN KEY (`hak_akses`) REFERENCES `hak_akses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mesin`
--
ALTER TABLE `mesin`
  ADD CONSTRAINT `mesin_id_cabang_gedung_foreign` FOREIGN KEY (`id_cabang_gedung`) REFERENCES `cabang_gedung` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
