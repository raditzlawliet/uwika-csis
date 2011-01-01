-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2010 at 03:55 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_password`
--

CREATE TABLE IF NOT EXISTS `tb_password` (
  `nrp` varchar(11) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_password`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_mata_kuliah_dosen`
--

CREATE TABLE IF NOT EXISTS `tr_mata_kuliah_dosen` (
  `kode_mata_kuliah` varchar(11) NOT NULL,
  `nrp` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_mata_kuliah_dosen`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_mata_kuliah_jurusan`
--

CREATE TABLE IF NOT EXISTS `tr_mata_kuliah_jurusan` (
  `kode_mata_kuliah` varchar(11) NOT NULL,
  `kode_jurusan` varchar(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_mata_kuliah_jurusan`
--


-- --------------------------------------------------------

--
-- Table structure for table `tr_mata_kuliah_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `tr_mata_kuliah_mahasiswa` (
  `kode_mata_kuliah` varchar(11) NOT NULL,
  `nrp` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_mata_kuliah_mahasiswa`
--

INSERT INTO `tr_mata_kuliah_mahasiswa` (`kode_mata_kuliah`, `nrp`) VALUES
('T00001', '31109036'),
('E00001', '61109001'),
('U00001', '31109036'),
('U00001', '61109001');

-- --------------------------------------------------------

--
-- Table structure for table `tr_mata_kuliah_syarat`
--

CREATE TABLE IF NOT EXISTS `tr_mata_kuliah_syarat` (
  `kode_mata_kuliah` varchar(11) NOT NULL,
  `kode_mata_kuliah_syarat` varchar(11) NOT NULL,
  `kode_syarat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_mata_kuliah_syarat`
--

INSERT INTO `tr_mata_kuliah_syarat` (`kode_mata_kuliah`, `kode_mata_kuliah_syarat`, `kode_syarat`) VALUES
('T00001', 'T00002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_dosen`
--

CREATE TABLE IF NOT EXISTS `t_dosen` (
  `nrp` varchar(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `kode_jurusan_prioritas` varchar(11) NOT NULL,
  `uid` varchar(64) NOT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_dosen`
--

INSERT INTO `t_dosen` (`nrp`, `password`, `nama`, `jenis_kelamin`, `kode_jurusan_prioritas`, `uid`) VALUES
('15131106001', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Dosen Sukiyem', 'Laki - Laki', '311', '4141415'),
('15161106001', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Dosen Makiyem', 'Perempuan', '611', '123334');

-- --------------------------------------------------------

--
-- Table structure for table `t_fakultas`
--

CREATE TABLE IF NOT EXISTS `t_fakultas` (
  `kode_fakultas` varchar(4) NOT NULL,
  `nama_fakultas` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_fakultas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_fakultas`
--

INSERT INTO `t_fakultas` (`kode_fakultas`, `nama_fakultas`) VALUES
('FE', 'Fakultas Ekonomi'),
('FT', 'Fakultas Teknik'),
('FIB', 'Fakultas Ilmu Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `t_jurusan`
--

CREATE TABLE IF NOT EXISTS `t_jurusan` (
  `kode_jurusan` varchar(11) NOT NULL,
  `nama_jurusan` varchar(35) NOT NULL,
  `kode_fakultas` varchar(4) NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_jurusan`
--

INSERT INTO `t_jurusan` (`kode_jurusan`, `nama_jurusan`, `kode_fakultas`) VALUES
('311', 'Teknik Informatika', 'FT'),
('611', 'Managemen', 'FE');

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE IF NOT EXISTS `t_karyawan` (
  `nrp` varchar(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `uid` varchar(64) NOT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`nrp`, `password`, `nama`, `jenis_kelamin`, `uid`) VALUES
('50100006001', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Karyawan Coy', 'Laki - Laki', 'fcvvasdw');

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `t_mahasiswa` (
  `nrp` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `asal_sekolah` varchar(50) DEFAULT NULL,
  `kode_jurusan` varchar(11) NOT NULL,
  `uid` varchar(64) NOT NULL,
  PRIMARY KEY (`nrp`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_mahasiswa`
--

INSERT INTO `t_mahasiswa` (`nrp`, `password`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `asal_sekolah`, `kode_jurusan`, `uid`) VALUES
('31109036', '5433360fc17cbedefa50b5802da3212357b00b9e', 'Radityo Hernanda.', 'Laki - Laki', '2010-11-25', NULL, NULL, '311', 'eb11e576c743b2c44a725dac99a8c969'),
('61109001', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Nonsense', '', NULL, NULL, NULL, '611', '0124'),
('31109000', 'df2cd7104536553afde9f7d66133d578eccb4606', 'Unknow', '', NULL, NULL, NULL, '0', '222'),
('31109001', 'df2cd7104536553afde9f7d66133d578eccb4606', 'aaaaaaaaaaaaaa', '', NULL, NULL, NULL, '0', '0424'),
('31109032', 'df2cd7104536553afde9f7d66133d578eccb4606', '2323', '', NULL, NULL, NULL, '0', '011');

-- --------------------------------------------------------

--
-- Table structure for table `t_mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `t_mata_kuliah` (
  `kode_mata_kuliah` varchar(11) NOT NULL,
  `nama_mata_kuliah` varchar(50) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `probis` tinyint(1) NOT NULL,
  `hari` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  PRIMARY KEY (`kode_mata_kuliah`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_mata_kuliah`
--

INSERT INTO `t_mata_kuliah` (`kode_mata_kuliah`, `nama_mata_kuliah`, `jumlah_sks`, `probis`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
('T00001', 'Algoritma Pemrogaman I', 3, 0, 3, '08:00:00', '10:30:00'),
('E00001', 'Mikro Managemen', 3, 0, 2, '09:00:00', '09:50:00'),
('U00001', 'Kewarganegaraan', 3, 0, 5, '08:00:00', '10:30:00'),
('T00002', 'Algoritma Pemrogaman II', 3, 0, 4, '09:00:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_ruang`
--

CREATE TABLE IF NOT EXISTS `t_ruang` (
  `kode_ruang` varchar(11) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `lt_ruang` int(11) NOT NULL,
  `letak_ruang` text NOT NULL,
  `jumlah_kuota` int(11) NOT NULL,
  PRIMARY KEY (`kode_ruang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ruang`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
