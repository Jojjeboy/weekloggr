-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2020 at 09:42 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `weekloggr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `tags`
--

TRUNCATE TABLE `tags`;
--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, '#ers'),
(2, '#handbas'),
(3, '#php'),
(13, '#uppdaterad'),
(14, '#nytag');

-- --------------------------------------------------------

--
-- Table structure for table `weekloggr`
--

DROP TABLE IF EXISTS `weekloggr`;
CREATE TABLE `weekloggr` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `weeknr` tinyint(2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `weekloggr`
--

TRUNCATE TABLE `weekloggr`;
--
-- Dumping data for table `weekloggr`
--

INSERT INTO `weekloggr` (`id`, `date`, `text`, `weeknr`, `is_visible`) VALUES
(1, '2019-11-14 23:00:00', 'Haft sprintplanneringsmöte', 46, 1),
(2, '2019-12-09 23:00:00', 'Planerat nästa sprint', 50, 1),
(4, '2020-01-22 23:00:00', 'Fått svar från EA om MDR och vi förväntas använda valideringstjänsten i dagsläget.', 4, 1),
(5, '2019-12-24 23:00:00', 'Diskuterat Test strategier med Taif och Ivo', 52, 1),
(6, '2020-01-02 23:00:00', 'Haft lite kontakt med FMC om hur de gör när de gör beställningar av nya konton\r\n', 1, 1),
(65, '2020-01-06 20:45:51', 'Logging #php', 2, 1),
(66, '2020-01-25 16:38:46', 'Testar hashtaggar #ers', 4, 1),
(68, '2020-01-25 17:10:09', 'ssss #handbas', 4, 1),
(73, '2020-01-25 17:26:46', 'Nu provar vi med lite hashtags #ers #handbas #php', 4, 1),
(75, '2020-01-26 14:19:26', 'Prövar med en till #ers tag', 5, 1),
(81, '2020-01-25 23:00:00', 'En #php tag nu nuuuuu', 4, 1),
(84, '2019-12-25 23:00:00', 'Testar att uppdatera denna #uppdaterad', 52, 1),
(85, '2020-01-25 23:00:00', 'Ny Tag #nytag #uppdaterad', 4, 1),
(86, '2020-01-27 18:00:38', 'testar veckonr', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `weekloggr_tags`
--

DROP TABLE IF EXISTS `weekloggr_tags`;
CREATE TABLE `weekloggr_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `weekloggr_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `weekloggr_tags`
--

TRUNCATE TABLE `weekloggr_tags`;
--
-- Dumping data for table `weekloggr_tags`
--

INSERT INTO `weekloggr_tags` (`id`, `weekloggr_id`, `tag_id`) VALUES
(1, 66, 1),
(2, 73, 1),
(4, 65, 3),
(5, 68, 2),
(6, 73, 2),
(8, 75, 1),
(14, 81, 3),
(16, 84, 13),
(17, 85, 14),
(18, 85, 13);

-- --------------------------------------------------------

--
-- Stand-in structure for view `weekloggr_with_tags`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `weekloggr_with_tags`;
CREATE TABLE `weekloggr_with_tags` (
`name` varchar(255)
,`id` int(11)
,`tagId` int(11) unsigned
,`text` text
,`date` timestamp
,`weeknr` tinyint(2)
);

-- --------------------------------------------------------

--
-- Structure for view `weekloggr_with_tags`
--
DROP TABLE IF EXISTS `weekloggr_with_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `weekloggr_with_tags`  AS  select `t`.`name` AS `name`,`w`.`id` AS `id`,`t`.`id` AS `tagId`,`w`.`text` AS `text`,`w`.`date` AS `date`,`w`.`weeknr` AS `weeknr` from ((`tags` `t` join `weekloggr_tags` `wt` on((`wt`.`tag_id` = `t`.`id`))) join `weekloggr` `w` on((`w`.`id` = `wt`.`weekloggr_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekloggr`
--
ALTER TABLE `weekloggr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  ADD KEY `weekloggr_tags_weekloggr` (`weekloggr_id`),
  ADD KEY `weekloggr_tags_tags` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `weekloggr`
--
ALTER TABLE `weekloggr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
