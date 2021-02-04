-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 01:56 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_detail`
--

CREATE TABLE `admin_login_detail` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` text NOT NULL,
  `admin_number` bigint(20) NOT NULL,
  `admin_token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login_detail`
--

INSERT INTO `admin_login_detail` (`admin_id`, `admin_username`, `admin_password`, `admin_name`, `admin_email`, `admin_number`, `admin_token`) VALUES
(1, 'admin', '123456', 'xyz', 'xyz@xyz.com', 9999999999, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_list`
--

CREATE TABLE `faculty_list` (
  `faculty_id` int(11) NOT NULL,
  `faculty_username` varchar(255) NOT NULL,
  `faculty_password` varchar(255) NOT NULL,
  `faculty_name` text NOT NULL,
  `faculty_email` varchar(255) NOT NULL,
  `faculty_number` bigint(20) NOT NULL,
  `faculty_department` varchar(255) NOT NULL,
  `faculty_token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(1, 'Shivam Jain', 'shivamjain248@gmail.com', 'Hello Shivam'),
(2, 'Testing', 'testing@gmail.com', 'Hello'),
(3, 'CvnB', 'shivamjain248@gmail.com', '..'),
(4, 'Shivam', 'shivamjain248@gmail.com', 'fvsdvsdvsdvsvsvsvsdvsdvsdvsdv'),
(5, 'asd', 'asdcfasc@GMAIL.COM', 'aaaa'),
(6, 'advadv', 'asdcfasc@GMAIL.COM', 'dvsdvsdvbsdbsdb'),
(7, 'vats', 'vats@gmail.com', 'sccdjbd'),
(8, 'Yhsvhwhdhehdh', 'shivamjain248@gmail.com', 'Hydhdhd'),
(9, 'Dty', 'shivamjain248@gmail.com', '5yuu');

-- --------------------------------------------------------

--
-- Table structure for table `hod_list`
--

CREATE TABLE `hod_list` (
  `hod_id` int(11) NOT NULL,
  `hod_username` varchar(255) NOT NULL,
  `hod_password` varchar(255) NOT NULL,
  `hod_name` text NOT NULL,
  `hod_email` varchar(255) NOT NULL,
  `hod_number` bigint(20) NOT NULL,
  `hod_department` varchar(255) NOT NULL,
  `hod_token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hod_message_to_faculty`
--

CREATE TABLE `hod_message_to_faculty` (
  `hod_message_id` int(11) NOT NULL,
  `hod_department` varchar(255) NOT NULL,
  `hod_message` longtext NOT NULL,
  `hod_message_sent_to` text NOT NULL,
  `hod_message_sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hod_message_sent_to_faculty_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login_detail`
--
ALTER TABLE `admin_login_detail`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_username` (`faculty_username`),
  ADD UNIQUE KEY `faculty_number` (`faculty_number`),
  ADD UNIQUE KEY `faculty_email` (`faculty_email`),
  ADD KEY `faculty_list_ibfk_1` (`faculty_department`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hod_list`
--
ALTER TABLE `hod_list`
  ADD PRIMARY KEY (`hod_id`),
  ADD UNIQUE KEY `hod_department` (`hod_department`),
  ADD UNIQUE KEY `hod_username` (`hod_username`),
  ADD UNIQUE KEY `hod_number` (`hod_number`),
  ADD UNIQUE KEY `hod_email` (`hod_email`);

--
-- Indexes for table `hod_message_to_faculty`
--
ALTER TABLE `hod_message_to_faculty`
  ADD PRIMARY KEY (`hod_message_id`),
  ADD KEY `hod_message_to_faculty_ibfk_1` (`hod_department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login_detail`
--
ALTER TABLE `admin_login_detail`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_list`
--
ALTER TABLE `faculty_list`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hod_list`
--
ALTER TABLE `hod_list`
  MODIFY `hod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hod_message_to_faculty`
--
ALTER TABLE `hod_message_to_faculty`
  MODIFY `hod_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD CONSTRAINT `faculty_list_ibfk_1` FOREIGN KEY (`faculty_department`) REFERENCES `hod_list` (`hod_department`);

--
-- Constraints for table `hod_message_to_faculty`
--
ALTER TABLE `hod_message_to_faculty`
  ADD CONSTRAINT `hod_message_to_faculty_ibfk_1` FOREIGN KEY (`hod_department`) REFERENCES `hod_list` (`hod_department`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
