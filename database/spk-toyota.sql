-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 01:07 AM
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
(6, 'Joko', 'Susilo', 'BP 3220 DT', 'RA98897867KA', 'Honda', 'XPANDER 2020', '082160271959', 'Batam Centre'),
(7, 'Burhan', 'Ardan', 'BP 7340 DT', 'RA98764567KA', 'Toyota', 'YARIS', '081354709870', 'Jl. Botania 2'),
(8, 'Ruslan ', 'Anwar', 'BP 9340 DT', 'RA76456798KA', 'Honda', 'JAZZ 2018', '083156789870', 'Jl. Nagoya 13'),
(9, 'Bayu ', 'Anugerah', 'BP 3113 CK', 'RA67873456KA', 'Honda', 'Brio 2018', '081688976890', 'Batam Centre');

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
(17, 6, 9, 11, 90),
(18, 6, 9, 12, 80),
(19, 6, 9, 13, 70),
(20, 6, 9, 14, 70),
(21, 7, 10, 11, 100),
(22, 7, 10, 12, 80),
(23, 7, 10, 13, 70),
(24, 7, 10, 14, 100);

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
(9, 6, '1. Ganti Oli\r\n2. Cek Air Radiator', '27-08-2022'),
(10, 7, ' 1. Service Pintu Belakang', '27-08-2022'),
(11, 8, ' 1. Ganti Ban Belakang', '27-08-2022'),
(12, 9, '1. Ganti Stir\r\n2. Cek Lampu Belakang', '27-08-2022');

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
  ADD PRIMARY KEY (`idCustomer`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `idCustomer` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idKriteria` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idPenilaian` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
