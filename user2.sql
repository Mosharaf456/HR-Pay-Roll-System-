-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 10:18 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user2`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(18) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(57) NOT NULL,
  `password` varchar(30) NOT NULL,
  `age` varchar(40) NOT NULL,
  `join_date` varchar(55) NOT NULL,
  `quality` varchar(90) NOT NULL,
  `address` varchar(90) NOT NULL,
  `salary` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `age`, `join_date`, `quality`, `address`, `salary`) VALUES
(17, 'RIFAT', 'rifat@gmail.com', 'rifat', '2020-08-11', '2019-07-12', 'Cse', 'Dhaka', '999999999'),
(18, 'sifat', 'sifat@gmail.com', 'sifat', '2020-08-13', '2020-08-11', 'CSE', 'Dhaka', '85757576'),
(19, 'Neon', 'neon@gmail.com', 'neon', '1990-12-22', '2016-05-22', 'SE', 'Dhaka', '9876544'),
(20, 'Chayon', 'chayon@gmail.com', 'chayon', '1999-01-03', '2014-05-23', 'CSE', 'Dhaka', '88778766'),
(21, 'Raihan', 'raihan@gmail.com', 'raihan', '1996-06-25', '2019-03-23', 'BBA', 'BBaria', '555555555'),
(22, 'Sajib', 'sajib@gmail.com', 'sajib', '2002-08-13', '2010-02-22', 'BBA', 'Narsingdi', '35353'),
(23, 'Rahat', 'rahat@gmail.com', 'rahat', '1995-04-22', '2010-02-11', 'CSE', 'Dhaka', '857576');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `join_date` varchar(55) NOT NULL,
  `address` varchar(90) NOT NULL,
  `gender` varchar(28) NOT NULL,
  `age` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`id`, `name`, `email`, `password`, `phoneNumber`, `join_date`, `address`, `gender`, `age`) VALUES
(3, 'HR', 'hr@gmail.com', 'hr', '01735467896', '1990-08-28', 'Bashundhara,Dhaka', 'Male', '35');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(15) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(16) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`) VALUES
(3, 'HR', 'hr@gmail.com', 'hr', 'hr'),
(17, 'RIFAT', 'rifat@gmail.com', 'rifat', 'employee'),
(18, 'sifat', 'sifat@gmail.com', 'sifat', 'employee'),
(19, 'Neon', 'neon@gmail.com', 'neon', 'employee'),
(20, 'Chayon', 'chayon@gmail.com', 'chayon', 'employee'),
(21, 'Raihan', 'raihan@gmail.com', 'raihan', 'employee'),
(22, 'Sajib', 'sajib@gmail.com', 'sajib', 'employee'),
(23, 'Rahat', 'rahat@gmail.com', 'rahat', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(57) NOT NULL,
  `paydate` varchar(30) NOT NULL,
  `withdraw` varchar(112) NOT NULL,
  `bankname` varchar(55) NOT NULL,
  `total_amount` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `name`, `email`, `paydate`, `withdraw`, `bankname`, `total_amount`) VALUES
(17, 'RIFAT', 'rifat@gmail.com', '2019-07-12', '999999999', 'United Comercial Bank Limited', '0'),
(19, 'Neon', 'neon@gmail.com', '2016-05-22', '9876544', 'National Bank Limited', '9876544'),
(20, 'Chayon', 'chayon@gmail.com', '2020-08-13', '88778766', 'Dhaka Bank Limited', '0'),
(21, 'Raihan', 'raihan@gmail.com', '2019-03-23', '555555555', 'Dhaka Bank Limited', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
