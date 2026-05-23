-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2026 at 11:01 PM
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
-- Database: `skimania`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'Skije'),
(2, 'Pancerice'),
(3, 'Jakne'),
(4, 'Kacige'),
(5, 'Rukavice'),
(6, 'Naocare'),
(7, 'Snowboard');

-- --------------------------------------------------------

--
-- Table structure for table `porudzbine`
--

CREATE TABLE `porudzbine` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `ukupna_cena` decimal(10,2) NOT NULL,
  `status` enum('na cekanju','obradjena','poslata') DEFAULT 'na cekanju'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `porudzbine`
--

INSERT INTO `porudzbine` (`id`, `user_id`, `datum`, `ukupna_cena`, `status`) VALUES
(22, 18, '2026-05-23 20:56:46', 185570.00, 'na cekanju');

-- --------------------------------------------------------

--
-- Table structure for table `poruke_klijenata`
--

CREATE TABLE `poruke_klijenata` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `telefon` varchar(30) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sadrzaj` text NOT NULL,
  `datum_slanja` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poruke_klijenata`
--

INSERT INTO `poruke_klijenata` (`id`, `user_id`, `telefon`, `naslov`, `sadrzaj`, `datum_slanja`) VALUES
(4, 19, '066/777-777-777', 'Pohvala za zaposljene!', 'Sve pohvale za zaposlene u lokalu!!', '2026-05-23 23:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(150) NOT NULL,
  `opis` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `kategorija_id` int(11) DEFAULT NULL,
  `kolicina_na_stanju` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `velicina` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `opis`, `cena`, `slika`, `kategorija_id`, `kolicina_na_stanju`, `created_at`, `velicina`) VALUES
