-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2025 at 08:43 AM
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
  `role` enum('user','sysadmin','admin1','admin2','admin3','admin4') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'default.png',
  `reset_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `rank`, `email`, `phonenumber`, `password`, `role`, `profile_photo`, `reset_token`, `reset_token_expires`) VALUES
(115, 'SystemAdmin', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$fFktiUE.UnfDJhhBIDNsEuYKTUZ6T1OrGzoxD5qiURY4TchpcMifW', 'sysadmin', 'uploads/profile_photos/profile_681f22e83c4c96.53408511.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(119, 'HOD/CO', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$jYXJbgPuIQ7KO/55fVLK9eOnwEXn3MsECcvbfAB37wQ8NY5AJnS4y', 'admin1', 'uploads/profile_photos/default.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(120, 'DG/Director', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$dnYew/kO5ob1lJ0C8d0hyOnxwiqyxSngfiViSE6OfFTfidKtN1L.m', 'admin2', 'uploads/profile_photos/default.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(121, 'DDNIT(S)', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$5At0VB3tzfTiOEN/vJw2j.HvVJ9a7BOJirIwu/2Lp2ZZy76rv5FBu', 'admin3', 'uploads/profile_photos/default.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(122, 'DNIT', 'Sub Lieutenant', 'kavindu9805@gmail.com', 779669719, '$2y$10$cE8.HmoNrMstTsNAZY55R.1H1vSOcqJvoOqjpBcFZER0XihEKhdPK', 'admin4', 'uploads/profile_photos/default.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(123, 'Nuwan', 'Midshipman', 'kavindu9805@gmail.com', 779669719, '$2y$10$0h7iI4w4N0NbGEw3T4FFeuFlpltCkAQVZTA8CvIKHyyUF4.s47NVO', 'user', 'uploads/profile_photos/default.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(124, 'Nuwan123', 'Admiral Of the Fleet', 'kavindu9805@gmail.com', 779669718, '$2y$10$wMhKkgg2GaMTO3xtrJoEduYBQtqZpBNmzJYogq.2nuFBAVXzAqfo6', 'user', 'uploads/profile_photos/profile_682443e3ac3480.40359360.png', '081e628ceede46bcbe2350f6d31d061516be1d6ab858a7f6a9dc2a23042d9715', '2025-05-14 11:58:20'),
(125, 'DNIT1233', 'Commodore', 'amkv-alahakoon@navy.lk', 779669719, '$2y$10$UKaZhzLgrlmxvcPyw9gX4enRFPiJ57o.cf77Pg6xhyRQRotjMg.sa', 'user', 'uploads/profile_photos/default.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('pending','admin1_approved','admin2_approved','approved','rejected','admin3_approved') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin1_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `admin2_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `admin3_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `admin4_remark` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `user_id`, `title`, `details`, `status`, `admin1_remark`, `admin2_remark`, `admin3_remark`, `admin4_remark`) VALUES
(23, 123, '12345', 'Check', 'approved', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.'),
(24, 123, '12345', 'AI Overview\r\nLearn more\r\nA car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. \r\nHere\'s a more detailed breakdown of potential essay topics:\r\n1. The Invention and Evolution of the Automobile:\r\n\r\n    Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. \r\n\r\nDiscuss the impact of the automobile on transportation, society, and the economy. \r\nExplore the rise of different types of vehicles, such as trucks, buses, and electric cars. \r\n\r\n2. The Mechanics and Technology of Cars:\r\n\r\n    Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. \r\n\r\nExplain how these components work together to propel the car and provide various features. \r\nDiscuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. \r\n\r\n3. The Impact of Cars on Society: \r\n\r\n    Examine how cars have influenced urban development, lifestyles, and transportation systems.\r\n    Discuss the environmental impact of cars, including pollution and resource depletion.\r\n    Explore the economic implications of the automotive industry, including jobs, production, and consumption. \r\n\r\n4. Personal Reflections on Cars: \r\n\r\n    Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips.\r\n    Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance.\r\n    Reflect on the emotional connection people have with their vehicles.', 'approved', 'Apprpove', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.', 'AI Overview Learn more A car essay can explore various aspects of vehicles, from their historical significance to their impact on society and individual lives. It can delve into the mechanics of a car, the evolution of automotive technology, or even personal reflections on the significance of cars in one\'s own life. The essay might also discuss the environmental impact of cars, their role in transportation, or the economics of owning and operating a vehicle. Here\'s a more detailed breakdown of potential essay topics: 1. The Invention and Evolution of the Automobile: Trace the development of the car from its early prototypes to modern models, highlighting key inventions like the internal combustion engine and the automobile starter motor. Discuss the impact of the automobile on transportation, society, and the economy. Explore the rise of different types of vehicles, such as trucks, buses, and electric cars. 2. The Mechanics and Technology of Cars: Describe the basic components of a car, including the engine, transmission, wheels, brakes, and electrical system. Explain how these components work together to propel the car and provide various features. Discuss advancements in automotive technology, such as fuel efficiency, safety features, and autonomous driving. 3. The Impact of Cars on Society: Examine how cars have influenced urban development, lifestyles, and transportation systems. Discuss the environmental impact of cars, including pollution and resource depletion. Explore the economic implications of the automotive industry, including jobs, production, and consumption. 4. Personal Reflections on Cars: Discuss the significance of cars in one\'s own life, whether for commuting, leisure, or family trips. Share personal experiences with cars, such as road trips, memorable journeys, or car maintenance. Reflect on the emotional connection people have with their vehicles.');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
