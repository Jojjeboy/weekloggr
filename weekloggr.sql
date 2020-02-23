-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2020 at 04:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `weekloggr`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(25) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'archiveOld', '0'),
(2, 'archiveAfter', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tags_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tags_id`, `name`) VALUES
(17, '#ers'),
(18, '#handbas'),
(99, '#scrum'),
(100, '#hashtags');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `todo_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_sticky` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `text`, `status`, `is_sticky`) VALUES
(1, 'Bjud in taif till demoplanering', 1, 0),
(3, 'Nu provar vi igennnnn', 0, 1),
(16, 'nuuuuu jvlr', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `todo_tags`
--

DROP TABLE IF EXISTS `todo_tags`;
CREATE TABLE `todo_tags` (
  `todo_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_todo_tags`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `v_todo_tags`;
CREATE TABLE `v_todo_tags` (
`todo_id` int(11)
,`text` text
,`status` tinyint(1)
,`is_sticky` tinyint(1)
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_weekloggr_tags`
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
-- Table structure for table `weekloggr`
--

DROP TABLE IF EXISTS `weekloggr`;
CREATE TABLE `weekloggr` (
  `weekloggr_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `weeknr` tinyint(2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekloggr`
--

INSERT INTO `weekloggr` (`weekloggr_id`, `date`, `text`, `weeknr`, `is_visible`) VALUES
(1, '2020-01-20', 'Bokat daily #ers #scrum', 4, 1),
(3, '2020-01-26', 'Ringt samtal #handbas #scrum', 5, 1),
(13, '2020-02-02', 'Nu provar vi med lite #hashtags #ers #handbas', 6, 1),
(17, '2020-02-23', 'Bjud in taif till demoplanering', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `weekloggr_tags`
--

DROP TABLE IF EXISTS `weekloggr_tags`;
CREATE TABLE `weekloggr_tags` (
  `weekloggr_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekloggr_tags`
--

INSERT INTO `weekloggr_tags` (`weekloggr_id`, `tags_id`) VALUES
(1, 17),
(13, 17),
(3, 18),
(13, 18),
(1, 99),
(3, 99),
(13, 100);

-- --------------------------------------------------------

--
-- Structure for view `v_todo_tags`
--
DROP TABLE IF EXISTS `v_todo_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_todo_tags`  AS  select `t`.`todo_id` AS `todo_id`,`t`.`text` AS `text`,`t`.`status` AS `status`,`t`.`is_sticky` AS `is_sticky`,`ta`.`name` AS `name` from ((`todo` `t` join `todo_tags` `tt` on((`t`.`todo_id` = `tt`.`todo_id`))) join `tags` `ta` on((`tt`.`tags_id` = `ta`.`tags_id`))) order by `t`.`is_sticky` desc,`t`.`status`,`t`.`todo_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_weekloggr_tags`
--
DROP TABLE IF EXISTS `v_weekloggr_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_weekloggr_tags`  AS  select `w`.`weekloggr_id` AS `weekloggr_id`,`w`.`text` AS `text`,`w`.`date` AS `date`,`w`.`weeknr` AS `weeknr`,`w`.`is_visible` AS `is_visible`,`t`.`name` AS `name` from ((`weekloggr` `w` join `weekloggr_tags` `wt` on((`w`.`weekloggr_id` = `wt`.`weekloggr_id`))) join `tags` `t` on((`wt`.`tags_id` = `t`.`tags_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Indexes for table `todo_tags`
--
ALTER TABLE `todo_tags`
  ADD PRIMARY KEY (`todo_id`,`tags_id`),
  ADD KEY `tags_id_idx_1` (`tags_id`);

--
-- Indexes for table `weekloggr`
--
ALTER TABLE `weekloggr`
  ADD PRIMARY KEY (`weekloggr_id`);

--
-- Indexes for table `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  ADD PRIMARY KEY (`weekloggr_id`,`tags_id`),
  ADD KEY `tags_id_idx` (`tags_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `weekloggr`
--
ALTER TABLE `weekloggr`
  MODIFY `weekloggr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo_tags`
--
ALTER TABLE `todo_tags`
  ADD CONSTRAINT `tags_id_1` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`tags_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `todo_id` FOREIGN KEY (`todo_id`) REFERENCES `todo` (`todo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `weekloggr_tags`
--
ALTER TABLE `weekloggr_tags`
  ADD CONSTRAINT `tags_id` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`tags_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `weekloggr_id` FOREIGN KEY (`weekloggr_id`) REFERENCES `weekloggr` (`weekloggr_id`) ON DELETE CASCADE ON UPDATE CASCADE;
