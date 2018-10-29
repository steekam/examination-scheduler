-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2018 at 06:08 AM
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
  `faculty_code` varchar(255) NOT NULL,
  `course_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `name`, `faculty_code`, `course_type`) VALUES
('BBIT', 'Bachelor of Business Information Technology', 'FIT', 1),
('BICS', 'Bachelor of Informatics and Computer Science', 'FIT', 1),
('BTC', 'Bachelor of Telecommunications', 'FIT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`id`, `name`) VALUES
(1, 'Degree'),
(2, 'Diploma'),
(3, 'Certificate'),
(4, 'Masters'),
(5, 'Phd');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_code`, `name`) VALUES
('FIT', 'Faculty of Information Technology'),
('SGS', 'School of Graduate Studies'),
('SHSS', 'School of Humanity and Social Sciences'),
('SIMS', 'Strathmore Institute of Mathematical Sciences'),
('SLS', 'Strathmore Law School'),
('SOA', 'School of Accountancy'),
('STH', 'School of Tourism and Hospitality');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_rep`
--

CREATE TABLE `faculty_rep` (
  `rep_id` int(11) NOT NULL,
  `faculty_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_rep`
--

INSERT INTO `faculty_rep` (`rep_id`, `faculty_code`) VALUES
(29, 'SLS'),
(25, 'FIT'),
(30, 'SLS');

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`id`, `name`, `course_type`) VALUES
(1, 'APRIL-NOV', 1),
(5, 'JAN-MARCH', 2),
(6, 'JULY-MARCH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invigilators`
--

