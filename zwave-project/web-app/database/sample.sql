-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 11:53 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `auth_id` varchar(255) NOT NULL,
  `auth_pass` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('active','disable','deleted') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `auth_id`, `auth_pass`, `role_id`, `user_id`, `status`) VALUES
(55, 'admin@way2mint.com', 'fe14d20fe72d9a0594876b3511bef9f1', 1, 44, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `id` int(11) NOT NULL,
  `menu_label` varchar(255) NOT NULL,
  `menu_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`id`, `menu_label`, `menu_title`) VALUES
(1, 'menu_dashboard', 'Dashboard'),
(2, 'menu_notification', 'Notification'),
(3, 'menu_campaigns', 'Campaigns'),
(4, 'menu_phone_book', 'Phone Book'),
(5, 'menu_user_account', 'User Accounts'),
(6, 'menu_other', 'Others'),
(7, 'menu_support_tools', 'Support Tools'),
(8, 'menu_settings', 'Settings');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `menu_phone_book` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `menu_dashboard` int(11) NOT NULL DEFAULT 1,
  `menu_notification` int(11) DEFAULT 0,
  `menu_campaigns` int(11) NOT NULL DEFAULT 0,
  `menu_support_tools` int(11) NOT NULL DEFAULT 0,
  `menu_user_account` int(11) NOT NULL DEFAULT 0,
  `menu_other` int(11) NOT NULL DEFAULT 0,
  `menu_settings` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`menu_phone_book`, `id`, `login_id`, `menu_dashboard`, `menu_notification`, `menu_campaigns`, `menu_support_tools`, `menu_user_account`, `menu_other`, `menu_settings`) VALUES
(1, 7, 34, 1, 1, 1, 0, 0, 0, 0),
(1, 8, 35, 1, 1, 1, 1, 0, 0, 0),
(1, 9, 36, 1, 1, 1, 1, 0, 0, 0),
(1, 10, 37, 1, 1, 1, 1, 0, 0, 0),
(1, 11, 38, 1, 1, 1, 1, 0, 0, 0),
(1, 12, 39, 1, 1, 1, 1, 0, 0, 0),
(1, 13, 40, 1, 1, 1, 1, 0, 0, 0),
(1, 14, 41, 1, 1, 1, 1, 0, 0, 0),
(1, 15, 42, 1, 1, 1, 1, 0, 0, 0),
(1, 16, 43, 1, 1, 1, 1, 0, 0, 0),
(1, 17, 44, 1, 1, 1, 1, 0, 0, 0),
(0, 18, 45, 1, 0, 0, 0, 0, 0, 0),
(0, 19, 46, 1, 0, 1, 0, 0, 0, 0),
(0, 20, 47, 1, 0, 0, 1, 0, 0, 0),
(0, 21, 48, 1, 0, 0, 1, 0, 0, 0),
(1, 22, 49, 1, 1, 1, 1, 0, 0, 0),
(1, 23, 50, 1, 1, 1, 1, 0, 0, 0),
(1, 24, 51, 1, 1, 1, 1, 0, 1, 0),
(1, 25, 52, 1, 1, 1, 1, 0, 0, 0),
(1, 26, 53, 1, 1, 1, 1, 0, 0, 0),
(1, 27, 54, 1, 1, 1, 1, 1, 1, 0),
(1, 28, 55, 1, 1, 1, 1, 1, 1, 1),
(0, 29, 56, 1, 0, 0, 1, 0, 0, 0),
(1, 30, 57, 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_permission`
--

CREATE TABLE `tbl_role_permission` (
  `menu_support_tools` int(11) NOT NULL,
  `menu_dashboard` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_notification` int(11) NOT NULL DEFAULT 1,
  `menu_campaigns` int(11) NOT NULL DEFAULT 1,
  `menu_phone_book` int(11) NOT NULL DEFAULT 1,
  `menu_user_account` int(11) NOT NULL DEFAULT 1,
  `menu_other` int(11) NOT NULL DEFAULT 1,
  `menu_settings` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_permission`
--

INSERT INTO `tbl_role_permission` (`menu_support_tools`, `menu_dashboard`, `id`, `role_id`, `menu_notification`, `menu_campaigns`, `menu_phone_book`, `menu_user_account`, `menu_other`, `menu_settings`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(1, 1, 2, 2, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(2555) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `landline` bigint(20) NOT NULL,
  `company_description` text NOT NULL,
  `bd_id` int(11) NOT NULL,
  `status` enum('enable','disable','deleted') NOT NULL DEFAULT 'enable',
  `assigned_no_count` int(11) DEFAULT NULL,
  `max_no_count` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `company_name`, `email`, `mobile_no`, `landline`, `company_description`, `bd_id`, `status`, `assigned_no_count`, `max_no_count`) VALUES
(44, 'System Admin', 'Way2mint Administrator', 'admin@way2mint.com', 8299502081, 0, 'Way2mint Services Banglore', 10, 'enable', NULL, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `tbl_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
