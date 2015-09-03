-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2015 at 03:25 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `check_login`(IN `username` VARCHAR(100), IN `password` VARCHAR(100))
    READS SQL DATA
SELECT t.team_id as uid, username, p.first_name, p.last_name
FROM podestrian p
JOIN team_member t ON t.podestrian = p.podestrian_id
WHERE t.username = username AND t.password = password$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_podestrians`()
    READS SQL DATA
    COMMENT 'gets all podestrians'
SELECT p.podestrian_id, p.pic, p.first_name, p.last_name, p.email, pt.podestrian_type, a.city, a.country, p.sex, p.facebook, p.twitter, p.instagram, p.birthday, p.how_found
FROM podestrian AS p
	JOIN podestrian_type AS pt
		ON p.podestrian_type_id = pt.podestrian_type_id
	JOIN address AS a
		ON p.address_id = a.address_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_team_members`()
    READS SQL DATA
SELECT t.team_id, p.first_name, p.last_name, t.username, r.role
FROM team_member as t
JOIN podestrian as p ON t.podestrian = p.podestrian_id
JOIN team_member_role as r ON t.role = r.role_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_team_member_roles`()
    READS SQL DATA
SELECT * FROM team_member_role$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_team_member`(IN `team_id` INT(11))
    READS SQL DATA
SELECT team_id, t.username, t.role, p.first_name, p.last_name
FROM team_member as t
JOIN podestrian as p ON t.podestrian = p.podestrian_id
WHERE t.team_id = team_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `update_team_member`(IN `id` INT(11), IN `role_id` INT(11))
    MODIFIES SQL DATA
UPDATE team_member
SET role = role_id
WHERE team_id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `city`, `country`) VALUES
(1, 'Los Angeles', 'United States'),
(2, 'Detroit', 'United States');

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
  `address_id` int(11) DEFAULT NULL,
  `sex` varchar(20) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `podestrian_type_id` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `how_found` varchar(500) NOT NULL,
  PRIMARY KEY (`podestrian_id`),
  UNIQUE KEY `podestrian_number` (`podestrian_number`),
  KEY `address` (`address_id`),
  KEY `podestrian type` (`podestrian_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `podestrian`
--

INSERT INTO `podestrian` (`podestrian_id`, `podestrian_number`, `first_name`, `last_name`, `email`, `address_id`, `sex`, `facebook`, `twitter`, `instagram`, `podestrian_type_id`, `birthday`, `pic`, `how_found`) VALUES
(1, NULL, 'Sleepover', 'Admin', 'pod@pod.pod', 2, 'Not Applicable', 'facebook', 'twitter', 'instagram', 2, '1990-01-01', '', 'internet'),
(3, NULL, 'Brian', 'Smith', 'briaguya@gmail.com', 1, 'Male', '', '', '', 1, '2015-01-01', NULL, ''),
(4, NULL, 'Henry', 'Henry', 'henry@henry@henry', 1, 'Male', '', '', '', 1, '0000-00-00', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `podestrian_type`
--

CREATE TABLE IF NOT EXISTS `podestrian_type` (
  `podestrian_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `podestrian_type` varchar(50) NOT NULL,
  PRIMARY KEY (`podestrian_type_id`),
  UNIQUE KEY `podestrian_type` (`podestrian_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `podestrian_type`
--

INSERT INTO `podestrian_type` (`podestrian_type_id`, `podestrian_type`) VALUES
(1, 'Default'),
(2, 'Not Default');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`team_id`, `podestrian`, `username`, `password`, `role`, `startdate`) VALUES
(1, 1, 'sleepover', 'pod', 1, '2015-09-01'),
(7, 4, 'henry', 'henry', 2, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `team_member_role`
--

CREATE TABLE IF NOT EXISTS `team_member_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `team_member_role`
--

INSERT INTO `team_member_role` (`role_id`, `role`, `description`) VALUES
(1, 'DB Admin', 'Superuser'),
(2, 'Front Desk', 'checkin/out');

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