CREATE TABLE `invigilators` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `faculty_code` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invigilators`
--

INSERT INTO `invigilators` (`id`, `first_name`, `last_name`, `faculty_code`, `status`) VALUES
(1, 'Dickson', 'Owuor', 'FIT', 1),
(3, 'E.', 'Manyasi', 'FIT', 1),
(4, 'K.', 'Omondi', 'FIT', 1),
(5, 'S.', 'Evelia', 'FIT', 1),
(8, 'W.', 'Muchiri', 'FIT', 1),
(12, 'T.', 'Tabulu', 'FIT', 1),
(13, 'J.', 'Kiriu', 'FIT', 1),
(14, 'N.', 'Maingi', 'FIT', 1),
(15, 'C.', 'Ojiambo', 'FIT', 1),
(16, 'Dr. B.', 'Shibwabo', 'FIT', 1),
(17, 'R.', 'Kingori', 'FIT', 1),
(18, 'V.', 'Kimutai', 'FIT', 1),
(19, 'Dr. H.', 'Njogu', 'FIT', 1),
(20, 'M.', 'Oteri', 'FIT', 1),
(21, 'N.', 'Ochieng', 'FIT', 1),
(22, 'A.', 'Khajira', 'FIT', 1),
(23, 'K.', 'Maina', 'FIT', 1),
(24, 'M.', 'Obado', 'FIT', 1),
(25, 'J.', 'Gikera', 'FIT', 1),
(26, 'S.', 'Kayugira', 'FIT', 1),
(27, 'Dr. L.', 'Chaba', 'SIMS', 1),
(28, 'R.', 'Kinyanjui', 'SOA', 1),
(29, 'A.', 'Gathogo', 'FIT', 1),
(30, 'Dr. K.', 'Awuor', 'SIMS', 1),
(31, 'M.', 'Ojijo', 'FIT', 1),
(32, 'B.', 'Kimanthi', 'SHSS', 1),
(33, 'T.', 'Tunduny', 'FIT', 1),
(34, 'J.', 'Manani', 'FIT', 1),
(35, 'I.', 'Kigen', 'FIT', 1),
(36, 'P.', 'Mogaka', 'SIMS', 1),
(37, 'Dr. V.', 'Ozianyi', 'FIT', 1),
(38, 'B.', 'Alaka', 'FIT', 1),
(39, 'S.', 'Mugambi', 'FIT', 1),
(40, 'D.', 'Mosoti', 'FIT', 1),
(41, 'P.', 'Shabaya', 'FIT', 1),
(42, 'J.', 'Osumba', 'SIMS', 1),
(43, 'J', 'Njane', 'FIT', 1),
(44, 'Prof I.', 'Ateya', 'FIT', 1),
(45, 'P.', 'Neri', 'FIT', 1);

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
(2, 'MSB 1', 2, 80, 'active'),
(3, 'Lecture Room 1', 3, 0, 'active'),
(4, 'SBS 1', 4, 0, 'active'),
(5, 'Shaba', 5, 0, 'active'),
(6, 'Zumaridi', 5, 25, 'active'),
(7, 'SBS 2', 4, 0, 'active'),
(8, 'SBS 3', 4, 0, 'active'),
(10, 'Lecture Room 4', 3, 0, 'active'),
(11, 'Lecturer Room 5', 3, 0, 'active'),
(12, 'Lecture Room 3', 3, 0, 'active'),
(13, 'Room 2', 3, 0, 'active'),
(14, 'Lecture Room 2', 3, 0, 'active'),
(15, 'Room 1', 3, 0, 'active'),
(16, 'Room 3', 3, 0, 'active'),
(18, 'MSB 2', 2, 80, 'active'),
(20, 'Room 4', 3, 0, 'active'),
(21, 'MSB 3', 2, 40, 'active'),
(22, 'MSB 4', 2, 40, 'active'),
(23, 'MSB 5', 2, 0, 'active'),
(24, 'STMB F1-04', 1, 40, 'active'),
(25, 'STMB F1-03', 1, 0, 'active'),
(32, 'MSB 6', 2, 0, 'active'),
(33, 'MSB 7', 2, 40, 'active'),
(60, 'STMB F1-01', 1, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `intake_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_group`
--

INSERT INTO `student_group` (`group_id`, `name`, `course_code`, `size`, `intake_id`) VALUES
(2, 'ICS2A', 'BICS', 41, 1),
(5, 'ICS2B', 'BICS', 23, 1),
(6, 'ICS2C', 'BICS', 38, 1),
(7, 'BIT1A', 'BBIT', 53, 1),
(8, 'BIT1B', 'BBIT', 51, 1),
(9, 'BTC1', 'BTC', 10, 1),
(10, 'BTC2', 'BTC', 20, 1),
(11, 'BTC3', 'BTC', 19, 1),
(12, 'BTC4', 'BTC', 21, 1),
(14, 'ICS1A', 'BICS', 27, 1),
(15, 'ICS1B', 'BICS', 41, 1),
(16, 'ICS1C', 'BICS', 36, 1),
(17, 'ICS4', 'BICS', 39, 1),
(18, 'BBT4A', 'BBIT', 59, 1),
(19, 'BBT4B', 'BBIT', 46, 1),
(20, 'BBT3A', 'BBIT', 34, 1),
(21, 'BBT3B', 'BBIT', 53, 1),
(22, 'BBT3C', 'BBIT', 41, 1),
(23, 'ICS3A', 'BICS', 46, 1),
(24, 'ICS3B', 'BICS', 45, 1),
(25, 'BBT2A', 'BBIT', 22, 1),
(26, 'BBT2B', 'BBIT', 41, 1),
(27, 'BBT2C', 'BBIT', 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_tagmap`
--

CREATE TABLE `student_tagmap` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tagmap`
--

INSERT INTO `student_tagmap` (`id`, `group_id`, `tag_id`) VALUES
(2, 2, 2),
(3, 2, 2),
(4, 5, 2),
(5, 6, 2),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1),
(9, 10, 2),
(10, 11, 3),
(11, 12, 4),
(13, 14, 1),
(14, 15, 1),
(15, 16, 1),
(16, 17, 4),
(17, 18, 4),
(18, 19, 4),
(19, 20, 3),
(20, 21, 3),
(21, 22, 3),
(22, 23, 3),
(23, 24, 3),
(24, 25, 2),
(25, 26, 2),
(26, 27, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `tag_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_group`) VALUES
(1, 'Year 1', 'year'),
(2, 'Year 2', 'year'),
(3, 'Year 3', 'year'),
(4, 'Year 4', 'year'),
(5, 'Semester 1', 'semester'),
(6, 'Semester 2', 'semester');

-- --------------------------------------------------------

--
-- Table structure for table `tagmap`
--

CREATE TABLE `tagmap` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(255) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagmap`
--

