-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 04:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Sapi', 'Kucing kecil lucu bercorak seperti sapi, makannya saya kasih nama Sapi.', 'sapi.jpg', '2025-01-08', 'danny'),
(2, 'SLANK', 'Nonton Slank, setelah selesai perform, saya pulang (cuman mau nonton Slank)', 'slank.jpg', '2025-01-06', 'admin'),
(3, 'freddy', 'Sapi tetangga saya masuk kolam renang, namanya Freddy. Setelah berhasil keluar, dia jadi sate sapi.', 'cow.jpg', '2025-01-06', 'admin'),
(4, 'Homies', 'Hangout bersama homies setelah 1 tahun tidak bertemu(lebay)', 'chill.jpg', '2025-01-06', 'admin'),
(6, 'Snowi', 'Kucing yang waktu kecil berwarna putih polos (snow), ketika remaja dia malah bercorak garis-garis abu.', 'snowi.jpg', '2025-01-06', 'admin'),
(7, 'Hot Wheels', 'This would be me in 30 Years. Sedang melihat koleksi Hot Wheels terbaik.', 'hotwheels.jpg', '2025-01-06', 'admin'),
(9, 'ma beloved', 'Chillin\' at Borobudur Temple with my mom, back when I was in middle school during the holiday.', '20250106192609.jpg', '2025-01-06', 'danny');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `alt`, `tanggal`, `username`, `gambar`) VALUES
(1, 'badminton', '2025-01-06 18:09:46', 'salah', '20250106180946.jpg'),
(3, 'mama', '2025-01-06 19:28:59', 'danny', '20250106192859.jpg'),
(4, 'martikulasi', '2025-01-06 18:11:53', 'salah', '20250106181153.jpg'),
(5, 'smk', '2025-01-06 18:39:22', 'salah', '20250106183922.jpg'),
(6, 'ki', '2025-01-06 18:42:41', 'salah', '20250106184241.jpg'),
(7, 'venellope', '2025-01-06 18:44:28', 'salah', '20250106184428.jpg'),
(8, 'nongki', '2025-01-06 18:49:27', 'salah', '20250106184927.png'),
(9, 'ki11', '2025-01-08 16:49:17', 'danny', '20250106185035.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('guest','admin') NOT NULL DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`, `role`) VALUES
(2, 'Msalah', 'cb476fd299e9adb31893e6bd94df882ee69b77763683992663cb1ec438d31dab', '20250106180624.jpg', 'admin'),
(3, 'danny', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '20250106185547.png', 'admin'),
(4, 'panji', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '20250106185821.png', 'admin'),
(6, 'akmal', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '20250106185955.jpg', 'admin'),
(8, 'Panji Laksono', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '20250106190428.jpg', 'admin'),
(9, 'andi', '998ed4d621742d0c2d85ed84173db569afa194d4597686cae947324aa58ab4bb', '20250106190832.jpg', 'guest'),
(10, 'Pak Ganjari', 'e1fe3252fba9143d39d53852a9a778e49f6b077bc1aa02552f70a75fc35efd9f', '20250106190844.jpg', 'guest'),
(16, 'farhan', '14b2ce63ca9bff5dd028e657617c8e492e979c777a0899d090cca1204b44aedc', 'Snapinsta.app_464945017_18465618142046986_8433682156656456614_n_1080.jpg', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
