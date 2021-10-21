-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2021 at 02:37 AM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utsriyan_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) NOT NULL,
  `name` text COLLATE utf8_swedish_ci NOT NULL,
  `wa` text COLLATE utf8_swedish_ci NOT NULL,
  `fb` longtext COLLATE utf8_swedish_ci NOT NULL,
  `ig` longtext COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `wa`, `fb`, `ig`) VALUES
(2, 'Riyan Yazid M', '6281295434639', 'namakutakpenting109', 'riyanntp');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `tingkat` text NOT NULL,
  `nama_sekolah` text NOT NULL,
  `tahun_lulus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `tingkat`, `nama_sekolah`, `tahun_lulus`) VALUES
(1, 'SD', 'AL-IHSAN', '2010');

-- --------------------------------------------------------

--
-- Table structure for table `hoby`
--

CREATE TABLE `hoby` (
  `id` int(11) NOT NULL,
  `hoby_name` text NOT NULL,
  `detail_hoby` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoby`
--

INSERT INTO `hoby` (`id`, `hoby_name`, `detail_hoby`) VALUES
(2, 'Jalan jalan', 'Naik Gunung'),
(3, 'Content Creator', 'Yt  : TripleEnam Channel');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_matakuliah`
--

CREATE TABLE `jadwal_matakuliah` (
  `id` int(11) NOT NULL,
  `kelas` text NOT NULL,
  `kode_matkul` text NOT NULL,
  `date` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_matakuliah`
--

INSERT INTO `jadwal_matakuliah` (`id`, `kelas`, `kode_matkul`, `date`, `start_time`, `end_time`) VALUES
(1, 'IFA301', 'Jaringan Komputer (INF)', 'Senin', '07:00', '10:30'),
(3, 'IFA309', 'Jaringan Komputer (INF)', 'Jumat', '10:10', '15:20');

-- --------------------------------------------------------

--
-- Table structure for table `learn_about_me`
--

CREATE TABLE `learn_about_me` (
  `id` int(11) NOT NULL,
  `experience_name` text NOT NULL,
  `persentage` int(11) NOT NULL,
  `gambar` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learn_about_me`
--

INSERT INTO `learn_about_me` (`id`, `experience_name`, `persentage`, `gambar`) VALUES
(1, 'Photographer', 99, 'about-me.jpg'),
(2, 'Cameraman', 90, 'about-me.jpg'),
(3, 'Designer', 85, 'about-me.jpg'),
(4, 'Content Creator', 90, 'about-me.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `tipe` enum('Photographer','Designer','Content Creator') NOT NULL,
  `nama_portfolio` text NOT NULL,
  `gambar` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `tipe`, `nama_portfolio`, `gambar`) VALUES
(1, 'Photographer', 'Photo contest', 'portfolio-1.jpg'),
(2, 'Designer', 'Design Photo', 'portfolio-x.jpg'),
(7, 'Content Creator', 'TripleEnam at Youtube', '123-1235246_youtube-ndash-logos-brands-and-logotypes-youtube-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `full_name` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `level` enum('Free','Member','Agen','Reseller','Admin','Developers') COLLATE utf8_swedish_ci NOT NULL,
  `registered` date NOT NULL,
  `status` enum('Active','Suspended') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `email`, `level`, `registered`, `status`) VALUES
(4, 'Riyan Yazid M', 'Admin123', 'Admin@admin.com', 'Developers', '2021-10-20', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `author` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `name`, `keyword`, `description`, `author`, `contact`) VALUES
(2, 'UTS-RIYAN', 'UTS,UJIAN,UAS,RYAN,RIYAN YAZID', 'Selamat datang', 'Riyan Yazid M', '6281295434639');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoby`
--
ALTER TABLE `hoby`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_matakuliah`
--
ALTER TABLE `jadwal_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learn_about_me`
--
ALTER TABLE `learn_about_me`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hoby`
--
ALTER TABLE `hoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_matakuliah`
--
ALTER TABLE `jadwal_matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `learn_about_me`
--
ALTER TABLE `learn_about_me`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
