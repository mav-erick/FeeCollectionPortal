-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2015 at 03:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_title`
--

CREATE TABLE IF NOT EXISTS `page_title` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `hits` bigint(20) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `submember` int(4) NOT NULL,
  `rank` int(2) unsigned NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashier`
--

CREATE TABLE IF NOT EXISTS `tbl_cashier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `transactions` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `position` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_cashier`
--

INSERT INTO `tbl_cashier` (`id`, `name`, `transactions`, `total`, `position`) VALUES
(1, 'Adrish Banerjee', 0, 0, 'Head Cashier'),
(2, 'Akash Dubey', 7, 15000, 'Cashier'),
(3, 'Abhishek Vijayan ', 21, 21000, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fees`
--

CREATE TABLE IF NOT EXISTS `tbl_fees` (
  `exam` int(11) NOT NULL,
  `admission` int(11) NOT NULL,
  `tuition` int(11) NOT NULL,
  `infrastructure` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fees`
--

INSERT INTO `tbl_fees` (`exam`, `admission`, `tuition`, `infrastructure`, `late`, `fid`, `class`) VALUES
(100, 300, 500, 400, 50, 125, 10),
(100, 500, 600, 400, 50, 126, 11),
(100, 10000, 700, 400, 50, 127, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(60) NOT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `ip_addr` varchar(15) NOT NULL,
  `uptime` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `email`, `password`, `is_admin`, `status`, `ip_addr`, `uptime`) VALUES
(2, 'admin', '$2y$11$cW.dCZHV9HrOxVYMjw/c2O7NRHz4MlRiXA.GB.DMdbxeLpmqfMvCW', 1, 1, '::1', '2015-03-27 19:12:28'),
(3, 'abhi', '$2y$11$fgUJ5VfAYDJJ0.PyGogviuq4ImPl.2uNxnHJ/eFHTTVXir0V.cU5.', 0, 1, '::1', '2015-01-03 00:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reciept`
--

CREATE TABLE IF NOT EXISTS `tbl_reciept` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `admno` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scholarship`
--

CREATE TABLE IF NOT EXISTS `tbl_scholarship` (
  `sid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `discount` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_scholarship`
--

INSERT INTO `tbl_scholarship` (`sid`, `name`, `discount`, `description`) VALUES
(1, 'Inspire', 700, 'One reason people lie is to achieve personal power. Achieving personal power is helpful for someone who pretends to be more confident than he really is. For example, one of my friends threw a party at his house last month. He asked me to come to his party and bring a date. However, I didn’t have a girlfriend. One of my other friends, who had a date to go to the party with, asked me about my date. I didn’t want to be embarrassed, so I claimed that I had a lot of work to do. I said I could easily find a date even better than his if I wanted to. I also told him that his date was ugly. I achieved power to help me feel confident; however, I embarrassed my friend and his date. Although this lie helped me at the time, since then it has made me look down on myself.'),
(2, 'Go Helly', 1000, 'Money causes teenagers to feel stress. It makes them feel bad about themselves and envy other people. My friend, for instance, lives with her family and has to share a room with her sister, who is very cute and intelligent. This girl wishes she could have her own room and have a lot of stuff, but she can’t have these things because her family doesn’t have much money. Her family’s income is pretty low because her father is old and doesn’t go to work. Her sister is the only one who works. Because her family can’t buy her the things she wants, she feels a lot of stress and gets angry sometimes. Once, she wanted a beautiful dress to wear to a sweetheart dance. She asked her sister for some money to buy the dress. She was disappointed because her sister didn’t have money to give her. She sat in silence for a little while and then started yelling out loud. She said her friends got anything they wanted but she didn’t. Then she felt sorry for herself and asked why she was born into a poor family. Not having money has caused this girl to think negatively about herself and her family. It has caused a lot of stress in her life.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `name` varchar(128) NOT NULL,
  `admno` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `section` varchar(1) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `q1` tinyint(4) NOT NULL,
  `q2` tinyint(4) NOT NULL,
  `q3` tinyint(4) NOT NULL,
  `q4` tinyint(4) NOT NULL,
  `fid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `admission` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`name`, `admno`, `roll`, `class`, `section`, `sex`, `q1`, `q2`, `q3`, `q4`, `fid`, `sid`, `admission`) VALUES
('Akash Dubey', 5030, 1, 12, 'A', 'M', 1, 1, 0, 0, 2, 2, 1),
('Abhishek Vijayan', 5031, 2, 12, 'D', 'M', 1, 1, 0, 0, 2, 1, 1),
('Adrish Banerjee', 5032, 3, 10, 'C', 'M', 1, 1, 0, 0, 1, 1, 0),
('Juhi Kumari', 9999, 5, 2, 'E', 'F', 0, 0, 0, 0, 7, 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
