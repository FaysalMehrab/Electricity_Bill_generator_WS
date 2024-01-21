-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 08:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsco`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_all_info`
--

CREATE TABLE `bill_all_info` (
  `id` int(255) NOT NULL,
  `b_month` varchar(255) NOT NULL,
  `b_number` int(255) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `pre_unit` int(255) NOT NULL,
  `cur_unit` int(255) NOT NULL,
  `totalbill` int(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_all_info`
--

INSERT INTO `bill_all_info` (`id`, `b_month`, `b_number`, `issue_date`, `due_date`, `pre_unit`, `cur_unit`, `totalbill`, `type`) VALUES
(2, '2024-01', 23456789, '2024-01-21', '2024-02-21', 102, 500, 2842, 'offPeak'),
(2, '2024-02', 3698745, '2024-02-22', '2024-03-22', 100, 400, 2142, 'offPeak'),
(2, '2024-03', 1234567, '2024-03-22', '2024-04-23', 100, 700, 6451, 'peak'),
(2, '', 0, '', '', 0, 0, 0, 'peak');

-- --------------------------------------------------------

--
-- Table structure for table `bill_info`
--

CREATE TABLE `bill_info` (
  `id` int(255) NOT NULL,
  `bills` blob NOT NULL,
  `totalbill` int(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_info`
--

INSERT INTO `bill_info` (`id`, `bills`, `totalbill`, `month`) VALUES
(2, 0x75706c6f6164732f4d656872616220283135292e706466, 0, '2024-01'),
(2, 0x75706c6f6164732f4d656872616220283136292e706466, 0, '2024-02'),
(2, 0x75706c6f6164732f4d656872616220283137292e706466, 0, '2024-03');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `id` int(255) NOT NULL,
  `nid` varchar(13) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`id`, `nid`, `name`, `email`, `password`, `user_type`) VALUES
(2, '36987458745', 'Mehrab', 'faysal.chowdhury4@northsouth.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(5, '10236548927', 'Faysal', 'mehrabdaishi974@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(7, '10236548929', 'Test1', 'test2@gmail.com', '77963b7a931377ad4ab5ad6a9cd718aa', 'admin'),
(8, '10236548929', 'Test2', 'test3@gmail.com', '9990775155c3518a0d7917f7780b24aa', 'user'),
(11, '36987458745', 'Test5', 'test2@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `register_info`
--

CREATE TABLE `register_info` (
  `id` int(255) NOT NULL,
  `nid` varchar(13) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_info`
--

INSERT INTO `register_info` (`id`, `nid`, `name`, `email`, `password`, `user_type`) VALUES
(12, '36987458745', 'Test4', 'farhana@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_info`
--
ALTER TABLE `register_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_info`
--
ALTER TABLE `login_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `register_info`
--
ALTER TABLE `register_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
