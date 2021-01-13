-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2019 at 08:10 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbtc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukubaru`
--

DROP TABLE IF EXISTS `bukubaru`;
DROP TABLE IF EXISTS `lss`;

CREATE TABLE `bukubaru` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `nimNip` varchar(32) NOT NULL,
  `status` varchar(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `judul` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `ISBN` varchar(15) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `link` text,
  `respond` tinyint(4) DEFAULT '0',
  `dateReceived` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lss`
--

CREATE TABLE `lss` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `nimNip` varchar(32) NOT NULL,
  `status` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `literatur` varchar(25) NOT NULL,
  `judul` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `link` text,
  `extra` text,
  `respond` tinyint(1) NOT NULL DEFAULT '0',
  `dateReceived` date NOT NULL,
  `dateResponded` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukubaru`
--
ALTER TABLE `bukubaru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lss`
--
ALTER TABLE `lss`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukubaru`
--
ALTER TABLE `bukubaru`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lss`
--
ALTER TABLE `lss`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