(29, 'SKIJE ELAN VOYAGER', 'zelene', 129000.00, 'uploads/proizvod_69a869e0da6789.18145885.jpg', 1, 1, '2026-03-04 17:20:32', '170'),
(30, 'SKIJE ELAN VOYAGER', 'crne', 120000.00, 'uploads/proizvod_69a86a073b8037.02426415.jpg', 1, 1, '2026-03-04 17:21:11', '165'),
(31, 'SKIJE ELAN ACE SPEED MAGIC SLX PS ELX11 GW', 'roze', 119000.00, 'uploads/proizvod_69a86a2c684f89.72287192.jpg', 1, 1, '2026-03-04 17:21:48', '160'),
(32, 'SKIJE ELAN RIPSTICK 96', 'crne', 98000.00, 'uploads/proizvod_69a86a4c671bd6.86296926.jpg', 1, 3, '2026-03-04 17:22:20', '168'),
(33, 'SKIJE ELAN ELEMENT 74 W BLACK LS EL9 GW', 'sive', 119000.00, 'uploads/proizvod_69a86a8a494b03.34432686.jpg', 1, 2, '2026-03-04 17:23:22', '155'),
(34, 'SKIJE ELAN INSOMNIA 16 TI PS ELW11', 'plave', 109000.00, 'uploads/proizvod_69a86aac3eb525.66044066.jpg', 1, 7, '2026-03-04 17:23:56', '155'),
(35, 'SKIJE ELAN ACE SCX FX EMX12', 'zelene', 112000.00, 'uploads/proizvod_69a86acf7f60e2.27252969.jpg', 1, 2, '2026-03-04 17:24:31', '175'),
(36, 'SKIJE ELAN PRIMETIME 55 FX EMX12', 'sivo-zelene', 89000.00, 'uploads/proizvod_69a86b009c7f60.41337591.jpg', 1, 6, '2026-03-04 17:25:20', '160'),
(37, 'SKIJE ELAN RC MAGIC JRS EL 4.5 GW', 'roze decije', 79000.00, 'uploads/proizvod_69a86b4d8a60a5.21713225.jpg', 1, 1, '2026-03-04 17:26:37', '140'),
(38, 'SKIJE ELAN WINGMAN 82 CTI FX EMX12', 'braon', 129000.00, 'uploads/proizvod_69a86b7546a1b8.66656807.jpg', 1, 4, '2026-03-04 17:27:17', '176'),
(39, 'SKIJE ELAN ACE SL FUSIONX EMX12', 'zelene', 119000.00, 'uploads/proizvod_69a86bab8154e9.61362414.jpg', 1, 2, '2026-03-04 17:28:11', '168'),
(40, 'SKIJE ELAN ACE SCX FX EMX12', 'zelene', 105990.00, 'uploads/proizvod_69a86bdb31f638.91840648.jpg', 1, 1, '2026-03-04 17:28:59', '155'),
(41, 'CIPELE NORDICA UNLIMITED 130 DYN', '130 flex, black-irid green-red', 74000.00, 'uploads/proizvod_69a86da424d260.88167435.jpg', 2, 2, '2026-03-04 17:36:36', 'xl'),
(42, 'CIPELE NORDICA UNLIMITED 120 DYN', '120 flex ,green-black-red', 56000.00, 'uploads/proizvod_69a86ddbee2735.28951755.jpg', 2, 2, '2026-03-04 17:37:31', 'm'),
(43, 'CIPELE NORDICA SPEEDMACHINE 3 130', '130 flex, (GripWalk) black-anthracite-red', 59990.00, 'uploads/proizvod_69a86e1328f393.29146953.jpg', 2, 3, '2026-03-04 17:38:27', 'l'),
(44, 'CIPELE TECNICA MACH1 MV 120 TD', '120 flex, (GripWalk) black', 62990.00, 'uploads/proizvod_69a86e4b174fa0.33423157.jpg', 2, 1, '2026-03-04 17:39:23', 's'),
(45, 'CIPELE SNOWBOARD NITRO FUTURA TLS l1', 'camo-rose', 29900.00, 'uploads/proizvod_69a86e931de959.91392204.jpg', 2, 3, '2026-03-04 17:40:35', 's'),
(46, 'CIPELE SNOWBOARD NITRO VENTURE TLS', 'charcoal', 21000.00, 'uploads/proizvod_69a86ecbe57b28.07253005.jpg', 2, 2, '2026-03-04 17:41:31', 'm'),
(47, 'CIPELE SNOWBOARD NITRO RIVAL TLS', 'black', 24590.00, 'uploads/proizvod_69a86f04635204.30169921.jpg', 2, 6, '2026-03-04 17:42:28', 's'),
(48, 'CIPELE SNOWBOARD NITRO ŽENSKE FLORA TLS', 'grey-purple', 24590.00, 'uploads/proizvod_69a86f2bddba34.85319103.jpg', 2, 3, '2026-03-04 17:43:07', 'l'),
(49, 'JAKNA JC de CASTELBAJAC ŽENSKA STELLAR DOWN', 'zenska jakna sa 2000 jedinici propustljivosti', 117900.00, 'uploads/proizvod_69a86f8dc821a6.65471972.jpg', 3, 4, '2026-03-04 17:44:45', 'm'),
(50, 'JAKNA JC de CASTELBAJAC ŽENSKA MODUL DOWN BOMBER', 'Crvena zenska jakna u retro izgleda', 93490.00, 'uploads/proizvod_69a86fcf47d0a8.96023271.jpg', 3, 2, '2026-03-04 17:45:51', 's'),
(51, 'JAKNA DAINESE IVENTA DERMIZAX EV™', 'Dainese elegantna perjana skijaska jakna, 10000 jedinica za propustljivost', 89000.00, 'uploads/proizvod_69a8704dc91764.56066353.jpg', 3, 2, '2026-03-04 17:47:57', 'l'),
(52, 'JAKNA COLMAR HEAT SHIELD', 'Elegantna crna Colmar jakna', 119000.00, 'uploads/proizvod_69a87082dfa757.96334743.jpg', 3, 3, '2026-03-04 17:48:50', 'xl'),
(53, 'JAKNA COLMAR VICEVERSA HALF DOWN', 'Decija crna Colmar jakna za skijanje', 74900.00, 'uploads/proizvod_69a870b9b4adb1.04597781.jpg', 3, 1, '2026-03-04 17:49:45', 's'),
(54, 'JAKNA COLMAR ŽENSKA QUILTED EXTRA WARM DOWN', 'Decija muska Colmar jakna za skijanje', 74900.00, 'uploads/proizvod_69a870e864c594.29846172.jpg', 3, 2, '2026-03-04 17:50:32', 's'),
(55, 'JAKNA COLMAR ŽENSKA DUALITY DOWN', 'Zenska jakna Colmar Vrhunskog kvaliteta', 89900.00, 'uploads/proizvod_69a87127ef9328.84455477.jpg', 3, 3, '2026-03-04 17:51:35', 'm'),
(56, 'JAKNA DAINESE HP DIAMOND II S+', 'Dainese jakna sa 30000 jedinica za propustljivost', 119000.00, 'uploads/proizvod_69a8715b6f2fa0.43778595.jpg', 3, 1, '2026-03-04 17:52:27', 's'),
(57, 'SNOWBOARD NITRO TEST MAGNUM', 'Troslojna daska', 32990.00, 'uploads/proizvod_69a8719eb5c7c9.52315422.jpg', 7, 2, '2026-03-04 17:53:34', '165'),
(58, 'SNOWBOARD NITRO SUPRATEAM', 'libtech', 36990.00, 'uploads/proizvod_69a8727aa01e24.92220156.jpg', 7, 3, '2026-03-04 17:57:14', '160'),
(60, 'SNOWBOARD NITRO KARMA', 'rome nitro daska', 39900.00, 'uploads/proizvod_69a872f7ad4010.29921542.jpg', 7, 4, '2026-03-04 17:59:19', '170'),
(61, 'SNOWBOARD NITRO PRIME RAW', 'Zuta nitro daska', 28990.00, 'uploads/proizvod_69a8731eeaf461.32665171.jpg', 7, 4, '2026-03-04 17:59:58', '145'),
(62, 'SNOWBOARD NITRO CINEMA', 'k2 daska', 34490.00, 'uploads/proizvod_69a87349c5a0d9.39428095.jpg', 7, 4, '2026-03-04 18:00:41', '170'),
(63, 'HEAD SNB DRAKE CHARM', 'zenska HEAD-ova daska', 25990.00, 'uploads/proizvod_69a8737656a825.89455271.jpg', 7, 3, '2026-03-04 18:01:26', '140'),
(64, 'HEAD SNB DRAKE LEAGUEe', 'Headova muska daska', 27900.00, 'uploads/proizvod_69a873a14f4857.56246990.jpg', 7, 3, '2026-03-04 18:02:09', '165'),
(65, 'KACIGA UVEX ULTRA', 'silver-black mat', 7990.00, 'uploads/proizvod_69a87470b33287.16052866.jpg', 4, 3, '2026-03-04 18:05:36', 'm'),
(66, 'KACIGA BOLLE ATMOS PURE', 'bole crna mat kaciga', 27890.00, 'uploads/proizvod_69a874de4b1cf2.47261242.jpg', 4, 3, '2026-03-04 18:07:26', 'xl'),
(67, 'KACIGA SKI SCOTT BLEND PLUS LS', 'bela mat kaxiga sa naocarama', 29900.00, 'uploads/proizvod_69a8750edf34c6.56487790.jpg', 4, 5, '2026-03-04 18:08:14', 'l'),
(68, 'KACIGA BOLLE MIGHT VISOR', 'titanium red matte-brown gun', 31290.00, 'uploads/proizvod_69a875471a7e97.46418641.jpg', 4, 3, '2026-03-04 18:09:11', 'm'),
(69, 'KACIGA DAINESE AIRO MIPS', 'mono matt black', 9990.00, 'uploads/proizvod_69a87623342e22.87231351.jpg', 4, 3, '2026-03-04 18:12:51', 's'),
(70, 'KACIGA ELAN TWIST', 'white mat', 6990.00, 'uploads/proizvod_69a876543dec63.25817133.jpg', 4, 3, '2026-03-04 18:13:40', 'xl'),
(71, 'KACIGA SKI MARKER COMPANION', 'zenska bela kaciga', 7990.00, 'uploads/proizvod_69a876a0482569.29480297.jpg', 4, 3, '2026-03-04 18:14:56', 'm'),
(72, 'KACIGA BOLLE V-RYFT PURE', 'black coal matte-photochromic blue', 26000.00, 'uploads/proizvod_69a877005bea50.74959354.jpg', 4, 4, '2026-03-04 18:16:32', 'l'),
(73, 'NAOČARE SKI UVEX EVIDNT FM ATTRACT CV', 'white-dl silver yellow S2', 9990.00, 'uploads/proizvod_69a877df07df08.44939080.jpg', 6, 4, '2026-03-04 18:20:15', 'm'),
(74, 'NAOČARE SKI SCOTT AMBIT COMPACT', 'black-white-AMP aurora green chrome S1', 11790.00, 'uploads/proizvod_69a87817e11a01.35240413.jpg', 6, 3, '2026-03-04 18:21:11', 'l'),
(75, 'NAOČARE SKI OAKLEY FALL LINE L FACTORY PILOT', 'black-prizm snow sapphire iridium', 14900.00, 'uploads/proizvod_69a87851460d81.37988227.jpg', 6, 3, '2026-03-04 18:22:09', 'xl'),
(76, 'NAOČARE SKI SCOTT AMBIT', 'mineral black-AMP black chrome S3', 13490.00, 'uploads/proizvod_69a87891dd07e6.39852305.jpg', 6, 3, '2026-03-04 18:23:13', 'xl'),
(77, 'NAOČARE SKI SCOTT FACTOR', 'black-white-enhancer S2', 4900.00, 'uploads/proizvod_69a878d4bfa103.97553124.jpg', 6, 4, '2026-03-04 18:24:20', 's'),
(78, 'NAOČARE SKI SCOTT FACTOR PRO', 'blue-light grey-enhancer blue chrome', 13890.00, 'uploads/proizvod_69a879148d55f7.75239597.jpg', 6, 3, '2026-03-04 18:25:24', 'm'),
(79, 'NAOČARE SKI OAKLEY FLIGHT DECK M', 'matte black-prizm sapphire iridium', 19890.00, 'uploads/proizvod_69a879538f8e69.39414404.jpg', 6, 3, '2026-03-04 18:26:27', 'l'),
(80, 'NAOČARE SKI BOLLE NEVADA SMALL', 'black matte-volt pink', 15990.00, 'uploads/proizvod_69a879b0020712.93525599.jpg', 6, 3, '2026-03-04 18:28:00', 'm');

