-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2015 at 11:23 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nee_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation_alternates`
--

/*CREATE TABLE IF NOT EXISTS `reservation_alternates` (
`id` int(10) NOT NULL,
  `reservation_code` varchar(30) NOT NULL,
  `alternate_code` varchar(30) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;*/

--
-- Dumping data for table `reservation_alternates`
--

INSERT INTO `nee_reservation_alternates` (`reservation_code`, `alternate_code`) VALUES
('1109', '9209'),
('1109', '9201'),
('1211', '9201'),
('1211', '9202'),
('1211', '9203'),
('1211', '9209'),
('1212', '9201'),
('1212', '9202'),
('1212', '9203'),
('1212', '9209'),
('1213', '9201'),
('1213', '9202'),
('1213', '9203'),
('1213', '9209'),
('2102', '9201'),
('2102', '2101'),
('2102', '9202'),
('2103', '9201'),
('2103', '2101'),
('2103', '9203'),
('2104', '9201'),
('2104', '2101'),
('2104', '9209'),
('2105', '9201'),
('2105', '2101'),
('2105', '9209'),
('2210', '9201'),
('3101', '9201'),
('3102', '9201'),
('3102', '3101'),
('3102', '9202'),
('3103', '9201'),
('3103', '3101'),
('3103', '9203'),
('3109', '9201'),
('3109', '3101'),
('3109', '9209'),
('4101', '9201'),
('4106', '9201'),
('4106', '4101'),
('4107', '9201'),
('4107', '4101'),
('4108', '4101'),
('4108', '9209'),
('5101', '9201'),
('5109', '9201'),
('5109', '5101'),
('5109', '9209'),
('5201', '9201'),
('6101', '9201'),
('6109', '9201'),
('6109', '6101'),
('6109', '9209'),
('6201', '9201'),
('7101', '9201'),
('7102', '9201'),
('7102', '7101'),
('7102', '9202'),
('7103', '9201'),
('7103', '7101'),
('7103', '9203'),
('7109', '9201'),
('7109', '7101'),
('7109', '9209'),
('7114', '9201'),
('7114', '7101'),
('7115', '9201'),
('7115', '7101'),
('7216', '9201'),
('5101', '9202'),
('8101', '9201'),
('8103', '9201'),
('8103', '8101'),
('8103', '9203'),
('8109', '9201'),
('8109', '8101'),
('8109', '9209'),
('9202', '9201'),
('9203', '9201'),
('9209', '9201'),
('5201', '9202'),
('5201', '9203'),
('5201', '9209'),
('7216', '9202'),
('7216', '9203'),
('2210', '9202'),
('5101', '9203'),
('2210', '9203'),
('2210', '9209'),
('5101', '9209'),
('4108', '9201'),
('4108', '9203'),
('4101', '9202'),
('4101', '9203'),
('4101', '9209'),
('7216', '9209'),
('6201', '9202'),
('6201', '9203');
('6201', '9209');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation_alternates`
--
/*ALTER TABLE `reservation_alternates`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation_alternates`
--
ALTER TABLE `reservation_alternates`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
