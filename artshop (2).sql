-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 16, 2020 at 10:41 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

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
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

DROP TABLE IF EXISTS `komentars`;
CREATE TABLE IF NOT EXISTS `komentars` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
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
  `user_id` int(11) NOT NULL,
  `komentar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpas`
--

DROP TABLE IF EXISTS `korpas`;
CREATE TABLE IF NOT EXISTS `korpas` (
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kupacs`
--

DROP TABLE IF EXISTS `kupacs`;
CREATE TABLE IF NOT EXISTS `kupacs` (
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kupacs`
--

INSERT INTO `kupacs` (`user_id`, `created_at`, `updated_at`) VALUES
(2, '2020-05-16 20:35:52', '2020-05-16 20:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `kupac_picture`
--

DROP TABLE IF EXISTS `kupac_picture`;
CREATE TABLE IF NOT EXISTS `kupac_picture` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cena` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2020_05_05_182025_create_pictures_table', 1),
(24, '2020_05_05_205747_create_admins_table', 1),
(25, '2020_05_05_205805_create_slikars_table', 1),
(26, '2020_05_05_205817_create_kupacs_table', 1),
(27, '2020_05_05_210748_create_komentars_table', 1),
(28, '2020_05_05_211028_create_podacis_table', 1),
(29, '2020_05_05_211229_create_kupacs_pictures_table', 1),
(30, '2020_05_05_211310_create_za_ocenus_table', 1),
(31, '2020_05_05_211324_create_korpas_table', 1),
(32, '2020_05_05_211337_create_temas_table', 1),
(33, '2020_05_05_211350_create_stils_table', 1),
(34, '2020_05_05_211429_create_pictures_temas_table', 1),
(35, '2020_05_05_211756_create_kupacs_slikars_table', 1),
(36, '2020_05_05_211812_create_komentars_korisniks_table', 1),
(37, '2020_05_10_132603_add_deleted_at_column_to_pictures_tables', 1),
(38, '2020_05_15_224746_add_fields_for_user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `autor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stil_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cena` double DEFAULT NULL,
  `opis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aukcijaFlag` int(11) NOT NULL,
  `danIstekaAukcije` date DEFAULT NULL,
  `smer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vertikalno',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `autor`, `stil_id`, `path`, `naziv`, `cena`, `opis`, `aukcijaFlag`, `danIstekaAukcije`, `smer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'John Constable', 2, '\\images\\John_Constable\\Salisbury Cathedral from the Meadows.jpg', 'Salisbury Cathedral from the Meadows', 12000, 'Ovde je neko umro cetvrti put.', 0, NULL, 'horizontalno', '2020-05-16 20:38:57', '2020-05-16 20:38:57', NULL),
(2, 1, 'Caspar David Friedrich', 2, '\\images\\Caspar_David_Friedrich\\falaise-romanticism.jpg', 'Kreda litica na rugenu', NULL, 'Ovde je neka priroda cini mi se.', 2, '2020-05-20', 'vertikalno', '2020-05-16 20:40:25', '2020-05-16 20:40:25', NULL),
(3, 1, 'Caspar David Friedrich', 2, '\\images\\Caspar_David_Friedrich\\Two_Men_Contemplating_the_Moon_-_Caspar_David_Friedrich.jpg', 'Two Men Contemplating the Moon', 15000, 'Ovde su neke dve cike.', 1, '2020-05-20', 'horizontalno', '2020-05-16 20:41:17', '2020-05-16 20:41:17', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `picture_tema`
--

INSERT INTO `picture_tema` (`id`, `picture_id`, `tema_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 3, 5, NULL, NULL),
(7, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `podacis`
--

DROP TABLE IF EXISTS `podacis`;
CREATE TABLE IF NOT EXISTS `podacis` (
  `user_id` int(11) NOT NULL,
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slikars`
--

DROP TABLE IF EXISTS `slikars`;
CREATE TABLE IF NOT EXISTS `slikars` (
  `user_id` int(11) NOT NULL,
  `sumaOcena` int(11) NOT NULL DEFAULT '0',
  `brOcenjenihSlika` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slikars`
--

INSERT INTO `slikars` (`user_id`, `sumaOcena`, `brOcenjenihSlika`, `created_at`, `updated_at`) VALUES
(1, 0, 0, '2020-05-16 20:34:20', '2020-05-16 20:34:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stils`
--

INSERT INTO `stils` (`id`, `naziv`, `created_at`, `updated_at`) VALUES
(1, 'klasicizam', NULL, NULL),
(2, 'romantizam', NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temas`
--

INSERT INTO `temas` (`id`, `tema`, `created_at`, `updated_at`) VALUES
(1, 'priroda', '2020-05-16 20:38:57', '2020-05-16 20:38:57'),
(2, 'duga', '2020-05-16 20:38:57', '2020-05-16 20:38:57'),
(3, 'more', '2020-05-16 20:40:25', '2020-05-16 20:40:25'),
(4, 'litica', '2020-05-16 20:40:25', '2020-05-16 20:40:25'),
(5, 'mesec', '2020-05-16 20:41:17', '2020-05-16 20:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_path` varchar(191) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilna_slika` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brPrijava` int(11) NOT NULL DEFAULT '0',
  `brUspesnihPrijava` int(11) NOT NULL DEFAULT '0',
  `isSlikar` tinyint(4) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `picture_path`,`email_verified_at`, `password`, `profilna_slika`, `brPrijava`, `brUspesnihPrijava`, `isSlikar`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tasha', 'tasha@gmail.com', NULL, NULL, '$2y$10$19wemgF4yfIec.mdXTNW3uj/q88.npd1pGTv9Ngo24Gze.K4Om49i', NULL, 0, 0, 1, 0, NULL, '2020-05-16 20:34:20', '2020-05-16 20:34:20'),
(2, 'matpes', 'pavicevicvladana@gmail.com', NULL, NULL, '$2y$10$VMyy2qDs.EveD3CCStpLl.b6JcDXKvHnny0DAxQbIKHb81idxaXcm', NULL, 0, 0, 0, 0, NULL, '2020-05-16 20:35:52', '2020-05-16 20:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `za_ocenus`
--

DROP TABLE IF EXISTS `za_ocenus`;
CREATE TABLE IF NOT EXISTS `za_ocenus` (
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
