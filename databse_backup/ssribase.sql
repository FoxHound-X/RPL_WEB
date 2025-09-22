-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2025 at 09:10 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssribase`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tgl_absensi` date NOT NULL,
  `keterangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `almat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `tgl_lahir`, `almat`, `telp`, `username`, `password`) VALUES
(9, 'Budi Anantha', '2006-02-17', 'Jalan budi utomo no23', '09091289384', 'Adminuser', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int NOT NULL,
  `id_guru` int NOT NULL,
  `tgl_mengajar` date NOT NULL,
  `id_kelas` int NOT NULL,
  `materi` varchar(100) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `singkatan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `singkatan`) VALUES
(2, 'Rekayasa Perangkat Lunak', 'RPL'),
(5, 'Desain Komunikasi Visual', 'DKV');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `id_guru` int NOT NULL,
  `id_jurusan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_guru`, `id_jurusan`) VALUES
(2, 'X PPLG ', 9, 2),
(3, 'X DKV1', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mpk`
--

CREATE TABLE `mpk` (
  `id_mpk` int NOT NULL,
  `id_siswa` int NOT NULL,
  `id_kelas` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `tgl_lahir`, `alamat`, `telp`, `username`, `password`) VALUES
(4, 'Kadek Setia Dharma', '2002-09-10', 'JL Pratu made rambug, GGtunjung 2 nomr 2', '090909090', 'setia', '7bfe28a587e8fc1b5ad4b2aaba710bf5'),
(5, 'Axcela', '1998-03-12', '', '93893948029', 'Axcel', 'axcela123'),
(6, 'Andini Putri', '2025-09-18', 'Denpasar', '87328437', 'admin', 'admin'),
(7, 'SETIA', '2025-09-22', 'hajfhjwesjtfbejw', '8237487328', 'setia', 'setia2009');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `bulan` int NOT NULL,
  `nominal` int NOT NULL,
  `metode` varchar(10) NOT NULL,
  `id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `no_absen` int NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(14) NOT NULL,
  `nis` int NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `no_absen`, `tgl_lahir`, `alamat`, `telp`, `nis`, `nisn`, `id_kelas`) VALUES
(4, 'Prima Jaya jaya', 10, '2025-09-22', 'jaufjewtgjjw', '72375478295478', 2935487, '13423', 2),
(5, 'Prima Abadi', 61, '2025-09-22', 'Jl.Kehidupan', '9486985496', 1231323, '5001', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `mpk`
--
ALTER TABLE `mpk`
  ADD PRIMARY KEY (`id_mpk`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mpk`
--
ALTER TABLE `mpk`
  MODIFY `id_mpk` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mpk`
--
ALTER TABLE `mpk`
  ADD CONSTRAINT `mpk_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mpk_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
