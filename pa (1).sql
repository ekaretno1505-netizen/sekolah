-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 06:41 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nis` varchar(15) NOT NULL,
  `ket` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absensi`, `id_jadwal`, `tanggal`, `nis`, `ket`) VALUES
(13, 4, '2021-05-20', '2021010', 'H'),
(14, 4, '2021-05-20', 'ASDK', 'H'),
(15, 4, '2021-05-20', '123', 'H'),
(16, 4, '2021-05-20', '20210011', 'S'),
(17, 5, '2021-05-21', '2021001', 'H'),
(18, 5, '2021-05-21', '2021002', 'H'),
(19, 5, '2021-05-21', '2021003', 'H'),
(20, 5, '2021-05-21', '2021004', 'H'),
(21, 5, '2021-05-21', '2021006', 'H'),
(22, 5, '2021-05-21', '2021007', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `kode_guru` varchar(11) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `kode_guru`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`) VALUES
(1, '100001', 'KEKE', 'KG_001', 'PEREMPUAN', 'TENGGARONG', '1996-10-22', 'JL. SAI', 'ISLAM'),
(2, '100002', 'MAMAN', 'KG_002', 'LAKI-LAKI', 'JOGJA', '1993-06-08', 'JL. KAMBOJA', 'ISLAM'),
(3, '100003', 'SUNIEM', 'KG_003', 'PEREMPUAN', 'JAKARTA', '1997-03-05', 'JL AYOO', 'ISLAM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_mengajar` int(11) NOT NULL,
  `hari` varchar(25) NOT NULL,
  `jam_mulai` varchar(25) NOT NULL,
  `jam_berakhir` varchar(25) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `id_mengajar`, `hari`, `jam_mulai`, `jam_berakhir`, `id_kelas`) VALUES
(2, 1, 'Selasa', '08:00', '09:00', 1),
(3, 2, 'Kamis', '08:00', '09:30', 2),
(4, 3, 'Kamis', '08:00', '09:00', 1),
(5, 3, 'Jumat', '08:00', '09:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(10) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X ADM'),
(2, 'X RPL');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL,
  `kode_mapel` varchar(6) NOT NULL,
  `mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `kode_mapel`, `mapel`) VALUES
(1, 'KM_001', 'BAHASA INDONESIA'),
(2, 'KM_002', 'OLAHRAGA'),
(3, 'KM_003', 'AGAMA ISLAM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `id_mengajar` int(11) NOT NULL,
  `kode_guru` varchar(15) NOT NULL,
  `kode_mapel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`id_mengajar`, `kode_guru`, `kode_mapel`) VALUES
(1, 'KG_001', 'KM_001'),
(2, 'KG_002', 'KM_002'),
(3, 'KG_003', 'KM_003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(10) NOT NULL,
  `username` varchar(99) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `username`, `password`, `status`) VALUES
(1, 'admin', '$2y$10$nWvQe91f0jo3UUAOlBIaY.CSnjoYG4ydyDhGqBBJVBOwwDxagvpIi', 'Admin'),
(3, '100001', '$2y$10$.B.ABKWtU6evCZo88r9iZeAGF5jXA4jAyj6o3pBzKUuXbk1xoIHIu', 'Guru'),
(4, 'tatausaha', '$2y$10$oIXMfyfVgTpIvxU5.WPJbuc9H2IrfB/iAT0/mW1qosPWfAH2CPe5e', 'TU'),
(5, '100002', '$2y$10$nKpXvIE5sXzGLU/8EmKaZuo5sgRpcG15NeTZhvIB6bD/EtDT1dMnG', 'Guru'),
(6, '100003', '$2y$10$3cKviBg2cLIn0v8OEtvASu6PRwIcSwEyL0p3hCBirPBWLaZlvrF4S', 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `no_ortu` varchar(15) NOT NULL,
  `biaya` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `agama`, `nama_ortu`, `no_ortu`, `biaya`, `id_kelas`) VALUES
