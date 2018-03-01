-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2018 at 01:06 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(40) DEFAULT NULL,
  `customer_alamat` text,
  `no_tlp` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_alamat`, `no_tlp`) VALUES
(1, 'didi', NULL, NULL),
(2, 'didi', 'subang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_produk`
--

CREATE TABLE `tbl_kategori_produk` (
  `kategori_produk_id` int(11) NOT NULL,
  `kategori_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_produk`
--

INSERT INTO `tbl_kategori_produk` (`kategori_produk_id`, `kategori_name`) VALUES
(1, 'Elektronik'),
(2, 'Obat'),
(3, 'Peralatan Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `produk_id` int(11) NOT NULL,
  `produk_name` varchar(50) DEFAULT NULL,
  `produk_kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`produk_id`, `produk_name`, `produk_kategori_id`) VALUES
(1, 'Laptop', 1),
(2, 'Oskadon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_type_id` int(11) DEFAULT NULL,
  `transaksi_tanggal` datetime DEFAULT NULL,
  `jumlah_item` int(10) DEFAULT NULL,
  `transaksi_harga` int(30) NOT NULL,
  `total_harga` int(80) DEFAULT NULL,
  `transaksi_customer_id` int(11) NOT NULL,
  `transaksi_produk_id` int(11) NOT NULL,
  `transaksi_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`transaksi_id`, `transaksi_type_id`, `transaksi_tanggal`, `jumlah_item`, `transaksi_harga`, `total_harga`, `transaksi_customer_id`, `transaksi_produk_id`, `transaksi_type`) VALUES
(2, 2, '2018-02-28 20:04:43', 100, 10000000, 10000000, 2, 1, 'Pemasukan'),
(3, 1, '2018-02-28 19:30:32', 20, 500000, 10000000, 2, 1, 'Pengeluaran'),
(5, 1, '2018-03-01 00:00:16', 12, 10000, 120000, 1, 1, 'Pengeluaran'),
(6, 2, '2018-03-01 00:55:41', 3, 3000000, 9000000, 2, 1, 'Pemasukan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_type`
--

CREATE TABLE `tbl_trans_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trans_type`
--

INSERT INTO `tbl_trans_type` (`id`, `name`) VALUES
(3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_kategori_produk`
--
ALTER TABLE `tbl_kategori_produk`
  ADD PRIMARY KEY (`kategori_produk_id`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tbl_trans_type`
--
ALTER TABLE `tbl_trans_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_kategori_produk`
--
ALTER TABLE `tbl_kategori_produk`
  MODIFY `kategori_produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_trans_type`
--
ALTER TABLE `tbl_trans_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
