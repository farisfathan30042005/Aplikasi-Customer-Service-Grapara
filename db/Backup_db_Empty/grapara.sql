-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 12:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grapara`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_performance`
--

CREATE TABLE `cs_performance` (
  `id` int(11) NOT NULL,
  `cs_name` varchar(50) NOT NULL,
  `performance_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_history`
--

CREATE TABLE `customer_history` (
  `id` int(11) NOT NULL,
  `customer_queue_number` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL,
  `issue` text NOT NULL,
  `solution` text NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_issues`
--

CREATE TABLE `customer_issues` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL,
  `customer_queue_number` int(11) NOT NULL,
  `issue` text NOT NULL,
  `solution` text NOT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE `desks` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desks`
--

INSERT INTO `desks` (`id`, `desk_number`) VALUES
(1, 1101),
(2, 1102),
(3, 2101),
(4, 2201),
(5, 3101);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `queue_number` int(11) NOT NULL,
  `status_pelayanan` varchar(15) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `phone`, `queue_number`, `status_pelayanan`) VALUES
(1, '087888698891', 1, 'belum'),
(2, '087738919399', 2, 'belum'),
(3, '087888698896', 3, 'belum'),
(4, '087888698891', 4, 'belum'),
(5, '087738919399', 5, 'belum'),
(6, '085175280207', 6, 'belum'),
(7, '01982791232', 7, 'belum'),
(8, '08156405549', 8, 'belum'),
(9, '08156405568', 9, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `service_stats`
--

CREATE TABLE `service_stats` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `total_requests` int(11) NOT NULL,
  `successful_requests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'kautsar', 'kautsar', 'Admin'),
(2, 'faris', 'faris', 'Manager'),
(3, 'afnan', 'afnan', 'CS'),
(4, 'faiz', 'faiz', 'CS'),
(5, 'iva', 'iva', 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_report`
--

CREATE TABLE `weekly_report` (
  `id` int(11) NOT NULL,
  `cs_name` varchar(50) NOT NULL,
  `performance_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cs_performance`
--
ALTER TABLE `cs_performance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_history`
--
ALTER TABLE `customer_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_issues`
--
ALTER TABLE `customer_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desks`
--
ALTER TABLE `desks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_stats`
--
ALTER TABLE `service_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_report`
--
ALTER TABLE `weekly_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cs_performance`
--
ALTER TABLE `cs_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_history`
--
ALTER TABLE `customer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_issues`
--
ALTER TABLE `customer_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_stats`
--
ALTER TABLE `service_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weekly_report`
--
ALTER TABLE `weekly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