INSERT INTO `tagmap` (`id`, `unit_code`, `tag_id`) VALUES
(11, 'ICS1102', 1),
(12, 'ICS1102', 5),
(13, 'ICS1103', 1),
(14, 'ICS1103', 5),
(15, 'ICS1104', 1),
(16, 'ICS1104', 5),
(17, 'ICS1105', 1),
(18, 'ICS1105', 5),
(19, 'ICS1201', 1),
(20, 'ICS1201', 6),
(21, 'ICS2101', 2),
(22, 'ICS2101', 5),
(25, 'ICS1101', 1),
(26, 'ICS1101', 5),
(29, 'BTC1202', 1),
(30, 'BTC1202', 5),
(31, 'ICS2206', 2),
(32, 'ICS2206', 6),
(33, 'BTC3106', 2),
(34, 'BTC3106', 6),
(35, 'BBT1201', 1),
(36, 'BBT1201', 6),
(37, 'ICS4201', 4),
(38, 'ICS4201', 6),
(39, 'ICS1203', 1),
(40, 'ICS1203', 6),
(41, 'BBT4201', 4),
(42, 'BBT4201', 6),
(43, 'BBT3203', 3),
(44, 'BBT3203', 6),
(45, 'BTC3203', 3),
(46, 'BTC3203', 6),
(47, 'ICS3205', 3),
(48, 'ICS3205', 6),
(49, 'BTC2201', 2),
(50, 'BTC2201', 6),
(51, 'BBT3103', 3),
(52, 'BBT3103', 6),
(53, 'ICS3105', 3),
(54, 'ICS3105', 6),
(55, 'BTC4203', 4),
(56, 'BTC4203', 6),
(57, 'ICS2202', 2),
(58, 'ICS2202', 6),
(59, 'BBT3202', 3),
(60, 'BBT3202', 6),
(61, 'BTC3205', 3),
(62, 'BTC3205', 6),
(63, 'BBT4104', 4),
(64, 'BBT4104', 5),
(65, 'ICS3204', 3),
(66, 'ICS3204', 6),
(69, 'ICS4206', 2),
(70, 'ICS4206', 6),
(71, 'BBT4203', 4),
(72, 'BBT4203', 6),
(73, 'ICS4204', 4),
(74, 'ICS4204', 6),
(75, 'BTC4204', 4),
(76, 'BTC4204', 6),
(79, 'ICS2103', 1),
(80, 'ICS2103', 6),
(81, 'BTC1203', 1),
(82, 'BTC1203', 6),
(83, 'BBT2205', 1),
(84, 'BBT2205', 6),
(87, 'BTC1205', 1),
(88, 'BTC1205', 6),
(89, 'BBT4204', 4),
(90, 'BBT4204', 6),
(91, 'BTC3204', 3),
(92, 'BTC3204', 6),
(93, 'ICS3203', 3),
(94, 'ICS3203', 6),
(95, 'ICS1205', 1),
(96, 'ICS1205', 6),
(97, 'BTC4202', 4),
(98, 'BTC4202', 6),
(99, 'ICS4203', 4),
(100, 'ICS4203', 6),
(101, 'BBT1204', 1),
(102, 'BBT1204', 6),
(103, 'BTC1201', 1),
(104, 'BTC1201', 6),
(105, 'BTC4201', 4),
(106, 'BTC4201', 6),
(107, 'BBT2206', 2),
(108, 'BBT2206', 6),
(109, 'BTC3201', 3),
(110, 'BTC3201', 6),
(111, 'BBT4106', 4),
(112, 'BBT4106', 6),
(113, 'BTC2203', 2),
(114, 'BTC2203', 6),
(115, 'ICS4202', 4),
(116, 'ICS4202', 6),
(117, 'BBT3201', 3),
(118, 'BBT3201', 6),
(119, 'BTC4205', 4),
(120, 'BTC4205', 6),
(123, 'ICS2203', 2),
(124, 'ICS2203', 6),
(125, 'ICS3202', 3),
(126, 'ICS3202', 6),
(127, 'ICS3206', 3),
(128, 'ICS3206', 6),
(129, 'BTC3206', 3),
(130, 'BTC3206', 6),
(131, 'BBT4205', 4),
(132, 'BBT4205', 6),
(133, 'BBT2202', 2),
(134, 'BBT2202', 6),
(135, 'ICS2201', 2),
(136, 'ICS2201', 6),
(137, 'BTC2204', 2),
(138, 'BTC2204', 6),
(139, 'BBT1206', 1),
(140, 'BBT1206', 6),
(141, 'ICS1204', 1),
(142, 'ICS1204', 6),
(143, 'BBT4211', 4),
(144, 'BBT4211', 6),
(145, 'ICS4107', 4),
(146, 'ICS4107', 6),
(147, 'BTC3202', 3),
(148, 'BTC3202', 6),
(149, 'BBT3204', 3),
(150, 'BBT3204', 6),
(153, 'BBT1203', 1),
(154, 'BBT1203', 6),
(155, 'ICS1202', 1),
(156, 'ICS1202', 6),
(157, 'ICS2211', 2),
(158, 'ICS2211', 6),
(161, 'BBT2201', 2),
(162, 'BBT2201', 6),
(163, 'BTC2202', 2),
(164, 'BTC2202', 6);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `exam_duration` double DEFAULT NULL,
  `pref_invigilator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_code`, `name`, `course_code`, `exam_duration`, `pref_invigilator`) VALUES
