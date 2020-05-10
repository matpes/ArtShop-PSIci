-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 01:13 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Vreme` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_korisnik`
--

CREATE TABLE `komentar_korisnik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `komentar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisniks`
--

CREATE TABLE `korisniks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilna_slika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brPrijava` int(11) NOT NULL,
  `brUspesnihPrijava` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `korpas` (
  `picture_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `kupacs` (
  `korisnik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `kupac_picture` (
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

CREATE TABLE `kupac_slikar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `slikar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(30, '2020_05_05_211812_create_komentars_korisniks_table', 1),
(31, '2014_10_12_000000_create_users_table', 2),
(32, '2019_08_19_000000_create_failed_jobs_table', 2),
(33, '2014_10_12_100000_create_password_resets_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `stil_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `opis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aukcijaFlag` int(11) NOT NULL,
  `danIstekaAukcije` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `picture_tema` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picture_id` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `podacis`
--

CREATE TABLE `podacis` (
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
  `updated_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `slikars` (
  `korisnik_id` int(11) NOT NULL,
  `sumaOcena` int(11) NOT NULL,
  `brOcenjenihSlika` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `stils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naziv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temas`
--

CREATE TABLE `temas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `za_ocenus`
--

CREATE TABLE `za_ocenus` (
  `picture_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar_korisnik`
--
ALTER TABLE `komentar_korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisniks`
--
ALTER TABLE `korisniks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisniks_username_unique` (`username`),
  ADD UNIQUE KEY `korisniks_password_unique` (`password`),
  ADD UNIQUE KEY `korisniks_mail_unique` (`mail`);

--
-- Indexes for table `korpas`
--
ALTER TABLE `korpas`
  ADD PRIMARY KEY (`picture_id`);

--
-- Indexes for table `kupacs`
--
ALTER TABLE `kupacs`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `kupac_slikar`
--
ALTER TABLE `kupac_slikar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_tema`
--
ALTER TABLE `picture_tema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podacis`
--
ALTER TABLE `podacis`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `slikars`
--
ALTER TABLE `slikars`
  ADD PRIMARY KEY (`korisnik_id`);

--
-- Indexes for table `stils`
--
ALTER TABLE `stils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stils_naziv_unique` (`naziv`);

--
-- Indexes for table `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `temas_tema_unique` (`tema`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `za_ocenus`
--
ALTER TABLE `za_ocenus`
  ADD PRIMARY KEY (`picture_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar_korisnik`
--
ALTER TABLE `komentar_korisnik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisniks`
--
ALTER TABLE `korisniks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kupac_slikar`
--
ALTER TABLE `kupac_slikar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `picture_tema`
--
ALTER TABLE `picture_tema`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stils`
--
ALTER TABLE `stils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temas`
--
ALTER TABLE `temas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
