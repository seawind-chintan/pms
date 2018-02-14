-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
<<<<<<< HEAD
-- Generation Time: Jan 06, 2018 at 02:44 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22
=======
-- Generation Time: Feb 14, 2018 at 04:03 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.6.33-1+ubuntu14.04.1+deb.sury.org+1
>>>>>>> master

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `club36`
--

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `status`, `created`, `modified`) VALUES
(1, 'Ahmedabad', 1, 1, '2018-02-05 11:32:24', '2018-02-05 11:32:24'),
(2, 'Baroda', 1, 0, '2018-02-05 11:32:36', '2018-02-08 11:04:22'),
(3, 'Morbi', 1, 1, '2018-02-05 11:32:59', '2018-02-05 11:32:59'),
(4, 'Gandhinagar', 1, 1, '2018-02-05 11:33:07', '2018-02-08 10:57:49'),
(5, 'Mumbai', 2, 1, '2018-02-05 11:33:23', '2018-02-05 11:33:28'),
(6, 'Udaipur', 3, 1, '2018-02-08 10:57:40', '2018-02-08 10:57:40'),
(7, 'Jodhpur', 3, 1, '2018-02-08 10:58:09', '2018-02-08 10:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'India', 1, '2018-02-05 11:29:50', '2018-02-08 11:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `address` text,
  `images` text,
  `images_dir` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `sunday_open` int(3) NOT NULL DEFAULT '0',
  `monday_open` int(3) NOT NULL DEFAULT '0',
  `tuesday_open` int(3) NOT NULL DEFAULT '0',
  `wednesday_open` int(3) NOT NULL DEFAULT '0',
  `thursday_open` int(3) NOT NULL DEFAULT '0',
  `friday_open` int(3) NOT NULL DEFAULT '0',
  `saturday_open` int(3) NOT NULL DEFAULT '0',
  `notes` text,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`user`),
  KEY `user` (`user`),
  KEY `type_2` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `name`, `type`, `user`, `address`, `images`, `images_dir`, `start_time`, `end_time`, `sunday_open`, `monday_open`, `tuesday_open`, `wednesday_open`, `thursday_open`, `friday_open`, `saturday_open`, `notes`, `status`, `created`, `modified`) VALUES
