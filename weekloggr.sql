-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 08 jan 2020 kl 15:09
-- Serverversion: 8.0.18
-- PHP-version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `weekloggr`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `weekloggr`
--

CREATE TABLE `weekloggr` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `weeknr` tinyint(2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `weekloggr`
--
ALTER TABLE `weekloggr`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `weekloggr`
--
ALTER TABLE `weekloggr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/**

========================================================================

*/


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `weekloggr`
--

-- --------------------------------------------------------

--
-- Table structure for table `weekloggrTags`
--

CREATE TABLE `weekloggrTags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `weekloggr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weekloggrTags`
--
ALTER TABLE `weekloggrTags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weekloggr_id` (`weekloggr_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `weekloggrTags`
--
ALTER TABLE `weekloggrTags`
  ADD CONSTRAINT `weekloggrtags_ibfk_1` FOREIGN KEY (`weekloggr_id`) REFERENCES `weekloggr` (`id`) ON DELETE CASCADE;
