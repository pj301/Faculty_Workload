-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 05:44 AM
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
-- Database: `scheduling_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `ad_role` varchar(50) NOT NULL,
  `ad_accountName` varchar(50) NOT NULL,
  `ad_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `ad_name`, `ad_role`, `ad_accountName`, `ad_password`) VALUES
(1, 'Peter', 'Program Head', 'peter123', 'peter123');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_ID` int(30) NOT NULL,
  `year_level` varchar(30) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_ID`, `year_level`, `section`) VALUES
(27, 'First Year', 'A'),
(28, 'Second Year', 'B'),
(29, 'Third Year', 'C'),
(30, 'Fourth Year', 'D'),
(31, '', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule_info`
--

CREATE TABLE `class_schedule_info` (
  `id` int(30) NOT NULL,
  `schedule_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `subject` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `col_ID` int(11) NOT NULL,
  `col_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`col_ID`, `col_name`) VALUES
(24, 'COLLEGE OF EDUCATION'),
(25, 'College of Engineering'),
(27, 'COLLEGE OF TECHNOLOGY'),
(30, 'Colle of Vocational');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `prog_code` varchar(50) NOT NULL,
  `course` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `prog_code`, `course`, `description`) VALUES
(4, '', 'BSCS', 'Bachelor of Science in Computer Science'),
(5, '', 'BSIS', 'Bachelor of Science in Information Systems'),
(6, '', 'BSED', 'Bachelor in Secondary Education'),
(7, '', 'BSBA', 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `facultyID` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `f_position` varchar(50) NOT NULL,
  `f_empStatus` varchar(50) NOT NULL,
  `f_emp_ID` varchar(50) NOT NULL,
  `f_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`facultyID`, `f_name`, `f_position`, `f_empStatus`, `f_emp_ID`, `f_password`) VALUES
(1, 'john', 'teacher', 'full time', '100023', 'john123');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(30) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `id_no`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `email`) VALUES
(2, '37362629', 'Claire', 'C', 'Blake', '+12345687923', 'Female', 'Sample Address', 'cblake@sample.com'),
(3, '07101187', 'Bernadettess', 'C.', 'Requinto', '0912312421', 'Female', 'Naga, Cebu, City', 'berna@gmail.com'),
(4, '28993801', 'john paul', 'C.', 'cano', '0912312421', 'Male', 'naga', 'dsasdas@fds');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_workload`
--

CREATE TABLE `faculty_workload` (
  `workload_id` int(11) NOT NULL,
  `prod_ID` int(11) NOT NULL,
  `col_ID` int(11) NOT NULL,
  `class_ID` int(11) NOT NULL,
  `roomCODE` int(11) NOT NULL,
  `sched_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `prog_ID` int(11) NOT NULL,
  `prog_code` varchar(50) NOT NULL,
  `prog_name` varchar(50) NOT NULL,
  `col_ID` int(11) DEFAULT NULL,
  `class_ID` int(11) DEFAULT NULL,
  `sub_code` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`prog_ID`, `prog_code`, `prog_name`, `col_ID`, `class_ID`, `sub_code`) VALUES
(18, 'BSIT', 'Bachelor of Science in Information Technology', 27, NULL, NULL),
(42, 'BSED', 'Bachelor of Science in Basic Accounting', 24, NULL, NULL),
(47, 'sdsd', 'Bachelor of Science in Education', 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_subjects`
--

CREATE TABLE `program_subjects` (
  `prosub_ID` int(11) NOT NULL,
  `prog_ID` int(11) DEFAULT NULL,
  `sub_code` int(11) DEFAULT NULL,
  `col_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_subjects`
--

INSERT INTO `program_subjects` (`prosub_ID`, `prog_ID`, `sub_code`, `col_ID`) VALUES
(1, 18, NULL, 24);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomCODE` int(11) NOT NULL,
  `rm_buildingName` varchar(50) NOT NULL,
  `rm_Desc` varchar(50) NOT NULL,
  `rm_type` varchar(50) NOT NULL,
  `rm_floor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomCODE`, `rm_buildingName`, `rm_Desc`, `rm_type`, `rm_floor`) VALUES
(2, 'Main ', 'St.Dominic', 'Comlab', '3rd'),
(3, 'Indigo', 'Ubos', 'Shs', '1'),
(5, 'Indigo', 'elem', 'ching', '1st'),
(6, 'Main ', 'SKYGYM', 'No aircon', '6'),
(8, 'sadasd', 'sads', 'No aircon', '4');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `schedule_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= class, 2= meeting,3=others',
  `description` text NOT NULL,
  `location` text NOT NULL,
  `is_repeating` tinyint(1) NOT NULL DEFAULT 1,
  `repeating_data` text NOT NULL,
  `schedule_date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `faculty_id`, `title`, `schedule_type`, `description`, `location`, `is_repeating`, `repeating_data`, `schedule_date`, `time_from`, `time_to`, `date_created`) VALUES
