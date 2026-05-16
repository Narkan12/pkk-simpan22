-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 14, 2026 at 12:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkk-simpan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status` enum('hadir','terlambat','cuti','tanpa keterangan') NOT NULL DEFAULT 'tanpa keterangan',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_pegawai`, `tanggal`, `jam_masuk`, `jam_keluar`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-13', '15:52:24', '22:40:41', 'terlambat', NULL, '2026-04-13 08:52:24', '2026-04-13 15:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `nama_lengkap`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'admin01', 'Menambahkan Data Jabatan : Manager', '2026-04-13 08:41:16', '2026-04-13 08:41:16'),
(2, 'admin01', 'Menambahkan Data Departemen : Teknik Informasi Jaringan', '2026-04-13 08:41:25', '2026-04-13 08:41:25'),
(3, 'admin01', 'Menambahkan Status baru: Aktif', '2026-04-13 08:41:32', '2026-04-13 08:41:32'),
(4, 'admin01', 'Menambahkan Golongan baru: GOL III/B', '2026-04-13 08:41:41', '2026-04-13 08:41:41'),
(5, 'admin01', 'Menambahkan Pendidikan baru: SD/ Sekolah Dasar', '2026-04-13 08:41:56', '2026-04-13 08:41:56'),
(6, 'admin01', 'Menambahkan Komponen Gaji baru: Potongan', '2026-04-13 08:42:24', '2026-04-13 08:42:24'),
(7, 'admin01', 'Menambahkan pegawai baru: Nazran Arkan Azizan', '2026-04-13 08:43:22', '2026-04-13 08:43:22'),
(8, 'admin01', 'Menambahkan pegawai baru & Akun Login: Abdul Akmal Setiawan', '2026-04-13 09:31:54', '2026-04-13 09:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `jenis_cuti` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `alasan` text DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `id_pegawai`, `jenis_cuti`, `tanggal_mulai`, `tanggal_selesai`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cuti Tahunan', '2026-04-02', '2026-04-03', 'tahunan', 'ditolak', '2026-04-13 08:53:36', '2026-04-13 09:04:49'),
(2, 1, 'Izin Penting', '2026-04-13', '2026-05-14', NULL, 'ditolak', '2026-04-13 08:53:56', '2026-04-13 09:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_departemen` varchar(20) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `kepala_departemen` varchar(100) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_departemen`, `nama_departemen`, `kepala_departemen`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'DEPT-TKJ', 'Teknik Informasi Jaringan', 'Budi Aminah', 'Lantai 1, Sukamaju', '2026-04-13 08:41:25', '2026-04-13 08:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `NIK` varchar(20) NOT NULL,
  `NIP` varchar(30) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Aliran Kepercayaan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `status_pernikahan` varchar(255) DEFAULT NULL,
  `jenis_pegawai` varchar(255) DEFAULT NULL,
  `id_jabatan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_departemen` bigint(20) UNSIGNED DEFAULT NULL,
  `id_golongan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_status` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pendidikan` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `id_user`, `NIK`, `NIP`, `foto`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `agama`, `alamat`, `no_telp`, `status_pernikahan`, `jenis_pegawai`, `id_jabatan`, `id_departemen`, `id_golongan`, `id_status`, `id_pendidikan`, `tanggal_masuk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '100234567890', '009898939793', 'foto_pegawai/1776095002_69dd0f1a3d52c.jpg', 'Nazran Arkan Azizan', 'L', '2026-03-31', 'Bandung', 'Islam', 'Bandung', '0854344335', 'Belum Menikah', 'Pegawai Tetap', 1, 1, 1, 1, 1, '2026-05-08', '2026-04-13 08:43:22', '2026-04-13 08:43:22', NULL),
