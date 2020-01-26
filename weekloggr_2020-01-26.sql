# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Värd: localhost (MySQL 5.7.26)
# Databas: weekloggr
# Genereringstid: 2020-01-26 14:27:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Tabelldump tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Tabelldump weekloggr
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weekloggr`;

CREATE TABLE `weekloggr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `weeknr` tinyint(2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Tabelldump weekloggr_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `weekloggr_tags`;

CREATE TABLE `weekloggr_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weekloggr_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `weekloggr_tags_weekloggr` (`weekloggr_id`),
  KEY `weekloggr_tags_tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Tabelldump weekloggr_with_tags
# ------------------------------------------------------------

DROP VIEW IF EXISTS `weekloggr_with_tags`;

CREATE TABLE `weekloggr_with_tags` (
   `name` VARCHAR(255) NOT NULL DEFAULT '',
   `id` INT(11) NOT NULL DEFAULT '0',
   `text` TEXT NOT NULL,
   `date` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
   `weeknr` TINYINT(2) NOT NULL
) ENGINE=MyISAM;





# Replace placeholder table for weekloggr_with_tags with correct view syntax
# ------------------------------------------------------------

DROP TABLE `weekloggr_with_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `weekloggr_with_tags`
AS SELECT
   `t`.`name` AS `name`,
   `w`.`id` AS `id`,
   `t.id` as `tagId`,
   `w`.`text` AS `text`,
   `w`.`date` AS `date`,
   `w`.`weeknr` AS `weeknr`
FROM ((`tags` `t` join `weekloggr_tags` `wt` on((`wt`.`tag_id` = `t`.`id`))) join `weekloggr` `w` on((`w`.`id` = `wt`.`weekloggr_id`)));

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
