-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 07:43 PM
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
(1, 'Matematika Diskrit', 'Pertemuan 14 atau Terakhir Mata Kuliah Matematika Diskrit pada semester 2.', 'diskrit.jpg', '2023-09-12', 'admin'),
(2, 'Sapi', 'Kucing kecil lucu bercorak seperti sapi, makannya saya kasih naman Sapi.', 'sapi.jpg', '2024-08-24', 'admin'),
(3, 'Snowi', 'Kucing yang waktu kecil berwarna putih polos (snow), ketika remaja dia malah bercorak garis-garis abu.', 'snowi.jpg', '2023-07-08', 'admin'),
(4, 'Freddy', 'Sapi tetangga saya masuk kolam renang, namanya Freddy. Setelah berhasil keluar, dia jadi sate sapi.', 'cow.jpg', '2023-12-11', 'admin'),
(5, 'SLANK', 'Nonton Slank, setelah selesai perform, saya pulang (cuman mau nonton Slank)', 'slank.jpg', '2023-12-29', 'admin'),
(6, 'Homies\r\n\r\n', 'Hangout bersama homies setelah 1 tahun tidak bertemu(lebay)\r\n\r\n', 'chill.jpg', '2023-10-10', 'admin'),
(7, 'Hot Wheels', 'This would be me in 30 Years. Sedang melihat koleksi Hot Wheels terbaik.', 'hotwheels.jpg', '2021-07-07', 'admin'),
(11, 'Ambarawa~~~', 'Ambarawa is a town located between the city of Semarang and Salatiga in Central Java, Indonesia. ', '20241214135016.jpeg', '2024-12-14', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gambar` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gambar`, `tanggal`) VALUES
('diskrit.jpg', '2023-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', ''),
(2, 'mouse', 'eak', ''),
(3, 'Kendrick', 'd6e2d241ed8bbe9c6bd55358e95bd9e0', ''),
(4, 'Frank Sinatra', 'b5c0b187fe309af0f4d35982fd961d7e', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
