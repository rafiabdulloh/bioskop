-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 03:57 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `nama_film` varchar(255) DEFAULT NULL,
  `harga_tiket` int(11) NOT NULL,
  `jam_tayang` datetime NOT NULL,
  `film_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `harga_tiket`, `jam_tayang`, `film_image`) VALUES
(4, 'tenet', 45000, '2024-01-29 10:00:00', 'img/11111.jpg'),
(5, 'the maze runner', 45000, '2024-01-29 22:00:00', 'img/222222.jpg'),
(6, 'in time', 45000, '2024-01-29 23:00:00', 'img/intime.jpg'),
(7, 'inception', 50000, '2024-01-30 12:00:00', 'img/inception.jpg'),
(8, 'ancika', 55000, '2024-01-29 10:00:00', 'img/ancika.jpg'),
(9, 'aquaman', 45000, '2024-01-29 10:00:00', 'img/aquaman.jpg'),
(10, 'oppenheimer', 45000, '2024-01-29 10:00:00', 'img/oppenheimer.jpg'),
(11, 'sehidup semati', 50000, '2024-01-30 12:00:00', 'img/sehidupsemati.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
