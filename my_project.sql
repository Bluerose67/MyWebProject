-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `d_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`d_id`, `user_id`) VALUES
(1, 46),
(2, 47),
(3, 51),
(4, 52);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `batch_no` int(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `batch_no`) VALUES
(21, 2077),
(23, 2078),
(24, 2076);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`) VALUES
(22, 'BCA'),
(24, 'CSIT'),
(25, 'BBM');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `d_id` int(11) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`d_id`, `department`) VALUES
(1, 'Not available'),
(2, 'Department of Science'),
(3, 'Department of Management'),
(4, 'Department of Arts');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image`, `date`) VALUES
(2, 'graduation ceremony', 'we are going to host a graduation ceremony so we request the students to visit the college once.', 'Screenshot 2023-04-10 151525.png', '2023-07-16'),
(3, 'Cultural Festa', 'Alumni can join us for the years biggest festival of ACHS. Furthermore, if you are interested for funding us we will be glad to do so.', '64a57b99a97ed_Screenshot 2023-04-16 130610.png', '2023-10-18'),
(5, 'UI/UX session', 'Alumni related to UI/UX designing field can volunteer for this session as a guide for the young generations.', '64a5a5cf92cea_istockphoto-1300397135-612x612.jpg', '2023-07-20'),
(6, 'New Event', 'This is a new event which is exclusively only for Alumni.', '64b206e6b98e8_Screenshot_20221226_080404.png', '2023-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`) VALUES
(25, 'Humanities'),
(27, 'Science'),
(28, 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `interested_users`
--

CREATE TABLE `interested_users` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interested_users`
--

INSERT INTO `interested_users` (`user_id`, `id`) VALUES
(55, 2),
(55, 3),
(57, 2),
(57, 5),
(55, 5),
(55, 6),
(57, 3),
(57, 6),
(58, 2),
(58, 3),
(58, 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'super_admin'),
(2, 'admin'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `role_junction`
--

CREATE TABLE `role_junction` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_junction`
--

INSERT INTO `role_junction` (`role_id`, `user_id`) VALUES
(1, 46),
(2, 47),
(3, 49),
(3, 50),
(2, 51),
(2, 52),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(3, 60);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `std_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`std_id`, `faculty_id`, `course_id`, `batch_id`, `user_id`) VALUES
(21, 25, 22, 21, 49),
(22, 25, 22, 21, 50),
(24, 25, 22, 21, 54),
(25, 25, 22, 21, 55),
(26, 27, 24, 23, 56),
(27, 25, 22, 21, 57),
(28, 28, 25, 21, 58),
(29, 25, 22, 21, 59),
(30, 28, 24, 24, 60);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reset_token_hash` varchar(200) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `address` varchar(40) NOT NULL,
  `DOB` date NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `bio` varchar(500) NOT NULL DEFAULT 'Write about Yourself:',
  `image` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `reset_token_hash`, `reset_token_expires_at`, `address`, `DOB`, `phone_no`, `bio`, `image`, `status`) VALUES
