-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 04:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` bigint(20) NOT NULL,
  `nominal_uang` bigint(20) NOT NULL,
  `total_bayar` bigint(20) NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(1077, 40000, 35554, '2024-02-28 17:01:09'),
(1637, 20000, 17777, '2024-02-28 17:06:06'),
(2454, 70000, 66000, '2024-03-02 15:29:44'),
(2496, 70000, 66000, '2024-03-02 15:33:26'),
(2684, 20000, 17777, '2024-02-28 17:40:45'),
(3295, 90000, 90000, '2024-03-02 15:33:47'),
(3489, 30000, 23777, '2024-03-02 15:29:16'),
(3620, 170000, 162000, '2024-03-02 15:35:08'),
(3646, 100000, 53331, '2024-03-01 12:19:34'),
(3705, 50000, 50000, '2024-03-02 15:28:00'),
(3737, 110000, 101554, '2024-03-02 15:30:39'),
(6244, 260000, 256000, '2024-03-02 15:34:16'),
(8663, 70000, 66554, '2024-03-02 15:32:06'),
(8724, 100000, 60000, '2024-03-02 15:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailpjl`
--

CREATE TABLE `tb_detailpjl` (
  `id_detail` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detailpjl`
--

INSERT INTO `tb_detailpjl` (`id_detail`, `penjualan_id`, `produk_id`, `jumlah_produk`, `subtotal`) VALUES
(38, 1637, 7679, 1, '17777.00'),
(42, 1077, 7679, 2, '35554.00'),
(44, 2684, 7679, 1, '17777.00'),
(45, 3646, 7679, 3, '53331.00'),
(46, 8724, 3657, 1, '0.00'),
(47, 8724, 7018, 1, '0.00'),
(48, 3705, 7644, 2, '50000.00'),
(49, 3489, 7679, 1, '0.00'),
(50, 3489, 7264, 1, '0.00'),
(51, 2454, 3657, 2, '0.00'),
(52, 2454, 7264, 1, '0.00'),
(53, 3737, 3657, 1, '0.00'),
(54, 3737, 7018, 1, '0.00'),
(55, 3737, 7264, 1, '0.00'),
(56, 3737, 7679, 2, '0.00'),
(57, 8663, 7679, 2, '0.00'),
(58, 8663, 7644, 1, '0.00'),
(59, 8663, 7264, 1, '0.00'),
(60, 2496, 3657, 2, '0.00'),
(61, 2496, 7264, 1, '0.00'),
(62, 3295, 7018, 3, '90000.00'),
(63, 6244, 7644, 10, '0.00'),
(64, 6244, 7264, 1, '0.00'),
(65, 3620, 7264, 2, '0.00'),
(66, 3620, 7018, 5, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telepon`) VALUES
(1023, 'Rafli fachri', 'fdfdgf\r\n', '34353'),
(1081, 'elray', '', '0515591422');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL DEFAULT current_timestamp(),
  `total_harga` decimal(10,2) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `tanggal_penjualan`, `total_harga`, `pelanggan_id`) VALUES
(1077, '2024-03-18', '35554.00', 1023),
(1637, '2024-02-16', '17777.00', 1023),
(2454, '2024-05-16', '66000.00', 1081),
(2496, '2024-09-16', '66000.00', 1023),
(2684, '2024-03-17', '17777.00', 1023),
(3295, '2024-12-16', '90000.00', 1081),
(3489, '2024-07-16', '23777.00', 1081),
(3620, '2024-10-16', '162000.00', 1081),
(3646, '2024-03-17', '53331.00', 1081),
(3705, '2024-06-16', '50000.00', 1023),
(3737, '2024-01-16', '101554.00', 1023),
(6244, '2024-11-16', '256000.00', 1081),
(8663, '2024-08-16', '66554.00', 1081),
(8724, '2024-04-16', '60000.00', 1023);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama`, `satuan`, `harga`, `stok`) VALUES
(3657, 'Rokok Sampoerna ', 'bungkus', 30000, 9),
(7018, 'Rokok Surya 16', 'bungkus', 30000, 20),
(7264, 'Korek Criket', 'biji', 6000, 92),
(7644, 'Rokok Surya 12', 'bungkus', 25000, 7),
(7679, 'Rokok Grow 16', 'bungkus', 17777, 44);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(9, 'Rafli', 'admin@gmail.com', 'admin', 'admin'),
(10, 'Saya', 'kasir@gmail.com', 'kasir', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_detailpjl`
--
ALTER TABLE `tb_detailpjl`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `penjualan_id` (`penjualan_id`,`produk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `pelanggan` (`pelanggan_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8725;

--
-- AUTO_INCREMENT for table `tb_detailpjl`
--
ALTER TABLE `tb_detailpjl`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9808;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7680;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detailpjl`
--
ALTER TABLE `tb_detailpjl`
  ADD CONSTRAINT `tb_detailpjl_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `tb_produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detailpjl_ibfk_2` FOREIGN KEY (`penjualan_id`) REFERENCES `tb_penjualan` (`id_penjualan`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
