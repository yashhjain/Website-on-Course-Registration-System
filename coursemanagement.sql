-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2019 at 07:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`username`, `name`, `emailid`, `password`) VALUES
('anuj', 'anuj', 'anuj@gmail.com', 'anujjio'),
('Sreeram', 'Sreeram', 'chittelasreeram@gmail.com', 'someone'),
('yash', 'yash', 'yashhjain@gmail.com', 'someone');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(10) NOT NULL,
  `course_code` int(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `about` varchar(100) NOT NULL,
  `seats` int(10) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `course_code`, `course_name`, `dept_id`, `about`, `seats`, `time`) VALUES
(4, 1, 'reproduction in animals and humans', 4, 'about how animals make off-springs.', 50, '10:00 - 11:15'),
(5, 2, 'photosynthesis', 4, 'food for plants', 35, '11:00 - 12:30'),
(8, 3, 'rain forest', 4, 'about forests', 40, '11:00 - 12:30'),
(9, 636, 'database design', 5, 'creating and managing database', 60, '11:30 - 12:45'),
(10, 6390, 'distributed system', 5, 'network of computers', 75, '8:30 - 9:45'),
(11, 6301, 'project management', 6, 'managing a project and maintain it', 60, '4:30 - 5:45');

-- --------------------------------------------------------

--
-- Table structure for table `course_term`
--

CREATE TABLE `course_term` (
  `course_id` int(10) NOT NULL,
  `term_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_term`
--

INSERT INTO `course_term` (`course_id`, `term_id`) VALUES
(4, 2),
(4, 3),
(5, 1),
(5, 3),
(8, 2),
(11, 1),
(11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptid` int(10) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `dept_name`) VALUES
(4, 'biology'),
(5, 'computer science'),
(6, 'information systems');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `course_id` int(10) NOT NULL,
  `term_id` int(10) NOT NULL,
  `available_seats` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`course_id`, `term_id`, `available_seats`) VALUES
(4, 2, 40),
(4, 3, 50),
(5, 1, 35),
(5, 3, 34),
(8, 2, 40),
(11, 1, 54),
(11, 3, 55);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `termid` int(10) NOT NULL,
  `termname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`termid`, `termname`) VALUES
(1, 'Fall'),
(2, 'Spring'),
(3, 'Summer');

-- --------------------------------------------------------

--
-- Table structure for table `users_enrolled`
--

CREATE TABLE `users_enrolled` (
  `user_name` varchar(50) NOT NULL,
  `course_id` int(10) NOT NULL,
  `term_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_enrolled`
--

INSERT INTO `users_enrolled` (`user_name`, `course_id`, `term_id`) VALUES
('anuj', 11, 1),
('Sreeram', 5, 3),
('Sreeram', 8, 1),
('Sreeram', 9, 1),
('yash', 8, 1),
('yash', 9, 1),
('yash', 9, 2),
('yash', 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`username`,`emailid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `course_term`
--
ALTER TABLE `course_term`
  ADD PRIMARY KEY (`course_id`,`term_id`),
  ADD KEY `term_id` (`term_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`course_id`,`term_id`),
  ADD KEY `term_id` (`term_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`termid`);

--
-- Indexes for table `users_enrolled`
--
ALTER TABLE `users_enrolled`
  ADD PRIMARY KEY (`user_name`,`course_id`,`term_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deptid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`deptid`);

--
-- Constraints for table `course_term`
--
ALTER TABLE `course_term`
  ADD CONSTRAINT `course_term_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `course_term_ibfk_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`termid`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`term_id`) REFERENCES `term` (`termid`),
  ADD CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`term_id`) REFERENCES `term` (`termid`);

--
-- Constraints for table `users_enrolled`
--
ALTER TABLE `users_enrolled`
  ADD CONSTRAINT `users_enrolled_ibfk_1` FOREIGN KEY (`term_id`) REFERENCES `term` (`termid`),
  ADD CONSTRAINT `users_enrolled_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `users_enrolled_ibfk_3` FOREIGN KEY (`user_name`) REFERENCES `authentication` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
