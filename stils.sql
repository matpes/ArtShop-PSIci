-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 10:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `stils`
--

CREATE TABLE `stils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stils`
--

INSERT INTO `stils` (`id`, `naziv`, `created_at`, `updated_at`) VALUES
(5, 'romantizam', NULL, NULL),
(4, 'neoklasicizam', NULL, NULL),
(3, 'klasicizam', NULL, NULL),
(2, 'barok', NULL, NULL),
(1, 'renesansa', NULL, NULL),
(6, 'impresionizam', NULL, NULL),
(7, 'simobolizam', NULL, NULL),
(8, 'ekspresionizam', NULL, NULL),
(9, 'kubizam', NULL, NULL),
(10, 'futurizam', NULL, NULL),
(11, 'dadaizam', NULL, NULL),
(12, 'nadrealizam', NULL, NULL),
(13, 'popart', NULL, NULL),
(14, 'postmodernizam', NULL, NULL),
(15, 'savremenaUmetnost', NULL, NULL),
(16, 'realizam', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stils`
--
ALTER TABLE `stils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stils_naziv_unique` (`naziv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stils`
--
ALTER TABLE `stils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
