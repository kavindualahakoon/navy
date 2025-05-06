-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2025 at 11:32 AM
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
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int NOT NULL,
  `request_id` int DEFAULT NULL,
  `admin_level` enum('admin1','admin2','admin3') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `decision` enum('approved','rejected') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci,
  `decision_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `request_id`, `admin_level`, `decision`, `remark`, `decision_time`) VALUES
(1, 1, 'admin1', 'approved', 'ghdgfhsdfsjdf', '2025-05-05 10:43:06'),
(2, 1, 'admin2', 'approved', 'erwerwerwe', '2025-05-05 10:43:23'),
(3, 1, 'admin3', 'approved', 'erewrerwerwe', '2025-05-05 10:43:40'),
(4, 2, 'admin1', 'approved', 'erwrwerewrewrwerewrwer', '2025-05-06 03:53:15'),
(5, 2, 'admin2', 'approved', 'ewrwrewrwerweewrwerwrw', '2025-05-06 03:53:36'),
(6, 2, 'admin3', 'approved', 'ewrwerewrwerewrewrewrwerewre', '2025-05-06 03:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_text` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `current_approver` enum('admin1','admin2','admin3') COLLATE utf8mb4_general_ci DEFAULT 'admin1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_name`, `request_text`, `status`, `current_approver`, `created_at`) VALUES
(1, 'fgdfgdfg', 'gfdfgdfg', 'approved', 'admin3', '2025-05-05 10:37:51'),
(2, 'sdfdsfdsf', 'dfsdfsdfsdf', 'approved', 'admin3', '2025-05-06 03:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `request_reviews`
--

CREATE TABLE `request_reviews` (
  `id` int NOT NULL,
  `request_id` int DEFAULT NULL,
  `admin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action` enum('approved','rejected') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_general_ci,
  `reviewed_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(41, 'Taniya', 'SLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$OSOrR43IYvB6YSwPP5kusuS1yQBf/54F1/HsK92wz5roaZlfoVFCu', 'admin'),
(42, 'WWE', 'ASLT', 'kavindu9805@gmail.com', 779669719, '$2y$10$isWqNtjkCiiQa5OS9jOfJO85PMUF4BdBg.1VLViRHi2Ygte3kPBB.', 'user'),
(44, 'Taniya1', 'Capt', 'kavindu9805@gmail.com', 779669719, '$2y$10$uYYo5.byRZUww/w7H9yEGuCks7b7TQO6tchYtFD1G8oOX3OG7oJ5m', 'admin'),
(45, 'NUWAN', 'Lt Cdr', 'kavindu9805@gmail.com', 779669719, '$2y$10$Las83SxyDPRlYJtovCG5b.JAnJw/2OWkOGq41dOIfgEeDC2/Q1wvG', 'admin'),
(46, 'Game', 'R Adm', 'kavindu9805@gmail.com', 779669719, '$2y$10$gcftKUP.waUtqCdFM3RGa.OAiI/fAkeanPN1.tko6rQNwGKbyvj.K', 'user'),
(47, 'Ruwan1', 'Lt', 'kavindu9805@gmail.com', 779669719, '$2y$10$ooKEuA8zDXeilrHPEAQNOuwN8sz1i6g21eMpurZrGQXb5/6Abv5iq', 'user'),
(48, 'fgdfgdf', 'Lt', 'kavindu9805@gmail.com', 779669719, '$2y$10$.i8bHL0khR.ZukgmHbPNsuJzeRZK33t561x7L30Nyy4cMm2H31MWC', 'user'),
(49, 'dfsdfsdf', 'A/S/Lt', 'sw43973@navy.lk', 779669719, '$2y$10$MQ.hGJglMx2f6DjwVSjT9OEkxK5C4QDIrvQuCsInI7WnTrGXzkEwy', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `title`, `details`, `status`, `admin_remark`) VALUES
(1, 'sdasd', 'sdasdas', 'approved', 'fdshfshdjfgsdjhgfdsjhfgs'),
(2, 'fdgjkdfhgdfhgdfjkhgkdf', 'fdhgdhfjgdfghdfjgdf', 'pending', NULL),
(3, 'Kavindu', 'vsdjhgfsdjgfsjhdgfjhsgf', 'pending', NULL),
(4, 'frewerwer', 'werwerwerwerwer', 'pending', NULL),
(5, 'ggdsgdgfdg', 'fgdfgsdfgsdfgdsfg', 'pending', NULL),
(6, 'eewrewr', 'erwerwerwer', 'pending', NULL),
(7, 'rtertertertert', 'wertewrtwertertwertewr', 'pending', NULL),
(8, '123456789', '123456789', 'approved', 'ytryrtyryerte'),
(9, '123456789', '123456789', 'approved', 'rtertretwer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_reviews`
--
ALTER TABLE `request_reviews`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_reviews`
--
ALTER TABLE `request_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
