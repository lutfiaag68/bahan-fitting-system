-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 09:37 AM
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
-- Database: `bahan_fitting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', '2025-06-21 06:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `booking_fitting`
--

CREATE TABLE `booking_fitting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_fitting` date NOT NULL,
  `jam_fitting` time NOT NULL,
  `jenis_pakaian` varchar(100) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','dikonfirmasi','selesai','dibatalkan') DEFAULT 'pending',
  `tanggal_booking` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_fitting`
--

INSERT INTO `booking_fitting` (`id`, `user_id`, `tanggal_fitting`, `jam_fitting`, `jenis_pakaian`, `jumlah_orang`, `catatan`, `status`, `tanggal_booking`) VALUES
(1, 1, '2025-06-23', '14:00:00', 'kebaya', 2, 'warna biru', 'dikonfirmasi', '2025-06-21 07:02:21'),
(2, 2, '2025-07-02', '08:00:00', 'Gaun Pesta', 5, 'Warna Hijau', 'dikonfirmasi', '2025-06-21 07:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_bahan`
--

CREATE TABLE `pemesanan_bahan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_bahan` varchar(100) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `jumlah` float NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','diproses','selesai','dibatalkan') DEFAULT 'pending',
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan_bahan`
--

INSERT INTO `pemesanan_bahan` (`id`, `user_id`, `jenis_bahan`, `warna`, `jumlah`, `satuan`, `catatan`, `status`, `tanggal_pesan`) VALUES
(1, 1, 'sutra', 'merah', 2, 'meter', 'boleh', 'selesai', '2025-06-21 06:55:25'),
(2, 2, 'Taffeta', 'pink', 4, 'meter', 'Bisa DI LEBIHKAN ', 'diproses', '2025-06-21 07:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `telp`, `created_at`) VALUES
(1, 'sungkar', 'sungkar@gmail.com', 'dda1097a0f68639a76510023857501cb', '0212345678', '2025-06-21 06:49:31'),
(2, 'Galih', 'galih@gmail.com', 'eaca4f6f92801365fa45bb702a5de5bb', '+62-56-788-888', '2025-06-21 07:28:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `booking_fitting`
--
ALTER TABLE `booking_fitting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pemesanan_bahan`
--
ALTER TABLE `pemesanan_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_fitting`
--
ALTER TABLE `booking_fitting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan_bahan`
--
ALTER TABLE `pemesanan_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_fitting`
--
ALTER TABLE `booking_fitting`
  ADD CONSTRAINT `booking_fitting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pemesanan_bahan`
--
ALTER TABLE `pemesanan_bahan`
  ADD CONSTRAINT `pemesanan_bahan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
