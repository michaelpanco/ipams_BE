# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 172.30.1.5 (MySQL 5.7.18-0ubuntu0.16.04.1)
# Database: ipams
# Generation Time: 2021-08-12 18:55:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;

INSERT INTO `accounts` (`id`, `username`, `name`, `password`, `created_at`, `updated_at`)
VALUES
	(1,'sampleuser','John Doe','$2y$10$bjP1WmIqMO7MOFu4ZgTOy.qLSm7RqUh.A.FgMwtN9A60Isjvu6K/a','2021-08-18 00:00:00','2021-08-18 00:00:00');

/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ip_addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ip_addresses`;

CREATE TABLE `ip_addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(64) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ip_addresses` WRITE;
/*!40000 ALTER TABLE `ip_addresses` DISABLE KEYS */;

INSERT INTO `ip_addresses` (`id`, `account_id`, `ip_address`, `label`, `created_at`, `updated_at`)
VALUES
	(1,1,'192.168.0.444','Michaelsss222','2021-12-12 00:00:00','2021-08-12 16:00:04'),
	(2,1,'192.168.0.1','Michaelsss','2021-12-12 00:00:00','2021-08-12 16:39:07'),
	(3,1,'192.168.0.1','Michael','2021-08-12 13:59:46','2021-08-12 15:15:57'),
	(4,1,'192.168.0.1','Michael','2021-08-12 14:00:12','2021-08-12 14:00:12'),
	(5,1,'192.168.0.1','Mija','2021-08-12 14:01:39','2021-08-12 15:26:39'),
	(6,1,'192.168.0.1','Michael','2021-08-12 14:01:41','2021-08-12 14:01:41'),
	(7,1,'192.168.0.1','Michael','2021-08-12 14:02:58','2021-08-12 14:02:58'),
	(8,1,'192.168.0.1','Michael','2021-08-12 14:03:07','2021-08-12 14:03:07'),
	(9,1,'192.168.0.1','Michael','2021-08-12 14:03:19','2021-08-12 14:03:19'),
	(10,1,'192.168.0.1','Michael','2021-08-12 14:03:20','2021-08-12 14:03:20'),
	(11,1,'192.168.0.1','Michael','2021-08-12 14:03:21','2021-08-12 14:03:21'),
	(12,1,'192.168.0.1','Michael','2021-08-12 14:06:21','2021-08-12 14:06:21'),
	(13,1,'192.168.0.1','Michael','2021-08-12 14:08:28','2021-08-12 14:08:28'),
	(14,1,'192.168.0.1','Michael','2021-08-12 14:08:30','2021-08-12 14:08:30'),
	(15,1,'sdf','as','2021-08-12 16:47:40','2021-08-12 16:47:40'),
	(16,1,'192.186.0.1','Manei','2021-08-12 16:51:05','2021-08-12 16:51:05'),
	(17,1,'192.178.5.55','sadas asd','2021-08-12 16:52:08','2021-08-12 16:52:08'),
	(18,1,'192.144.22.12','Michael Panco','2021-08-12 16:54:20','2021-08-12 16:54:20'),
	(19,1,'192.323.43','Mdsad hh','2021-08-12 16:54:33','2021-08-12 16:54:33'),
	(20,1,'192.344.233.21','Michael Panco','2021-08-12 16:55:05','2021-08-12 16:55:05'),
	(21,1,'192.334.33.234','New IP Address','2021-08-12 16:56:08','2021-08-12 16:56:26'),
	(22,1,'192.168.0.133','sadasd','2021-08-12 17:24:17','2021-08-12 17:31:32'),
	(23,1,'192.3.3.3','ddd','2021-08-12 17:24:31','2021-08-12 17:24:31'),
	(24,1,'192.33.3.1','ID 24 Label','2021-08-12 17:24:56','2021-08-12 18:00:01'),
	(25,1,'192.168.12.12','Hello','2021-08-12 18:00:21','2021-08-12 18:06:08'),
	(26,1,'192.168.0.12','Hello World','2021-08-12 18:06:43','2021-08-12 18:23:59');

/*!40000 ALTER TABLE `ip_addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `meta` text,
  `account_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;

INSERT INTO `logs` (`id`, `type`, `message`, `meta`, `account_id`, `created_at`)
VALUES
	(1,'LOGSUC','Login Success',NULL,1,'2021-08-12 17:57:04'),
	(2,'UPTIPA','Update IP Address',NULL,1,'2021-08-12 18:00:01'),
	(3,'CRTIPA','Created IP Address',NULL,1,'2021-08-12 18:00:21'),
	(4,'LOGSUC','Login Success',NULL,1,'2021-08-12 18:04:45'),
	(5,'LOGSUC','Login Success','a:0:{}',1,'2021-08-12 18:05:14'),
	(6,'UPTIPA','Updated an IP Address','a:2:{s:3:\"old\";a:2:{s:10:\"ip_address\";s:12:\"192.168.12.1\";s:5:\"label\";s:5:\"Hello\";}s:3:\"new\";a:2:{s:10:\"ip_address\";s:13:\"192.168.12.12\";s:5:\"label\";s:5:\"Hello\";}}',1,'2021-08-12 18:06:08'),
	(7,'CRTIPA','Created an IP Address','a:2:{s:10:\"ip_address\";s:11:\"192.168.0.1\";s:5:\"label\";s:5:\"Hello\";}',1,'2021-08-12 18:06:43'),
	(8,'UPTIPA','Updated an IP Address','a:2:{s:3:\"old\";a:2:{s:10:\"ip_address\";s:11:\"192.168.0.1\";s:5:\"label\";s:5:\"Hello\";}s:3:\"new\";a:2:{s:10:\"ip_address\";s:12:\"192.168.0.12\";s:5:\"label\";s:5:\"Hello\";}}',1,'2021-08-12 18:09:35'),
	(9,'LOGSUC','Login Success','a:0:{}',1,'2021-08-12 18:22:50'),
	(10,'UPTIPA','Updated an IP Address','a:2:{s:3:\"old\";a:2:{s:10:\"ip_address\";s:12:\"192.168.0.12\";s:5:\"label\";s:5:\"Hello\";}s:3:\"new\";a:2:{s:10:\"ip_address\";s:12:\"192.168.0.12\";s:5:\"label\";s:5:\"Hello\";}}',1,'2021-08-12 18:23:03'),
	(11,'UPTIPA','Updated an IP Address','a:2:{s:3:\"old\";a:2:{s:10:\"ip_address\";s:12:\"192.168.0.12\";s:5:\"label\";s:5:\"Hello\";}s:3:\"new\";a:2:{s:10:\"ip_address\";s:12:\"192.168.0.12\";s:5:\"label\";s:11:\"Hello World\";}}',1,'2021-08-12 18:23:59'),
	(12,'LOGSUC','Login Success','a:0:{}',1,'2021-08-12 18:26:35');

/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
