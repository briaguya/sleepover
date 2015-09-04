-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2015 at 04:47 PM
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

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_pods`()
    READS SQL DATA
SELECT 
p.pod_id,
p.pod_name,
pt.pod_type,
l.location_name,
CONCAT(l.location_name,' - ',p.pod_name) comboname
FROM pod as p 
JOIN pod_type as pt ON p.pod_type = pt.pod_type_id
JOIN location as l ON p.location_id = l.location_id
ORDER BY l.location_name, p.pod_type, p.pod_name$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_status`()
    READS SQL DATA
SELECT * FROM booking_status order by status_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_team_members`()
    READS SQL DATA
SELECT t.team_id, p.first_name, p.last_name, t.username, r.role
FROM team_member as t
JOIN podestrian as p ON t.podestrian = p.podestrian_id
JOIN team_member_role as r ON t.role = r.role_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_all_team_member_roles`()
    READS SQL DATA
SELECT * FROM team_member_role$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_booking`(IN `booking_id` INT(11))
    READS SQL DATA
SELECT 
booking_id,
ps.podestrian_id,
pd.pod_id,
CONCAT(ps.first_name,' ',ps.last_name) podestrian_name,
b.checkin_datetime,
b.checkout_date
FROM
booking b
JOIN podestrian ps ON b.podestrian = ps.podestrian_id
JOIN pod pd ON b.pod - pd.pod_id
JOIN pod_type pt ON pd.pod_type = pt.pod_type_id
WHERE b.booking_id = booking_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_bookings`()
    READS SQL DATA
SELECT 
b.booking_id,
ps.podestrian_id,
pd.pod_id,
CONCAT(ps.first_name,' ',ps.last_name) podestrian,
CONCAT(pd.pod_name,' - ',pt.pod_type) pod,
b.checkin_datetime,
b.checkout_date
FROM
booking b
JOIN podestrian ps ON b.podestrian = ps.podestrian_id
JOIN pod pd ON b.pod - pd.pod_id
JOIN pod_type pt ON pd.pod_type = pt.pod_type_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_pod`(IN `id` INT(11))
    READS SQL DATA
SELECT id, pod_name, pod_type, location_id
FROM pod
WHERE pod_id = id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `get_team_member`(IN `team_id` INT(11))
    READS SQL DATA
SELECT team_id, t.username, t.role, p.first_name, p.last_name
FROM team_member as t
JOIN podestrian as p ON t.podestrian = p.podestrian_id
WHERE t.team_id = team_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `update_booking`(IN `booking_id` INT(11), IN `pod_id` INT(11), IN `checkout_date` DATE)
    MODIFIES SQL DATA
UPDATE booking as b
SET b.pod = pod_id,
b.checkout_date = checkout_date
WHERE b.booking_id = booking_id$$

CREATE DEFINER=`sleepover`@`localhost` PROCEDURE `update_pod`(IN `id` INT(11), IN `name` VARCHAR(50), IN `type` INT(11))
    MODIFIES SQL DATA
UPDATE pod
SET pod_name = name, pod_type = type
WHERE pod_id = id$$

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
  KEY `podestrian` (`podestrian`),
  KEY `booking_status` (`booking_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `podestrian`, `pod`, `checkin_datetime`, `checkout_date`, `price`, `booking_status`) VALUES
(1, 5, 4, '2015-09-03 11:00:00', '2015-09-05', 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE IF NOT EXISTS `booking_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_status` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `booking_status` (`booking_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`status_id`, `booking_status`) VALUES
(2, 'Booked'),
(5, 'Cancelled'),
(3, 'Checked In'),
(4, 'Checked Out'),
(1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  `location_description` varchar(500) NOT NULL,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_description`, `address_id`) VALUES
(1, 'Default Location', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(4,2) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pod`
--

CREATE TABLE IF NOT EXISTS `pod` (
  `pod_id` int(11) NOT NULL AUTO_INCREMENT,
  `pod_name` varchar(50) NOT NULL,
  `pod_type` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`pod_id`),
  UNIQUE KEY `pod_name` (`pod_name`),
  KEY `pod_type` (`pod_type`),
  KEY `location` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pod`
--

INSERT INTO `pod` (`pod_id`, `pod_name`, `pod_type`, `location_id`) VALUES
(4, 'Pod 2', 1, 1),
(5, 'Pod 1', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `podestrian`
--

INSERT INTO `podestrian` (`podestrian_id`, `podestrian_number`, `first_name`, `last_name`, `email`, `address_id`, `sex`, `facebook`, `twitter`, `instagram`, `podestrian_type_id`, `birthday`, `pic`, `how_found`) VALUES
(1, NULL, 'Sleepover', 'Admin', 'pod@pod.pod', 2, 'Not Applicable', 'facebook', 'twitter', 'instagram', 2, '1990-01-01', '', 'internet'),
(5, NULL, 'First', 'Customer', 'first@cust.omer', 1, 'Female', '', '', '', 1, '1995-01-01', NULL, '');

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
  ADD CONSTRAINT `booking must have status` FOREIGN KEY (`booking_status`) REFERENCES `booking_status` (`status_id`),
  ADD CONSTRAINT `booking must have pod` FOREIGN KEY (`pod`) REFERENCES `pod` (`pod_id`),
  ADD CONSTRAINT `booking must have podestrian` FOREIGN KEY (`podestrian`) REFERENCES `podestrian` (`podestrian_id`);

--
-- Constraints for table `pod`
--
ALTER TABLE `pod`
  ADD CONSTRAINT `pod must have location` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
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
