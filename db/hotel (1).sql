-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 07:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE `checkins` (
  `id` int(11) NOT NULL,
  `passport_no` varchar(30) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `room_no` varchar(10) DEFAULT NULL,
  `checkin_time` datetime DEFAULT current_timestamp(),
  `checkout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`id`, `passport_no`, `full_name`, `room_no`, `checkin_time`, `checkout_time`) VALUES
(1, 'N987456123', 'Jayamali Nilumini', '11', '2025-07-06 00:10:16', '2025-07-06 00:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE `food_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_menu`
--

INSERT INTO `food_menu` (`id`, `name`, `category`, `description`, `price`, `image`) VALUES
(1, 'Pancakes', 'Breakfast', 'Served with syrup and butter', 350.00, NULL),
(2, 'Omelette', 'Breakfast', '3 eggs with cheese and veggies', 60.00, NULL),
(3, 'Chicken Rice', 'Lunch', 'Grilled chicken with steamed rice', 1000.00, NULL),
(4, 'Grilled Fish', 'Dinner', 'Served with lemon butter sauce', 1000.00, NULL),
(5, 'Iced Coffee', 'Coffee', 'Chilled coffee with milk', 150.00, NULL),
(6, 'Red Wine', 'Liquors', 'House special dry red', 5000.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foreign_guests`
--

CREATE TABLE `foreign_guests` (
  `id` int(11) NOT NULL,
  `passport_no` varchar(30) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foreign_guests`
--

INSERT INTO `foreign_guests` (`id`, `passport_no`, `full_name`, `email`, `country`, `phone`, `password`, `reg_date`) VALUES
(7, 'N789456123', 'Anjana Madubashana', 'anjana@gmail.com', 'UAE', '0714569879', '$2y$10$FKl.vB2.unRzrcD.tyutaOeE05RFf0mECZAeQyA4lhEEsWB5Hykhi', '2025-07-06 13:34:24'),
(8, 'N147852369', 'John Mors', 'johnj@gmail.com', 'France', '0764165454', '$2y$10$YVS9jBleBw.xAJcQ/JMr6O3fbH0hQWPq7my00WkyFTJjoEChawUWy', '2025-07-13 14:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `room_service_orders`
--

CREATE TABLE `room_service_orders` (
  `id` int(11) NOT NULL,
  `passport_no` varchar(30) DEFAULT NULL,
  `room_no` varchar(10) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_service_orders`
--

INSERT INTO `room_service_orders` (`id`, `passport_no`, `room_no`, `category`, `item_name`, `quantity`, `request_time`, `job_status`) VALUES
(8, 'N987456123', '11', 'Breakfast', 'Toast & Jam', 1, '2025-07-04 19:08:09', 'In Progress'),
(9, 'N987456123', '11', 'Breakfast', 'Omelette', 1, '2025-07-04 19:15:24', 'Completed'),
(11, 'N987456123', '11', 'Breakfast', 'Pancakes', 1, '2025-07-05 10:16:34', 'Pending'),
(12, 'N789456123', '11', 'Breakfast', 'Pancakes', 3, '2025-07-06 13:43:24', 'In Progress'),
(13, 'N789456123', '12', 'Liquors', 'Red Wine', 1, '2025-07-06 13:44:48', 'Completed'),
(14, '', '', '', '', 1, '2025-07-14 08:37:38', NULL),
(15, 'N789456123', '', '', '', 1, '2025-07-15 19:30:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` int(11) NOT NULL,
  `passport_no` varchar(30) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_status` varchar(100) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `passport_no`, `room_no`, `service_type`, `details`, `requested_at`, `job_status`) VALUES
(1, 'N987456123', '11', 'Cleaning', 'floor is wet', '2025-07-04 18:37:29', 'Pending'),
(2, 'N987456123', '11', 'Cleaning', 'hgfjfgfgjffgj', '2025-07-05 10:17:14', 'Pending'),
(3, 'N987456123', '11', 'House Keeping', 'bed', '2025-07-07 20:50:09', 'Pending'),
(4, 'N987456123', '11', 'Maintenance', 'cc', '2025-07-07 20:56:33', 'Pending'),
(5, 'N987456123', '11', 'Maintenance', 'ssdsdsds', '2025-07-07 21:42:04', 'Completed'),
(6, 'N789456123', '12', 'House Keeping', 'er', '2025-07-12 20:20:09', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `staff_users`
--

CREATE TABLE `staff_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_users`
--

INSERT INTO `staff_users` (`id`, `username`, `email`, `password`, `department`, `created_at`) VALUES
(1, 'amal', 'amal@gmail.com', '$2y$10$fC6T20a907UQ1qnrbutqVuAxejZzexOSxPzKYZPDEJOXaszuGugge', 'Housekeeping', '2025-07-13 01:31:24'),
(2, 'kamal', 'kamal@gmail.com', '$2y$10$cjH7bnrQrW9fkR7TlW6GgeD5Vj61MiZgKua5vJJ6rZ.w1fVzW6zuu', 'Maintenance', '2025-07-13 01:31:53'),
(3, 'nimal', 'nimal@gmail.com', '$2y$10$e3sklAHEKd4viroK/Pjy2eKWpqVhE.zhf/Md5whKQ4dj5jaweSeHG', 'Kitchen', '2025-07-13 01:32:08'),
(4, 'saman', 'saman@gmail.com', '$2y$10$bWTboIAaA3xHkqOF5AdDT.tit/s3Xfds1VBh5P/VR18zvWiag9OSK', 'Manager', '2025-07-13 01:59:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foreign_guests`
--
ALTER TABLE `foreign_guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_service_orders`
--
ALTER TABLE `room_service_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_users`
--
ALTER TABLE `staff_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkins`
--
ALTER TABLE `checkins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_menu`
--
ALTER TABLE `food_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foreign_guests`
--
ALTER TABLE `foreign_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_service_orders`
--
ALTER TABLE `room_service_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_users`
--
ALTER TABLE `staff_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
