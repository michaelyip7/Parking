-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 09:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `institusi`
--

CREATE TABLE `institusi` (
  `no` int(11) NOT NULL,
  `universitas_id` int(11) NOT NULL,
  `universitas` varchar(20) NOT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institusi`
--

INSERT INTO `institusi` (`no`, `universitas_id`, `universitas`, `logo`) VALUES
(1, 1, 'Untar', 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraan`
--

CREATE TABLE `jenis_kendaraan` (
  `no` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `harga_flat` int(20) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kendaraan`
--

INSERT INTO `jenis_kendaraan` (`no`, `nama`, `kendaraan_id`, `harga`, `harga_flat`, `type`) VALUES
(1, 'Mobil', 1, 8000, 4000, 'flat'),
(2, 'Motor', 2, 5000, 4000, 'flat'),
(3, 'Sepeda', 3, 3000, 2000, 'flat');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `petugas` varchar(20) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `tarif` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `petugas`, `kendaraan_id`, `plat_nomor`, `waktu_masuk`, `waktu_keluar`, `status`, `tarif`) VALUES
(23, '', 2, '42028191', '2021-12-01 04:42:12', '2022-01-12 09:03:00', 'out', '2024000'),
(30, '', 2, '41201800000', '2022-01-03 05:48:10', '2022-01-06 08:38:58', 'out', '148000'),
(35, '', 2, '4120180016', '2022-01-05 10:33:20', '2022-01-14 07:14:56', 'out', '424000'),
(38, '', 1, '343743', '2022-01-06 01:27:07', '2022-01-06 02:28:38', 'out', '5000'),
(39, '', 3, '', '2022-01-06 08:39:07', '2022-01-14 07:25:21', 'out', '190000'),
(40, '', 1, '4120180022', '2022-01-12 09:03:19', '2022-01-20 06:30:42', 'out', '1890000'),
(42, '', 3, '', '2022-01-13 02:52:39', '2022-01-19 13:07:47', 'out', '154000'),
(43, '', 1, '41201800000', '2022-01-13 03:27:22', '2022-02-12 03:27:22', 'out', '300000'),
(44, '', 1, '1222312123', '2022-01-13 04:02:20', '2022-01-13 04:02:20', 'out', '5000'),
(45, '', 2, '21212211', '2022-01-13 08:40:18', '2022-01-13 08:40:18', 'in', ''),
(46, '', 2, '412018002222', '2022-01-13 09:12:41', '2022-01-13 09:12:41', 'in', ''),
(47, '', 2, '412018002222', '2022-01-13 07:12:41', '2022-01-13 09:13:07', 'out', '4000'),
(48, '', 1, '101110001', '2022-01-19 05:26:44', '2022-01-19 05:26:44', 'in', ''),
(50, '', 2, '412019111', '2022-01-19 13:07:36', '2022-01-19 13:07:36', 'in', ''),
(51, '', 1, NULL, '2022-01-20 05:44:26', '2022-01-20 05:44:26', '', ''),
(52, '', 1, NULL, '2022-01-20 05:46:50', '2022-01-20 05:46:50', '', ''),
(53, '', 2, NULL, '2022-01-20 05:47:10', '2022-01-20 05:47:10', '', ''),
(54, '', 1, NULL, '2022-01-20 05:49:31', '2022-01-20 05:49:31', '', ''),
(55, '', 2, '412031001', '2022-01-20 06:13:04', '2022-01-20 06:13:04', 'in', ''),
(56, '', 2, '4120301112', '2022-01-20 06:13:18', '2022-01-20 06:13:18', 'in', ''),
(57, 'Tony', 2, '4120111112', '2022-01-20 06:17:18', '2022-01-20 06:17:18', 'in', ''),
(58, 'willy', 3, '', '2022-01-20 06:18:28', '2022-01-21 00:55:34', 'out', '36000'),
(59, 'willy', 3, '', '2022-01-21 00:55:25', '2022-01-21 00:55:25', 'in', ''),
(60, 'willy', 2, '4120181123213121', '2022-01-23 10:29:25', '2022-01-23 10:29:30', 'out', '0'),
(61, 'willy', 2, '4583434', '2022-01-23 10:30:26', '2022-01-23 10:37:47', 'out', '5000'),
(62, 'willy', 3, '', '2022-01-23 10:39:26', '2022-01-23 10:39:30', 'out', '2000'),
(63, 'willy', 2, '', '2022-01-23 10:41:21', '2022-01-23 10:41:21', 'in', ''),
(64, 'willy', 2, '41201900231', '2022-01-23 09:18:38', '2022-01-23 11:36:40', 'out', '15000'),
(65, 'willy', 3, '0', '2022-01-23 09:25:13', '2022-01-23 11:36:14', 'out', '8000'),
(66, 'willy', 3, 'Kosong', '2022-01-23 11:27:06', '2022-01-23 11:27:06', 'in', ''),
(67, 'Tony', 2, '412020002', '2022-01-24 03:48:34', '2022-01-24 03:48:34', 'in', ''),
(68, 'Tony', 3, 'Kosong', '2022-01-24 03:51:19', '2022-01-24 03:51:25', 'out', '3000'),
(69, 'willy', 1, '41201331', '2022-01-25 05:02:28', '2022-01-25 05:02:33', 'out', '5000'),
(70, 'willy', 1, '3423423', '2022-01-25 03:04:19', '2022-01-25 05:05:28', 'out', '15000'),
(71, 'willy', 1, '12345667', '2022-01-25 08:33:18', '2022-01-25 08:33:18', 'in', ''),
(72, 'willy', 2, '92384832', '2022-01-25 21:36:30', '2022-01-25 21:36:44', 'out', '5000'),
(73, 'willy', 2, '412020024', '2022-01-26 15:40:45', '2022-01-26 15:41:08', 'out', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `universitas_id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `universitas_id`, `nama`, `email`, `password`, `jabatan`, `status`) VALUES
(1, 1, 'janet', 'dummy@gmail.com', 'dummy', 'pemimpin', 'Enable'),
(2, 1, 'Admin', 'admin@admin.com', 'admin', 'admin', 'Enable'),
(3, 1, 'willy', 'willy@gmail.com', 'kerja', 'petugas', 'Enable'),
(4, 1, 'Tony', 'tony@gmail.com', 'kerja', 'petugas', 'Disable'),
(5, 1, 'aaa', 'aaa@gmail.com', 'kerja', 'petugas', 'Enable'),
(6, 1, 'jaiudin', 'jaiudin@gmail.com', 'kerja', 'petugas', 'Enable'),
(7, 1, 'suman', 'suman@gmail.com', 'kerja', 'pemimpin', 'Disable'),
(8, 1, 'remi', 'remi@gmail.com', 'kerja', 'petugas', 'Enable'),
(10, 1, 'zidane', 'zidane@gmail.com', 'zidane', 'petugas', 'Enable'),
(11, 1, 'michael', 'michael@gmail.com', 'kerja', 'petugas', 'Enable'),
(12, 1, 'yulli', 'yulli@gmail.com', 'kerja', 'petugas', 'Disable'),
(13, 1, 'keny', 'keny@gmail.com', 'kerja', 'petugas', 'Enable'),
(14, 1, 'redy', 'redy@gmail.com', 'redy', 'pemimpin', 'Enable'),
(15, 1, 'tedy', 'tedy@gmail.com', 'tedy', 'pemimpin', 'Enable'),
(16, 1, 'bbb', 'bbb@gmail.com', 'bbb', 'pemimpin', 'Enable'),
(17, 1, 'fredy', 'fredy@gmail.com', 'fredy', 'pemimpin', 'Disable');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institusi`
--
ALTER TABLE `institusi`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraan_id` (`kendaraan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `universitas_id` (`universitas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `institusi`
--
ALTER TABLE `institusi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `jenis_kendaraan` (`no`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`universitas_id`) REFERENCES `institusi` (`no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
