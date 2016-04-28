-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2016 at 04:58 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `booking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_limits`
--

CREATE TABLE IF NOT EXISTS `booking_limits` (
  `lmit_id` bigint(20) NOT NULL,
  `selected_date` date NOT NULL,
  `maximum_limit` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_limits`
--

INSERT INTO `booking_limits` (`lmit_id`, `selected_date`, `maximum_limit`, `created_date`, `modified_date`) VALUES
(1, '2016-02-25', 3, '2016-02-16 20:44:54', '2016-02-16 20:44:54'),
(2, '2016-02-29', 3, '2016-02-16 20:47:43', '2016-02-16 20:47:43'),
(3, '2016-02-26', 2, '2016-02-16 20:53:32', '2016-02-16 20:53:32'),
(4, '2016-02-20', 3, '2016-02-17 00:50:45', '2016-02-17 00:50:45'),
(5, '2016-02-19', 3, '2016-02-17 00:53:53', '2016-02-17 00:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `booking_logs`
--

CREATE TABLE IF NOT EXISTS `booking_logs` (
  `log_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_logs`
--

INSERT INTO `booking_logs` (`log_id`, `user_id`, `url`, `created_date`, `modified_date`) VALUES
(175, 3, '/booking/user-home.php', '2016-02-17 15:14:05', '2016-02-17 15:14:05'),
(176, 3, '/booking/user-home.php', '2016-02-17 15:14:57', '2016-02-17 15:14:57'),
(177, 3, '/booking/user-home.php', '2016-02-17 15:15:12', '2016-02-17 15:15:12'),
(178, 3, '/booking/user-home.php', '2016-02-17 15:17:16', '2016-02-17 15:17:16'),
(179, 3, '/booking/user-home.php', '2016-02-17 15:18:35', '2016-02-17 15:18:35'),
(180, 3, '/booking/user-home.php', '2016-02-17 15:19:13', '2016-02-17 15:19:13'),
(181, 3, '/booking/user-home.php', '2016-02-17 15:19:22', '2016-02-17 15:19:22'),
(182, 3, '/booking/user-home.php', '2016-02-17 15:21:49', '2016-02-17 15:21:49'),
(183, 3, '/booking/user-home.php', '2016-02-17 15:22:43', '2016-02-17 15:22:43'),
(184, 3, '/booking/user-home.php', '2016-02-17 15:22:54', '2016-02-17 15:22:54'),
(185, 3, '/booking/user-home.php', '2016-02-17 15:23:26', '2016-02-17 15:23:26'),
(186, 3, '/booking/user-home.php', '2016-02-17 15:23:50', '2016-02-17 15:23:50'),
(187, 3, '/booking/user-home.php', '2016-02-17 15:23:51', '2016-02-17 15:23:51'),
(188, 3, '/booking/user-home.php', '2016-02-17 15:24:16', '2016-02-17 15:24:16'),
(189, 3, '/booking/user-home.php', '2016-02-17 15:24:33', '2016-02-17 15:24:33'),
(190, 3, '/booking/user-home.php', '2016-02-17 15:24:48', '2016-02-17 15:24:48'),
(191, 3, '/booking/user-home.php', '2016-02-17 15:25:35', '2016-02-17 15:25:35'),
(192, 3, '/booking/user-home.php', '2016-02-17 15:25:51', '2016-02-17 15:25:51'),
(193, 3, '/booking/user-home.php', '2016-02-17 15:26:02', '2016-02-17 15:26:02'),
(194, 3, '/booking/user-home.php', '2016-02-17 15:26:04', '2016-02-17 15:26:04'),
(195, 3, '/booking/user-home.php', '2016-02-17 15:26:16', '2016-02-17 15:26:16'),
(196, 6, '/booking/admin-home.php', '2016-02-17 15:27:46', '2016-02-17 15:27:46'),
(197, 6, '/booking/admin-home.php', '2016-02-17 15:29:30', '2016-02-17 15:29:30'),
(198, 6, '/booking/admin-home.php', '2016-02-17 15:29:40', '2016-02-17 15:29:40'),
(199, 6, '/booking/admin-home.php', '2016-02-17 15:30:09', '2016-02-17 15:30:09'),
(200, 6, '/booking/admin-home.php', '2016-02-17 15:31:11', '2016-02-17 15:31:11'),
(201, 6, '/booking/admin-home.php', '2016-02-17 15:35:27', '2016-02-17 15:35:27'),
(202, 6, '/booking/admin-home.php', '2016-02-17 15:35:37', '2016-02-17 15:35:37'),
(203, 6, '/booking/admin-home.php', '2016-02-17 15:37:02', '2016-02-17 15:37:02'),
(204, 6, '/booking/admin-home.php', '2016-02-17 15:38:46', '2016-02-17 15:38:46'),
(205, 6, '/booking/admin-home.php', '2016-02-17 15:39:32', '2016-02-17 15:39:32'),
(206, 6, '/booking/admin-home.php', '2016-02-17 15:39:33', '2016-02-17 15:39:33'),
(207, 6, '/booking/admin-home.php', '2016-02-17 15:40:18', '2016-02-17 15:40:18'),
(208, 6, '/booking/admin-home.php', '2016-02-17 15:40:19', '2016-02-17 15:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `booking_reservations`
--

CREATE TABLE IF NOT EXISTS `booking_reservations` (
  `reservation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reserve_date` date NOT NULL,
  `remarks` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_reservations`
--

INSERT INTO `booking_reservations` (`reservation_id`, `user_id`, `reserve_date`, `remarks`, `status`, `created_date`, `modified_date`) VALUES
(21, 3, '2016-02-20', 'This is just a remark', 1, '2016-02-17 15:19:33', '2016-02-17 15:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `booking_users`
--

CREATE TABLE IF NOT EXISTS `booking_users` (
  `user_id` bigint(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `upass` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_users`
--

INSERT INTO `booking_users` (`user_id`, `fname`, `lname`, `uname`, `upass`, `level`, `status`, `created_date`, `modified_date`) VALUES
(2, 'Justin', 'Bieber', 'justin', 'qwer1234', 2, 1, '2016-02-13 16:00:00', '2016-02-13 16:00:00'),
(3, 'Juan', 'Dela Cruz', 'juan', 'qwer1234', 2, 1, '2016-02-13 16:00:00', '2016-02-13 16:00:00'),
(6, 'Admin', '', 'admin', 'admin', 1, 1, '2016-02-16 16:00:00', '2016-02-16 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_limits`
--
ALTER TABLE `booking_limits`
  ADD PRIMARY KEY (`lmit_id`);

--
-- Indexes for table `booking_logs`
--
ALTER TABLE `booking_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `booking_reservations`
--
ALTER TABLE `booking_reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `booking_users`
--
ALTER TABLE `booking_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_limits`
--
ALTER TABLE `booking_limits`
  MODIFY `lmit_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `booking_logs`
--
ALTER TABLE `booking_logs`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT for table `booking_reservations`
--
ALTER TABLE `booking_reservations`
  MODIFY `reservation_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `booking_users`
--
ALTER TABLE `booking_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
