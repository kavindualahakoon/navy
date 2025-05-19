-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2025 at 03:35 AM
-- Server version: 8.0.41
-- PHP Version: 8.2.28

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
  `admin_level` enum('admin1','admin2','admin3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `decision` enum('approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `request_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `current_approver` enum('admin1','admin2','admin3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'admin1',
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
  `admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action` enum('approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
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
  `role` enum('user','sysadmin','admin1','admin2','admin3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `rank`, `email`, `phonenumber`, `password`, `role`, `profile_photo`) VALUES
(99, 'Kavindu', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$4cdT5auNIy85sOGFlX/HnO5NZmOmrASu9LfNYgg4i3VbKrwz2aO0G', 'admin1', 'uploads/profile_photos/profile_681eff7d86e052.28626721.jpg'),
(100, 'Ravindu', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$mESAUhbPFiax1UpLwghfd.zGeoyQuzR2TP6tw6eyrLomwEanDzP5W', 'admin2', NULL),
(101, 'Nuwan', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$AWZGao85BWmEpWVdYYXoUegR8SiE2wJK7KNL7NpWANj5v4rMxTQYu', 'admin3', 'uploads/profile_photos/profile_681eef8bb79b44.66418567.jpeg'),
(103, 'Nuwan1233', 'Vice Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$Vy607XIeVuDcanFqhbbfBuqXYLgprrEtymVjh7bJBWMINqVhtTHby', 'admin2', 'uploads/profile_photos/profile_681dc08c853603.61947822.png'),
(108, 'Check890', 'Rear Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$JSzbwLUqyOZeBP/i2G1s3uRMX6WeR7D49ULRc2uIhARTXmMk9wsyW', 'user', 'uploads/profile_photos/default.png'),
(109, 'Check12345678', 'Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$lrl//tEJLpbKZXySor.n9.HU11XLAtq36du.Wx6UW5hVACLYuRuRW', 'user', 'uploads/profile_photos/profile_681df16861f4b4.73757608.gif'),
(110, 'Check1', 'Vice Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$ubX3iFh8Q9YrxZWgbvewnuGXwUqMrs99.bcyjiWoD5fvF0uD9ldK2', 'user', 'uploads/profile_photos/profile_681df7e4010db3.68351888.png'),
(111, 'Check9805', 'Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$YEdT4HZiPbVfJ4nwmPOS2ukw15BJ8J1CtQoBJLjj0ZlVq7h.z8Rn2', 'user', 'uploads/profile_photos/profile_681dfb7f575d63.99110632.gif'),
(112, 'Game1998', 'Vice Admiral', 'kavindu9805@gmail.com', 779669719, '$2y$10$ap6IddOImWXJApWs93SwZ.pQ0tTnyNgHsvek9H6zKhJJvdmQXgKGm', 'admin3', 'uploads/profile_photos/profile_681ef075bb0938.60158849.jpeg'),
(113, 'Ruwan G', 'Midshipman', 'kavindu9805@gmail.com', 779669719, '$2y$10$LPk8YLPkWxFOu.eFfOpgZun5WeBEcjwqS/Fpi0hv0sssddKsr6dpe', 'admin1', 'uploads/profile_photos/default.png'),
(115, 'SystemAdmin', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$fFktiUE.UnfDJhhBIDNsEuYKTUZ6T1OrGzoxD5qiURY4TchpcMifW', 'sysadmin', 'uploads/profile_photos/profile_681f22e83c4c96.53408511.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('pending','admin1_approved','admin2_approved','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin1_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `admin2_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `admin3_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `user_id`, `title`, `details`, `status`, `admin1_remark`, `admin2_remark`, `admin3_remark`) VALUES
(1, 99, 'ghghhgfghf', 'hfdfhdfgdgfdfgd', 'rejected', 'dsdsadasdasdasdasd', NULL, NULL),
(2, 99, 'wqeqweqwe', 'weqweqweqwewqe', 'rejected', 'sdsadsasdasd', NULL, NULL),
(5, 109, 'wqeweqweqw', 'eweqweqweqweqe', 'approved', 'please Approve 2', 'Approve 3 pleae', 'Done'),
(6, 99, 'gfdtydfxfyiugyjg', 'hgyiufycgh viguougj', 'admin1_approved', 'Approve', NULL, NULL),
(10, 108, 'HI', 'Hi', 'rejected', 'sdasdasdasd', NULL, NULL),
(11, 108, 'HI', 'Kaindu', 'rejected', 'sasdasdasds', NULL, NULL),
(12, 101, 'vcvcbvcbcv', 'fgdfgfdgf', 'admin1_approved', 'dxxcccxx', NULL, NULL),
(14, 99, 'vnbmnm', 'xvcbvn b', 'approved', 'Approve', 'Approve', 'Done'),
(15, 99, 'efwgreg', 'sdsfdgb', 'pending', NULL, NULL, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);

--
-- Constraints for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD CONSTRAINT `user_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
