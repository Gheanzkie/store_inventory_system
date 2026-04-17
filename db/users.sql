-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2026 at 05:58 AM
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
-- Database: `store_inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `name`, `phone`, `avatar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'ghean123', '$2y$10$WeuCOSyW.yRAnBwX1GRMwO2l7Z2RROMZxVDEpOT1f1M2Gge/TFJH6', 'admin', 'Active', 'Arnelle', '09278809655', NULL, '2026-02-20 02:35:30', '2026-04-15 23:35:22', '2026-04-03 22:54:58'),
(14, 'Ria123', '$2y$10$UTT.h5SjJjE8umd39rXcdeg.2OzMa2KPKMBUwtQFWNK4iTF4QQVg2', 'Staff', 'In Active', 'Ria Mae Palata ', '', NULL, '2026-04-16 13:20:52', '2026-04-17 01:47:54', '2026-04-16 05:20:52'),
(15, 'anthea123', '$2y$10$wctx9Rzk19KQaBmFqFFMgOMEkwYBnpZ7AZsLP5.XBdO8H/f7PXc1i', 'admin', 'Active', 'Anthea Abaygar', '', NULL, '2026-04-16 13:21:48', '2026-04-16 05:21:48', '2026-04-16 05:21:48'),
(17, 'canoy123', '$2y$10$VuwhAlm7J0fWn3zp12FnT.8QzYNyeo6RngYj.OR9UH1FLluVo0cJm', 'admin', 'Active', 'John Paul Canoy', '', NULL, '2026-04-16 13:25:07', '2026-04-16 05:25:07', NULL),
(19, 'kurt123', '$2y$10$VpQlektaN2sbjmy0Elo.b.hOQn.E3ZzzG68F9IJA6HWMDlhcNDM2y', 'admin', 'Active', 'Kurt ', '', NULL, '2026-04-16 13:46:24', '2026-04-16 05:46:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