(3, 2, 'Class 101 (M & Th)', 1, 'Sample Only', 'Online', 1, '{\"dow\":\"1,4\",\"start\":\"2020-10-01\",\"end\":\"2020-11-30\"}', '0000-00-00', '09:00:00', '12:00:00', '2020-10-20 15:51:01'),
(4, 1, 'math', 1, 'discussed', 'main building', 1, '{\"dow\":\"2\",\"start\":\"2024-02-01\",\"end\":\"2024-03-31\"}', '0000-00-00', '01:43:00', '02:43:00', '2024-01-28 12:45:00'),
(5, 2, 'sadsadsa', 1, 'sadad', 'wqeqweq', 1, '{\"dow\":\"2\",\"start\":\"2024-07-01\",\"end\":\"2024-03-31\"}', '0000-00-00', '18:51:00', '18:51:00', '2024-01-28 18:51:32'),
(6, 2, 'ghgfg', 1, 'zxhgg', 'ghhghg', 1, '{\"dow\":\"4\",\"start\":\"2024-01-01\",\"end\":\"2024-12-31\"}', '0000-00-00', '09:59:00', '10:59:00', '2024-01-28 19:59:19'),
(7, 3, 'BSIT', 1, 'CC101', 'MAIN BUILDING', 1, '{\"dow\":\"1,2,3\",\"start\":\"2024-01-01\",\"end\":\"2024-02-29\"}', '0000-00-00', '13:49:00', '14:49:00', '2024-01-30 11:50:30'),
(8, 4, 'vdss', 1, 'sadasd', 'sadsa', 1, '{\"dow\":\"1,2,3\",\"start\":\"2024-01-01\",\"end\":\"2024-01-31\"}', '0000-00-00', '13:49:00', '14:49:00', '2024-01-30 18:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_code` int(30) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `year_level` varchar(50) DEFAULT NULL,
  `semester` varchar(50) NOT NULL,
  `unit_credit` int(11) NOT NULL,
  `lecture_hrs` int(11) NOT NULL,
  `lab_hrs` int(11) NOT NULL,
  `slot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Event Management System', 'info@sample.comm', '+6948 8542 623', '1707100860_Capture.PNG', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `termID` int(11) NOT NULL,
  `termName` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Department', 'admin', '0192023a7bbd73250516f069df18b500', 1),
(2, 'peter', 'superadmin', '123456', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_account` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `user_account`, `password`, `user_type`, `image`) VALUES
(1, 'john', 'test', '202cb962ac59075b964b07152d234b70', 'chairperson', 'logo.png'),
(2, 'admin', 'test', '098f6bcd4621d373cade4e832627b4f6', '', 'mark.jpg'),
(3, 'axa', 'test1', '5a105e8b9d40e1329780d62ea2265d8a', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_ID`);

--
-- Indexes for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`col_ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_workload`
--
ALTER TABLE `faculty_workload`
  ADD PRIMARY KEY (`workload_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`prog_ID`),
  ADD KEY `program_ibfk_1` (`sub_code`),
  ADD KEY `program_ibfk_2` (`class_ID`),
  ADD KEY `program_ibfk_3` (`col_ID`);

--
-- Indexes for table `program_subjects`
--
ALTER TABLE `program_subjects`
  ADD PRIMARY KEY (`prosub_ID`),
  ADD KEY `prog_ID` (`prog_ID`),
  ADD KEY `sub_code` (`sub_code`),
  ADD KEY `col_ID` (`col_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomCODE`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_code`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`termID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `col_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `facultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculty_workload`
--
ALTER TABLE `faculty_workload`
  MODIFY `workload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `prog_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `program_subjects`
--
ALTER TABLE `program_subjects`
  MODIFY `prosub_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomCODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_code` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `termID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`sub_code`) REFERENCES `subjects` (`sub_code`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `program_ibfk_2` FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `program_ibfk_3` FOREIGN KEY (`col_ID`) REFERENCES `colleges` (`col_ID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `program_subjects`
--
ALTER TABLE `program_subjects`
  ADD CONSTRAINT `program_subjects_ibfk_1` FOREIGN KEY (`prog_ID`) REFERENCES `program` (`prog_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `program_subjects_ibfk_2` FOREIGN KEY (`sub_code`) REFERENCES `subjects` (`sub_code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `program_subjects_ibfk_3` FOREIGN KEY (`col_ID`) REFERENCES `colleges` (`col_ID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
