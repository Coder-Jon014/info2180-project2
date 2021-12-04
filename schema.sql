-- MySQL dump 10.11
--
-- to install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME schema < schema.sql
--
-- Host: localhost    Database: bugme
-- ------------------------------------------------------
-- Server version   5.0.45-log


DROP DATABASE IF EXISTS bugme;
CREATE DATABASE bugme;
USE bugme;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_joined` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4000 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`) VALUES ('Group','2','$2y$10$cvsH.RtQIYP.aSDLKThywe5AymIUgnwM8z/q1Q/N3YmyPcpnTNxfi','admin@project2.com');
UNLOCK TABLES;



--
-- Table structure for table `issues`
--
DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`description` text NOT NULL,
`type` varchar(255) NOT NULL,
`priority` varchar(255) NOT NULL,
`status` varchar(255) NOT NULL,
`assigned_to` text NOT NULL,
`created_by` text NOT NULL,
`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=400 DEFAULT CHARSET=utf8;
