-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 03:32 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan_customer`
--

CREATE TABLE `kendaraan_customer` (
  `id_kendaraan` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nopol` varchar(8) NOT NULL,
  `kode_parkir` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan_customer`
--

INSERT INTO `kendaraan_customer` (`id_kendaraan`, `email`, `nopol`, `kode_parkir`) VALUES
(6, 'enggarh98@gmail.com', 'AB6468CC', 'SK7VAB6468CC'),
(7, 'enggarh98@gmail.com', 'AB6454CD', 'V28EAB6454CD'),
(8, 'enggarh98@gmail.com', 'AB7474BE', '5Mz7AB7474BE'),
(9, 'enggarh98@gmail.com', 'AB9494AC', 'uc2kAB9494AC'),
(10, 'enggarh98@gmail.com', 'L2500X', 'xW4pL2500X');

-- --------------------------------------------------------

--
-- Table structure for table `parkir_keluar`
--

CREATE TABLE `parkir_keluar` (
  `id_parkir_keluar` int(11) NOT NULL,
  `id_parkir_masuk` int(11) NOT NULL,
  `kode_parkir` varchar(20) NOT NULL,
  `jam_keluar` time NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkir_masuk`
--

CREATE TABLE `parkir_masuk` (
  `id_parkir_masuk` int(11) NOT NULL,
  `kode_parkir` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `tempat_parkir` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tempat_parkir`
--

CREATE TABLE `tempat_parkir` (
  `id_temkir` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kode` varchar(3) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_customer`
--

CREATE TABLE `users_customer` (
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `status` int(1) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_customer`
--

INSERT INTO `users_customer` (`username`, `email`, `no_hp`, `status`, `password`) VALUES
('enggar', 'enggarh98@gmail.com', '+6289668730345', 0, 'enggar');

-- --------------------------------------------------------

--
-- Table structure for table `users_pegawai`
--

CREATE TABLE `users_pegawai` (
  `nik` int(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` longtext NOT NULL,
  `shift` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `password` longtext NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_pegawai`
--

INSERT INTO `users_pegawai` (`nik`, `nama`, `alamat`, `shift`, `status`, `password`, `admin`) VALUES
(143216001, 'Feri Andriyanto Sandika', 'Rungkut Menanggal 2B No.14D', 1, 0, 'a8c580937868fb72b53706017b8e0e00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_pegawai_login_activity`
--

CREATE TABLE `users_pegawai_login_activity` (
  `id_users_pegawai_login_activity` int(11) NOT NULL,
  `nik` int(9) NOT NULL,
  `tanggal_signin` date NOT NULL,
  `tanggal_signout` date NOT NULL,
  `jam_signin` time NOT NULL,
  `jam_signout` time NOT NULL,
  `note` longtext NOT NULL,
  `status_failed` int(1) NOT NULL,
  `ip_address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_customer_login_activity`
--

CREATE TABLE `user_customer_login_activity` (
  `email` varchar(50) NOT NULL,
  `tanggal_signin` date NOT NULL,
  `tanggal_signout` date NOT NULL,
  `jam_signin` time NOT NULL,
  `jam_signout` time NOT NULL,
  `note` longtext NOT NULL,
  `status_failed` int(1) NOT NULL,
  `ip_address` longtext NOT NULL,
  `id_user_customer_login_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan_customer`
--
ALTER TABLE `kendaraan_customer`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `parkir_keluar`
--
ALTER TABLE `parkir_keluar`
  ADD PRIMARY KEY (`id_parkir_keluar`),
  ADD KEY `id_parkir_masuk` (`id_parkir_masuk`);

--
-- Indexes for table `parkir_masuk`
--
ALTER TABLE `parkir_masuk`
  ADD PRIMARY KEY (`id_parkir_masuk`);

--
-- Indexes for table `tempat_parkir`
--
ALTER TABLE `tempat_parkir`
  ADD PRIMARY KEY (`id_temkir`);

--
-- Indexes for table `users_customer`
--
ALTER TABLE `users_customer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users_pegawai`
--
ALTER TABLE `users_pegawai`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `users_pegawai_login_activity`
--
ALTER TABLE `users_pegawai_login_activity`
  ADD PRIMARY KEY (`id_users_pegawai_login_activity`);

--
-- Indexes for table `user_customer_login_activity`
--
ALTER TABLE `user_customer_login_activity`
  ADD PRIMARY KEY (`id_user_customer_login_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan_customer`
--
ALTER TABLE `kendaraan_customer`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parkir_keluar`
--
ALTER TABLE `parkir_keluar`
  MODIFY `id_parkir_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parkir_masuk`
--
ALTER TABLE `parkir_masuk`
  MODIFY `id_parkir_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tempat_parkir`
--
ALTER TABLE `tempat_parkir`
  MODIFY `id_temkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users_pegawai_login_activity`
--
ALTER TABLE `users_pegawai_login_activity`
  MODIFY `id_users_pegawai_login_activity` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_customer_login_activity`
--
ALTER TABLE `user_customer_login_activity`
  MODIFY `id_user_customer_login_activity` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan_customer`
--
ALTER TABLE `kendaraan_customer`
  ADD CONSTRAINT `kendaraan_customer_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users_customer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parkir_keluar`
--
ALTER TABLE `parkir_keluar`
  ADD CONSTRAINT `parkir_keluar_ibfk_1` FOREIGN KEY (`id_parkir_masuk`) REFERENCES `parkir_masuk` (`id_parkir_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
