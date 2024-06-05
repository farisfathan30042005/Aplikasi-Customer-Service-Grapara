-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2024 pada 14.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `cs_performance`
--

CREATE TABLE `cs_performance` (
  `id` int(11) NOT NULL,
  `cs_name` varchar(50) NOT NULL,
  `performance_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cs_performance`
--

INSERT INTO `cs_performance` (`id`, `cs_name`, `performance_score`) VALUES
(1, '', 10),
(2, '', 10),
(3, '', 10),
(4, '', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_issues`
--

CREATE TABLE `customer_issues` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL,
  `customer_queue_number` int(11) NOT NULL,
  `issue` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer_issues`
--

INSERT INTO `customer_issues` (`id`, `desk_number`, `customer_queue_number`, `issue`, `solution`) VALUES
(1, 0, 1234, 'perbaikan sinyal', 'restart handphone'),
(2, 0, 4, 'perbaikan sinyal', 'restart handphone'),
(3, 0, 123, 'dsfsdv', 'advazdva'),
(4, 0, 1234, 'rdzcvzdvd', 'svadf4wfaedfda'),
(5, 2, 1, 'hp rusak', 'beli baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desks`
--

CREATE TABLE `desks` (
  `id` int(11) NOT NULL,
  `desk_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `desks`
--

INSERT INTO `desks` (`id`, `desk_number`) VALUES
(3, 456),
(4, 2134),
(5, 123),
(6, 234);

-- --------------------------------------------------------

--
-- Struktur dari tabel `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `queue_number` int(11) NOT NULL,
  `status_pelayanan` varchar(10) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `queue`
--

INSERT INTO `queue` (`id`, `phone`, `queue_number`, `status_pelayanan`) VALUES
(1, '087888698891', 1, 'sudah_dila'),
(2, '087738919399', 2, 'belum'),
(3, '087888698896', 3, 'belum'),
(4, '087888698891', 4, 'belum'),
(5, '087738919399', 5, 'belum'),
(6, '085175280207', 6, 'belum'),
(7, '01982791232', 7, 'belum'),
(8, '08156405549', 8, 'belum'),
(9, '08156405549', 9, 'belum'),
(10, '08888888', 10, 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_stats`
--

CREATE TABLE `service_stats` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `total_requests` int(11) NOT NULL,
  `successful_requests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'Admin'),
(2, 'kautsar', 'kautsar', 'Manager'),
(3, 'faris', 'faris', 'CS'),
(8, 'haidar', 'haidar', 'Admin'),
(9, 'gaji', 'gaji', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `weekly_report`
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
-- Indeks untuk tabel `cs_performance`
--
ALTER TABLE `cs_performance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer_issues`
--
ALTER TABLE `customer_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `desks`
--
ALTER TABLE `desks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service_stats`
--
ALTER TABLE `service_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `weekly_report`
--
ALTER TABLE `weekly_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cs_performance`
--
ALTER TABLE `cs_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customer_issues`
--
ALTER TABLE `customer_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `desks`
--
ALTER TABLE `desks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `service_stats`
--
ALTER TABLE `service_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `weekly_report`
--
ALTER TABLE `weekly_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
