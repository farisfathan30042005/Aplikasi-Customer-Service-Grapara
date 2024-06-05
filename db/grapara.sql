-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 08:57 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cs_performance`
--

INSERT INTO `cs_performance` (`id`, `cs_name`, `performance_score`) VALUES
(1, '', 10),
(2, '', 10),
(3, '', 10),
(4, '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer_issues`
--

CREATE TABLE `customer_issues` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL,
  `customer_queue_number` int(11) NOT NULL,
  `issue` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_issues`
--

INSERT INTO `customer_issues` (`id`, `desk_number`, `customer_queue_number`, `issue`, `solution`) VALUES
(1, 0, 1234, 'perbaikan sinyal', 'restart handphone'),
(2, 0, 4, 'perbaikan sinyal', 'restart handphone'),
(3, 0, 123, 'dsfsdv', 'advazdva'),
(4, 0, 1234, 'rdzcvzdvd', 'svadf4wfaedfda');

-- --------------------------------------------------------

--
-- Table structure for table `desks`
--

CREATE TABLE `desks` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desks`
--

INSERT INTO `desks` (`id`, `desk_number`) VALUES
(3, 456),
(4, 2134),
(5, 123),
(6, 234);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `queue_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `phone`, `queue_number`) VALUES
(1, '087888698891', 1),
(2, '087738919399', 2),
(3, '087888698896', 3),
(4, '087888698891', 4),
(5, '087738919399', 5),
(6, '085175280207', 6),
(7, '01982791232', 7),
(8, '08156405549', 8),
(9, '08156405549', 9);

-- --------------------------------------------------------

--
-- Table structure for table `service_stats`
--

CREATE TABLE `service_stats` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `total_requests` int(11) NOT NULL,
  `successful_requests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'Admin'),
(2, 'kautsar', 'kautsar', 'Manager'),
(3, 'faris', 'faris', 'CS'),
(8, 'haidar', 'haidar', 'Admin'),
(9, 'gaji', 'gaji', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_report`
--

CREATE TABLE `weekly_report` (
  `id` int(11) NOT NULL,
  `cs_name` varchar(50) NOT NULL,
  `performance_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cs_performance`
--
ALTER TABLE `cs_performance`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_issues`
--
ALTER TABLE `customer_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `desks`
--
ALTER TABLE `desks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `weekly_report`
--
ALTER TABLE `weekly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
