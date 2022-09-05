-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 06:45 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-sipdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_golongan`
--

CREATE TABLE `tbl_golongan` (
  `gol_id` varchar(2) NOT NULL,
  `gol_nama` varchar(5) NOT NULL,
  `gol_pangkat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_golongan`
--

INSERT INTO `tbl_golongan` (`gol_id`, `gol_nama`, `gol_pangkat`) VALUES
('11', 'I/a', 'Juru Muda'),
('12', 'I/b', 'Juru Muda Tk. I'),
('13', 'I/c', 'Juru'),
('14', 'I/d', 'Juru Tk. I'),
('21', 'II/a', 'Pengatur Muda'),
('22', 'II/b', 'Pengatur Muda Tk. I'),
('23', 'II/c', 'Pengatur'),
('24', 'II/d', 'Pengatur Tk. I'),
('31', 'III/a', 'Penata Muda'),
('32', 'III/b', 'Penata Muda Tk. I'),
('33', 'III/c', 'Penata'),
('34', 'III/d', 'Penata Tk. I'),
('41', 'IV/a', 'Pembina'),
('42', 'IV/b', 'Pembina Tk. I'),
('43', 'IV/c', 'Pembina Utama Muda'),
('44', 'IV/d', 'Pembina Utama Madya'),
('45', 'IV/e', 'Pembina Utama');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
