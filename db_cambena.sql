-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 03:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cambena`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kain`
--

CREATE TABLE `jenis_kain` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kain`
--

INSERT INTO `jenis_kain` (`id`, `nama`) VALUES
(1, 'Combed 24 S'),
(3, 'Combed 30 SS'),
(4, 'Combed 32 S'),
(5, 'Combed 32 SS');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pakaian`
--

CREATE TABLE `jenis_pakaian` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pakaian`
--

INSERT INTO `jenis_pakaian` (`id`, `nama`) VALUES
(1, 'UNNISEX'),
(3, 'L. Panjang'),
(4, 'Cewek'),
(5, 'L. Panjang Cewek'),
(6, 'Anak 2-6 Th'),
(7, 'L. Panjang anak');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id`, `nama`) VALUES
(1, 'Potong'),
(2, 'Badan Depan'),
(3, 'Badan Belakang '),
(4, 'Lengan'),
(5, 'RIB Leher'),
(6, 'RIB Lengan'),
(7, 'Lapisan'),
(8, 'Kerah'),
(9, 'Manset'),
(10, 'Kantong'),
(11, 'AFDRUK'),
(12, 'FILM'),
(13, 'SETTING'),
(14, 'SABLON'),
(15, 'PRESS'),
(16, 'JAHIT'),
(17, 'LEBEL'),
(18, 'PACKING'),
(19, 'QC');

-- --------------------------------------------------------

--
-- Table structure for table `mockup`
--

CREATE TABLE `mockup` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `nama`) VALUES
(1, 'Kaos Oblong'),
(2, 'Kaos Kerah'),
(3, 'Polonya');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id` int(11) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id`, `no_nota`, `nama`, `alamat`, `no_hp`, `tgl_masuk`, `tgl_selesai`, `create_at`) VALUES
(1, 'AB-01', 'Zaki', 'Magelang', '0891243019243', '2023-08-13 04:13:46', '2023-08-13 04:13:46', '2023-08-13 04:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `id_jenis_pakaian` int(11) NOT NULL,
  `id_jenis_kain` int(11) NOT NULL,
  `id_mockup` int(11) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `id_warna` int(11) NOT NULL,
  `id_keterangan` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_pemesan`, `id_model`, `id_jenis_pakaian`, `id_jenis_kain`, `id_mockup`, `id_ukuran`, `id_warna`, `id_keterangan`, `keterangan`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 11, '1212e1221');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama`, `no_hp`, `alamat`, `foto`) VALUES
(1, 'Cambena', '00000', 'jogja', ''),
(3, 'qwe', '123', 'qwe', 'qwe'),
(4, 'qwe', '123', 'qwe', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id`, `nama`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XLL');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `nama`) VALUES
(1, 'Merah'),
(2, 'Kuning'),
(3, 'Hijau'),
(4, 'Biru'),
(5, 'Pink'),
(6, 'Hitam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_kain`
--
ALTER TABLE `jenis_kain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pakaian`
--
ALTER TABLE `jenis_pakaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mockup`
--
ALTER TABLE `mockup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kain`
--
ALTER TABLE `jenis_kain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_pakaian`
--
ALTER TABLE `jenis_pakaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mockup`
--
ALTER TABLE `mockup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
