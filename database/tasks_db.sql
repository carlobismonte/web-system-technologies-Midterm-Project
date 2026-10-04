-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2026 at 03:10 PM
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
-- Database: `tasks_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'juan dela cruz', 'juandc@example.com', '09123456789', '2026-10-04 16:29:46'),
(2, 'sam melby', 'sam@example.com', '63456789123', '2026-10-04 19:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `task_date` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `status`, `task_date`, `created_at`) VALUES
(1, 'Finish Web Technologies assignment', 'pending', '2026-10-03', '2026-10-03 22:59:53'),
(2, 'Review CodeIgniter MVC', 'completed', '2026-10-03', '2026-10-03 22:59:53'),
(3, 'Prepare presentation slides', 'pending', '2026-10-03', '2026-10-03 22:59:53'),
(4, 'Submit laboratory activity', 'pending', '2026-10-02', '2026-10-03 22:59:53'),
(5, 'Study database models', 'completed', '2026-10-02', '2026-10-03 22:59:53'),
(6, 'Practice Query Builder', 'pending', '2026-10-01', '2026-10-03 22:59:53'),
(7, 'Organize project files', 'completed', '2026-10-01', '2026-10-03 22:59:53'),
(8, 'Read course materials', 'pending', '2026-09-30', '2026-10-03 22:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `avatar`, `created_at`, `password`) VALUES
(1, 'carlo01', 'Carlo Bismonte', 'carlo@example.com', '1791110140_8a2ec71989070a8ccc8f.png', '2026-10-03 22:59:53', '$2y$10$6ggentXpxpjQPi4qKtPhC.xaZxnGI4uHf4P70xAseYu4Ez.7Qb27G'),
(2, 'jeff02', 'jeff mendez', 'jeffm@example.com', NULL, '0000-00-00 00:00:00', '$2y$10$6ggentXpxpjQPi4qKtPhC.xaZxnGI4uHf4P70xAseYu4Ez.7Qb27G'),
(3, 'zach03', 'zach santos', 'zach@example.com', '1791112117_56fd862f22fa2a1fbb90.png', '2026-10-04 11:05:08', '$2y$10$6ggentXpxpjQPi4qKtPhC.xaZxnGI4uHf4P70xAseYu4Ez.7Qb27G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
