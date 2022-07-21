-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 02:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `requestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kerja`
--

CREATE TABLE `pengajuan_kerja` (
  `id_pengajuan` varchar(255) NOT NULL,
  `no_employee` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `aktivitas_pekerjaan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `penanggung_jwb` varchar(255) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `tgl_rencana_selesai` date NOT NULL,
  `tgl_actual` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(255) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_employee` varchar(50) NOT NULL,
  `role_id` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `thn_masuk` varchar(255) NOT NULL,
  `thn_hbs_kontrak` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_employee`, `role_id`, `password`, `nama`, `email`, `dept`, `jabatan`, `thn_masuk`, `thn_hbs_kontrak`, `status`) VALUES
('farur', 1234, '', '', '', '', '', '', '', ''),
('zaky', 1234, '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengajuan_kerja`
--
ALTER TABLE `pengajuan_kerja`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD UNIQUE KEY `no_employee` (`no_employee`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_employee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