('BBT1201', 'Database Systems', 'BBIT', 2, 14),
('BBT1203', 'Object Oriented Programming I', 'BBIT', 2, 33),
('BBT1204', 'Business anf Finance', 'BBIT', 2, 34),
('BBT1206', 'Calculus I', 'BBIT', 2, 42),
('BBT2201', 'Computer Organization and Architecture', 'BBIT', 2, 45),
('BBT2202', 'Software Engineering', 'BBIT', 2, 41),
('BBT2205', 'Computer networks', 'BBIT', 2, 26),
('BBT2206', 'Probability and Statistics I', 'BBIT', 2, 36),
('BBT3103', 'IT Project Management', 'BBIT', 2, 19),
('BBT3201', 'Artificial Intelligence', 'BBIT', 2, 8),
('BBT3202', 'Mobile Application Development', 'BBIT', 2, 21),
('BBT3203', 'Research Methodology and technical Writing', 'BBIT', 2, 16),
('BBT3204', 'Simulation and Modelling', 'BBIT', 2, 18),
('BBT4104', 'Accounting Information Systems', 'BBIT', 2, 23),
('BBT4106', 'Computer games and programming', 'BBIT', 2, 38),
('BBT4201', 'Information Systems Auditing', 'BBIT', 2, 15),
('BBT4203', 'IT and Business Law', 'BBIT', 2, 24),
('BBT4204', 'WAN Technologies and Enterprise Networks', 'BBIT', 2, 5),
('BBT4205', 'Business IntelligenceII', 'BBIT', 2, 14),
('BBT4211', 'Corporate Governance and Sustainability', 'BBIT', 2, 43),
('BTC1201', 'Data Structures and Algorithm', 'BTC', 2, 33),
('BTC1202', 'Basic Voice and Data Communication', 'BTC', 2, 12),
('BTC1203', 'Introduction to computer networks', 'BTC', 2, 1),
('BTC1205', 'Principles of Management', 'BTC', 2, 28),
('BTC2201', 'Wireless Communications', 'BTC', 2, 18),
('BTC2202', 'Computer Organization Architecture', 'BTC', 2, 44),
('BTC2203', 'Data Networks and Design', 'BTC', 2, 37),
('BTC2204', 'Computational Models for telecommunication', 'BTC', 2, 22),
('BTC3106', 'Probability and Statistics II', 'BTC', 2, 1),
('BTC3201', 'WAN technologies', 'BTC', 2, 26),
('BTC3202', 'Telecommunication Standards', 'BTC', 2, 18),
('BTC3203', 'Research Methodology and technical Writing', 'BTC', 2, 17),
('BTC3204', 'Telecommunication Project management', 'BTC', 2, 15),
('BTC3205', 'Mobile Application Development', 'BTC', 2, 22),
('BTC3206', 'Server Administration', 'BTC', 2, 40),
('BTC4201', 'Distributed systems', 'BTC', 2, 14),
('BTC4202', 'Telecommunication Network Architectures', 'BTC', 2, 31),
('BTC4203', 'Advanced Wireless Communication', 'BTC', 2, 18),
('BTC4204', 'Telecommunications and Business Law', 'BTC', 2, 1),
('BTC4205', 'Artificial Intelligence', 'BTC', 2, 1),
('ICS1101', 'Fundamentals of Computer', 'BICS', 2, 4),
('ICS1102', 'Introduction to programming', 'BICS', 2, NULL),
('ICS1103', 'Differential Calculus', 'BICS', 2, NULL),
('ICS1104', 'Discrete Mathematics', 'BICS', 2, NULL),
('ICS1105', 'Principles of Economics', 'BICS', 2, NULL),
('ICS1201', 'Data Structures and Algorithm', 'BICS', 2, NULL),
('ICS1202', 'Object Oriented Programming I', 'BICS', 2, 22),
('ICS1203', 'Database Systems', 'BICS', 2, 13),
('ICS1204', 'Integral Calculus', 'BICS', 2, 30),
('ICS1205', 'Linear Algebra', 'BICS', 2, 30),
('ICS2101', 'Object Oriented Programming II', 'BICS', 2, NULL),
('ICS2103', 'Computer Networks', 'BICS', 2, 25),
('ICS2201', 'Software Engineering', 'BICS', 2, 3),
('ICS2202', 'Operating Systems', 'BICS', 2, 20),
('ICS2203', 'Advanced Networking', 'BICS', 2, 1),
('ICS2206', 'Probability and Statistics II', 'BICS', 2, 27),
('ICS2211', 'Digital Logic', 'BICS', 2, 20),
('ICS3105', 'Multimedia Applications', 'BICS', 2, 4),
('ICS3202', 'Artificial intelligence', 'BICS', 2, 39),
('ICS3203', 'Assembly Language Programming', 'BICS', 2, 22),
('ICS3204', 'Computer Graphics', 'BICS', 2, 4),
('ICS3205', 'Research and Methodology and technical Writing', 'BICS', 2, 1),
('ICS3206', 'Server Administration', 'BICS', 2, 40),
('ICS4107', 'Corporate Governance and Sustainability', 'BICS', 2, 43),
('ICS4201', 'Social Informatics', 'BICS', 2, 8),
('ICS4202', 'Mobile Wireless Security', 'BICS', 2, 31),
('ICS4203', 'Informations Systems Security and Design', 'BICS', 2, 12),
('ICS4204', 'Computing and Business Law', 'BICS', 2, 1),
('ICS4206', 'IT Entrepreneurship and Innovation', 'BICS', 2, 28);

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
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activated` varchar(255) NOT NULL DEFAULT 'false',
  `user_type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `registered_at`, `activated`, `user_type`) VALUES
