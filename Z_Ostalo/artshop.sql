-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 08, 2020 at 05:52 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

DROP TABLE IF EXISTS `komentars`;
CREATE TABLE IF NOT EXISTS `komentars` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vreme` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_korisnik`
--

DROP TABLE IF EXISTS `komentar_korisnik`;
CREATE TABLE IF NOT EXISTS `komentar_korisnik` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL,
  `komentar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisniks`
--

DROP TABLE IF EXISTS `korisniks`;
CREATE TABLE IF NOT EXISTS `korisniks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilna_slika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brPrijava` int(11) NOT NULL,
  `brUspesnihPrijava` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `korisniks_username_unique` (`username`),
  UNIQUE KEY `korisniks_password_unique` (`password`),
  UNIQUE KEY `korisniks_mail_unique` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisniks`
--

INSERT INTO `korisniks` (`id`, `username`, `password`, `mail`, `profilna_slika`, `brPrijava`, `brUspesnihPrijava`, `created_at`, `updated_at`) VALUES
(1, 'kupac', '123', 'a@a.com', '/images/tamara.jpg', 0, 0, '2020-05-06 16:05:41', '2020-05-06 16:05:41'),
(2, 'slikar', '1234', 'b@a.com', '/images/drazend.jpg', 0, 0, '2020-05-06 16:05:41', '2020-05-06 16:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `korpas`
--

DROP TABLE IF EXISTS `korpas`;
CREATE TABLE IF NOT EXISTS `korpas` (
  `picture_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korpas`
--

INSERT INTO `korpas` (`picture_id`, `korisnik_id`, `created_at`, `updated_at`) VALUES
(2, 1, '2020-05-08 08:31:01', '2020-05-08 08:31:01'),
(3, 1, '2020-05-08 08:31:01', '2020-05-08 08:31:01'),
(4, 1, '2020-05-08 08:31:01', '2020-05-08 08:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `kupacs`
--

DROP TABLE IF EXISTS `kupacs`;
CREATE TABLE IF NOT EXISTS `kupacs` (
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kupacs`
--

INSERT INTO `kupacs` (`korisnik_id`, `created_at`, `updated_at`) VALUES
(1, '2020-05-06 16:06:54', '2020-05-06 16:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `kupac_picture`
--

DROP TABLE IF EXISTS `kupac_picture`;
CREATE TABLE IF NOT EXISTS `kupac_picture` (
  `picture_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `cena` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kupac_slikar`
--

DROP TABLE IF EXISTS `kupac_slikar`;
CREATE TABLE IF NOT EXISTS `kupac_slikar` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kupac_id` int(11) NOT NULL,
  `slikar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2020_05_05_182025_create_pictures_table', 1),
(17, '2020_05_05_205731_create_korisniks_table', 1),
(18, '2020_05_05_205747_create_admins_table', 1),
(19, '2020_05_05_205805_create_slikars_table', 1),
(20, '2020_05_05_205817_create_kupacs_table', 1),
(21, '2020_05_05_210748_create_komentars_table', 1),
(22, '2020_05_05_211028_create_podacis_table', 1),
(23, '2020_05_05_211229_create_kupacs_pictures_table', 1),
(24, '2020_05_05_211310_create_za_ocenus_table', 1),
(25, '2020_05_05_211324_create_korpas_table', 1),
(26, '2020_05_05_211337_create_temas_table', 1),
(27, '2020_05_05_211350_create_stils_table', 1),
(28, '2020_05_05_211429_create_pictures_temas_table', 1),
(29, '2020_05_05_211756_create_kupacs_slikars_table', 1),
(30, '2020_05_05_211812_create_komentars_korisniks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `korisnik_id` int(11) NOT NULL,
  `stil_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `opis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aukcijaFlag` int(11) NOT NULL,
  `danIstekaAukcije` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `korisnik_id`, `stil_id`, `path`, `naziv`, `ocena`, `opis`, `aukcijaFlag`, `danIstekaAukcije`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '/images/Gemma_Gene/Helium%20ballons.png', 'helium', 11, 'Baloni puni helijuma', 0, '2020-05-10', '2020-05-08 08:31:01', '2020-05-08 08:31:01'),
(3, 2, 1, '/images/Samantha_French/Underwater%20tranquility.png', 'mirnoca', 11, 'Podzemna mirnoca', 0, '2020-05-10', '2020-05-08 08:31:01', '2020-05-08 08:31:01'),
(4, 2, 1, '/images/Gerry_Miles/underwater-painting.-gerry-miles.jellyfish.jpg', 'Logo', 11, 'logo sajta', 0, '2020-05-10', '2020-05-08 08:31:01', '2020-05-08 08:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `picture_tema`
--

DROP TABLE IF EXISTS `picture_tema`;
CREATE TABLE IF NOT EXISTS `picture_tema` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `podacis`
--

DROP TABLE IF EXISTS `podacis`;
CREATE TABLE IF NOT EXISTS `podacis` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brUlice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brTelefona` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ZIPCode` int(11) NOT NULL,
  `metodNaplate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podacis`
--

INSERT INTO `podacis` (`korisnik_id`, `ime`, `prezime`, `adresa`, `grad`, `brUlice`, `brTelefona`, `ZIPCode`, `metodNaplate`, `created_at`, `updated_at`) VALUES
(1, 'Matija', 'Pesic', 'Bogradana Zerajica', 'Beograd', '32', '+381646371410', 11090, 'placanje po preuzimanju', '2020-05-08 14:36:13', '2020-05-08 14:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `slikars`
--

DROP TABLE IF EXISTS `slikars`;
CREATE TABLE IF NOT EXISTS `slikars` (
  `korisnik_id` int(11) NOT NULL,
  `sumaOcena` int(11) NOT NULL,
  `brOcenjenihSlika` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slikars`
--

INSERT INTO `slikars` (`korisnik_id`, `sumaOcena`, `brOcenjenihSlika`, `created_at`, `updated_at`) VALUES
(2, 0, 0, '2020-05-06 16:08:03', '2020-05-06 16:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `stils`
--

DROP TABLE IF EXISTS `stils`;
CREATE TABLE IF NOT EXISTS `stils` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stils_naziv_unique` (`naziv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `temas_tema_unique` (`tema`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `za_ocenus`
--

DROP TABLE IF EXISTS `za_ocenus`;
CREATE TABLE IF NOT EXISTS `za_ocenus` (
  `picture_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
