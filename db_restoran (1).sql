-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2019 at 11:41 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan`
-- (See below for the actual view)
--
CREATE TABLE `laporan` (
`kd_transaksi` int(11)
,`menu` varchar(100)
,`harga` int(11)
,`subtotal` int(11)
,`tgl_transaksi` datetime
,`no_meja` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `q_user`
-- (See below for the actual view)
--
CREATE TABLE `q_user` (
`kd_user` int(11)
,`nama` varchar(50)
,`no_hp` varchar(15)
,`username` varchar(50)
,`password` varchar(50)
,`level` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `kategori`) VALUES
(1, 'Makanan Ringan'),
(2, 'Makanan Berat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `kd_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`kd_menu`, `menu`, `jenis`, `harga`, `status`, `foto`, `kd_kategori`) VALUES
(32, 'Ayam Goreng', 'Makanan', 15000, 'Tersedia', 'a.jpeg', 2),
(44, 'Nasi Goreng', 'Makanan', 10000, 'Tersedia', 'd.jpeg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kd_user` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_menu`, `jumlah`, `subtotal`, `tgl_transaksi`, `kd_user`, `no_meja`) VALUES
(1, 13, 2, 20000, '2019-01-08 14:20:11', 18, 1),
(2, 7000, 10, 70000, '2019-01-09 09:17:28', 0, 17),
(2, 13, 10, 70000, '2019-01-09 09:19:19', 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`kd_user`, `nama`, `no_hp`, `username`, `password`, `level`) VALUES
(17, 'Dafa Rizki Fadillah', '0000', 'admin', 'admin', 'admin'),
(18, 'casie', '2', 'dafa', 'sdcs', 'admin'),
(22, 'casie', '2', 'dafa', 'cash', 'kasir');

-- --------------------------------------------------------

--
-- Structure for view `laporan`
--
DROP TABLE IF EXISTS `laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan`  AS  select `tb_transaksi`.`kd_transaksi` AS `kd_transaksi`,`tb_menu`.`menu` AS `menu`,`tb_menu`.`harga` AS `harga`,`tb_transaksi`.`subtotal` AS `subtotal`,`tb_transaksi`.`tgl_transaksi` AS `tgl_transaksi`,`tb_transaksi`.`no_meja` AS `no_meja` from (`tb_transaksi` join `tb_menu`) where (`tb_transaksi`.`kd_menu` = `tb_menu`.`kd_menu`) ;

-- --------------------------------------------------------

--
-- Structure for view `q_user`
--
DROP TABLE IF EXISTS `q_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `q_user`  AS  select `tb_user`.`kd_user` AS `kd_user`,`tb_user`.`nama` AS `nama`,`tb_user`.`no_hp` AS `no_hp`,`tb_user`.`username` AS `username`,`tb_user`.`password` AS `password`,`tb_user`.`level` AS `level` from `tb_user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`kd_menu`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD KEY `kd_user` (`kd_user`) USING BTREE,
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`),
  ADD KEY `kd_user` (`kd_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
