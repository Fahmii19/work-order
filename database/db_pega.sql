-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 08:11 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(10) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `status_masuk` enum('Y','N') NOT NULL DEFAULT 'N',
  `status_keluar` enum('Y','N') NOT NULL DEFAULT 'N',
  `ket` char(2) NOT NULL DEFAULT 'NA',
  `terlambat` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nip`, `tanggal_absen`, `jam_masuk`, `jam_keluar`, `status_masuk`, `status_keluar`, `ket`, `terlambat`) VALUES
(39, '1234', '2013-01-15', '03:28:26', '00:00:00', 'N', 'N', 'I', 'N'),
(37, '1234', '2013-01-16', '03:22:16', '03:22:26', 'Y', 'Y', 'M', 'Y'),
(40, '1234', '2013-01-14', '03:31:50', '00:00:00', 'N', 'N', 'S', 'N'),
(41, '1234', '2013-01-13', '03:32:39', '03:32:55', 'Y', 'Y', 'M', 'N'),
(42, '1234', '2013-01-12', '03:39:01', '03:39:15', 'Y', 'Y', 'M', 'N'),
(43, '1234', '2013-01-11', '03:53:54', '03:54:23', 'Y', 'Y', 'M', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id_bag` int(4) NOT NULL,
  `kd_bag` varchar(4) NOT NULL,
  `n_bag` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bag`, `kd_bag`, `n_bag`) VALUES
(4, 'B004', 'ADMINISTRASI'),
(2, 'B001', 'DIREKTUR UTAMA'),
(3, 'B003', 'HRD MANAGER'),
(7, 'B002', 'DIREKTUR'),
(9, 'B005', 'LEADER ADMINISTRASI'),
(11, 'B006', 'PROGRAMMER'),
(12, 'B007', 'OFFICE BOY'),
(13, 'B008', 'MARKETING'),
(16, 'B009', 'PERSONAL MANAGER'),
(17, 'B010', 'LEADER'),
(18, 'B011', 'TEKNISI'),
(19, 'B012', 'FREE AGENT');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `kode_cuti` varchar(30) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `tgl` date NOT NULL,
  `ket` enum('Accept','Pending','Reject') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `kode_cuti`, `nik`, `jumlah`, `keperluan`, `dari`, `sampai`, `tgl`, `ket`) VALUES
(2, '01/CPLR/VII/2018', '18150', '2', 'sendiri', '2018-07-16', '2018-07-18', '2018-07-11', 'Accept');

--
-- Triggers `cuti`
--
DELIMITER $$
CREATE TRIGGER `cuti_acc` AFTER UPDATE ON `cuti` FOR EACH ROW BEGIN
IF(NEW.ket = 'Accept') THEN
	UPDATE tbl_cuti SET cuti_dipakai = cuti_dipakai + OLD.jumlah, 
    sisa_cuti = sisa_cuti - OLD.jumlah WHERE nik = OLD.nik;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_gaji`
--

