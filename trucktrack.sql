-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 23, 2023 at 05:36 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trucktrack`
--
CREATE DATABASE IF NOT EXISTS `trucktrack` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `trucktrack`;

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

DROP TABLE IF EXISTS `trucks`;
CREATE TABLE IF NOT EXISTS `trucks` (
  `UTID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Lat` decimal(10,0) NOT NULL DEFAULT '0',
  `Lon` decimal(10,0) DEFAULT '0',
  `status` enum('normal','reststop','traffic','breakdown') NOT NULL DEFAULT 'normal',
  UNIQUE KEY `UTID` (`UTID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
