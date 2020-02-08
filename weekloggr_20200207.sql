-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 08 feb 2020 kl 15:41
-- Serverversion: 5.7.26
-- PHP-version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databas: `weekloggr`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tags_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Trunkera tabell innan inläggning `tags`
--

TRUNCATE TABLE `tags`;
--
-- Dumpning av Data i tabell `tags`
--

INSERT INTO `tags` (`tags_id`, `name`) VALUES
(17, '#ers'),
(18, '#handbas'),
(19, '#php'),
(20, '#uppdaterad'),
(22, '#nytag'),
(33, '#uppdaterat'),
(99, '#scrum'),
(100, '#hashtags');

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `v_weekloggr_tags`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_weekloggr_tags`;
CREATE TABLE `v_weekloggr_tags` (
`weekloggr_id` int(11)
,`text` text
,`date` date
,`weeknr` tinyint(2)
,`is_visible` tinyint(1)
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabellstruktur `weekloggr`
--

DROP TABLE IF EXISTS `weekloggr`;
CREATE TABLE `weekloggr` (
  `weekloggr_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `weeknr` tinyint(2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `weekloggr_tags`
--

DROP TABLE IF EXISTS `weekloggr_tags`;
CREATE TABLE `weekloggr_tags` (
  `weekloggr_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur för vy `v_weekloggr_tags`
--
DROP TABLE IF EXISTS `v_weekloggr_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_weekloggr_tags`  AS  select `w`.`weekloggr_id` AS `weekloggr_id`,`w`.`text` AS `text`,`w`.`date` AS `date`,`w`.`weeknr` AS `weeknr`,`w`.`is_visible` AS `is_visible`,`t`.`name` AS `name` from ((`weekloggr` `w` join `weekloggr_tags` `wt` on((`w`.`weekloggr_id` = `wt`.`weekloggr_id`))) join `tags` `t` on((`wt`.`tags_id` = `t`.`tags_id`))) ;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Index för tabell `weekloggr`
--
ALTER TABLE `weekloggr`
  ADD PRIMARY KEY (`weekloggr_id`);

--
-- Index för tabell `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  ADD PRIMARY KEY (`weekloggr_id`,`tags_id`),
  ADD KEY `tags_id_idx` (`tags_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `tags`
--
ALTER TABLE `tags`
  MODIFY `tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT för tabell `weekloggr`
--
ALTER TABLE `weekloggr`
  MODIFY `weekloggr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  ADD CONSTRAINT `tags_id` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`tags_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `weekloggr_id` FOREIGN KEY (`weekloggr_id`) REFERENCES `weekloggr` (`weekloggr_id`) ON DELETE CASCADE ON UPDATE CASCADE;
