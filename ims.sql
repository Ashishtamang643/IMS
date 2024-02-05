-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 12:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `name` varchar(50) NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`name`, `rate`, `quantity`) VALUES
('cookies', 20, 30),
('nothing', 800, 150),
('Pancakes', 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_record`
--

CREATE TABLE `purchase_record` (
  `name` varchar(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(20) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_record`
--

INSERT INTO `purchase_record` (`name`, `rate`, `quantity`, `vendor`, `remarks`) VALUES
('cookies', 20, 50, 'Pasupati bakery', ''),
('Pancakes', 150, 20, 'Pasupati bakery', ''),
('Muffins', 200, 5, 'bb bakery', ''),
('nothing', 1000, 50, 'bb bakery', ''),
('nothing', 1000, 50, 'bb bakery', ''),
('nothing', 800, 50, 'bb bakery', ''),
('Pancakes', 500, 10, 'Tarzan Bakery', 'Pre Payment');

-- --------------------------------------------------------

--
-- Table structure for table `salesrecord`
--

CREATE TABLE `salesrecord` (
  `consumer` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesrecord`
--

INSERT INTO `salesrecord` (`consumer`, `name`, `rate`, `quantity`, `total`, `remarks`) VALUES
('Babish', 'cookies', 0, 5, 0, ''),
('Babish', 'cookies', 0, 5, 0, ''),
('Babish', 'cookies', 0, 50, 0, ''),
('Babish', 'cookies', 20, 10, 200, ''),
('Ram', 'Muffins', 200, 1, 200, ''),
('Ram', 'Muffins', 200, 1, 200, ''),
('Ram', 'Muffins', 200, 1, 200, ''),
('Ram', 'Muffins', 200, 1, 200, ''),
('Ram', 'Muffins', 200, 1, 200, ''),
('Babish', 'Pancakes', 500, 30, 15000, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
