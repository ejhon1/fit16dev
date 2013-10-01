-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2013 at 10:20 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbtrial`
--

-- --------------------------------------------------------

--
-- Table structure for table `casestatuses`
--

CREATE TABLE IF NOT EXISTS `casestatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientcase_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientcase_id` (`clientcase_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `casestatuses`
--

INSERT INTO `casestatuses` (`id`, `clientcase_id`, `status_id`, `date_updated`, `employee_id`) VALUES
(1, 424, 8, '2013-09-29 00:00:00', 6),
(2, 424, 6, '2013-09-30 00:00:00', 6),
(3, 424, 6, '2013-09-30 00:00:00', 6),
(4, 424, 7, '2013-09-30 00:00:00', 6),
(5, NULL, 7, '2013-09-30 00:00:00', NULL),
(6, NULL, 10, '2013-09-30 00:00:00', NULL),
(7, NULL, 4, '2013-09-30 00:00:00', NULL),
(8, 424, 7, '2013-09-30 00:00:00', 6),
(9, 424, 9, '2013-09-30 00:00:00', 6),
(10, 424, 10, '2013-09-30 00:00:00', 6),
(11, 424, 5, '2013-09-30 00:00:00', 6),
(12, 424, 5, '2013-09-30 00:00:00', 6),
(13, 424, 4, '2013-09-30 00:00:00', 6),
(14, 424, 9, '2013-09-30 00:00:00', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