-- --------------------------------------------------------

--
-- Stand-in structure for view `proizvodi_kat`
-- (See below for the actual view)
--
CREATE TABLE `proizvodi_kat` (
`id` int(11)
,`naziv` varchar(150)
,`opis` text
,`cena` decimal(10,2)
,`slika` varchar(255)
,`kategorija_id` int(11)
,`kolicina_na_stanju` int(11)
,`created_at` timestamp
,`velicina` varchar(16)
,`kategorija` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `stavke_porudzbine`
--

CREATE TABLE `stavke_porudzbine` (
  `id` int(11) NOT NULL,
  `porudzbina_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stavke_porudzbine`
--

INSERT INTO `stavke_porudzbine` (`id`, `porudzbina_id`, `proizvod_id`, `kolicina`, `cena`) VALUES
(20, 22, 30, 1, 120000.00),
(21, 22, 74, 2, 11790.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `prezime` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uloga` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `email`, `password`, `uloga`, `created_at`) VALUES
(17, 'Test', 'Admin', 'admin@example.com', '$2y$10$.QB2n2bipv6vZP5sogKIaORN6hGSMuIvU5cMGUKGCHxtFOtuA6ahW', 'admin', '2026-05-23 20:53:53'),
(18, 'Test', 'User', 'user@example.com', '$2y$10$k1RoXDUvCOC9V6RHVdtJbevfWHpD93FCUm2knYV2QiXD9D8WXS7LO', 'user', '2026-05-23 20:55:04'),
(19, 'Test', 'User2', 'user2@example.com', '$2y$10$d.MWOQoJbggYqZk1uF/vweP/BHFnbjHkiEUefZaDN6xo2daWZoBgm', 'user', '2026-05-23 20:59:49');

-- --------------------------------------------------------

--
-- Structure for view `proizvodi_kat`
--
DROP TABLE IF EXISTS `proizvodi_kat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proizvodi_kat`  AS SELECT `p`.`id` AS `id`, `p`.`naziv` AS `naziv`, `p`.`opis` AS `opis`, `p`.`cena` AS `cena`, `p`.`slika` AS `slika`, `p`.`kategorija_id` AS `kategorija_id`, `p`.`kolicina_na_stanju` AS `kolicina_na_stanju`, `p`.`created_at` AS `created_at`, `p`.`velicina` AS `velicina`, `k`.`naziv` AS `kategorija` FROM (`proizvodi` `p` join `kategorije` `k` on(`p`.`kategorija_id` = `k`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porudzbine`
--
ALTER TABLE `porudzbine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `poruke_klijenata`
--
ALTER TABLE `poruke_klijenata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorija_id` (`kategorija_id`);

--
-- Indexes for table `stavke_porudzbine`
--
ALTER TABLE `stavke_porudzbine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `porudzbina_id` (`porudzbina_id`),
  ADD KEY `proizvod_id` (`proizvod_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `porudzbine`
--
ALTER TABLE `porudzbine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `poruke_klijenata`
--
ALTER TABLE `poruke_klijenata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `stavke_porudzbine`
--
ALTER TABLE `stavke_porudzbine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `porudzbine`
--
ALTER TABLE `porudzbine`
  ADD CONSTRAINT `porudzbine_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poruke_klijenata`
--
ALTER TABLE `poruke_klijenata`
  ADD CONSTRAINT `poruke_klijenata_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorije` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stavke_porudzbine`
--
ALTER TABLE `stavke_porudzbine`
  ADD CONSTRAINT `stavke_porudzbine_ibfk_1` FOREIGN KEY (`porudzbina_id`) REFERENCES `porudzbine` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stavke_porudzbine_ibfk_2` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