CREATE TABLE `daftar_gaji` (
  `id_gaji` int(6) NOT NULL,
  `tanggal` date NOT NULL,
  `nip` varchar(15) NOT NULL,
  `id_jabatan` varchar(6) NOT NULL,
  `id_departemen` varchar(6) NOT NULL,
  `uang_lembur` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `uang_transport` int(11) NOT NULL,
  `tunj_istri` int(11) NOT NULL,
  `tunj_anak` int(11) NOT NULL,
  `tunj_hari_tua` int(11) NOT NULL,
  `tunj_kecelakaan` int(11) NOT NULL,
  `tunj_kesehatan` int(11) NOT NULL,
  `tunj_kematian` int(11) NOT NULL,
  `tunj_hari_raya` int(11) NOT NULL,
  `jumlah_produksi` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga_per_unit` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `gaji_kotor` int(11) NOT NULL,
  `total_upah` int(11) NOT NULL,
  `status_pgw` enum('Tetap','Kontrak','Buruh') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_gaji`
--

INSERT INTO `daftar_gaji` (`id_gaji`, `tanggal`, `nip`, `id_jabatan`, `id_departemen`, `uang_lembur`, `uang_makan`, `uang_transport`, `tunj_istri`, `tunj_anak`, `tunj_hari_tua`, `tunj_kecelakaan`, `tunj_kesehatan`, `tunj_kematian`, `tunj_hari_raya`, `jumlah_produksi`, `jenis`, `harga_per_unit`, `bonus`, `potongan`, `gaji_kotor`, `total_upah`, `status_pgw`) VALUES
(1, '2011-09-25', '1083038', '1', '2', 80000, 90000, 80000, 50000000, 5000, 1850, 445, 190, 3350, 5000, 0, '', 0, 5000, 5000, 50325835, 0, 'Tetap'),
(2, '2011-09-25', '1083039', '1', '2', 50000, 50000, 50000, 50000, 50000, 1850, 445, 190, 3350, 50000, 0, '', 0, 50000, 50000, 355835, 0, 'Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `divisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `divisi`) VALUES
(1, 'OFFICE'),
(2, 'DIV PROVISIONING'),
(3, 'DIV COMMISSIONING TEST'),
(4, 'DIV RADIO ALITA'),
(5, 'DIV  LINTASARTA'),
(6, 'FREE AGENT'),
(7, 'PKL');

-- --------------------------------------------------------

--
-- Table structure for table `d_project`
--

CREATE TABLE `d_project` (
  `id_p` int(11) NOT NULL,
  `project` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_project`
--

INSERT INTO `d_project` (`id_p`, `project`) VALUES
(1, 'Activation'),
(3, 'Relocation'),
(6, 'Dismantle');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_ktp` varchar(100) NOT NULL,
  `file_kk` varchar(100) NOT NULL,
  `file_foto` varchar(100) NOT NULL,
  `file_ijazah` varchar(100) NOT NULL,
  `file_sima` varchar(100) NOT NULL,
  `file_simc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nik` varchar(20) NOT NULL,
  `gaji` varchar(30) NOT NULL,
  `tunjangan` varchar(30) NOT NULL,
  `insentiv` varchar(30) NOT NULL,
  `thr` varchar(30) NOT NULL,
  `plus_kes` varchar(30) NOT NULL,
  `plus_tenaga` varchar(30) NOT NULL,
  `gaji_bruto` varchar(30) NOT NULL,
  `pajak` varchar(30) NOT NULL,
  `min_tenaga` varchar(30) NOT NULL,
  `min_kes` varchar(30) NOT NULL,
  `pinjaman` varchar(30) NOT NULL,
  `gaji_bersih` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `tgl`, `nik`, `gaji`, `tunjangan`, `insentiv`, `thr`, `plus_kes`, `plus_tenaga`, `gaji_bruto`, `pajak`, `min_tenaga`, `min_kes`, `pinjaman`, `gaji_bersih`) VALUES
(1, '2018-06-07', '18150', '1000000', '1000000', '1000000', '1000000', '40000', '0', '4040000', '0', '', '10000', '0', '4030000'),
(2, '2018-06-07', '18150', '1000000', '1000000', '1000000', '1000000', '40000', '62400', '4102400', '0', '0', '10000', '0', '4092400');

-- --------------------------------------------------------

--
-- Table structure for table `h_jabatan`
--

CREATE TABLE `h_jabatan` (
  `idh` int(11) NOT NULL,
  `idkjb` varchar(4) NOT NULL,
  `jab_old` varchar(20) NOT NULL,
  `tgl_ajb` date NOT NULL,
  `jabatan_baru` varchar(20) NOT NULL,
  `tgl_kjb` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_jabatan`
--

INSERT INTO `h_jabatan` (`idh`, `idkjb`, `jab_old`, `tgl_ajb`, `jabatan_baru`, `tgl_kjb`) VALUES
(10, 'KJ01', 'Rekom', '2009-01-16', 'Kepala Rekom', '2013-01-16'),
(11, 'KJ01', 'Kepala Rekom', '2009-01-16', 'Mgr.Rekom', '2013-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jab` int(4) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `n_jab` varchar(20) NOT NULL,
  `gapok` varchar(25) NOT NULL,
  `tunj_jab` varchar(25) NOT NULL,
  `m_kerja` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jab`, `kode`, `n_jab`, `gapok`, `tunj_jab`, `m_kerja`) VALUES
(3, 'J003', 'Mgr.Rekom', '1500000', '150000', '0'),
(4, 'J004', 'Kepala IT', '1200000', '500000', '1450'),
(10, 'J005', 'IT', '5000000', '300000', '35'),
(11, 'J005', 'IT 1', '3520000', '220000', '53232'),
(12, 'J006', 'asdad', '236565', '26565', '26565'),
(13, 'J007', 'ASDASDA', '256565', '265656', '2656565'),
(14, 'J008', 'ASDASD', '35656565', '53556565', '35365'),
(15, 'J0009', 'ASDASD', '658689', '6356532', '565650'),
(17, '0009', 'tesss', '23232', '23232', '0');

-- --------------------------------------------------------

--
-- Table structure for table `k_jabatan`
--

CREATE TABLE `k_jabatan` (
  `idkjb` varchar(4) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `masa_kerja` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_jabatan`
--

INSERT INTO `k_jabatan` (`idkjb`, `nip`, `masa_kerja`, `keterangan`) VALUES
('KJ01', '1234', 4, 'dsda');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(3) NOT NULL,
  `nm_pt` varchar(50) NOT NULL,
  `alamat_pt` text NOT NULL,
  `Profile` text NOT NULL,
  `npwp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `nm_pt`, `alamat_pt`, `Profile`, `npwp`) VALUES
(1, 'PT. LUMBUNG RIANG COMMUNICATION', 'Jl. Pisangan Lama 1 No. 20, Pisangan Jakarta Timur', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `m_kerja`
--
CREATE TABLE `m_kerja` (
`nip` varchar(10)
,`nama` varchar(40)
,`tgl_masuk` date
,`t_mk` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `notes`, `status`) VALUES
(1, 'aaaa', 'tidak aktif'),
(3, 'b', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tmpt_lahir` varchar(200) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat_jalan` varchar(200) NOT NULL,
  `rt` text NOT NULL,
  `rw` text NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` text NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_bag` varchar(4) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `level_user` int(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tlpn` text NOT NULL,
  `nohp` text NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `id_agm` int(3) NOT NULL,
  `kdpndidik` int(3) NOT NULL,
  `noktp` varchar(25) NOT NULL,
  `nojamsos` varchar(25) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `id_bank` int(15) NOT NULL,
  `kdstatusk` int(3) NOT NULL,
  `kdstatusp` int(3) NOT NULL,
  `time_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nosimc` varchar(30) NOT NULL,
  `nosima` varchar(30) NOT NULL,
  `nokk` varchar(25) NOT NULL,
  `bpjskes` varchar(30) NOT NULL,
  `bpjstk` varchar(30) NOT NULL,
  `filefoto` varchar(100) NOT NULL,
  `filektp` varchar(100) NOT NULL,
  `filekk` varchar(100) NOT NULL,
  `fileijazah` varchar(100) NOT NULL,
  `filesima` varchar(100) NOT NULL,
  `filesimc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `tmpt_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat_jalan`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `tgl_masuk`, `id_bag`, `divisi`, `level_user`, `foto`, `tlpn`, `nohp`, `npwp`, `id_agm`, `kdpndidik`, `noktp`, `nojamsos`, `norek`, `id_bank`, `kdstatusk`, `kdstatusp`, `time_update`, `nosimc`, `nosima`, `nokk`, `bpjskes`, `bpjstk`, `filefoto`, `filektp`, `filekk`, `fileijazah`, `filesima`, `filesimc`) VALUES
(1, '18150', 'ARI ARIYANTO', 'BOGOR', '2000-04-04', 'L', 'Jl. Cilangkap', '005', '007', 'Cilangkap', 'Tapos', 'Depok', '16465', '2018-05-07', 'B006', 'OFFICE', 5, '/pega/assets/avatars/avatar5.png', '', '081389061742', '', 1, 3, '3276100404000002', '0', '1570006124581', 3, 1, 2, '2018-06-08 03:11:52', '1221170600432', '-', '3276102805140002', '-', '-', 'Penguins.jpg', '', '', '', '', ''),
(2, '12001', 'ERLAN SUTRAJAT', '', '0000-00-00', 'L', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:08:39', '', '', '', '', '', '', '', '', '', '', ''),
(3, '12003', 'RISKA ADRINI', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:09:14', '', '', '', '', '', '', '', '', '', '', ''),
(4, '12017', 'IRWAN SETIAWAN', 'JAKARTA', '1986-08-13', 'L', 'jalan almubarok III no 75', '007', '010', 'Cipulir', 'Kebayoran Lama', 'Jakarta Selatan', '12230', '2012-10-01', 'B011', '-- Divisi --', 5, '/pega/assets/avatars/avatar5.png', '', '085885778797', '54.293.089.6-013.000', 1, 4, '3174051308860011', '0', '9000011749182', 3, 2, 1, '2018-06-04 03:58:04', '860812054186', '1220170707438', '', '0001609066708', '14037497311', '', '', '', '', '', ''),
(5, '13049', 'AGNES EKA LESTIA', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:10:48', '', '', '', '', '', '', '', '', '', '', ''),
(6, '13057', 'TONI', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:11:05', '', '', '', '', '', '', '', '', '', '', ''),
(7, '13058', 'ACHMAD SYARIF', 'JAKARTA', '1978-11-15', 'L', 'jl.Jati pulo VI', '09', '05', 'jatipulo', 'palmerah', 'jakarta barat', '11430', '2013-01-10', 'B004', '', 5, '/pega/assets/avatars/avatar5.png', '', '081585167652', '87.201.214.1-031.000', 1, 4, '3173071511780009 ', '0', '1210005098631', 3, 2, 1, '2018-05-31 04:57:39', '-', '-', '3173070601093070', '0001800385424', '14037497063', '', '', '', '', '', ''),
(8, '14069', 'BADAR SURAWAN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:12:43', '', '', '', '', '', '', '', '', '', '', ''),
(9, '18149', 'DEA RACHMAYATI HANDIARTO', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:13:14', '', '', '', '', '', '', '', '', '', '', ''),
(10, '14090', 'RAHMANIA RAMADHANI', 'CIANJUR', '1996-02-05', 'P', 'Perum Gadung Permai Blok E/11', '003', '016', 'Bojong', 'Karangtengah', 'Cianjur', '43281', '2014-10-01', 'B004', '', 5, '/pega/assets/avatars/avatar5.png', '(000) 000-0000', '085771005674', '72.689.748.1-406.000', 1, 3, '3203074502960012', '0', '600077296888', 3, 1, 1, '2018-05-31 05:02:24', '-', '-', '3203073005070009', '0001609066743', '15000577062', '', '', '', '', '', ''),
(11, '14091', 'ETI FITRIANI', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:16:59', '', '', '', '', '', '', '', '', '', '', ''),
(12, '15095', 'BANGUN DWI PRASETYO', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:17:22', '', '', '', '', '', '', '', '', '', '', ''),
(13, '15097', 'FARHAN RAMADHAN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:20:12', '', '', '', '', '', '', '', '', '', '', ''),
(14, '15098', 'GALUH DEVI PARADHITA GAMEKA', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:21:17', '', '', '', '', '', '', '', '', '', '', ''),
(15, '15100', 'MUHAMMAD GILANG RAMADHAN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:23:37', '', '', '', '', '', '', '', '', '', '', ''),
(16, '15103', 'NUR MUFID', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:23:59', '', '', '', '', '', '', '', '', '', '', ''),
(17, '15107', 'ACHMAD AJIJUDIN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:24:26', '', '', '', '', '', '', '', '', '', '', ''),
(18, '15116', 'LUTHFIAN SYAUQI', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:24:59', '', '', '', '', '', '', '', '', '', '', ''),
(19, '15121', 'MUHAMMAD NAUFAL', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:25:34', '', '', '', '', '', '', '', '', '', '', ''),
(20, '16129', 'HALIM RACHMAN RIFALDI', 'JAKARTA', '1995-01-27', 'L', 'Kp. Kekupu', '02', '03', 'Rangkapan Jaya', 'Pancoran Mas', 'Depok', '16435', '2013-08-13', 'B011', '-- Divisi --', 5, '/pega/assets/avatars/avatar5.png', '(021) 778-8541', '08998176115', '66.010.755.8-412.000', 1, 3, '3276012701950003', '0', '1570005116075', 3, 2, 1, '2018-06-04 03:58:41', '950112210918', '', '3276010410160014', '', '14037497055', '', '', '', '', '', ''),
(21, '16130', 'MUADZ AZMI AMRULLAH', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:34:30', '', '', '', '', '', '', '', '', '', '', ''),
(22, '16132', 'JOSHUA ILHAM', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:34:59', '', '', '', '', '', '', '', '', '', '', ''),
(23, '17135', 'DOBIYANTO KRISNA SETIAWAN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:35:31', '', '', '', '', '', '', '', '', '', '', ''),
(24, '17137', 'MUHAMMAD AFIF AFDHOLUL MATIN', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:36:00', '', '', '', '', '', '', '', '', '', '', ''),
(25, '17139', 'RIZQI ADITAMA', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:36:19', '', '', '', '', '', '', '', '', '', '', ''),
(26, '17143', 'ADE SYAUQI M', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 06:36:51', '', '', '', '', '', '', '', '', '', '', ''),
(27, '17144', 'JAFAR SIDIX', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 08:21:34', '', '', '', '', '', '', '', '', '', '', ''),
(28, '18146', 'RIAN ANANG PRAKOSO', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 08:21:59', '', '', '', '', '', '', '', '', '', '', ''),
(29, '18147', 'BUDIMAN PRASETYO', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 08:22:24', '', '', '', '', '', '', '', '', '', '', ''),
(30, '18148', 'ARYA ERLANGGA', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 08:22:47', '', '', '', '', '', '', '', '', '', '', ''),
(31, '18151', 'RIZKI PRATAMA PUTRA', '', '0000-00-00', '', '', '', '', '', '', '', '', '0000-00-00', '-- J', '', 5, '/pega/assets/avatars/avatar5.png', '', '', '', 0, 0, '', '0', '', 0, 0, 0, '2018-05-30 08:23:04', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id_pelatihan` int(4) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `tgl_pelatihan` date NOT NULL,
  `topik_pelatihan` varchar(100) NOT NULL,
  `penyelenggara` text NOT NULL,
  `hasil_pelatihan` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `idp` int(4) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `t_pdk` varchar(20) NOT NULL,
  `d_pdk` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`idp`, `nip`, `t_pdk`, `d_pdk`) VALUES
(1, '1234', '2000 - 2006', 'SD Negeri 2 Palembang'),
(2, '1234', '2006 - 2007', 'SMP Negeri 3 Palembang'),
(3, '1234', '2007 - 2010', 'SMA 1 Negeri Palembang');

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman_kerja`
--

CREATE TABLE `pengalaman_kerja` (
  `id_peker` int(4) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nm_pekerjaan` varchar(50) NOT NULL,
  `d_pekerjaan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengalaman_kerja`
--

INSERT INTO `pengalaman_kerja` (`id_peker`, `nip`, `nm_pekerjaan`, `d_pekerjaan`) VALUES
(1, '1234', 'Freelance Networking ', 'Rancang bangun jaringan untuk warnet.'),
(2, '1234', 'Freelance Web Programmer', '- Merancang Aplikasi Berbasis Web untuk keperluan TA/Skripsi mahasiswa.\r\n- Merancang dan membangun website toko online, Personal, Akademik dan Company profile.\r\n'),
(5, 'admin', 'gvfdg', 'gdfg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `berita` text NOT NULL,
  `tipe` int(2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nip`, `berita`, `tipe`, `time`) VALUES
(39, '1235', 'test\r\n', 1, '2018-05-16 03:55:27'),
(40, '2558', 'hahahaha', 1, '2018-05-17 02:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `status_app`
--

CREATE TABLE `status_app` (
  `kd_approve` int(11) NOT NULL,
  `approve` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_app`
--

INSERT INTO `status_app` (`kd_approve`, `approve`) VALUES
(0, 'Pending'),
(1, 'Approved'),
(2, 'Bloked');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pesan`
--

CREATE TABLE `tabel_pesan` (
  `nomor` int(10) NOT NULL,
  `waktu` datetime NOT NULL,
  `dari` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `attachments` varchar(100) NOT NULL,
  `sudahbaca` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_pesan`
--

INSERT INTO `tabel_pesan` (`nomor`, `waktu`, `dari`, `kepada`, `subject`, `pesan`, `attachments`, `sudahbaca`) VALUES
(1, '2014-12-01 06:55:00', 'wahyu', '1', 'tes', 'ketika setan berteman', '', 'N'),
(2, '2014-12-01 06:56:00', 'wahyu', '1', 'Hai Kapan Kembali', 'Hai Kapan Kembali', '', 'N'),
(3, '2014-12-01 06:43:00', 'wahyu', '1', 'Admin nih ada yg eror', 'Admin nih ada yg eror', '', 'N'),
(4, '2014-12-01 06:56:00', 'siska', '2', 'Hai Kapan Kembali', 'Hai Kapan Kembali', '', 'N'),
(5, '2014-12-01 06:43:00', 'admin', '2', 'Andez nih link nya', 'Andez nih link nya', '', 'N'),
(6, '2014-12-01 06:43:00', 'portgastea', '1', 'Ni Bagaimana Admin kok eror', 'Ni Bagaimana Admin kok eror', '', 'N'),
(7, '2014-12-01 06:43:00', 'rohmah', '1', 'ni bagaimana ya eror mulu', 'ni bagaimana ya eror mulu', '', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absen`
--

CREATE TABLE `tbl_absen` (
  `id_abs` int(11) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `transport` varchar(15) NOT NULL,
  `uang_shift` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_absen`
--

INSERT INTO `tbl_absen` (`id_abs`, `shift`, `jam_masuk`, `jam_pulang`, `transport`, `uang_shift`) VALUES
(8, 'Shift 1', '08:00:00', '17:00:00', '0', '0'),
(9, 'Shift 2', '08:30:00', '17:30:00', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `id_agm` int(3) NOT NULL,
  `nmagama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agama`
--

INSERT INTO `tbl_agama` (`id_agm`, `nmagama`) VALUES
(1, 'Islam'),
(2, 'Khatolik'),
(3, 'Kristen Protestan'),
(4, 'Hindu'),
(5, 'Budha'),
(6, 'Konghucu'),
(7, 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(3) NOT NULL,
  `nm_bank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nm_bank`) VALUES
(1, 'BCA'),
(2, 'BRI'),
(3, 'MANDIRI'),
(4, 'CIMB'),
(6, 'BNI'),
(7, 'CIMB NIAGA'),
(8, 'PERMATA BANK'),
(9, 'MANDIRI SYARIAH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti`
--

CREATE TABLE `tbl_cuti` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `cuti_sebelum` varchar(20) NOT NULL,
  `cuti_sekarang` varchar(20) NOT NULL,
  `total_cuti` varchar(20) NOT NULL,
  `cuti_dipakai` varchar(20) NOT NULL,
  `sisa_cuti` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cuti`
--

INSERT INTO `tbl_cuti` (`id`, `nik`, `cuti_sebelum`, `cuti_sekarang`, `total_cuti`, `cuti_dipakai`, `sisa_cuti`) VALUES
(1, '18150', '0', '12', '12', '2', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email`
--

CREATE TABLE `tbl_email` (
  `id_email` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nm_email` varchar(50) NOT NULL,
  `domain` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_email`
--

INSERT INTO `tbl_email` (`id_email`, `nik`, `nm_email`, `domain`) VALUES
(1, '1235', 'hr', '@lrcom.co.id'),
(2, '18150', 'ari.yanto', '@lrcom.co.id'),
(3, '18151', 'rizky.pratama', '@lrcom.co.id'),
(4, '13058', 'achmad.syarif', '@lrcom.co.id'),
(5, '18149', 'dea.handiarto', '@lrcom.co.id'),
(6, '17143', 'ade.syauki', '@lrcom.co.id'),
(7, '13049', 'agnes.eka', '@lrcom.co.id'),
(8, '15107', 'ahmad.ajijudin', '@lrcom.co.id'),
(10, '18148', 'aryaerlangga', '@lrcom.co.id'),
(11, '15095', 'bangun.prasetyo', '@lrcom.co.id'),
(12, '18147', 'budimanp24', '@lrcom.co.id'),
(14, '17144', 'jaffarsdk', '@lrcom.co.id'),
(15, '17135', 'dobi', '@lrcom.co.id'),
(16, '12001', 'erlan.sutrajat', '@lrcom.co.id'),
(17, '14091', 'eti.fitriani', '@lrcom.co.id'),
(18, '15097', 'farhanr', '@lrcom.co.id'),
(19, '15908', 'galuh.devi', '@lrcom.co.id'),
(20, '16129', 'halim.rachman', '@lrcom.co.id'),
(21, '12017', 'irwan.setiawan', '@lrcom.co.id'),
(22, '16132', 'joshuailham', '@lrcom.co.id'),
(23, '15116', 'luthfian.syauqi', '@lrcom.co.id'),
(24, '15100', 'mgilang', '@lrcom.co.id'),
(25, '16130', 'muadzazmi', '@lrcom.co.id'),
(26, '17137', 'muhammad.afif', '@lrcom.co.id'),
(27, '15121', 'muhammad.naufal', '@lrcom.co.id'),
(28, '15103', 'nmufid', '@lrcom.co.id'),
(29, '14090', 'rahmania.ramadhani', '@lrcom.co.id'),
(30, '18146', 'rian.anang', '@lrcom.co.id'),
(31, '12003', 'riskaadrini', '@lrcom.co.id'),
(32, '17139', 'rizqy.aditama', '@lrcom.co.id'),
(33, '13057', 'toni', '@lrcom.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendidikan`
--

CREATE TABLE `tbl_pendidikan` (
  `kdpndidik` int(3) NOT NULL,
  `nmpndidik` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendidikan`
--

INSERT INTO `tbl_pendidikan` (`kdpndidik`, `nmpndidik`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA/SMK/MA'),
(4, 'D3'),
(5, 'S1'),
(6, 'S2'),
(7, 'D1'),
(8, 'D2'),
(9, 'S2'),
(10, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peng`
--

CREATE TABLE `tbl_peng` (
  `id_pes` int(2) NOT NULL,
  `pesan` text NOT NULL,
  `tgl_pesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_peng`
--

INSERT INTO `tbl_peng` (`id_pes`, `pesan`, `tgl_pesan`) VALUES
(2, 'Bagi Para Staff IT di mohon kehadirannya dirapat besok. Terima kasih.\r\n\r\nSTAFF HRD', '2014-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pkl`
--

CREATE TABLE `tbl_pkl` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `nohp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pkl`
--

INSERT INTO `tbl_pkl` (`id`, `nik`, `nama`, `jabatan`, `divisi`, `nohp`) VALUES
(1, '18973', 'ari', 'B011', 'PKL', '081389061742'),
(3, '19837', 'rizky', 'B011', 'PKL', '083467389937');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sosialmedia`
--

CREATE TABLE `tbl_sosialmedia` (
  `id_sm` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `web` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google+` varchar(100) NOT NULL,
  `patch` varchar(100) NOT NULL,
  `pinbb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sosialmedia`
--

INSERT INTO `tbl_sosialmedia` (`id_sm`, `nip`, `web`, `facebook`, `twitter`, `google+`, `patch`, `pinbb`) VALUES
(0, '1235', 'www.andeznet.com', 'http://facebook.com/andeztea', 'http://twitter.com/portgastea', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statusk`
--

CREATE TABLE `tbl_statusk` (
  `kdstatusk` int(3) NOT NULL,
  `nmstatusk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_statusk`
--

INSERT INTO `tbl_statusk` (`kdstatusk`, `nmstatusk`) VALUES
(1, 'Lajang'),
(2, 'Menikah'),
(3, 'Duda'),
(4, 'Janda');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statusp`
--

CREATE TABLE `tbl_statusp` (
  `kdstatusp` int(3) NOT NULL DEFAULT '0',
  `nmstatusp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_statusp`
--

INSERT INTO `tbl_statusp` (`kdstatusp`, `nmstatusp`) VALUES
(1, 'Tetap'),
(2, 'Kontrak'),
(3, 'Magang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `level_user` int(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nip` varchar(5) NOT NULL,
  `status` int(5) NOT NULL,
  `w_login` datetime NOT NULL,
  `w_daftar` datetime NOT NULL,
  `photo` varchar(100) NOT NULL,
  `kd_approve` int(3) NOT NULL,
  `aboutme` text NOT NULL,
  `web` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google+` varchar(100) NOT NULL,
  `patch` varchar(100) NOT NULL,
  `pinbb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `pass`, `level_user`, `email`, `nip`, `status`, `w_login`, `w_daftar`, `photo`, `kd_approve`, `aboutme`, `web`, `facebook`, `twitter`, `google+`, `patch`, `pinbb`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'hr@lrcom.co.id', '1235', 1, '2018-07-27 08:47:24', '2018-05-07 00:00:00', '/pega/assets/avatars/avatar.png\r\n', 1, '', '', '', '', '', '', ''),
(15, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 5, 'ari.yanto@lrcom.co.id', '18150', 1, '2018-06-28 16:13:18', '2018-05-24 14:17:03', '/pega/assets/avatars/avatar5.png', 1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_wo`
--

CREATE TABLE `tbl_user_wo` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` enum('Super Admin','Admin WO','Admin Finance','Admin') NOT NULL,
  `w_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_wo`
--

INSERT INTO `tbl_user_wo` (`id`, `username`, `password`, `nama`, `level`, `w_login`) VALUES
(1, 'super', '1b3231655cebb7a1f783eddf27d254ca', 'Super Admin', 'Super Admin', '2018-07-30 11:02:36'),
(3, 'finance', '57336afd1f4b40dfd9f5731e35302fe5', 'Finance', 'Admin Finance', '2018-07-30 10:41:42');

-- --------------------------------------------------------

--
-- Stand-in structure for view `umur_p`
--
CREATE TABLE `umur_p` (
`nip` varchar(10)
,`nama` varchar(40)
,`tgl_lahir` date
,`t_lahir` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_lv` int(50) NOT NULL,
  `n_lv` varchar(50) NOT NULL,
  `level_user` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_lv`, `n_lv`, `level_user`) VALUES
(1, 'Admin', 1),
(2, 'Admin Pegawai', 2),
(3, 'Admin Absen', 3),
(4, 'Admin Payrol', 4),
(5, 'User', 5);

-- --------------------------------------------------------

--
-- Structure for view `m_kerja`
--
DROP TABLE IF EXISTS `m_kerja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `m_kerja`  AS  select `pegawai`.`nip` AS `nip`,`pegawai`.`nama` AS `nama`,`pegawai`.`tgl_masuk` AS `tgl_masuk`,(year(curdate()) - year(`pegawai`.`tgl_masuk`)) AS `t_mk` from `pegawai` order by (year(curdate()) - year(`pegawai`.`tgl_masuk`)) desc ;

-- --------------------------------------------------------

--
-- Structure for view `umur_p`
--
DROP TABLE IF EXISTS `umur_p`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `umur_p`  AS  select `pegawai`.`nip` AS `nip`,`pegawai`.`nama` AS `nama`,`pegawai`.`tgl_lahir` AS `tgl_lahir`,(year(curdate()) - year(`pegawai`.`tgl_lahir`)) AS `t_lahir` from `pegawai` order by (year(curdate()) - year(`pegawai`.`tgl_lahir`)) desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bag`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_gaji`
--
ALTER TABLE `daftar_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_project`
--
ALTER TABLE `d_project`
  ADD PRIMARY KEY (`id_p`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_jabatan`
--
ALTER TABLE `h_jabatan`
  ADD PRIMARY KEY (`idh`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jab`);

--
-- Indexes for table `k_jabatan`
--
ALTER TABLE `k_jabatan`
  ADD PRIMARY KEY (`idkjb`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`idp`);

--
-- Indexes for table `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  ADD PRIMARY KEY (`id_peker`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_app`
--
ALTER TABLE `status_app`
  ADD PRIMARY KEY (`kd_approve`);

--
-- Indexes for table `tabel_pesan`
--
ALTER TABLE `tabel_pesan`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `tbl_absen`
--
ALTER TABLE `tbl_absen`
  ADD PRIMARY KEY (`id_abs`);

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`id_agm`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email`
--
ALTER TABLE `tbl_email`
  ADD PRIMARY KEY (`id_email`);

--
-- Indexes for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  ADD PRIMARY KEY (`kdpndidik`);

--
-- Indexes for table `tbl_peng`
--
ALTER TABLE `tbl_peng`
  ADD PRIMARY KEY (`id_pes`);

--
-- Indexes for table `tbl_pkl`
--
ALTER TABLE `tbl_pkl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sosialmedia`
--
ALTER TABLE `tbl_sosialmedia`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indexes for table `tbl_statusk`
--
ALTER TABLE `tbl_statusk`
  ADD PRIMARY KEY (`kdstatusk`);

--
-- Indexes for table `tbl_statusp`
--
ALTER TABLE `tbl_statusp`
  ADD PRIMARY KEY (`kdstatusp`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_user_wo`
--
ALTER TABLE `tbl_user_wo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_lv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bag` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `daftar_gaji`
--
ALTER TABLE `daftar_gaji`
  MODIFY `id_gaji` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `d_project`
--
ALTER TABLE `d_project`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `h_jabatan`
--
ALTER TABLE `h_jabatan`
  MODIFY `idh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id_pelatihan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `idp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  MODIFY `id_peker` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `status_app`
--
ALTER TABLE `status_app`
  MODIFY `kd_approve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tabel_pesan`
--
ALTER TABLE `tabel_pesan`
  MODIFY `nomor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_absen`
--
ALTER TABLE `tbl_absen`
  MODIFY `id_abs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  MODIFY `id_agm` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_cuti`
--
ALTER TABLE `tbl_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_email`
--
ALTER TABLE `tbl_email`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  MODIFY `kdpndidik` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_peng`
--
ALTER TABLE `tbl_peng`
  MODIFY `id_pes` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_pkl`
--
ALTER TABLE `tbl_pkl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_statusk`
--
ALTER TABLE `tbl_statusk`
  MODIFY `kdstatusk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_user_wo`
--
ALTER TABLE `tbl_user_wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no_lv` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
