-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2021 at 10:16 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rental_mobil_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_mobil`
--

CREATE TABLE `brand_mobil` (
  `id_brand` int(11) NOT NULL,
  `nama_brand` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_mobil`
--

INSERT INTO `brand_mobil` (`id_brand`, `nama_brand`, `logo`) VALUES
(1, 'Toyota', '6055602bdea7a.png'),
(2, 'Mitsubishi', '60555c3534647.png'),
(3, 'Wuling Motors', '605546efbada0.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `id_dsewa` varchar(10) NOT NULL,
  `id_kendaraan` char(5) NOT NULL,
  `id_tsewa` int(11) NOT NULL,
  `biaya` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_sewa`
--

INSERT INTO `detail_sewa` (`id_dsewa`, `id_kendaraan`, `id_tsewa`, `biaya`) VALUES
('PKT001', 'AVA47', 1, 900000),
('PKT002', 'AVA47', 2, 2300000);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_mobil` char(5) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `id_mobil`, `gambar`) VALUES
(2, 'AVA47', '6059c4f3bb537.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_kendaraan` char(5) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `nama_kendaraan` varchar(50) NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `tahun` int(11) NOT NULL,
  `warna` varchar(15) NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `bahan_bakar` varchar(20) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `no_mesin` varchar(30) NOT NULL,
  `kondisi` text NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_kendaraan`, `id_merk`, `nama_kendaraan`, `nopol`, `tahun`, `warna`, `jumlah_kursi`, `bahan_bakar`, `no_rangka`, `no_mesin`, `kondisi`, `jumlah`) VALUES
('AVA47', 1, 'Avanza', 'N 7474 L', 2007, 'hitam', 6, 'bensin', 'MHKM 1BA2JDK042694', 'MC85044', 'Layak jalan, layak pakai dan selalu dalam keadaan bersih.\r\n', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` varchar(10) NOT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `id_dsewa` varchar(10) NOT NULL,
  `ket` enum('pending','paid','due','done') NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `tgl_dikembalikan` datetime DEFAULT NULL,
  `denda` bigint(20) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id_rental`, `customer`, `nama`, `alamat`, `nohp`, `id_dsewa`, `ket`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `denda`, `id_user`, `status`) VALUES
('RENT001', 'PT Firecracker', 'akbar jalaludin', 'tawangmangus', '089726154611', 'PKT002', 'done', '2021-06-29 12:57:00', '2021-06-30 12:57:00', '2021-07-02 12:57:00', 3220000, 1, '1'),
('RENT002', 'PT JAYA LUHUR', 'Bima', 'dqasdwegrehwer', '089726154614', 'PKT002', 'pending', '2021-06-29 19:08:00', '2021-07-01 19:08:00', NULL, NULL, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_sewa`
--

CREATE TABLE `tipe_sewa` (
  `id_tsewa` int(11) NOT NULL,
  `durasi` varchar(15) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_sewa`
--

INSERT INTO `tipe_sewa` (`id_tsewa`, `durasi`, `keterangan`) VALUES
(1, '1 bulan', 'Exclude: driver, toll payment, bbm (modal sendiri).'),
(2, '1 hari', 'Include: (Driver &amp; BBM)\r\nExclude: (Toll Payment)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nickname`, `pw`, `role`, `status`) VALUES
(1, 'sonny', '$2y$10$Bvz/8MtBF3Lzos8QDgIvXuVHUBQUBnSTBLW16xZT8JHetNjjZjIG6', 'superadmin', '1'),
(2, 'akbar', '$2y$10$cyRjx.V46ZF9MrJaqEVGoeBpbE9Nf65FwJ7xT81wPQTo2nbLoA3HG', 'admin', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_mobil`
--
ALTER TABLE `brand_mobil`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD PRIMARY KEY (`id_dsewa`),
  ADD KEY `id_tsewa` (`id_tsewa`),
  ADD KEY `id_kendaraan` (`id_kendaraan`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `id_merk` (`id_merk`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`),
  ADD KEY `id_dsewa` (`id_dsewa`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tipe_sewa`
--
ALTER TABLE `tipe_sewa`
  ADD PRIMARY KEY (`id_tsewa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_mobil`
--
ALTER TABLE `brand_mobil`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipe_sewa`
--
ALTER TABLE `tipe_sewa`
  MODIFY `id_tsewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `detail_sewa_ibfk_1` FOREIGN KEY (`id_tsewa`) REFERENCES `tipe_sewa` (`id_tsewa`),
  ADD CONSTRAINT `detail_sewa_ibfk_2` FOREIGN KEY (`id_kendaraan`) REFERENCES `mobil` (`id_kendaraan`);

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_kendaraan`);

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `mobil_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `brand_mobil` (`id_brand`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
