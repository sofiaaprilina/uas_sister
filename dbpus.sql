-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 05:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nm_admin` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `nm_admin`, `username`, `password`) VALUES
(1, 'Admin', 'jwd', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbanggota`
--

CREATE TABLE `tbanggota` (
  `idanggota` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(30) CHARACTER SET latin1 NOT NULL,
  `jeniskelamin` varchar(10) CHARACTER SET latin1 NOT NULL,
  `alamat` varchar(40) CHARACTER SET latin1 NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 NOT NULL,
  `foto` varchar(35) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbanggota`
--

INSERT INTO `tbanggota` (`idanggota`, `nama`, `jeniskelamin`, `alamat`, `status`, `foto`) VALUES
('AG001', 'Riki Subekti', 'Pria', 'Jl. Semangka No. 3', 'Tidak Meminjam', '-'),
('AG002', 'Aini Rahmawati', 'Wanita', 'Jl. Anggrek No 45', 'Tidak Meminjam', '-'),
('AG003', 'Rudi Dermawan', 'Pria', 'Jl. Kalianggis No.98 Jakarta Utara', 'Tidak Meminjam', 'AG003.png'),
('AG004', 'Dino Riano', 'Pria', 'Jl. Melon No 33', 'Tidak Meminjam', '-'),
('AG005', 'Agus Wardoyo', 'Pria', 'Jl. Cempedak No 88', 'Tidak Meminjam', '-'),
('AG006', 'Shinta Riani', 'Wanita', 'Jl. Jeruk No 1', 'Tidak Meminjam', '-'),
('AG007', 'M. Ilham', 'Pria', 'Jl. Margo No 23', 'Tidak Meminjam', '-'),
('AG008', 'Moh Yuda', 'Pria', 'Jl. Tanjung Enim No.5', 'Tidak Meminjam', 'AG008.png'),
('AG009', 'Sabilla Andini', 'Wanita', 'Jl. Basuki No. 20', 'Tidak Meminjam', '-'),
('AG010', 'Muthia Al Faradisah', 'Wanita', 'Jl. Agus Salim No. 8A', 'Tidak Meminjam', '-'),
('AG011', 'Santika', 'Wanita', 'Jl. Bandung No 12', 'Tidak Meminjam', 'AG011.png'),
('AG012', 'Hadi Basuki', 'Pria', 'Jl. Sisir No. 6 ', 'Tidak Meminjam', '-'),
('AG013', 'Mustika Rani', 'Wanita', 'Jl Teluk Bayur No. 105', 'Tidak Meminjam', 'AG013.png'),
('AG014', 'Yusuf M.', 'Pria', 'Jl. Tangkuban Perahu No. 7', 'Tidak Meminjam', '-'),
('AG015', 'Choi Soobin', 'Pria', 'Jl. Bighit No. 512', 'Tidak Meminjam', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbbuku`
--

CREATE TABLE `tbbuku` (
  `idbuku` varchar(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `kategori` int(11) NOT NULL,
  `pengarang` varchar(40) NOT NULL,
  `penerbit` varchar(40) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbbuku`
--

INSERT INTO `tbbuku` (`idbuku`, `judul`, `kategori`, `pengarang`, `penerbit`, `tahun`, `jumlah`, `cover`) VALUES
('B01', 'Bumi', 1, 'Tere Liye', 'Gramedia', 2012, 4, 'B01.jpg'),
('B02', 'Bulan', 1, 'Tere Liye', 'Gramedia', 2013, 2, 'B02.jpg'),
('B03', 'Matahari', 1, 'Tere Liye', 'Gramedia', 2013, 3, 'B03.jpg'),
('B04', 'Chairul Tanjung, Si Anak Singkong', 5, 'Chairul Tanjung', 'Gramedia', 2012, 2, 'B04.png'),
('B05', 'Kamus Inggris Indonesia', 1, 'John M. Echols', 'Gramedia', 1975, 8, 'B05.jpg'),
('B06', 'Detektif Conan Spesial vol.39', 2, 'Aoyama Gosho', 'Elex Media Komputindo', 2016, 1, 'B06.jpg'),
('B07', 'Detektif Conan Spesial vol.41', 2, 'Aoyama Gosho', 'Elex Media Komputindo', 2017, 2, 'B07.jpg'),
('B08', 'Ensiklopedia Sains', 3, 'Usborne', 'BIP', 2014, 3, 'B08.jpg'),
('B09', 'Rindu', 1, 'Tere Liye', 'Republika', 2014, 2, 'B09.jpg'),
('B10', 'Hujan Bulan Juni', 4, 'Sapardi Djoko Damono', 'Grasindo', 1994, 1, 'B10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `idkategori` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`idkategori`, `nama`) VALUES
(1, 'Novel'),
(2, 'Komik'),
(3, 'Ensiklopedia'),
(4, 'Kumpulan Puisi'),
(5, 'Biografi'),
(6, 'Kamus');

-- --------------------------------------------------------

--
-- Table structure for table `tbkembali`
--

CREATE TABLE `tbkembali` (
  `idkembali` varchar(5) NOT NULL,
  `idpinjam` varchar(5) NOT NULL,
  `idanggota` varchar(5) NOT NULL,
  `idbuku` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tglkembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkembali`
--

INSERT INTO `tbkembali` (`idkembali`, `idpinjam`, `idanggota`, `idbuku`, `jumlah`, `tglkembali`) VALUES
('K01', 'P01', 'AG002', 'B09', 1, '2021-07-08'),
('K02', 'P02', 'AG005', 'B07', 1, '2021-07-09'),
('K03', 'P03', 'AG006', 'B01', 1, '2021-07-12'),
('K04', 'P04', 'AG009', 'B01', 1, '2021-07-20'),
('K06', 'P06', 'AG013', 'B02', 1, '2021-08-05'),
('K07', 'P08', 'AG001', 'B05', 1, '2021-08-09'),
('K08', 'P07', 'AG004', 'B05', 1, '2021-09-11'),
('K09', 'P10', 'AG010', 'B03', 1, '2021-08-16'),
('K10', 'P09', 'AG011', 'B04', 1, '2021-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbpinjam`
--

CREATE TABLE `tbpinjam` (
  `idpinjam` varchar(5) NOT NULL,
  `idanggota` varchar(5) NOT NULL,
  `idbuku` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tglpinjam` date NOT NULL,
  `tglkembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpinjam`
--

INSERT INTO `tbpinjam` (`idpinjam`, `idanggota`, `idbuku`, `jumlah`, `tglpinjam`, `tglkembali`) VALUES
('P11', 'AG015', 'B08', 1, '2021-08-27', '2021-09-03'),
('P12', 'AG003', 'B05', 1, '2021-08-27', '2021-09-03'),
('P13', 'AG014', 'B07', 1, '2021-09-01', '2021-09-08'),
('P14', 'AG007', 'B06', 1, '2021-09-01', '2021-09-08'),
('P15', 'AG002', 'B03', 1, '2021-09-01', '2021-09-08'),
('P16', 'AG006', 'B10', 1, '2021-09-01', '2021-09-08'),
('P17', 'AG004', 'B04', 1, '2021-09-01', '2021-09-08'),
('P18', 'AG009', 'B02', 1, '2021-09-01', '2021-09-08'),
('P19', 'AG013', 'B01', 1, '2021-09-01', '2021-09-08'),
('P20', 'AG012', 'B05', 1, '2021-09-01', '2021-09-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`idanggota`);

--
-- Indexes for table `tbbuku`
--
ALTER TABLE `tbbuku`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `tbkembali`
--
ALTER TABLE `tbkembali`
  ADD PRIMARY KEY (`idkembali`);

--
-- Indexes for table `tbpinjam`
--
ALTER TABLE `tbpinjam`
  ADD PRIMARY KEY (`idpinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