(1, '2021001', 'JAMET', 'LAKI-LAKI', 'SAMARINDA', '2021-05-11', 'JL. KUY', 'ISLAM', 'JAMALUDIN', '082133243241', 0, 2),
(2, '2021002', 'LINDA', 'PEREMPUAN', 'SAMARINDA', '2021-05-03', 'JL. SAJA', 'ISLAM', 'JEJE', '082347281912', 0, 2),
(3, '2021003', 'DINO', 'LAKI-LAKI', 'SAMARINDA', '2005-12-12', 'JL. LOA IPY', 'ISLAM', 'SAURU', '081237122382', 0, 2),
(4, '2021004', 'JANU', 'PEREMPUAN', 'SAMARINDA', '2021-05-03', 'JL. NIH', 'ISLAM', 'KANE', '081273261237', 0, 2),
(6, '2021006', 'WAKNS', 'LAKI-LAKI', 'SNDSD', '0000-00-00', 'JL AYOO', 'ISLAM', 'SADNAK', '1493249', 0, 2),
(7, '2021010', 'SESAH', 'PEREMPUAN', 'TENGGARONG', '2005-07-22', 'JL. NAH', 'ISLAM', 'MEMEN', '08342124142', 0, 1),
(8, 'ASDK', 'WDNAJSDN', 'LAKI-LAKI', 'JKANDSAD', '0000-00-00', 'JL. SAJA', 'ASDNA', 'JEJE', '1493249', 0, 1),
(9, '123', 'AHSNDA', 'PEREMPUAN', 'ADSJIJ', '2021-05-18', 'JL. SAJA', 'SDNF DS', 'SJFDBJSBD', '1493249', 0, 1),
(13, '2021007', 'RAMA', 'LAKI-LAKI', 'SAMARINDA', '2005-10-11', 'JL. SAJA', 'KRISTEN', 'KANE', '0877762617', 150000, 2),
(14, '20210011', 'KDWMK', 'PEREMPUAN', 'QWEQW', '2021-05-07', 'JL. SAJA', 'ISLAM', 'WE23', '0877762617', 150000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jatuhtempo` date NOT NULL,
  `tglbayar` date DEFAULT NULL,
  `bulan` varchar(25) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `id_siswa`, `jatuhtempo`, `tglbayar`, `bulan`, `jumlah`, `ket`, `id_pengguna`) VALUES
(19, 13, '2021-05-11', '2021-05-20', 'Mei 2021', 150000, 'LUNAS', 4),
(20, 13, '2021-06-11', '2021-05-20', 'Juni 2021', 150000, 'LUNAS', 4),
(21, 13, '2021-07-11', '2021-05-20', 'Juli 2021', 150000, 'LUNAS', 4),
(22, 13, '2021-08-11', '2021-05-20', 'Agustus 2021', 150000, 'LUNAS', 4),
(23, 13, '2021-09-11', '2021-05-20', 'September 2021', 150000, 'LUNAS', 4),
(24, 13, '2021-10-11', NULL, 'Oktober 2021', 150000, 'Belum Bayar', 0),
(25, 14, '2021-05-21', NULL, 'Mei 2021', 150000, 'Belum Bayar', 0),
(26, 14, '2021-06-21', NULL, 'Juni 2021', 150000, 'Belum Bayar', 0),
(27, 14, '2021-07-21', NULL, 'Juli 2021', 150000, 'Belum Bayar', 0),
(28, 14, '2021-08-21', NULL, 'Agustus 2021', 150000, 'Belum Bayar', 0),
(29, 14, '2021-09-21', NULL, 'September 2021', 150000, 'Belum Bayar', 0),
(30, 14, '2021-10-21', NULL, 'Oktober 2021', 150000, 'Belum Bayar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_walkel`
--

CREATE TABLE `tb_walkel` (
  `id_walkel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kode_guru` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_walkel`
--

INSERT INTO `tb_walkel` (`id_walkel`, `id_kelas`, `kode_guru`) VALUES
(1, 1, 'KG_002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `kode_guru` (`kode_guru`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_mengajar` (`id_mengajar`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`id_mengajar`),
  ADD KEY `kode_guru` (`kode_guru`,`kode_mapel`),
  ADD KEY `kode_mapel` (`kode_mapel`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`),
  ADD KEY `id_siswa` (`id_siswa`,`id_pengguna`);

--
-- Indexes for table `tb_walkel`
--
ALTER TABLE `tb_walkel`
  ADD PRIMARY KEY (`id_walkel`),
  ADD KEY `id_kelas` (`id_kelas`,`kode_guru`),
  ADD KEY `kode_guru` (`kode_guru`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `id_mengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_spp`
--
ALTER TABLE `tb_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_walkel`
--
ALTER TABLE `tb_walkel`
  MODIFY `id_walkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`id_mengajar`) REFERENCES `tb_mengajar` (`id_mengajar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD CONSTRAINT `tb_mengajar_ibfk_1` FOREIGN KEY (`kode_mapel`) REFERENCES `tb_mapel` (`kode_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_mengajar_ibfk_2` FOREIGN KEY (`kode_guru`) REFERENCES `tb_guru` (`kode_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD CONSTRAINT `tb_spp_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_walkel`
--
ALTER TABLE `tb_walkel`
  ADD CONSTRAINT `tb_walkel_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_walkel_ibfk_2` FOREIGN KEY (`kode_guru`) REFERENCES `tb_guru` (`kode_guru`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