(1, 'SW001', 'Swad Restaurant', 2, 3, 'maninagar , ahmedabad', '', '1sC-58qTU0Y2', '11:30:00', '23:59:00', 1, 1, 1, 1, 1, 1, 1, 'test notes', 1, '2018-02-13 05:10:00', '2018-02-13 05:10:00'),
(2, 'AVPI', 'Palace Inn', 1, 2, 'S.g Highway, Ahmedabad', '20225774-317331188714749-7763899870015913984-n.jpg,Rlogo.png', 'ed6fb62b-4324-4d17-80bb-0caedc151b43', '10:30:00', '23:59:00', 1, 0, 0, 1, 1, 1, 1, '', 1, '2018-02-13 06:00:51', '2018-02-14 07:52:10'),
(6, 'AVYS', 'Yummy Sizzlers', 2, 2, 'ahmedabad', 'Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images5.jpg,Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images.jpg', 'w_po-TT7-TtVG-YOw_T63LH-O', '07:59:00', '07:59:00', 1, 0, 0, 0, 0, 0, 1, '', 1, '2018-02-14 08:00:06', '2018-02-14 08:00:06'),
(7, 'ddfsdf', 'dsfsdfd', 1, 2, '', 'Cb-logo-sans-words-transparent-bg.png', 'LgtwP7rEfk__a3Wqwhf_T_PLt', '08:25:00', '08:25:00', 0, 0, 0, 1, 0, 0, 0, '', 0, '2018-02-14 08:26:01', '2018-02-14 08:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE IF NOT EXISTS `property_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `notes` text,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `notes`, `status`, `created`, `modified`) VALUES
(1, 'Hotel', '', 1, '2018-02-12 13:35:34', '2018-02-13 09:30:19'),
(2, 'Restaurant', '', 1, '2018-02-12 13:35:45', '2018-02-12 13:35:45'),
(3, 'Cafe', '', 1, '2018-02-12 13:35:54', '2018-02-12 13:35:54'),
(4, 'sdfdfg', 'gfhgfh', 1, '2018-02-13 09:29:29', '2018-02-13 09:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `type_2` (`type`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `slug`, `number`, `code`, `type`, `description`, `user_id`, `status`, `created`, `modified`) VALUES
(3, 'River View Room', 'River-View-Room', '001', 'RVR001', 4, 'cfsdfsdfsddfg', 2, 1, '2018-02-14 09:57:03', '2018-02-14 09:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `room_statuses`
--

CREATE TABLE IF NOT EXISTS `room_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `room_statuses`
--

INSERT INTO `room_statuses` (`id`, `name`, `slug`, `user_id`, `status`, `created`, `modified`) VALUES
(6, 'Booked', 'booked', 2, 1, '2018-02-14 09:46:09', '2018-02-14 09:46:09'),
(7, 'Empty', 'empty', 2, 1, '2018-02-14 09:46:38', '2018-02-14 09:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` float(11,2) NOT NULL,
  `total_rooms` int(11) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `slug`, `price`, `total_rooms`, `status`, `user_id`, `created`, `modified`) VALUES
(4, 'Normal', 'normal', 5000.00, 5, 1, 2, '2018-02-14 09:47:11', '2018-02-14 09:47:11'),
(5, 'Deluxe', 'deluxe', 7000.00, 2, 1, 2, '2018-02-14 09:47:47', '2018-02-14 09:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `status`, `created`, `modified`) VALUES
(1, 'Gujarat', 1, 1, '2018-02-05 11:30:55', '2018-02-05 11:30:55'),
(2, 'Maharastra', 1, 1, '2018-02-05 11:31:32', '2018-02-08 11:08:37'),
(3, 'Rajasthan', 1, 1, '2018-02-05 11:31:50', '2018-02-05 11:31:50');

-- --------------------------------------------------------

--
>>>>>>> master
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
<<<<<<< HEAD
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
=======
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '1:Superadmin;2:Clubadmin;3:Clubmanager;',
  `parent` int(11) NOT NULL DEFAULT '1',
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;
>>>>>>> master

--
-- Dumping data for table `users`
--

<<<<<<< HEAD
INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$93Lpx8ijg/ymzpTUAGuADOQ4ymk7sGvKbj7xlN7a70NkhT4UWmJ8.', 'superadmin', '2018-01-06 06:08:40', '2018-01-06 06:08:40'),
(2, 'manager1', '$2y$10$lbEdR2AVuAwbHfy5hOq3XeYNBuFO71xrUdIgrsval/sQGu3as0rjO', 'manager', '2018-01-06 07:15:30', '2018-01-06 07:15:30');
=======
INSERT INTO `users` (`id`, `username`, `password`, `role`, `parent`, `status`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$93Lpx8ijg/ymzpTUAGuADOQ4ymk7sGvKbj7xlN7a70NkhT4UWmJ8.', 1, 0, 1, '2018-01-06 06:08:40', '2018-02-12 11:56:16'),
(2, 'chintan', '$2y$10$jjyjmS1HiSP/.poBel6Wd.T8K3GkgqFQs3uTt1WmMgSR2vYLrCkLe', 2, 1, 1, '2018-01-06 07:15:30', '2018-02-13 05:52:48'),
(3, 'swpl', '$2y$10$1/QUF5Undj1Fwi/T0YZlue/cbbwwcJsNofyGGpJPWn4zK3i/OVb4S', 2, 1, 1, '2018-01-29 06:37:52', '2018-02-12 12:42:53'),
(10, 'superhotels', '$2y$10$FunlXuCrcG3x8Lde28MAQuid/zoC3/KHHGEB1GeIdsyK1OIQ/74Ky', 2, 1, 0, '2018-02-07 06:16:35', '2018-02-12 10:51:16'),
(12, 'superhotels12', '$2y$10$zemMh.s8Ican6XWkdOWW0up3/1At23VNwnnRy1EdC61z/nhjDlEKa', 2, 1, 0, '2018-02-07 06:19:59', '2018-02-07 06:19:59'),
(13, 'yoursclub', '$2y$10$fApbzYi7xRTlPIRjQ9NCOurYjnvVAHhD13c5NKCOAILp/6jrCxD7K', 2, 1, 0, '2018-02-07 06:21:36', '2018-02-12 10:51:23'),
(15, 'fsdf', '$2y$10$ZapEck17luuqvlXWBdPb3OjHhot6ntC/83.ejYRxzU/7Tjii1nHfC', 2, 1, 0, '2018-02-07 07:06:15', '2018-02-07 07:06:15'),
(29, 'dkfdnsn', '$2y$10$5rYIOJnw9.JG4gRX1Jh0TuyvNg84d1tImkig3vEEnBCjKAALZZIFm', 2, 1, 0, '2018-02-08 10:48:56', '2018-02-08 10:53:41'),
(30, 'fgdfg', '$2y$10$YR/eyJiUu7VeZa1UcLgYuegdK4oN7rxJhr7w.lM0x3HGSXu6rqKru', 2, 3, 0, '2018-02-12 12:43:15', '2018-02-12 12:43:15'),
(31, 'Suppp', '$2y$10$GGZFutIJWSkfPj8Y7tqlwuDxLZfOZ3yUnJqNJL/04cHb0kevHY0Ca', 3, 3, 0, '2018-02-12 12:52:45', '2018-02-12 12:52:45'),
(32, 'sdfdglkdfmg', '$2y$10$EaLVlWl6.8Ws9ehXykzQ6Omfb9oE//7PNLO57zotWe5HdTfDIirQS', 2, 3, 0, '2018-02-12 12:55:10', '2018-02-12 12:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `address` text,
  `profile_pic` text,
  `profile_pic_dir` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `last_name`, `city`, `state`, `country`, `pincode`, `address`, `profile_pic`, `profile_pic_dir`, `created`, `modified`) VALUES
(1, 2, 'Avirat', 'Group', 1, 1, 1, '382415', '', 'avirat.png', '38c1ea74-709a-499a-9b2b-6607078e6e1e', '2018-02-07 00:00:00', '2018-02-13 05:52:48'),
(8, 3, 'SWPL', 'Hotels', 1, 1, 1, '321520', 'test addreesss', '21484056_300x300', '2cfa8437-5dbe-474a-87e0-6eb635a857b8', '2018-02-07 05:49:20', '2018-02-12 12:42:53'),
(10, 12, 'Super', 'Hotels', 1, 1, 1, '985521', 'test addd', NULL, NULL, '2018-02-07 06:19:59', '2018-02-07 06:19:59'),
(11, 13, 'Yours', 'Hotel', 1, 1, 1, '987542', 'test addreesss 123', NULL, NULL, '2018-02-07 06:21:36', '2018-02-12 10:51:23'),
(12, 15, 'gdfgfdg', 'gfgdfgdfg', 1, 1, 1, '985521', '', NULL, NULL, '2018-02-07 07:06:15', '2018-02-07 07:06:15'),
(13, 10, 'dfgdf', 'fgfgh', 1, 1, 1, '$%#$%$#%#$%', '', '', NULL, '2018-02-07 08:07:01', '2018-02-07 08:07:01'),
(15, 29, 'kdfgnkdfgn', 'knfdkjgdfngl', 5, 3, 1, '989898', 'fgfdgfdgdfg', NULL, NULL, '2018-02-08 10:48:56', '2018-02-08 10:53:41'),
(16, 1, 'Super', 'Admin', 1, 1, 1, '98765422', '', 'cake.jpg', '261aa530-b1f2-4f31-9b32-78c00ec458d8', '2018-02-08 11:24:15', '2018-02-12 11:56:16'),
(17, 30, 'dfgdfg', 'dfgfghfghg', 1, 1, 1, '123456', '', NULL, NULL, '2018-02-12 12:43:15', '2018-02-12 12:43:15'),
(18, 31, 'ldfkgmdlfkgm', 'ldfgmfdlmg', 1, 1, 1, '789546', '', NULL, NULL, '2018-02-12 12:52:45', '2018-02-12 12:52:45'),
(19, 32, 'lkdfgmldfkm', 'flgmfglm', 1, 1, 1, '9878954', 'dfgfdlkm', NULL, NULL, '2018-02-12 12:55:10', '2018-02-12 12:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Super Admin', 0, '2018-02-05 09:24:41', '2018-02-05 09:24:41'),
(2, 'Club Admin', 1, '2018-02-05 09:24:55', '2018-02-05 09:43:24'),
(3, 'Club Manager', 1, '2018-02-05 09:25:07', '2018-02-05 09:25:07');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`type`) REFERENCES `property_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`type`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_statuses`
--
ALTER TABLE `room_statuses`
  ADD CONSTRAINT `room_statuses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
>>>>>>> master

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