(46, 'Super', 'Not Available', '$2y$10$JLsxnU4xgsIrMk9RbagCsucS2nUo8XbgI5ChazlGvHUF1Px04e4R.', NULL, NULL, 'Not available', '0000-00-00', 'Not Avialable', '', 'avatar.jpg', 'approved'),
(47, 'Rushab Khadka', 'rushabkhadka67@gmail.com', '$2y$10$/MIeKh9dsZlCsF499WPArOzm71F7YMTgIapGc.2Zl8eYU6DA6ZXpO', NULL, NULL, 'Budhanilkhanta', '2002-02-27', '9840379886', '       This is my Bio.', '64b2b6a0ac621_284955386_5047741688677274_8614783971046823201_n.jpg', 'approved'),
(49, 'Nalina Kunwar', 'Nalu@gmail.com', '$2y$10$MZTl4bgP6s/cQkyJWlExp.BXsMc2TFR29vTL85vYgN0V3OpFCcECy', NULL, NULL, 'Naikap', '2012-03-01', '9840293873', 'Write abour yourself', '64b3d15200920_355816296_244987931615656_8566132587215220801_n.jpg', 'pending'),
(50, 'Jinisha Magar', 'jinisha1234@gmail.com', '$2y$10$YR5iSAR8D..76gj/Dmh5AujW7sZZi5tOrjb5g6VHpVqGT5qf5FPmi', NULL, NULL, 'kalanki', '2023-06-27', '9833224455', 'Write abour yourself', '64b3deaa05a5e_jinisha.jpg', 'denied'),
(51, 'Suman Maharjan', 'chumu@gmail.com', '$2y$10$xlZ/nVl2LmrA.inMja.mG.3wYTOjIlTIr9rypvfKfbueQ435EgdwG', NULL, NULL, 'Dhobidhara', '2023-07-06', '9840293873', '  Write about Yourself:', '64b3dfd70bad6_0-02-03-3ba4bb5d0966fc86ea360744cbaef4eadfadc3c57db9c37a6aba831743cd6387_d8efe9dea916c815.jpg', 'pending'),
(52, 'Alisha Nepal', 'Alishanepal@gmail.com', '$2y$10$JK9EPxIdeBn1JEVHP1CIEeJpb0PAzhPNEm/6XX81Ozz8llYSTOd0K', NULL, NULL, 'balaju', '2023-07-12', '9840379886', 'Write about Yourself:', '64b3e0d2dc2bc_357319028_3519647611580907_7833749281630837291_n.jpg', 'denied'),
(54, 'Kiran Magar', 'Kiran@gmail.com', '$2y$10$AeLvBWnBQg.j2hKtaD2jfe9K8.ybBTLLdls9VSv/dxe4S6ABUW5.K', NULL, NULL, 'balaju', '2009-07-16', '9833224455', 'Write abour yourself', '64b41c8f62a3c_istockphoto-832533648-612x612.jpg', 'pending'),
(55, 'Azusa Shakya', 'Azusa@gmail.com', '$2y$10$T5HAWL.1iqKjVP5sRxAp..5kBnduNQIeueAjqZSmcPNdbZHSVBupi', NULL, NULL, 'Soyambhu', '2001-06-18', '9840293873', 'Write abour yourself', '64b6523a5e35b_Student.jpg', 'approved'),
(56, 'Noorin Shrestha', 'noorin@gmail.com', '$2y$10$VAu.rMo55AWLKTfbcpuwFuYR/CM1jXGJ7FJZnBcSDemTYlvuPn1Fq', NULL, NULL, 'Baneshwor', '2023-06-27', '9833224455', 'Write abour yourself', '64b7fa9897629_Screenshot 2023-06-29 143611.png', 'approved'),
(57, 'Anjan Phuyal', 'anjan123@gmail.com', '$2y$10$4JdqMLO2yN8LnbjvIYIlweHFkiP5B.PBjZaDhtbe8.fYyOh5xWzFW', NULL, NULL, 'Macchapokhari', '2023-07-11', '9840293873', 'Write abour yourself', '64b80a8f71880_Screenshot 2023-06-29 143347.png', 'approved'),
(58, 'Rabin Basnet', 'rabinb2001@gmail.com', '$2y$10$JwjGwcbDpvO75A2yRnUTMu24R0WPHNtNjwHQYPDfhpGAckI1I.qMy', '325ae894dfaec6b4fc174321834b327aa1a74903064e0d94f694d1d840469647', '2023-07-20 14:51:18', 'Budhanilkhanta', '2023-07-06', '9840293873', 'Write abour yourself', '64b925cf84272_0-02-03-cf6de4cfb3b580d60f76adfe3d3b7c732a61e10d186b5d71ed838cd66b605df1_bfabdc5d09baa137.jpg', 'approved'),
(59, 'midel shrestha', 'midelshrestha@gmail.com', '$2y$10$ziOYqnLef9FlYQt43KFGEeQq7iJyQeT9V1Elq6TtazRnPyjI0aS.y', NULL, NULL, 'Dhobidhara', '2023-07-04', '9840293873', 'Write abour yourself', '64bcbf0a88181_0-02-03-0c2f7062f77a25405643638a2380304af0afaedeb461248ca755a07354f87eca_fca639242fd2db52.jpg', 'approved'),
(60, 'Jenisha Shrestha', 'jenisha@gmail.com', '$2y$10$3k02S2sjxvM5ArDjE2p0WuzNaethwOly3QAsM.mCk4ZOxKWb0X.Qq', NULL, NULL, 'ason', '2023-07-11', '9833224455', 'Write abour yourself', '64bcc4e92d89a_jenesha.jpg', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `d_id` (`d_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `interested_users`
--
ALTER TABLE `interested_users`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_junction`
--
ALTER TABLE `role_junction`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `departments` (`d_id`),
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `interested_users`
--
ALTER TABLE `interested_users`
  ADD CONSTRAINT `interested_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `interested_users_ibfk_2` FOREIGN KEY (`id`) REFERENCES `events` (`id`);

--
-- Constraints for table `role_junction`
--
ALTER TABLE `role_junction`
  ADD CONSTRAINT `role_junction_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `role_junction_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`),
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
