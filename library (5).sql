-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2014 at 08:33 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` varchar(20) NOT NULL DEFAULT 'auth_',
  `author_name` varchar(60) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
('auth_1', 'HC Verma'),
('auth_2', 'Chetan Bhagat');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(20) NOT NULL AUTO_INCREMENT,
  `copy_id` varchar(20) NOT NULL DEFAULT 'copy_',
  `date_arrived` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `copy_id`, `date_arrived`) VALUES
(9, 'copy_2', '2014-10-06 06:20:19'),
(10, 'copy_2', '2014-10-06 06:20:19'),
(11, 'copy_3', '2014-10-06 06:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `book_copy`
--

CREATE TABLE IF NOT EXISTS `book_copy` (
  `copy_id` varchar(20) NOT NULL DEFAULT 'copy_',
  `title` varchar(50) NOT NULL,
  `publisher_id` varchar(20) NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `year_published` int(4) NOT NULL,
  `copies` int(3) NOT NULL,
  `count` varchar(100) NOT NULL,
  PRIMARY KEY (`copy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_copy`
--

INSERT INTO `book_copy` (`copy_id`, `title`, `publisher_id`, `author_id`, `year_published`, `copies`, `count`) VALUES
('copy_2', 'concepts of physics', 'pub_1', 'auth_1', 2007, 2, '0'),
('copy_3', 'half girlfriend', 'pub_2', 'auth_2', 2014, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `loan_faculty`
--

CREATE TABLE IF NOT EXISTS `loan_faculty` (
  `loan_id` varchar(20) NOT NULL DEFAULT 'fac_',
  `book_id` varchar(20) NOT NULL,
  `faculty_id` varchar(10) NOT NULL,
  `date_out` date NOT NULL,
  `date_expected` date NOT NULL,
  `date_returned` date NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_stud`
--

CREATE TABLE IF NOT EXISTS `loan_stud` (
  `loan_id` int(20) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(20) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `date_out` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_expected` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `fine` int(5) DEFAULT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `loan_stud`
--

INSERT INTO `loan_stud` (`loan_id`, `book_id`, `roll_no`, `date_out`, `date_expected`, `date_returned`, `fine`) VALUES
(1, '1', '12118016', '2014-11-12 16:41:23', '2015-01-16', NULL, NULL),
(2, '1', '12118016', '2014-11-12 16:41:28', '2015-01-16', NULL, NULL),
(3, '1', '12118016', '2014-11-12 16:41:31', '2015-01-16', NULL, NULL),
(4, '1', '12118016', '2014-11-12 16:41:35', '2015-01-16', NULL, NULL),
(51, '1', '12118016', '2014-11-12 16:42:42', '2015-01-16', NULL, NULL),
(52, '1', '12118016', '2014-11-12 16:42:42', '2015-01-16', NULL, NULL),
(53, '9', '12118058', '2014-11-12 18:49:27', '2015-01-16', NULL, NULL),
(54, '10', '12118070', '2014-11-12 18:50:53', '2015-01-16', NULL, NULL),
(55, '9', '12118058', '2014-11-12 18:59:32', '2015-01-16', NULL, NULL),
(56, '9', '12118058', '2014-11-12 19:00:47', '2015-01-16', NULL, NULL),
(57, '9', '12118058', '2014-11-12 19:00:49', '2015-01-16', NULL, NULL),
(58, '9', '12118058', '2014-11-12 19:01:05', '2015-01-16', NULL, NULL),
(59, '9', '12118058', '2014-11-12 19:03:55', '2015-01-16', NULL, NULL),
(60, '9', '12118058', '2014-11-12 19:04:35', '2015-01-16', NULL, NULL),
(61, '9', '12118058', '2014-11-12 19:05:29', '2015-01-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisher_id` varchar(20) NOT NULL DEFAULT 'pub_',
  `publisher_name` varchar(60) NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`) VALUES
('pub_1', 'Bharti Bhavan'),
('pub_2', 'Pearson');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `roll_no` varchar(10) NOT NULL,
  `full_name` char(60) NOT NULL,
  `department` char(50) NOT NULL,
  `semester` int(2) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`roll_no`, `full_name`, `department`, `semester`, `email`, `password`) VALUES
('12118001', 'Aayush Agrawal', 'Information Technology', 5, 'agfhgf@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('12118016', 'Arnab Banerjee', 'Information Technology', 5, 'arnab@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('12118058', 'Rahul Dewangan', 'Information Technology', 5, 'rahul@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('12118070', 'Saurabh Gupta', 'Information Technology', 5, 'saurabhz@outlook.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('12118901', 'Avijeet Mandloi', 'Information Technology', 5, 'dgjgjg@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `faculty_id` varchar(20) NOT NULL,
  `full_name` char(60) NOT NULL,
  `department` char(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `position_no` int(2) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`faculty_id`, `full_name`, `department`, `email`, `password`, `position_no`) VALUES
('1', 'arnab', 'Information Technology', 'asd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
