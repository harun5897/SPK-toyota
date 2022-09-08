-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 12:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-toyota`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `idCustomer` int(9) NOT NULL,
  `namaDepan` varchar(255) NOT NULL,
  `namaBelakang` varchar(255) NOT NULL,
  `nomorPolisi` varchar(255) NOT NULL,
  `nomorRangka` varchar(255) NOT NULL,
  `merkKendaraan` varchar(255) NOT NULL,
  `tipeKendaraan` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`idCustomer`, `namaDepan`, `namaBelakang`, `nomorPolisi`, `nomorRangka`, `merkKendaraan`, `tipeKendaraan`, `kontak`, `alamat`) VALUES
(9, 'Bayu ', 'Anugerah', 'BP 3113 CK', 'RA67873456KA', 'Honda', 'Brio 2018', '081688976890', 'Batam Centre'),
(10, 'Rudi', 'Sudarsono', 'BP 3113 DT', 'RA98897867KA', 'Toyota', 'JAZZ 2018', '081354709870', 'Batam'),
(6, 'Joko', 'Susilo', 'BP 3220 DT', 'RA98897867KA', 'Honda', 'XPANDER 2020', '082160271959', 'Batam Centre'),
(13, 'Suyamto ', 'Widodo', 'BP 3221 DT', 'RA67873196KA', 'Honda', 'JAZZ 2018', '081660271957', 'Batam'),
(14, 'Nur', 'Fadila', 'BP 3224 DT', 'RA98897767KA', 'Toyota', 'YARIS', '081660271967', 'Bengkong'),
(11, 'Bagas ', 'Saputra', 'BP 3340 DT', 'RA98764567KA', 'Mitsubishi', 'XPANDER 2020', '081354709870', 'batam'),
(15, 'Fatur', 'Rahman', 'BP 4120 DT', 'RA87897867KA', 'Honda', 'Brio 2018', '081660271556', 'Pinang'),
(7, 'Burhan', 'Ardan', 'BP 7340 DT', 'RA98764567KA', 'Toyota', 'YARIS', '081354709870', 'Jl. Botania 2'),
(8, 'Ruslan ', 'Anwar', 'BP 9340 DT', 'RA76456798KA', 'Honda', 'JAZZ 2018', '083156789870', 'Jl. Nagoya 13'),
(12, 'Novan', 'Prasetyo', 'BP 9341 DT', 'RA67873456KA', 'Honda', 'Brio 2018', '082160271959', 'Batam');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `idKriteria` int(9) NOT NULL,
  `namaKriteria` varchar(255) NOT NULL,
  `bobotKriteria` varchar(255) NOT NULL,
  `pertanyaanKriteria` varchar(255) NOT NULL,
  `costBenefit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`idKriteria`, `namaKriteria`, `bobotKriteria`, `pertanyaanKriteria`, `costBenefit`) VALUES
(11, 'Kriteria 1', '30', 'Apakah Durasi Service ideal ? ', 'benefit'),
(12, 'Kriteria 2', '20', ' Apakah Tempat Service Nyaman Bagi Customer ?', 'benefit'),
(13, 'Kriteria 3', '35', 'Apakah Pelayanan di Agung Toyota Ramah ? ', 'benefit'),
(14, 'Kriteria 4', '15', 'Apakah Hasil Service Sesuai dengan yang diharapkan ? ', 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idPenilaian` int(9) NOT NULL,
  `idCustomer` int(9) NOT NULL,
  `idService` int(9) NOT NULL,
  `idKriteria` int(9) NOT NULL,
  `nilai` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idPenilaian`, `idCustomer`, `idService`, `idKriteria`, `nilai`) VALUES
(37, 6, 13, 11, 9),
(38, 6, 13, 12, 6),
(39, 6, 13, 13, 9),
(40, 6, 13, 14, 7),
(41, 7, 14, 11, 9),
(42, 7, 14, 12, 8),
(43, 7, 14, 13, 7),
(44, 7, 14, 14, 7),
(45, 8, 15, 11, 7),
(46, 8, 15, 12, 8),
(47, 8, 15, 13, 9),
(48, 8, 15, 14, 7),
(49, 9, 16, 11, 7),
(50, 9, 16, 12, 6),
(51, 9, 16, 13, 7),
(52, 9, 16, 14, 7),
(53, 10, 17, 11, 5),
(54, 10, 17, 12, 4),
(55, 10, 17, 13, 7),
(56, 10, 17, 14, 5),
(57, 11, 18, 11, 7),
(58, 11, 18, 12, 6),
(59, 11, 18, 13, 5),
(60, 11, 18, 14, 9),
(61, 12, 19, 11, 9),
(62, 12, 19, 12, 8),
(63, 12, 19, 13, 9),
(64, 12, 19, 14, 7),
(65, 13, 20, 11, 5),
(66, 13, 20, 12, 6),
(67, 13, 20, 13, 7),
(68, 13, 20, 14, 7),
(69, 14, 21, 11, 5),
(70, 14, 21, 12, 6),
(71, 14, 21, 13, 7),
(72, 14, 21, 14, 9),
(73, 15, 22, 11, 7),
(74, 15, 22, 12, 8),
(75, 15, 22, 13, 7),
(76, 15, 22, 14, 9),
(77, 6, 23, 11, 9),
(78, 6, 23, 12, 9),
(79, 6, 23, 13, 7),
(80, 6, 23, 14, 7);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `idService` int(9) NOT NULL,
  `idCustomer` int(9) NOT NULL,
  `permasalahanKendaraan` varchar(255) NOT NULL,
  `tanggalService` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`idService`, `idCustomer`, `permasalahanKendaraan`, `tanggalService`) VALUES
(13, 6, ' 1. Ganti Oli', '27-08-2022'),
(14, 7, ' 1. Ganti Busi', '27-08-2022'),
(15, 8, ' 1. Cek Aki Motor', '27-08-2022'),
(16, 9, ' 1. Ganti Oli\r\n', '27-08-2022'),
(17, 10, ' 1. Ganti Busi', '30-08-2022'),
(18, 11, ' 1. Tambah Air Radiator', '30-08-2022'),
(19, 12, ' 1. Ganti Busi', '30-08-2022'),
(20, 13, ' 1. Tambah Air Radiator', '30-08-2022'),
(21, 14, ' 1. Ganti Piston', '30-08-2022'),
(22, 15, ' 1. Ganti Busi', '30-08-2022'),
(23, 6, ' 1. tes', '30-08-2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin12345', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`nomorPolisi`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idKriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idPenilaian`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idKriteria` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idPenilaian` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
