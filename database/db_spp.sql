-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 06:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(11) NOT NULL,
  `status` enum('Aktif','Non-Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tahun_ajaran`, `status`) VALUES
(1, 'XI IPS', '2024/2025', 'Aktif'),
(2, 'X IPA', '2024/2025', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_siswa`, `pesan`, `is_read`, `created_at`) VALUES
(1, 1, 'Tagihan pembayaran Ujian sebesar Rp 70000 telah ditambahkan.', 0, '2025-05-17 00:14:30'),
(2, 2, 'Tagihan pembayaran Kegiatan sebesar Rp 30000 telah ditambahkan.', 0, '2025-05-17 00:15:22'),
(3, 1, 'Tagihan pembayaran Ujian sebesar Rp 70000 telah ditambahkan.', 0, '2025-05-17 00:15:47'),
(4, 1, 'Pembayaran SPP sebesar Rp 200000 pada 2025-05-16 telah <b>Lunas</b>.', 1, '2025-05-17 00:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jenis` enum('Uang Gedung','SPP','Kegiatan','Ujian') NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_user`, `id_siswa`, `id_kelas`, `jenis`, `jumlah`, `tanggal_bayar`, `keterangan`, `created_at`) VALUES
(1, 1, 1, 1, 'SPP', 200000, '2025-05-16', '', '2025-05-15 07:56:23'),
(2, 1, 2, 1, 'SPP', 200000, '0000-00-00', NULL, '2025-05-15 07:56:23'),
(3, 1, 2, 2, 'Uang Gedung', 3000000, '0000-00-00', NULL, '2025-05-15 07:57:36'),
(6, 1, 2, 2, 'Kegiatan', 30000, '0000-00-00', NULL, '2025-05-17 00:15:22'),
(7, 1, 1, 1, 'Ujian', 70000, '0000-00-00', '', '2025-05-17 00:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Aktif','Non-Aktif') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `nis`, `kelas_id`, `no_hp`, `alamat`, `status`, `created_at`) VALUES
(1, 'anon', '12345', 1, '089123123123', 'jakarta1', 'Aktif', '2025-05-18 22:03:15'),
(2, 'budi', '56789', 2, '0892312323234', 'bekasi', 'Non-Aktif', '2025-05-18 22:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Siswa','Ortu') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(2, 'admin', '$2y$10$rD9LOmtP0yhS/olN5bTFQe/qD6IJgEOyJVGvODsni8gusW58gZ8tO', 'Admin', '2025-05-14 23:46:59'),
(3, '12345', '$2y$10$zu/YTuOoAfrvPv8aTlllB.mokn/v8VOhjrOt4UXM8rTfO.KQYI5S2', 'Siswa', '2025-05-16 23:10:05'),
(4, 'Or.12345', '$2y$10$ThdJXaUxQB9KmEmX0250meNPvpDavxKjRfwFcYjiYyN8VP.25KHSe', 'Ortu', '2025-05-16 23:10:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`id_siswa`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
