-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2018 at 12:13 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pega`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_kasbon`
--

CREATE TABLE `project_kasbon` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_kasbon`
--

INSERT INTO `project_kasbon` (`id`, `kategori`) VALUES
(1, 'ATK'),
(2, 'BBM'),
(3, 'Kas Masuk'),
(4, 'Material'),
(5, 'Office'),
(6, 'Operasional'),
(7, 'Parkir'),
(8, 'Saldo Awal'),
(9, 'Service'),
(10, 'Supervisi'),
(11, 'Tol'),
(12, 'Transport');

-- --------------------------------------------------------

--
-- Table structure for table `project_wo`
--

CREATE TABLE `project_wo` (
  `id` int(11) NOT NULL,
  `nama_project` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_wo`
--

INSERT INTO `project_wo` (`id`, `nama_project`) VALUES
(1, 'Instalasi'),
(2, 'Dismantle'),
(3, 'Aktifasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income`
--

CREATE TABLE `tbl_income` (
  `id_income` int(11) NOT NULL,
  `wo_id` varchar(50) NOT NULL,
  `so_id` varchar(50) NOT NULL,
  `no_ba` varchar(50) NOT NULL,
  `no_boq` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `waktu_input` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_income`
--

INSERT INTO `tbl_income` (`id_income`, `wo_id`, `so_id`, `no_ba`, `no_boq`, `price`, `waktu_input`) VALUES
(3, '111', '222', '63563647', '0879368', 'Rp. 150.000.000', '2018-08-24 06:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasbon`
--

CREATE TABLE `tbl_kasbon` (
  `id_kasbon` int(11) NOT NULL,
  `wo_id` varchar(100) NOT NULL,
  `so_id` varchar(100) NOT NULL,
  `no_vr` varchar(100) NOT NULL,
  `tgl_input` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_wo`
--

CREATE TABLE `tbl_project_wo` (
  `id_project` int(11) NOT NULL,
  `kode_project` varchar(20) NOT NULL,
  `kode_jadwal` varchar(20) NOT NULL,
  `kode_teknisi` varchar(20) NOT NULL,
  `level` enum('teknisi','admin') NOT NULL,
  `tgl_project` text NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `wo_id` varchar(20) NOT NULL,
  `so_id` varchar(20) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `pic` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project_wo`
--

INSERT INTO `tbl_project_wo` (`id_project`, `kode_project`, `kode_jadwal`, `kode_teknisi`, `level`, `tgl_project`, `project_title`, `wo_id`, `so_id`, `customer`, `lokasi`, `pic`, `status`) VALUES
(15, 'PRO001', 'SCH001', 'TCH001', 'teknisi', '2018/08/23', 'Instalasi', '111', '222', 'Rusunawa', 'Rusunawa Depok', '333', 'first'),
(17, 'PRO002', 'SCH002', 'TCH002', 'teknisi', '2018/08/21', 'Activation', '123', '456', 'PT Indosat Ooredo', 'Gedung Indosat', '789', 'first'),
(18, 'PRO001', 'SCH003', 'TCH003', 'teknisi', '2018/08/23', 'Instalasi', '111', '222', 'Rusunawa', 'Rusunawa Depok', '333', '');

--
-- Triggers `tbl_project_wo`
--
DELIMITER $$
CREATE TRIGGER `after_delete_project` AFTER DELETE ON `tbl_project_wo` FOR EACH ROW BEGIN
Delete from tbl_schedule_wo where kode_jadwal = OLD.kode_jadwal;
DELETE FROM tbl_teknisi_wo where kode_teknisi = OLD.kode_teknisi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_wo`
--

CREATE TABLE `tbl_schedule_wo` (
  `kode_jadwal` varchar(20) NOT NULL,
  `tgl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule_wo`
--

INSERT INTO `tbl_schedule_wo` (`kode_jadwal`, `tgl`) VALUES
('SCH001', '2018/08/24'),
('SCH002', '2018/08/24'),
('SCH003', '2018/08/31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teknisi_wo`
--

CREATE TABLE `tbl_teknisi_wo` (
  `kode_teknisi` varchar(20) NOT NULL,
  `teknisi1` varchar(255) NOT NULL,
  `teknisi2` varchar(255) NOT NULL,
  `teknisi3` varchar(255) NOT NULL,
  `teknisi4` varchar(255) NOT NULL,
  `pkl1` varchar(255) NOT NULL,
  `pkl2` varchar(255) NOT NULL,
  `pkl3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teknisi_wo`
--

INSERT INTO `tbl_teknisi_wo` (`kode_teknisi`, `teknisi1`, `teknisi2`, `teknisi3`, `teknisi4`, `pkl1`, `pkl2`, `pkl3`) VALUES
('TCH001', 'HALIM RACHMAN RIFALDI', '', '', '', 'ari', 'rizky', ''),
('TCH002', 'IRWAN SETIAWAN', 'HALIM RACHMAN RIFALDI', '', '', '', '', ''),
('TCH003', 'HALIM RACHMAN RIFALDI', '', '', '', 'ari', 'rizky', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_wo`
--

CREATE TABLE `tbl_user_wo` (
  `id` int(11) NOT NULL,
  `w_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_wo`
--

INSERT INTO `tbl_user_wo` (`id`, `w_login`) VALUES
(12003, '2018-08-27 11:09:26'),
(12017, '2018-08-09 09:03:28'),
(13049, '2018-08-27 09:20:39'),
(14090, '2018-08-24 14:54:10'),
(14091, '2018-08-27 10:17:17'),
(18146, '2018-08-27 09:35:33'),
(18149, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Indexes for table `project_kasbon`
--
ALTER TABLE `project_kasbon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_wo`
--
ALTER TABLE `project_wo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_income`
--
ALTER TABLE `tbl_income`
  ADD PRIMARY KEY (`id_income`);

--
-- Indexes for table `tbl_kasbon`
--
ALTER TABLE `tbl_kasbon`
  ADD PRIMARY KEY (`id_kasbon`);

--
-- Indexes for table `tbl_project_wo`
--
ALTER TABLE `tbl_project_wo`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `tbl_schedule_wo`
--
ALTER TABLE `tbl_schedule_wo`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indexes for table `tbl_teknisi_wo`
--
ALTER TABLE `tbl_teknisi_wo`
  ADD PRIMARY KEY (`kode_teknisi`);

--
-- Indexes for table `tbl_user_wo`
--
ALTER TABLE `tbl_user_wo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_kasbon`
--
ALTER TABLE `project_kasbon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_wo`
--
ALTER TABLE `project_wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_income`
--
ALTER TABLE `tbl_income`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kasbon`
--
ALTER TABLE `tbl_kasbon`
  MODIFY `id_kasbon` int(11) NOT NULL AUTO_INCREMENT;

--
--
-- AUTO_INCREMENT for table `tbl_project_wo`
--
ALTER TABLE `tbl_project_wo`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
