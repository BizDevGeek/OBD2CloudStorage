-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2014 at 12:30 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `obdapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

DROP TABLE IF EXISTS `gps`;
CREATE TABLE IF NOT EXISTS `gps` (
  `uid` int(11) DEFAULT NULL,
  `lat` float(10,6) unsigned NOT NULL COMMENT 'latitude',
  `NS` char(1) NOT NULL COMMENT 'North or South (n,s)',
  `lon` float(10,6) unsigned NOT NULL COMMENT 'longitude',
  `EW` char(1) NOT NULL COMMENT 'East or Weast (E,W)',
  `EventDate` datetime NOT NULL COMMENT 'local user''s datetime of the event',
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'generic key field',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=260980 ;

-- --------------------------------------------------------

--
-- Table structure for table `readings`
--

DROP TABLE IF EXISTS `readings`;
CREATE TABLE IF NOT EXISTS `readings` (
  `APIKey` varchar(200) NOT NULL,
  `PID` varchar(2) NOT NULL,
  `PIDValue` varchar(50) NOT NULL,
  `EventDate` datetime DEFAULT NULL,
  `EventMilliseconds` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118306 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `APIKey` varchar(200) NOT NULL,
  `dtAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'defaults to the date the record was created in the table. It exists for convenience and debugging.',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
