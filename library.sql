-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2014 at 10:48 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` varchar(20) NOT NULL,
  `author_name` varchar(60) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `isbn` int(20) NOT NULL,
  `publisher_id` varchar(20) NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `year_published` int(4) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_faculty`
--

CREATE TABLE IF NOT EXISTS `loan_faculty` (
  `loan_id` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `faculty_id` varchar(10) NOT NULL,
  `date_out` char(10) NOT NULL,
  `date_expected` char(10) NOT NULL,
  `date_returned` char(10) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_stud`
--

CREATE TABLE IF NOT EXISTS `loan_stud` (
  `loan_id` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `date_out` char(10) NOT NULL,
  `date_expected` char(10) NOT NULL,
  `date_returned` char(10) NOT NULL,
  `fine` int(5) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisher_id` varchar(20) NOT NULL,
  `publisher_name` varchar(60) NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `faculty_id` varchar(20) NOT NULL,
  `full_name` char(60) NOT NULL,
  `department` char(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `position_no` int(2) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
