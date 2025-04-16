-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 أبريل 2025 الساعة 10:45
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmi_clc`
--

-- --------------------------------------------------------

--
-- بنية الجدول `bmi_records`
--

CREATE TABLE `bmi_records` (
  `name` varchar(50) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `bmi` double NOT NULL,
  `interpretation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `bmi_records`
--

INSERT INTO `bmi_records` (`name`, `weight`, `height`, `bmi`, `interpretation`) VALUES
('fares', 55, 1.74, 18.166204254194742, 'Underweight');

-- --------------------------------------------------------

--
-- بنية الجدول `calc`
--

CREATE TABLE `calc` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `var_dump`
--

CREATE TABLE `var_dump` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calc`
--
ALTER TABLE `calc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `var_dump`
--
ALTER TABLE `var_dump`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calc`
--
ALTER TABLE `calc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `var_dump`
--
ALTER TABLE `var_dump`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
