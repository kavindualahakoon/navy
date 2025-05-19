-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2025 at 11:31 AM
-- Server version: 8.0.41
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rank` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phonenumber` int NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `rank`, `email`, `phonenumber`, `password`, `role`) VALUES
(35, 'Vidu9805', 'ASLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$G08ckhrGpTupTE0jMczQpOfGEZj/usheB1r8ylyFZnLwMs0CEEcMK', 'admin'),
(36, 'Kavi', 'ASLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$NqF3cZB9Y6INE7hl8q2KcuGrd4tN0UqPNhq4fFlJENRp.jyGqU/Qu', 'user'),
(37, 'SriLanka', 'ASLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$6kbCueyZS2NYNLWKX7K0a.vYy8atFPypiwAW/DqrRWXbJ.h1AxVyK', 'admin'),
(38, 'SriLanka1', 'ASLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$O3JuG3dNnMUzO.o.tvi7jux40MByuDoI78ly08QmVjO2Y0ODFj4n.', 'admin'),
(39, 'RUN', 'SLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$3Zshvkud/yFOaQXwiMJ7huXaxwFq7wSxAT7bVBwtUxHbzOapetzgm', 'admin'),
(40, 'RUN1', 'SLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$oCjPz4dbc8BBtNniE2o/4eu5X/iKBNRjIKu0tOWFMmvL/mkOPDHcG', 'user'),
(41, 'Taniya', 'SLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$OSOrR43IYvB6YSwPP5kusuS1yQBf/54F1/HsK92wz5roaZlfoVFCu', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin_remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `title`, `details`, `status`, `admin_remark`) VALUES
(1, 'sdasd', 'sdasdas', 'approved', 'fdshfshdjfgsdjhgfdsjhfgs'),
(2, 'fdgjkdfhgdfhgdfjkhgkdf', 'fdhgdhfjgdfghdfjgdf', 'rejected', 'ghvhhgghjghjg'),
(3, 'Kavindu', 'vsdjhgfsdjgfsjhdgfjhsgf', 'approved', 'ertertertertertertertertertretererterterterterterterterter'),
(4, 'dddfdsf', 'dfsdfsdfsd', 'pending', NULL),
(5, 'rtertetre', 'erterterterter', 'pending', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