(2, 5, '1', '2', 'foto_pegawai/1776097914_69dd1a7a230ef.png', 'Abdul Akmal Setiawan', 'L', '2026-04-04', 'Ngamprah', 'Islam', 'Melong', '0989156267872', 'Belum Menikah', 'Pegawai Kontrak', 1, 1, 1, 1, 1, '2026-04-04', '2026-04-13 09:31:54', '2026-04-13 09:31:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` year(4) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL DEFAULT 0,
  `tunjangan` bigint(20) NOT NULL DEFAULT 0,
  `potongan` bigint(20) NOT NULL DEFAULT 0,
  `total_gaji` bigint(20) GENERATED ALWAYS AS (`gaji_pokok` + `tunjangan` - `potongan`) STORED,
  `status_bayar` enum('Belum Dibayar','Sudah Dibayar') NOT NULL DEFAULT 'Belum Dibayar',
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `id_pegawai`, `bulan`, `tahun`, `gaji_pokok`, `tunjangan`, `potongan`, `status_bayar`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2026, 5000000, 0, 4000000, 'Belum Dibayar', NULL, '2026-04-13 09:19:59', '2026-04-13 09:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_golongan` varchar(20) NOT NULL,
  `nama_golongan` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `ruang` varchar(10) NOT NULL,
  `eselon` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id`, `kode_golongan`, `nama_golongan`, `pangkat`, `ruang`, `eselon`, `created_at`, `updated_at`) VALUES
(1, 'GOL-01', 'GOL III/B', 'Penata Muda Tk.2', 'III/B', 'Eselon II', '2026-04-13 08:41:41', '2026-04-13 08:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jabatan` varchar(20) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `kode_jabatan`, `nama_jabatan`, `level`, `gaji_pokok`, `tunjangan`, `created_at`, `updated_at`) VALUES
(1, 'MGR-01', 'Manager', 2, '5000000.00', '567000.00', '2026-04-13 08:41:16', '2026-04-13 08:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `komponen_gaji`
--

CREATE TABLE `komponen_gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jabatan` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_komponen` varchar(20) NOT NULL,
  `nama_komponen` varchar(100) NOT NULL,
  `jenis` enum('penghasilan','potongan') NOT NULL,
  `tipe_nominal` enum('fixed','percent') NOT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komponen_gaji`
--

INSERT INTO `komponen_gaji` (`id`, `id_jabatan`, `kode_komponen`, `nama_komponen`, `jenis`, `tipe_nominal`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 1, 'PT-02', 'Potongan', 'potongan', 'fixed', '4000000.00', '2026-04-13 08:42:24', '2026-04-13 08:42:24');

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
(1, '2026_03_22_143146_create_users_table', 1),
(2, '2026_03_22_144421_create_data-master_table', 1),
(3, '2026_03_22_144449_create_employess_table', 1),
(4, '2026_03_29_135457_create_log-activities_table', 1),
(5, '2026_03_30_184847_create_leave-application_table', 1),
(6, '2026_03_30_184924_create_attendances_table', 1),
(7, '2026_04_13_create_gaji_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pendidikan` varchar(20) NOT NULL,
  `jenjang` varchar(150) NOT NULL,
  `lama_studi` tinyint(3) UNSIGNED NOT NULL,
  `deskripsi` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `kode_pendidikan`, `jenjang`, `lama_studi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'P-01', 'SD/ Sekolah Dasar', 6, '-', '2026-04-13 08:41:56', '2026-04-13 08:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_status` varchar(20) NOT NULL,
  `nama_status` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id`, `kode_status`, `nama_status`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'ST-01', 'Aktif', 'Pegawai sedang aktif', '2026-04-13 08:41:32', '2026-04-13 08:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai') NOT NULL DEFAULT 'pegawai',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `foto`, `name`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin01', 'admin01@gmail.com', '$2y$12$8QlDndQRss.b4VdsSXtpNe6Buo0hKtpo7wJFRl/WmUSRmdvkFPH3W', 'admin', NULL, '2026-04-13 08:38:21', '2026-04-13 08:38:21'),
(2, NULL, 'Admin02', 'admin', 'admin012@gmail.com', '$2y$12$d9HnbmPtJZeS2fFIPcVO7et3qXRC131/cKRxeQKOlUjqd3opi5BzW', 'admin', NULL, '2026-04-13 08:38:21', '2026-04-13 08:38:21'),
(3, NULL, 'Budi Santoso', 'BudiSan', 'budisantoso01@gmail.com', '$2y$12$MW5Kk3koWQHeQw2A2wCrbeqecVDR8tFDnLhQChPco5LJRmbNPcZ0W', 'pegawai', NULL, '2026-04-13 08:38:21', '2026-04-13 08:38:21'),
(4, NULL, 'Nazran Arkan', 'Nazran', 'nazranarkan@gmail.com', '$2y$12$pybSmt/GKG1LKMJFy.RGCudposjAfAe3xj2EzdsmQb.hxuDeZyzsO', 'pegawai', NULL, '2026-04-13 08:38:22', '2026-04-13 08:38:22'),
(5, NULL, 'Abdul Akmal Setiawan', '2', '2@simpan.com', '$2y$12$PZpqe/4MofMsYyLseb9NOuXDIkKsBHMV0O7E4GlK4J9pEsls/281K', 'pegawai', NULL, '2026-04-13 09:31:54', '2026-04-13 09:31:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuti_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemen_kode_departemen_unique` (`kode_departemen`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_nik_unique` (`NIK`),
  ADD UNIQUE KEY `employees_nip_unique` (`NIP`),
  ADD KEY `employees_id_user_foreign` (`id_user`),
  ADD KEY `employees_id_jabatan_foreign` (`id_jabatan`),
  ADD KEY `employees_id_departemen_foreign` (`id_departemen`),
  ADD KEY `employees_id_golongan_foreign` (`id_golongan`),
  ADD KEY `employees_id_status_foreign` (`id_status`),
  ADD KEY `employees_id_pendidikan_foreign` (`id_pendidikan`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gaji_id_pegawai_bulan_tahun_unique` (`id_pegawai`,`bulan`,`tahun`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `golongan_kode_golongan_unique` (`kode_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan_kode_jabatan_unique` (`kode_jabatan`);

--
-- Indexes for table `komponen_gaji`
--
ALTER TABLE `komponen_gaji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `komponen_gaji_kode_komponen_unique` (`kode_komponen`),
  ADD KEY `komponen_gaji_id_jabatan_foreign` (`id_jabatan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendidikan_kode_pendidikan_unique` (`kode_pendidikan`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_pegawai_kode_status_unique` (`kode_status`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komponen_gaji`
--
ALTER TABLE `komponen_gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_id_departemen_foreign` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_id_golongan_foreign` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_id_pendidikan_foreign` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status_pegawai` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `komponen_gaji`
--
ALTER TABLE `komponen_gaji`
  ADD CONSTRAINT `komponen_gaji_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