(13, 'SWanyee', 'waynewanye@gmail.com', '$2y$10$aRsG7wpHpxr7H5XJRVLZ8OqOcdBrwrZc.z1wdhMbYMQje6.xX/wai', 'Stephen', 'Wanyee', '2018-09-11 19:31:42', 'true', 1),
(20, 'HMundui', 'hellen@gmail.com', '$2y$10$TvmntuNdn20fe/lIHnJ/GOVyAITOAlJ49DKkfM9sx2nOEoOYYTEeS', 'Hellen', 'Mundui', '2018-09-16 23:36:13', 'false', 2),
(21, 'MJordan', 'michael.jords@mail.com', '$2y$10$zowI5sFKlIJbEbL0mDPLVOwjpGpT6gF8wMeExO.4xKxSon2NM8Q1u', 'Michael', 'Jordan', '2018-09-16 23:36:57', 'false', 1),
(22, 'IMotanya', 'isaack.motanya@strathmore.edu', '$2y$10$t8Rb8OweGnxCS.4mNdyMs.fH3Bvvp3e2wU5yqRjOQrV8G/EE1YO1q', 'Isaack', 'Motanya', '2018-09-18 09:06:27', 'true', 1),
(23, 'RToor', 'isaackmotanya6@gmail.com', '$2y$10$NwMCHlcqoB5v5o2D5zWF7.d7sgkd10b7cBxfZL3U1uiObUzSme/h2', 'Root', 'Toor', '2018-09-20 17:28:54', 'true', 1),
(25, 'fitrep', 'stephen.wanyee@strathmore.edu', '$2y$10$mH0jw8pQe9sLttK8m7UgXehwiYmdV2.i64vHJ2PrZqYYB0JxfkUDG', 'fit', 'rep', '2018-10-08 07:49:07', 'true', 2),
(26, 'scheduler', 'stepwany8@gmail.com', '$2y$10$HSNZoEnH7DRHpckU0atEqe7xsnFFLwH5aUvJGsew1HbKFH./Q7YJK', 'Scheduler', 'Manager', '2018-10-08 07:50:52', 'true', 3),
(28, 'MMathew', 'waynewanyee@gmail.com', '$2y$10$Yo9leMQVZ8Xm.mq1hBd83uw5ELZoRT0u/HYZbgy7nbt7tRj08FavC', 'Mateo', 'Mathew', '2018-10-26 06:42:13', 'false', 2),
(29, 'CKing', 'kingjay@mail.com', '$2y$10$DaLPJalRQmVQNj34TN77uuTa2ehi08DNlXIlJ25fD8RkTbpdEwCSO', 'Christoper', 'King', '2018-10-26 06:45:57', 'false', 2),
(30, 'sls', 'sls@gmail.com', '$2y$10$4wldfkh6aji3CZu26XotYuh6ZpWD44Eu/.8DhwmvT8v843dva1O16', 'sls', 'rep', '2018-10-27 04:45:49', 'false', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'administrator'),
(2, 'faculty representative'),
(3, 'scheduler manager');

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
  ADD KEY `course_ibfk_1` (`faculty_code`),
  ADD KEY `course_ibfk_2` (`course_type`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_type` (`course_type`);

--
-- Indexes for table `invigilators`
--
ALTER TABLE `invigilators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_code` (`faculty_code`);

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
-- Indexes for table `student_tagmap`
--
ALTER TABLE `student_tagmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_tagmap_ibfk_1` (`group_id`),
  ADD KEY `student_tagmap_ibfk_2` (`tag_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tagmap`
--
ALTER TABLE `tagmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagmap_ibfk_1` (`unit_code`),
  ADD KEY `tagmap_ibfk_2` (`tag_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_code`),
  ADD KEY `unit_ibfk_1` (`course_code`),
  ADD KEY `pref_invigilator` (`pref_invigilator`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
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
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `intake`
--
ALTER TABLE `intake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invigilators`
--
ALTER TABLE `invigilators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student_tagmap`
--
ALTER TABLE `student_tagmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tagmap`
--
ALTER TABLE `tagmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`course_type`) REFERENCES `course_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculty_rep`
--
ALTER TABLE `faculty_rep`
  ADD CONSTRAINT `faculty_rep_ibfk_1` FOREIGN KEY (`rep_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_rep_ibfk_2` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`);

--
-- Constraints for table `intake`
--
ALTER TABLE `intake`
  ADD CONSTRAINT `intake_ibfk_1` FOREIGN KEY (`course_type`) REFERENCES `course_type` (`id`);

--
-- Constraints for table `invigilators`
--
ALTER TABLE `invigilators`
  ADD CONSTRAINT `invigilators_ibfk_1` FOREIGN KEY (`faculty_code`) REFERENCES `faculty` (`faculty_code`);

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
-- Constraints for table `student_tagmap`
--
ALTER TABLE `student_tagmap`
  ADD CONSTRAINT `student_tagmap_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `student_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_tagmap_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagmap`
--
ALTER TABLE `tagmap`
  ADD CONSTRAINT `tagmap_ibfk_1` FOREIGN KEY (`unit_code`) REFERENCES `unit` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagmap_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_ibfk_2` FOREIGN KEY (`pref_invigilator`) REFERENCES `invigilators` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
