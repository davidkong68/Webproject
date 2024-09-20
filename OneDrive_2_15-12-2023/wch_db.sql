-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 01:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wch_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `date_donated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `name`, `email`, `amount`, `payment_type`, `date_donated`) VALUES
(16, 'Darren', 'd123@gmail.com', 100, 'creditCard', '2023-12-15 06:26:29'),
(17, 'Tim', 't123@gmail.com', 123, 'creditCard', '2023-12-15 07:15:16'),
(18, 'Ron', 'ron123@gmail.com', 245, 'creditCard', '2023-12-15 07:18:45'),
(22, 'Nicholas Teyew', '19028760@imail.sunway.edu.my', 231, 'creditCard', '2023-12-15 11:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` text NOT NULL,
  `role` varchar(128) NOT NULL DEFAULT 'Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`, `role`) VALUES
(1, 'admin', 'admin@wch.com', '$2y$10$u0LmAd1uSUeamIlDEJhN/ODFqQ0lvcxK3U7j2o1MwYzjA6GocQTBO', 'Admin'),
(2, 'Darren', 'd123@gmail.com', '$2y$10$zX5Og2f0VaKyO.8FbQLHpeIvZdeefxEu1S0bGhmwTeb1MPaTRj572', 'Member'),
(3, 'rage', 'r123@gmail.com', '$2y$10$eiV3.uJJq7.JkCiwihJ9XO2L5DurCjzpdQfeQy.VeFoROy9JjLAG.', 'Member'),
(11, 'Tim', 't123@gmail.com', '$2y$10$uAEx70Naa/fmwVIJxbCyc.fts7YN04y8wULgIBmaK5ogUocBkoTBa', 'Member'),
(12, 'Ron', 'ron123@gmail.com', '$2y$10$Hc1r7nruUs049zsUJuuv8.QOPOwNrfS9vizYzAEclnJW/fmDAqJM.', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
