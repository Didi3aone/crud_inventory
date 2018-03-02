-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Mar 2018 pada 01.36
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(40) DEFAULT NULL,
  `customer_alamat` text,
  `no_tlp` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_alamat`, `no_tlp`) VALUES
(1, 'didi', 'jl.subang', 2147483647),
(3, 'Didi ganteng', 'asasda', 121);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori_produk`
--

CREATE TABLE `tbl_kategori_produk` (
  `kategori_produk_id` int(11) NOT NULL,
  `kategori_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori_produk`
--

INSERT INTO `tbl_kategori_produk` (`kategori_produk_id`, `kategori_name`) VALUES
(1, 'Elektronik'),
(2, 'Obats');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `produk_id` int(11) NOT NULL,
  `produk_name` varchar(50) DEFAULT NULL,
  `produk_kategori_id` int(11) NOT NULL,
  `produk_price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`produk_id`, `produk_name`, `produk_kategori_id`, `produk_price`) VALUES
(1, 'Laptop asus x453', 1, 100000),
(3, 'obat nyamuk', 2, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
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
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`transaksi_id`, `transaksi_type_id`, `transaksi_tanggal`, `jumlah_item`, `transaksi_harga`, `total_harga`, `transaksi_customer_id`, `transaksi_produk_id`, `transaksi_type`) VALUES
(10, 1, '2018-03-02 00:38:26', 13, 100000, 1300000, 1, 1, 'Pengeluaran'),
(11, 2, '2018-03-02 01:01:20', 12, 1000000, 12000000, 1, 3, 'Pemasukan'),
(12, 2, '2018-03-02 01:33:41', 3, 1000000, 3000000, 1, 3, 'Pemasukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_trans_type`
--

CREATE TABLE `tbl_trans_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kategori_produk`
--
ALTER TABLE `tbl_kategori_produk`
  MODIFY `kategori_produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_trans_type`
--
ALTER TABLE `tbl_trans_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
