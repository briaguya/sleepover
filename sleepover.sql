-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2015 at 11:04 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sleepover`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `city`, `country`) VALUES
(1, 'Los Angeles', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `podestrian` int(11) NOT NULL,
  `pod` int(11) NOT NULL,
  `checkin_datetime` datetime NOT NULL,
  `checkout_date` date NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `booking_status` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `pod` (`pod`),
  KEY `podestrian` (`podestrian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE IF NOT EXISTS `booking_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_status` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `booking_status` (`booking_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pod`
--

CREATE TABLE IF NOT EXISTS `pod` (
  `pod_id` int(11) NOT NULL AUTO_INCREMENT,
  `pod_name` varchar(50) NOT NULL,
  `pod_type` int(11) NOT NULL,
  PRIMARY KEY (`pod_id`),
  UNIQUE KEY `pod_name` (`pod_name`),
  KEY `pod_type` (`pod_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pod`
--

INSERT INTO `pod` (`pod_id`, `pod_name`, `pod_type`) VALUES
(3, 'Pod 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `podestrian`
--

CREATE TABLE IF NOT EXISTS `podestrian` (
  `podestrian_id` int(11) NOT NULL AUTO_INCREMENT,
  `podestrian_number` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(500) NOT NULL,
  `address_id` int(11) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `podestrian_type_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `pic` varchar(50) NOT NULL,
  `how_found` varchar(500) NOT NULL,
  PRIMARY KEY (`podestrian_id`),
  UNIQUE KEY `podestrian_number` (`podestrian_number`),
  KEY `address` (`address_id`),
  KEY `podestrian type` (`podestrian_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `podestrian`
--

INSERT INTO `podestrian` (`podestrian_id`, `podestrian_number`, `first_name`, `last_name`, `email`, `address_id`, `sex`, `facebook`, `twitter`, `instagram`, `podestrian_type_id`, `birthday`, `pic`, `how_found`) VALUES
(1, NULL, 'Sleepover', 'Admin', 'pod@pod.pod', 1, 'None', '', '', '', 1, '1990-01-01', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `podestrian_type`
--

CREATE TABLE IF NOT EXISTS `podestrian_type` (
  `podestrian_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `podestrian_type` varchar(50) NOT NULL,
  PRIMARY KEY (`podestrian_type_id`),
  UNIQUE KEY `podestrian_type` (`podestrian_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `podestrian_type`
--

INSERT INTO `podestrian_type` (`podestrian_type_id`, `podestrian_type`) VALUES
(1, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `pod_type`
--

CREATE TABLE IF NOT EXISTS `pod_type` (
  `pod_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `pod_type` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`pod_type_id`),
  UNIQUE KEY `pod_type` (`pod_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pod_type`
--

INSERT INTO `pod_type` (`pod_type_id`, `pod_type`, `description`) VALUES
(1, 'Pod', 'Standard Pod'),
(2, 'Queen', ''),
(3, 'Air Pod', '');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE IF NOT EXISTS `team_member` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `podestrian` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `startdate` date NOT NULL,
  PRIMARY KEY (`team_id`),
  UNIQUE KEY `podestrian` (`podestrian`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`team_id`, `podestrian`, `username`, `password`, `role`, `startdate`) VALUES
(1, 1, 'sleepover', 'pod', 1, '2015-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `team_member_role`
--

CREATE TABLE IF NOT EXISTS `team_member_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `team_member_role`
--

INSERT INTO `team_member_role` (`role_id`, `role`, `description`) VALUES
(1, 'DB Admin', 'Superuser');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking must have pod` FOREIGN KEY (`pod`) REFERENCES `pod` (`pod_id`),
  ADD CONSTRAINT `booking must have podestrian` FOREIGN KEY (`podestrian`) REFERENCES `podestrian` (`podestrian_id`);

--
-- Constraints for table `pod`
--
ALTER TABLE `pod`
  ADD CONSTRAINT `pod must have pod type` FOREIGN KEY (`pod_type`) REFERENCES `pod_type` (`pod_type_id`);

--
-- Constraints for table `podestrian`
--
ALTER TABLE `podestrian`
  ADD CONSTRAINT `podestrian must have address` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `podestrian must have type` FOREIGN KEY (`podestrian_type_id`) REFERENCES `podestrian_type` (`podestrian_type_id`);

--
-- Constraints for table `team_member`
--
ALTER TABLE `team_member`
  ADD CONSTRAINT `team member must have podestrian` FOREIGN KEY (`podestrian`) REFERENCES `podestrian` (`podestrian_id`),
  ADD CONSTRAINT `team member must have role` FOREIGN KEY (`role`) REFERENCES `team_member_role` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
