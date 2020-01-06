-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 06 jan 2020 kl 08:21
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
-- Dumpning av Data i tabell `weekloggr`
--

INSERT INTO `weekloggr` (`id`, `date`, `text`, `weeknr`, `is_visible`) VALUES
(1, '2019-12-07 23:00:00', 'Haft sprintplannering', 50, 1),
(2, '2019-12-08 23:00:00', 'Planerat nästa sprint', 50, 1),
(3, '2020-01-19 23:00:00', 'Undersökt om vi kan få ut ett exempel på /catch och det stöttar underlaget för avräkningsnotor', 51, 1),
(4, '2020-01-22 23:00:00', 'Fått svar från EA om MDR och vi förväntas använda valideringstjänsten i dagsläget.', 52, 1),
(5, '2020-01-02 23:00:00', 'Diskuterat Test strategier med Taif och Ivo', 1, 1),
(6, '2020-01-02 23:00:00', 'Haft lite kontakt med FMC om hur de gör när de gör beställningar av nya konton\r\n', 1, 1),
(7, '2020-01-03 11:50:54', 'asdasdasdasd', 1, 1),
(8, '2020-01-03 11:53:53', 'ssssssssssssssssssssss', 1, 1),
(9, '2020-01-03 11:56:15', 'ssssssssssssssssssssss', 1, 1),
(10, '2020-01-03 11:56:28', 'ssssssssssssssssssssss', 1, 1),
(11, '2020-01-03 11:56:39', 'asdasdasd', 1, 1),
(12, '2020-01-03 11:56:42', 'asdasdasdasdasdasd', 1, 1),
(13, '2020-01-03 11:56:46', 'sdfsdfsdfsdfsdf', 1, 1),
(14, '2020-01-03 11:56:49', 'dfgdfgdfgdfgdfg', 1, 1),
(15, '2020-01-03 11:56:54', 'qweqweqweqwe7', 1, 1),
(16, '2020-01-03 11:56:57', 'ertertertert', 1, 1),
(17, '2020-01-03 11:57:01', 'qqqqqq', 1, 1),
(18, '2020-01-03 11:58:01', 'qqqqqq', 1, 1),
(19, '2020-01-03 11:58:27', 'qqqqqq', 1, 1),
(20, '2020-01-03 11:59:34', 'qqqqqq', 1, 1),
(21, '2020-01-03 11:59:47', 'dsasdasdasdasdasdasdasdasdasdasdasd', 1, 1),
(22, '2020-01-03 12:00:14', 'asdasdasd', 1, 1),
(23, '2020-01-03 12:00:17', 'dfgdfgdfg7', 1, 1),
(24, '2020-01-03 12:04:07', 'dfgdfgdfg7', 1, 1),
(25, '2020-01-03 12:06:48', 'd', 1, 1),
(26, '2020-01-03 12:18:02', 'asdasdasdasd', 1, 1),
(27, '2020-01-03 12:18:04', 'sdfsdfsdf', 1, 1),
(28, '2020-01-03 12:18:08', 'asdasd', 1, 1),
(29, '2020-01-03 12:18:10', 'asdasdasd', 1, 1),
(30, '2020-01-03 12:18:13', 'asdasdasd', 1, 1),
(31, '2020-01-03 12:18:16', 'asdasdasdasdasdasdasd', 1, 1),
(32, '2020-01-04 15:14:24', 'asdasd', 1, 1),
(33, '2020-01-04 15:14:33', 'ssssssssssssssssssssssssssssss', 1, 1),
(34, '2020-01-04 15:24:48', 'ssssssssssssssssssssssssssssss', 1, 1),
(35, '2020-01-04 15:26:18', 'ssssssssssssssssssssssssssssss', 1, 1),
(36, '2020-01-04 15:28:45', 'ssssssssssssssssssssssssssssss', 1, 1),
(37, '2020-01-04 15:29:34', 'ssssssssssssssssssssssssssssss', 1, 1),
(38, '2020-01-04 15:31:18', 'ssssssssssssssssssssssssssssss', 1, 1),
(39, '2020-01-04 15:32:07', 'ssssssssssssssssssssssssssssss', 1, 1),
(40, '2020-01-04 15:32:42', 'ssssssssssssssssssssssssssssss', 1, 1),
(41, '2020-01-04 15:33:02', 'ssssssssssssssssssssssssssssss', 1, 1),
(42, '2020-01-04 15:33:34', 'ssssssssssssssssssssssssssssss', 1, 1),
(43, '2020-01-04 15:33:45', 'ssssssssssssssssssssssssssssss', 1, 1),
(44, '2020-01-04 15:34:53', 'ssssssssssssssssssssssssssssss', 1, 1),
(45, '2020-01-04 15:35:31', 'ssssssssssssssssssssssssssssss', 1, 1),
(46, '2020-01-04 15:36:15', 'ssssssssssssssssssssssssssssss', 1, 1),
(47, '2020-01-04 15:57:46', 'ssssssssssssssssssssssssssssss', 1, 1),
(48, '2020-01-04 15:58:53', 'ssssssssssssssssssssssssssssss', 1, 1),
(49, '2020-01-04 15:59:30', 'ssssssssssssssssssssssssssssss', 1, 1),
(50, '2020-01-04 15:59:51', 'ssssssssssssssssssssssssssssss', 1, 1),
(51, '2020-01-04 16:00:29', 'ssssssssssssssssssssssssssssss', 1, 1),
(52, '2020-01-04 16:01:19', 'ssssssssssssssssssssssssssssss', 1, 1),
(53, '2020-01-04 16:03:02', 'ssssssssssssssssssssssssssssss', 1, 1),
(54, '2020-01-04 16:03:26', 'ssssssssssssssssssssssssssssss', 1, 1),
(55, '2020-01-04 16:03:30', 'ssssssssssssssssssssssssssssss', 1, 1),
(56, '2020-01-04 16:04:34', 'ssssssssssssssssssssssssssssss', 1, 1),
(57, '2020-01-04 16:04:45', 'ssssssssssssssssssssssssssssss', 1, 1),
(58, '2020-01-04 16:04:54', 'ssssssssssssssssssssssssssssss', 1, 1),
(59, '2020-01-04 16:04:57', 'ssssssssssssssssssssssssssssss', 1, 1),
(60, '2020-01-04 16:05:02', 'ssssssssssssssssssssssssssssss', 1, 1),
(61, '2020-01-04 16:08:43', 'ssssssssssssssssssssssssssssss', 1, 1),
(62, '2020-01-04 16:09:56', 'ssssssssssssssssssssssssssssss', 1, 1),
(63, '2020-01-04 16:10:05', 'ggggggggggggg', 1, 1),
(64, '2020-01-04 16:10:12', 'ssssssssssssssssssssssssssssssssssssssss', 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
