-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2018 at 01:46 PM
-- Server version: 10.2.18-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `name`) VALUES
(1, 'STMB'),
(2, 'MSB'),
(3, 'Phase 1'),
(4, 'SBS'),
(5, 'SLS');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_rep`
--

CREATE TABLE `faculty_rep` (
  `rep_id` int(11) NOT NULL,
  `faculty_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reset_code` varchar(255) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `building_id` int(11) NOT NULL,
  `room_size` int(11) DEFAULT 0,
  `status` varchar(255) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `building_id`, `room_size`, `status`) VALUES
(1, 'STMB F1-02', 1, 0, 'active'),
(2, 'MSB 1', 2, 0, 'inactive'),
(3, 'Lecture Room 1', 3, 0, 'active'),
(4, 'SBS 1', 4, 0, 'active'),
(5, 'Shaba', 5, 0, 'active'),
(6, 'Zumaridi', 5, 25, 'inactive'),
(7, 'SBS 2', 4, 0, 'active'),
(8, 'SBS 3', 4, 0, 'active'),
(10, 'Lecture Room 4', 3, 0, 'active'),
(11, 'Lecturer Room 5', 3, 0, 'active'),
(12, 'Lecture Room 3', 3, 0, 'active'),
(13, 'Room 2', 3, 0, 'active'),
(14, 'Lecture Room 2', 3, 0, 'active'),
(15, 'Room 1', 3, 0, 'active'),
(16, 'Room 3', 3, 0, 'active'),
(18, 'MSB 2', 2, 0, 'active'),
(20, 'Room 4', 3, 0, 'active'),
(21, 'MSB 3', 2, 0, 'active'),
(22, 'MSB 4', 2, 0, 'active'),
(23, 'MSB 5', 2, 0, 'active'),
(24, 'STMB F1-04', 1, 40, 'active'),
(25, 'STMB F1-03', 1, 0, 'active'),
(32, 'MSB 6', 2, 0, 'active'),
(33, 'MSB 7', 2, 40, 'inactive'),
(60, 'STMB F1-01', 1, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `year_group` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `intake_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `year_group` int(11) DEFAULT NULL,
  `exam_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activated` varchar(255) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`, `registered_at`, `activated`) VALUES
(13, 'SWanyee', 'waynewanyee@gmail.com', '$2y$10$aRsG7wpHpxr7H5XJRVLZ8OqOcdBrwrZc.z1wdhMbYMQje6.xX/wai', 'Stephen', 'Wanyee', 'administrator', '2018-09-11 19:31:42', 'true'),
(20, 'HMundui', 'hellen@gmail.com', '$2y$10$TvmntuNdn20fe/lIHnJ/GOVyAITOAlJ49DKkfM9sx2nOEoOYYTEeS', 'Hellen', 'Mundui', 'faculty representative', '2018-09-16 23:36:13', 'false'),
(21, 'MJordan', 'michael.jords@mail.com', '$2y$10$zowI5sFKlIJbEbL0mDPLVOwjpGpT6gF8wMeExO.4xKxSon2NM8Q1u', 'Michael', 'Jordan', 'faculty representative', '2018-09-16 23:36:57', 'false'),
(22, 'IMotanya', 'isaack.motanya@strathmore.edu', '$2y$10$t8Rb8OweGnxCS.4mNdyMs.fH3Bvvp3e2wU5yqRjOQrV8G/EE1YO1q', 'Isaack', 'Motanya', 'administrator', '2018-09-18 09:06:27', 'true'),
(23, 'RToor', 'isaackmotanya6@gmail.com', '$2y$10$NwMCHlcqoB5v5o2D5zWF7.d7sgkd10b7cBxfZL3U1uiObUzSme/h2', 'Root', 'Toor', 'faculty representative', '2018-09-20 17:28:54', 'true'),
(25, 'fitrep', 'stephen.wanyee@strathmore.edu', '$2y$10$mH0jw8pQe9sLttK8m7UgXehwiYmdV2.i64vHJ2PrZqYYB0JxfkUDG', 'fit', 'rep', 'faculty representative', '2018-10-08 07:49:07', 'true'),
(26, 'scheduler', 'stepwany8@gmail.com', '$2y$10$HSNZoEnH7DRHpckU0atEqe7xsnFFLwH5aUvJGsew1HbKFH./Q7YJK', 'Scheduler', 'Manager', 'scheduler manager', '2018-10-08 07:50:52', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`),
  ADD KEY `faculty_code` (`faculty_code`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_code`);

--
-- Indexes for table `faculty_rep`
--
ALTER TABLE `faculty_rep`
  ADD KEY `rep_id` (`rep_id`),
  ADD KEY `faculty_code` (`faculty_code`);

--
-- Indexes for table `intake`
--
ALTER TABLE `intake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `room_ibfk_1` (`building_id`);

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `intake_id` (`intake_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_code`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `intake`
--
ALTER TABLE `intake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`);

--
-- Constraints for table `faculty_rep`
--
ALTER TABLE `faculty_rep`
  ADD CONSTRAINT `faculty_rep_ibfk_1` FOREIGN KEY (`rep_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_rep_ibfk_2` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`);

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `student_group_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `student_group_ibfk_2` FOREIGN KEY (`intake_id`) REFERENCES `intake` (`id`);

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
