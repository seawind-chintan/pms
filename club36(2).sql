-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2018 at 02:58 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.6.33-1+ubuntu14.04.1+deb.sury.org+1

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
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'ENewspaper', 1, '2018-02-09 17:59:07', '2018-02-09 18:09:23'),
(2, 'TV', 1, '2018-02-09 17:59:22', '2018-02-09 17:59:22'),
(3, 'News', 1, '2018-02-09 18:02:51', '2018-02-09 18:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE IF NOT EXISTS `checkins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `arrival_date_time` datetime NOT NULL,
  `no_of_adult` int(3) NOT NULL DEFAULT '1',
  `no_of_child` int(3) NOT NULL DEFAULT '0',
  `arrival_from` varchar(150) DEFAULT NULL,
  `destination` varchar(150) DEFAULT NULL,
  `purpose_of_visit` varchar(255) DEFAULT NULL,
  `travel_agent` varchar(255) DEFAULT NULL,
  `remarks` text,
  `property_id` int(11) NOT NULL,
  `dept_date_time` datetime NOT NULL,
  `checkin_status_id` int(11) NOT NULL DEFAULT '1',
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`,`property_id`),
  KEY `property_id` (`property_id`),
  KEY `checkin_status_id` (`checkin_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`id`, `member_id`, `arrival_date_time`, `no_of_adult`, `no_of_child`, `arrival_from`, `destination`, `purpose_of_visit`, `travel_agent`, `remarks`, `property_id`, `dept_date_time`, `checkin_status_id`, `status`, `created`, `modified`) VALUES
(6, 6, '2018-03-03 09:35:00', 2, 0, '', '', '', '', '', 2, '2018-03-08 10:02:04', 3, 1, '2018-03-03 09:36:02', '2018-03-08 13:18:00'),
(7, 39, '2018-03-03 11:38:00', 1, 0, '', 'ahmedabad', '', '', '', 2, '2018-03-21 11:40:21', 2, 1, '2018-03-03 11:39:35', '2018-03-21 11:40:21'),
(8, 6, '2018-03-03 12:05:09', 1, 0, '', '', '', '', '', 2, '2018-03-08 11:00:07', 3, 1, '2018-03-03 12:07:31', '2018-03-09 04:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `checkin_billings`
--

CREATE TABLE IF NOT EXISTS `checkin_billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkin_id` int(11) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `net_amount` decimal(11,2) NOT NULL,
  `tax_amount` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `bill_status` int(2) NOT NULL DEFAULT '0',
  `pay_mode` enum('cash','card') DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `card_holder` varchar(150) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkin_id` (`checkin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `checkin_billings`
--

INSERT INTO `checkin_billings` (`id`, `checkin_id`, `bill_number`, `net_amount`, `tax_amount`, `total_amount`, `bill_status`, `pay_mode`, `card_number`, `card_holder`, `created`, `modified`) VALUES
(5, 6, 'AVPICHBILL6', '11250.00', '0.00', '11250.00', 0, 'cash', '', '', '2018-03-08 10:02:04', '2018-03-08 13:17:40'),
(6, 8, 'AVPICHBILL8', '12000.00', '0.00', '12000.00', 0, 'card', '8785256487752354', 'FARHAN KHAN', '2018-03-08 11:00:07', '2018-03-09 04:47:09'),
(7, 7, 'AVPICHBILL7', '19998.00', '0.00', '19998.00', 0, NULL, NULL, NULL, '2018-03-21 11:40:21', '2018-03-21 11:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `checkin_rooms_rates`
--

CREATE TABLE IF NOT EXISTS `checkin_rooms_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkin_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_rate_id` int(11) NOT NULL,
  `no_of_adult` int(3) NOT NULL,
  `no_of_child` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `checkin_id` (`checkin_id`,`room_id`,`room_rate_id`),
  KEY `room_id` (`room_id`),
  KEY `room_rate_id` (`room_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `checkin_rooms_rates`
--

INSERT INTO `checkin_rooms_rates` (`id`, `checkin_id`, `room_id`, `room_rate_id`, `no_of_adult`, `no_of_child`) VALUES
(6, 6, 25, 14, 2, 0),
(7, 7, 23, 6, 1, 0),
(8, 8, 19, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `checkin_statuses`
--

CREATE TABLE IF NOT EXISTS `checkin_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `checkin_statuses`
--

INSERT INTO `checkin_statuses` (`id`, `name`) VALUES
(1, 'Stay'),
(2, 'Checked Out'),
(3, 'Bill Setteled');

-- --------------------------------------------------------

--
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
-- Table structure for table `kots`
--

CREATE TABLE IF NOT EXISTS `kots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `kot_no` int(11) NOT NULL,
  `restaurant_table_id` int(11) DEFAULT NULL,
  `restaurant_table_code` int(11) DEFAULT NULL,
  `no_of_pax` int(11) NOT NULL,
  `steward` varchar(255) DEFAULT NULL,
  `nc_kot` enum('Yes','No') NOT NULL DEFAULT 'No',
  `remark` text,
  `split` enum('Yes','No') NOT NULL DEFAULT 'No',
  `amount` decimal(15,2) DEFAULT NULL,
  `total_qty` varchar(10) DEFAULT NULL,
  `kot_status` int(3) NOT NULL DEFAULT '0' COMMENT '0-default, 1-generate kot, 2-billing, 3-cancel',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `restaurant_table_id` (`restaurant_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kot_items`
--

CREATE TABLE IF NOT EXISTS `kot_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kot_id` int(11) NOT NULL,
  `kot_no` int(11) NOT NULL,
  `restaurant_table_id` int(11) NOT NULL,
  `restaurant_waiter_id` int(11) NOT NULL,
  `restaurant_kitchen_id` int(11) NOT NULL,
  `restaurant_menu_id` int(11) NOT NULL,
  `menu_code` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `menu_price` decimal(15,2) NOT NULL,
  `remarks` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kot_id` (`kot_id`),
  KEY `restaurant_menu_id` (`restaurant_menu_id`),
  KEY `restaurant_table_id` (`restaurant_table_id`),
  KEY `restaurant_kitchen_id` (`restaurant_kitchen_id`),
  KEY `restaurant_waiter_id` (`restaurant_waiter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL,
  `member_type` enum('guest','member') NOT NULL DEFAULT 'guest',
  `code` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `application_no` varchar(100) NOT NULL,
  `member_group_id` int(11) NOT NULL DEFAULT '0',
  `occupation` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `anniversary_date` date DEFAULT NULL,
  `blood_group` varchar(25) DEFAULT NULL,
  `pancard` varchar(25) NOT NULL,
  `aadharcard` varchar(25) DEFAULT NULL,
  `remark` text,
  `gender` varchar(10) NOT NULL,
  `marrital_status` varchar(10) DEFAULT NULL,
  `cor_address` text NOT NULL,
  `cor_city` int(11) NOT NULL,
  `cor_state` int(11) NOT NULL,
  `cor_country` int(11) NOT NULL,
  `cor_pincode` varchar(10) NOT NULL,
  `res_address` text,
  `res_city` varchar(100) DEFAULT NULL,
  `res_state` varchar(100) DEFAULT NULL,
  `res_country` varchar(100) DEFAULT NULL,
  `res_pincode` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `images_dir` varchar(255) DEFAULT NULL,
  `services` varchar(255) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `package_id`, `parent`, `member_type`, `code`, `first_name`, `last_name`, `nick_name`, `application_no`, `member_group_id`, `occupation`, `organization`, `designation`, `birth_date`, `anniversary_date`, `blood_group`, `pancard`, `aadharcard`, `remark`, `gender`, `marrital_status`, `cor_address`, `cor_city`, `cor_state`, `cor_country`, `cor_pincode`, `res_address`, `res_city`, `res_state`, `res_country`, `res_pincode`, `email`, `phone`, `mobile`, `images`, `images_dir`, `services`, `discount`, `status`, `created`, `modified`) VALUES
(1, 1, 2, 'member', '3170', 'Viveka', 'Acharyaa', '1', '10473192', 1, 'Jobtitle', 'Seawindsol', 'SR. PHP Developer', '1985-05-22', '2010-04-22', 'B+', 'AKIPA0147B', '012425781241', 'Remark', '0', '0', 'Corr Add', 5, 2, 1, '789456', 'Res address', '6', '3', '1', '987654', 'projectdeska@seawindsolution.com', '8471281435', '1234567890', 'Test Image', NULL, '2,3,7', 10, 1, '2018-02-15 11:45:30', '2018-02-15 12:08:09'),
(2, 2, 3, 'guest', '104', 'chintan', 'seawind', 'chinta ', '123784565596', 2, 'job', 'Seawind', 'PHP Developer', '1970-01-01', '1970-01-01', 'B', 'AKIPA0147A', '012425781245', 'Test remark', '0', '0', 'as', 1, 1, 1, '380008', 'assdf', '1', '1', '1', '124578', 'projectdesk@seawindsolution.com', '8471281435', '1234567890', 'sdfsdf', NULL, 'as', 15, 0, '2018-02-16 07:32:01', '2018-02-16 07:32:01'),
(3, 1, 3, 'guest', '104', 'chintan', 'acharya', '1', '10473191', 3, 'Job', 'Seawind', 'PHP Developer', '1970-01-01', '1970-01-01', 'B', 'AKIPA0147A', '012425781245', 'asasasas', '1', '0', 'sdsdsd', 1, 1, 1, '380008', 'sdsdsd', '1', '1', '1', '124578', 'projectdesksa@seawindsolution.com', '8471281435', '1234567890', '', NULL, 'as', 13, 0, '2018-02-16 07:42:17', '2018-02-16 07:42:17'),
(4, 1, 2, 'guest', '65465', 'DFDFDSF', 'DSFSDFDF', '', '6546546554654555', 2, 'Job', 'Seawind', '', '1970-01-01', '1970-01-01', '', '5465465464', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '0', '0', 'Lorem Ipsum is simply dummy text o\r\nthe printing and typesetting industry. \r\nLorem Ipsum\r\n has been ', 1, 1, 1, '380008', '', '1', '1', '1', '', 'ach222arya.vivek1@gmail.com', '', '999888885555', 'banner.png.jpg', '55838b1e-f1b1-4e0c-8d28-be26def4cfb3', '', NULL, 0, '2018-02-16 08:18:09', '2018-02-17 12:43:46'),
(5, 1, 3, 'guest', '123', 'acharya', 'Acharyaa', 'vivek', '10473191', 3, 'Job', 'Seawind', 'PHP Developer', NULL, NULL, 'A', 'AKIPA0147B', '012425781245', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '0', '0', 'Lorem Ipsum is simply dummy text\r\n of the printing and typesetting industry.\r\n Lorem Ipsum has been the industry''s \r\nstandard dummy text ev', 1, 1, 1, '380005', '', '1', '1', '1', '', 'asdabc@sasa.com', '', '999888885555', 'banner.jpg', 'b5e5e32c-563c-4c4a-9943-9ee5598f62f6', '', 12, 0, '2018-02-16 10:56:45', '2018-02-16 12:09:12'),
(6, 0, 2, 'guest', 'NA', 'Farhan', 'Khan', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'test@jsdfh.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 06:38:28', '2018-03-03 12:07:31'),
(7, 0, 2, 'guest', 'NA', 'Suresh', 'Lehri', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, '', '987654321', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 06:51:17', '2018-02-17 06:51:17'),
(8, 0, 2, 'guest', 'NA', 'GG', 'Hotels', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'dfsdsdasd', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'chintan@seawindsolution.com', '987654321', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 07:02:38', '2018-02-17 07:02:38'),
(9, 0, 2, 'guest', '', 'TEST', 'TEST', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, 0, '2018-02-17 07:50:58', '2018-02-17 07:50:58'),
(10, 0, 2, 'guest', '', 'TEST', 'TEST', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, 0, '2018-02-17 07:51:17', '2018-02-17 07:51:17'),
(11, 0, 2, 'guest', '', 'TEST', 'TEST', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, 0, '2018-02-17 07:51:41', '2018-02-17 07:51:41'),
(12, 1, 2, 'guest', 'NA', 'Akash', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test\r\naddress', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'dfdfkjdnskfj@sdfkj.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 07:52:37', '2018-02-17 07:52:37'),
(13, 0, 2, 'guest', 'NA', 'Akash', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test\r\naddress', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'test@mail.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 07:58:28', '2018-02-17 07:58:28'),
(14, 0, 2, 'guest', 'NA', 'Girish', 'Kumar', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test addd', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'girish@mail.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 08:00:23', '2018-02-17 08:00:23'),
(15, 0, 2, 'guest', 'NA', 'Farhan', 'Khan', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'fff@mail.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 08:03:39', '2018-02-17 08:03:39'),
(16, 0, 2, 'guest', 'NA', 'Hiren', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test\r\naddress', 2, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'hiren.patel@mailinator.com', '9998565656', '9998565656', NULL, NULL, NULL, NULL, 1, '2018-02-17 09:12:00', '2018-02-17 09:12:00'),
(17, 0, 2, 'guest', 'NA', 'Swati', 'Bhatt', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'gyaspura', 2, 1, 1, '654213', NULL, NULL, NULL, NULL, NULL, 'swati123@mailinator.com', '', '9875521230', NULL, NULL, NULL, NULL, 1, '2018-02-17 09:24:03', '2018-02-17 09:24:03'),
(18, 2, 2, 'member', 'AVYS', 'Dinesh', 'Patel', '', '123456799555522', 3, '', '', '', NULL, NULL, '', 'ADCF452D', '', '', '0', '0', 'test\r\naddress', 1, 1, 1, '123456', '', '1', '1', '1', '', 'dinesh.patel22@mailinator.com', '', '9955223366', NULL, NULL, 'as', NULL, 1, '2018-02-17 12:50:04', '2018-02-17 12:50:04'),
(21, 0, 2, 'guest', 'NA', 'Suresh', 'Menon', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '385562', NULL, NULL, NULL, NULL, NULL, 'suresh.menon@mailinator.com', '8574562135', '8574562135', NULL, NULL, NULL, NULL, 1, '2018-02-21 12:15:27', '2018-02-21 12:15:27'),
(22, 0, 2, 'guest', 'NA', 'Suresh', 'Lehri', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'suresh.lehri@mailinator.com', '', '9884565231', NULL, NULL, NULL, NULL, 1, '2018-02-21 12:17:43', '2018-02-21 12:17:43'),
(23, 0, 2, 'guest', 'NA', 'Suresh', 'Joshi', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'dssfsdf', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'svdpatan999@gmail.com', '', '9884565231', NULL, NULL, NULL, NULL, 1, '2018-02-21 12:44:11', '2018-02-21 12:44:11'),
(24, 0, 2, 'guest', 'NA', 'Akash', 'Joshi', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'sdfsdf', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'talent5@mailinator.com', '987654321', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-21 12:45:15', '2018-02-21 12:45:15'),
(25, 0, 2, 'guest', 'NA', 'Dinesh', 'Lehri', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'kfjdfn', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'kjfn@skdjfn.com', '9898653231', '9898653212', NULL, NULL, NULL, NULL, 1, '2018-02-21 13:45:12', '2018-02-21 13:45:12'),
(26, 0, 2, 'guest', 'NA', 'Falgun', 'Solanki', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test\r\naddress', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'kfdjnskdjf@sdkjf.com', '9874566321', '986532124', NULL, NULL, NULL, NULL, 1, '2018-02-21 13:47:33', '2018-02-21 13:47:33'),
(27, 0, 2, 'guest', 'NA', 'Tina', 'Mathur', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test adrress', 1, 1, 1, '65412', NULL, NULL, NULL, NULL, NULL, 'dsfsdfjk@ksdfj.com', '9876543210', '646546546465', NULL, NULL, NULL, NULL, 1, '2018-02-22 04:35:27', '2018-02-22 04:35:27'),
(28, 0, 2, 'guest', 'NA', 'Suresh', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test dskfskdnfskdjfn', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'sfskdnf@kjfdn.com', '9876543210', '9876543601', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:13:20', '2018-02-22 05:13:20'),
(29, 0, 2, 'guest', 'NA', 'Jaysukh', 'Patni', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 2, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, '98784565332@mail.com', '98784565332', '98784565332', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:20:02', '2018-02-22 05:20:02'),
(30, 0, 2, 'guest', 'NA', 'Manav', 'Sharma', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test\r\ndddddd', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'manav@mail.com', '9878562145', '9878562145', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:23:18', '2018-02-22 05:23:18'),
(31, 0, 2, 'guest', 'NA', 'Vishal', 'Dadlani', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'lkmsdlf\r\ndlfknmsdlkfmkldmf', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'dfskjfn@kjdsfn.com', '8895653212', '8895653212', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:25:19', '2018-02-22 05:25:19'),
(32, 0, 2, 'guest', 'NA', 'Chinmay', 'Patil', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 6, 3, 1, '622233', NULL, NULL, NULL, NULL, NULL, 'chinmay@mailinator.com', '8855222222', '8855222222', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:29:18', '2018-02-22 05:29:18'),
(33, 0, 2, 'guest', 'NA', 'Suresh', 'Raina', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'jhbfdjhbsdfb', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'raina@mailinator.com', '9878451232', '9878451232', NULL, NULL, NULL, NULL, 1, '2018-02-22 05:39:25', '2018-02-22 05:39:25'),
(37, 0, 2, 'guest', 'MEM00025', 'sdlmsdlkfm', 'ldsmlsdmfldskm', NULL, 'APPMEM00025', 0, NULL, NULL, NULL, NULL, NULL, NULL, '123DD45668', NULL, NULL, 'male', NULL, 'lkmlkmlmlmdlfm', 1, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'kjsdfn@kjfkgj.com', '88552233255', '65465465465', NULL, NULL, NULL, NULL, 1, '2018-02-23 09:28:22', '2018-02-23 09:28:22'),
(38, 0, 2, 'guest', 'NA', 'Farhan', 'Khan', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'test@jsdfh1.co', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-28 07:21:27', '2018-02-28 07:21:27'),
(39, 0, 2, 'guest', 'MEM00030', 'Ramesh', 'Junjunwala', NULL, 'APPMEM00030', 0, NULL, NULL, NULL, NULL, NULL, NULL, '123456987A', NULL, NULL, 'male', NULL, 'some dummy address\r\nyes some\r\ndummy', 2, 1, 1, '123456', NULL, NULL, NULL, NULL, NULL, 'junjunwala1@mailinator.com', '9888855522', '9888855522', NULL, NULL, NULL, NULL, 1, '2018-03-03 11:39:35', '2018-03-03 11:39:35'),
(40, 0, 2, 'guest', 'NA', 'Babubhai', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'dkfjnsdf dskjfnsd dsjkfn', 0, 0, 0, '382415', NULL, NULL, NULL, NULL, NULL, 'babu.patel@mailinator.com', '9988552223', '9988552223', NULL, NULL, NULL, NULL, 1, '2018-03-09 05:02:14', '2018-03-09 05:02:14'),
(41, 0, 2, 'guest', 'NA', 'Kunal', 'Patel', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'tes djkfnsdkfnsd', 0, 0, 0, '300000', NULL, NULL, NULL, NULL, NULL, 'kunal.fake@mailinator.com', '9878454545', '9878454545', NULL, NULL, NULL, NULL, 1, '2018-03-12 05:28:35', '2018-03-12 05:28:35'),
(42, 1, 34, 'member', 'JMEM1', 'Suresh', 'Thakur', 'Suri', 'AP 654654 654', 2, 'Businessman', 'Tata Group', 'CEO', '1966-08-18', NULL, 'B+', 'ADCF452D', '', '', '0', '0', 'sdfsdf', 0, 0, 0, '300000', 'sdffdgdfg', '3', '1', '1', '', 'tata.ceo@mailinator.com', '9855555556', '9855555556', 'bannerinn.jpg', 'd8754275-fbea-4e37-8a56-79c5c322adfb', 'as', 10, 1, '2018-03-20 07:11:01', '2018-03-20 07:11:01'),
(43, 2, 34, 'member', 'JMEM2', 'Arun', 'Thakur', 'AT', 'AP 654654 655', 3, 'Businessman', 'Plenar Group', 'CEO', NULL, NULL, '', 'ADCF452F', '', '', '0', '0', 'dffdgdfgfd', 0, 0, 0, '380000', 'dfgfdg', '1', '1', '1', '380000', 'arun.thakur@mailinator.com', '6324824899', '6324824899', NULL, NULL, 'as', NULL, 1, '2018-03-20 07:12:49', '2018-03-20 07:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `member_groups`
--

CREATE TABLE IF NOT EXISTS `member_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `member_groups`
--

INSERT INTO `member_groups` (`id`, `user_id`, `name`, `remark`, `status`, `created`, `modified`) VALUES
(1, 1, 'Family', 'Test With edit', 1, '2018-02-15 06:03:00', '2018-02-15 06:09:01'),
(2, 1, 'Friends', 'Friends', 1, '2018-02-15 06:03:18', '2018-02-15 06:03:18'),
(3, 1, 'Other', 'Other', 0, '2018-02-15 06:04:33', '2018-02-15 06:04:33'),
(5, 1, 'test', 'test', 1, '2018-02-15 06:26:32', '2018-02-15 06:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` varchar(25) NOT NULL,
  `duration` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `user_id`, `name`, `rate`, `duration`, `description`, `status`, `created`, `modified`) VALUES
(1, 1, 'Platinum', '45001', 96, 'test \r\nfor add packageq', 1, '2018-02-13 17:19:01', '2018-02-14 11:45:04'),
(2, 1, 'Gold', '5001', 150, 'Testing gold pack\r\n', 1, '2018-02-13 17:39:28', '2018-02-14 11:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `profile_settings`
--

CREATE TABLE IF NOT EXISTS `profile_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `skin` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile_settings`
--

INSERT INTO `profile_settings` (`id`, `user_id`, `title`, `short_title`, `skin`, `created`, `modified`) VALUES
(1, 1, 'asdasd', 'asdasd', 'red-light', '2018-02-16 13:47:33', '2018-02-16 13:47:33');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `name`, `type`, `user`, `address`, `images`, `images_dir`, `start_time`, `end_time`, `sunday_open`, `monday_open`, `tuesday_open`, `wednesday_open`, `thursday_open`, `friday_open`, `saturday_open`, `notes`, `status`, `created`, `modified`) VALUES
(1, 'SW001', 'Swad Restaurant', 2, 3, 'maninagar , ahmedabad', '', '1sC-58qTU0Y2', '11:30:00', '23:59:00', 1, 1, 1, 1, 1, 1, 1, 'test notes', 1, '2018-02-13 05:10:00', '2018-02-13 05:10:00'),
(2, 'AVPI', 'Palace Inn', 1, 2, 'S.g Highway, Ahmedabad', '20225774-317331188714749-7763899870015913984-n.jpg,Rlogo.png', 'ed6fb62b-4324-4d17-80bb-0caedc151b43', '10:30:00', '23:59:00', 1, 0, 0, 1, 1, 1, 1, '', 1, '2018-02-13 06:00:51', '2018-02-14 07:52:10'),
(6, 'AVYS', 'Yummy Sizzlers', 2, 2, 'ahmedabad', 'Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images5.jpg,Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images.jpg', 'w_po-TT7-TtVG-YOw_T63LH-O', '07:59:00', '07:59:00', 1, 0, 0, 0, 0, 0, 1, '', 1, '2018-02-14 08:00:06', '2018-02-14 08:00:06'),
(7, 'AVPR', 'Palace Resort', 1, 2, 'test addresss', 'Cb-logo-sans-words-transparent-bg.png,padman-story-647-080317061310.jpg', 'LgtwP7rEfk__a3Wqwhf_T_PLt', '08:25:00', '08:25:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-02-14 08:26:01', '2018-02-15 11:17:03'),
(8, 'svas', 'Suvas Hotel', 1, 3, 'testnskdjfn\r\nsdfnj''kjhsdf\r\nAhmedabad', 'New-Zealand-ZM2V-DX-News.jpg', 'ZEFoXd4y2-dB---Kbi9r2nPFx', '05:56:00', '15:56:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-02-15 05:57:34', '2018-02-15 05:57:34'),
(9, 'JWW', 'Jolly Water World', 5, 34, 'the\r\njolly\r\nwater\r\nworld', '', '_ZVZFC6vt72oHy_iPG5Qnt_Pa', '10:00:00', '06:00:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-03-13 04:34:50', '2018-03-13 04:34:50'),
(10, 'Chinese', 'Chinese stall', 2, 34, '', '', 'fn5m_qi-_m-1-TEMCfZhY8-1V', '15:17:00', '15:17:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-03-12 15:21:39', '2018-03-13 13:03:51'),
(11, 'pizza', 'pizza', 2, 34, 'pizza', '', 'EG-_sO3yIfBV1L3-rweK__vEy', '13:00:00', '13:00:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-03-13 13:01:01', '2018-03-13 13:01:01'),
(12, 'Punjabi', 'Punjabi restaurant', 2, 34, '', '', '6j_N9V-BjVwH-qEVn2DzJQHx-', '13:01:00', '13:01:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-03-13 13:01:57', '2018-03-13 13:01:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `notes`, `status`, `created`, `modified`) VALUES
(1, 'Hotel', '', 1, '2018-02-12 13:35:34', '2018-02-13 09:30:19'),
(2, 'Restaurant', '', 1, '2018-02-12 13:35:45', '2018-02-12 13:35:45'),
(3, 'Cafe', '', 1, '2018-02-12 13:35:54', '2018-02-12 13:35:54'),
(4, 'sdfdfg', 'gfhgfh', 1, '2018-02-13 09:29:29', '2018-02-13 09:29:29'),
(5, 'Water Park', '', 1, '2018-03-13 04:26:33', '2018-03-13 04:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type` enum('guest','member') NOT NULL DEFAULT 'guest',
  `member_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `reservation_type` enum('inquiry','booking') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `no_of_adult` int(3) NOT NULL DEFAULT '0',
  `no_of_child` int(3) NOT NULL DEFAULT '0',
  `no_of_rooms` int(5) NOT NULL DEFAULT '1',
  `comments` text NOT NULL,
  `rate` decimal(11,2) NOT NULL,
  `discount` decimal(11,2) NOT NULL,
  `total_cost` decimal(11,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`,`city_id`,`state_id`,`country_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `member_type`, `member_id`, `first_name`, `last_name`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `phone`, `mobile`, `email`, `property_id`, `reservation_type`, `start_date`, `end_date`, `no_of_adult`, `no_of_child`, `no_of_rooms`, `comments`, `rate`, `discount`, `total_cost`, `created`, `modified`) VALUES
(19, 'guest', 33, 'Suresh', 'Raina', 'jhbfdjhbsdfb', 1, 1, 1, '123456', '9878451232', '9878451232', 'raina@mailinator.com', 2, 'inquiry', '2018-02-27', '2018-02-28', 2, 0, 2, 'celeb', '8111.00', '5.00', '7611.00', '2018-02-22 05:39:25', '2018-02-22 05:39:25'),
(20, 'guest', 40, 'Babubhai', 'Patel', 'dkfjnsdf dskjfnsd dsjkfn', 1, 1, 1, '382415', '9988552223', '9988552223', 'babu.patel@mailinator.com', 7, 'booking', '2018-03-09', '2018-03-10', 2, 0, 2, 'sddfsdff\r\ndfs\r\ndfsd\r\nsd\r\nfsd\r\nf\r\nsdfdsdfgdfgfg', '6100.00', '2.00', '5900.00', '2018-03-09 05:02:14', '2018-03-09 05:02:14'),
(21, 'guest', 41, 'Kunal', 'Patel', 'tes djkfnsdkfnsd', 1, 1, 1, '300000', '9878454545', '9878454545', 'kunal.fake@mailinator.com', 2, 'booking', '2018-03-12', '2018-03-15', 2, 0, 1, 'sdfsdfsdfsdfdsf', '4050.00', '0.50', '4000.00', '2018-03-12 05:28:36', '2018-03-12 05:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_rates`
--

CREATE TABLE IF NOT EXISTS `reservation_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `room_rate_id` int(11) NOT NULL,
  `no_of_adult` int(3) NOT NULL DEFAULT '1',
  `no_of_child` int(3) NOT NULL DEFAULT '0',
  `no_of_rooms` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`,`room_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservation_rates`
--

INSERT INTO `reservation_rates` (`id`, `reservation_id`, `room_rate_id`, `no_of_adult`, `no_of_child`, `no_of_rooms`) VALUES
(1, 19, 6, 1, 0, 1),
(2, 19, 13, 1, 0, 1),
(3, 20, 4, 2, 0, 2),
(4, 21, 16, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_rooms`
--

CREATE TABLE IF NOT EXISTS `reservation_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`,`room_id`),
  KEY `reservation_id_2` (`reservation_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_kitchens`
--

CREATE TABLE IF NOT EXISTS `restaurant_kitchens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `property_ids` varchar(255) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `restaurant_kitchens`
--

INSERT INTO `restaurant_kitchens` (`id`, `user_id`, `name`, `property_ids`, `status`, `created`, `modified`) VALUES
(1, 34, 'Punjabi', '12', 1, '2018-03-15 11:30:59', '2018-03-15 11:30:59'),
(2, 34, 'Chinese', '10', 1, '2018-03-15 11:31:18', '2018-03-15 11:31:18'),
(3, 2, 'Punjabi', '6', 1, '2018-03-15 11:31:39', '2018-03-15 11:31:39'),
(4, 2, 'South Indian', '1,6', 1, '2018-03-15 11:31:58', '2018-03-15 11:31:58'),
(5, 34, 'Pizza', '10,11', 1, '2018-03-15 11:32:17', '2018-03-15 11:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menus`
--

CREATE TABLE IF NOT EXISTS `restaurant_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `restaurant_kitchen_id` int(11) NOT NULL,
  `restaurant_menu_type_id` int(11) NOT NULL,
  `menu_category` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `description` text NOT NULL,
  `discountable` enum('Yes','No') DEFAULT NULL,
  `is_home_delivery` enum('Yes','No') DEFAULT 'No',
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_menu_type_id` (`restaurant_menu_type_id`),
  KEY `property_id` (`property_id`),
  KEY `restaurant_menus_ibfk_1` (`restaurant_kitchen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `restaurant_menus`
--

INSERT INTO `restaurant_menus` (`id`, `property_id`, `restaurant_kitchen_id`, `restaurant_menu_type_id`, `menu_category`, `code`, `name`, `price`, `description`, `discountable`, `is_home_delivery`, `status`, `created`, `modified`) VALUES
(1, 10, 2, 5, '0', 'manchurian01', 'Manchurian', '75.00', 'Manchurian', 'No', 'No', 1, '2018-03-15 11:34:31', '2018-03-15 11:34:31'),
(2, 10, 2, 5, '0', 'Noodle', 'Noodles', '95.00', 'Noodles', 'No', 'No', 1, '2018-03-15 11:35:30', '2018-03-15 11:35:30'),
(3, 12, 1, 6, '1', 'Paneer101', 'Paneer Tikka Masala', '175.00', 'Paneer Tikka Masala', 'No', 'No', 1, '2018-03-15 12:12:12', '2018-03-15 12:12:24'),
(4, 12, 1, 6, '1', 'Paneer', 'Panner Veg Kadai', '225.00', 'Panner Veg Kadai', 'No', 'No', 1, '2018-03-15 12:13:11', '2018-03-15 12:13:11'),
(5, 12, 1, 6, '1', 'Panner01', 'paneer toofani', '115.00', 'paneer toofani', 'No', 'No', 1, '2018-03-15 12:13:51', '2018-03-15 12:13:51'),
(6, 11, 5, 3, '1', 'PIZZA1', 'Margherita pizza ', '205.00', 'Margherita Pizza', 'No', 'No', 1, '2018-03-15 12:14:58', '2018-03-15 12:14:58'),
(7, 11, 5, 3, '1', 'PIZZA2', 'Thin Crust Pizza', '230.00', 'Thin Crust Pizza', 'No', 'No', 1, '2018-03-15 12:15:36', '2018-03-15 12:15:36'),
(8, 11, 5, 3, '1', 'PIZZA3', 'Veg Doubles', '300.00', 'Veg Doubles', 'No', 'No', 1, '2018-03-15 12:16:22', '2018-03-15 12:16:22'),
(9, 10, 5, 3, '1', 'PIZZA1', 'Margherita pizza', '145.00', 'Margherita pizza', 'No', 'No', 1, '2018-03-17 14:57:38', '2018-03-17 14:57:38'),
(10, 10, 2, 5, '1', '12', 'Chinese Bhel', '175.00', 'Chinese Bhel', 'No', 'No', 1, '2018-03-17 19:05:34', '2018-03-17 19:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menu_types`
--

CREATE TABLE IF NOT EXISTS `restaurant_menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `restaurant_menu_types`
--

INSERT INTO `restaurant_menu_types` (`id`, `user_id`, `name`, `status`, `created`, `modified`) VALUES
(1, 2, 'Punjabi', 1, '2018-03-15 11:27:56', '2018-03-15 11:27:56'),
(2, 2, 'South Indian', 1, '2018-03-15 11:28:19', '2018-03-15 11:28:19'),
(3, 34, 'Pizza', 1, '2018-03-15 11:28:55', '2018-03-15 11:28:55'),
(4, 2, 'Chinese', 1, '2018-03-15 11:29:09', '2018-03-15 11:29:09'),
(5, 34, 'Chinese', 1, '2018-03-15 11:29:25', '2018-03-15 11:29:25'),
(6, 34, 'Punjabi', 1, '2018-03-15 11:29:47', '2018-03-15 11:29:47'),
(7, 34, 'Ice Cream', 1, '2018-03-15 11:30:23', '2018-03-15 11:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

CREATE TABLE IF NOT EXISTS `restaurant_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `booking_status` int(3) NOT NULL COMMENT '0-occupied,1-not-occupied,3-booked',
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `restaurant_tables`
--

INSERT INTO `restaurant_tables` (`id`, `property_id`, `code`, `capacity`, `booking_status`, `status`, `created`, `modified`) VALUES
(1, 6, 1, 4, 1, 1, '2018-02-19 11:09:42', '2018-02-20 13:01:44'),
(2, 6, 2, 4, 1, 1, '2018-02-19 11:09:45', '2018-03-06 18:27:55'),
(3, 6, 3, 4, 1, 1, '2018-02-19 11:09:45', '2018-03-06 16:08:40'),
(4, 6, 4, 4, 1, 1, '2018-02-19 11:09:45', '2018-02-19 11:09:45'),
(5, 6, 5, 4, 1, 1, '2018-02-19 11:09:46', '2018-03-06 17:55:38'),
(6, 6, 6, 8, 1, 1, '2018-02-19 11:22:07', '2018-02-19 11:22:07'),
(7, 6, 7, 8, 1, 1, '2018-02-19 11:22:08', '2018-02-19 11:22:08'),
(8, 6, 8, 5, 1, 1, '2018-02-19 11:37:19', '2018-02-19 11:37:19'),
(9, 6, 9, 5, 1, 1, '2018-02-19 11:37:23', '2018-02-19 11:37:23'),
(10, 6, 10, 5, 0, 1, '2018-02-19 11:37:23', '2018-02-19 11:37:23'),
(11, 1, 1, 3, 1, 1, '2018-02-19 11:40:18', '2018-02-19 11:40:18'),
(12, 1, 2, 2, 1, 1, '2018-02-19 11:40:22', '2018-02-19 11:56:43'),
(18, 1, 3, 5, 1, 1, '2018-02-21 05:07:46', '2018-02-21 05:07:46'),
(19, 1, 4, 5, 1, 1, '2018-02-21 05:07:46', '2018-02-21 05:07:46'),
(20, 1, 5, 5, 1, 1, '2018-02-21 05:07:46', '2018-02-21 05:07:46'),
(21, 6, 11, 8, 1, 1, '2018-02-22 18:44:07', '2018-02-23 11:48:37'),
(22, 6, 12, 7, 1, 1, '2018-02-22 18:44:07', '2018-02-22 18:44:07'),
(23, 1, 6, 10, 1, 1, '2018-02-23 10:52:37', '2018-02-23 10:52:37'),
(24, 1, 7, 10, 1, 1, '2018-02-23 10:52:38', '2018-02-23 10:52:38'),
(25, 1, 8, 4, 1, 1, '2018-02-23 10:53:04', '2018-02-23 10:53:04'),
(26, 1, 9, 4, 1, 1, '2018-02-23 10:53:05', '2018-02-23 10:53:05'),
(27, 1, 10, 4, 1, 1, '2018-02-23 10:53:07', '2018-02-23 10:53:07'),
(28, 6, 13, 3, 0, 1, '2018-02-23 11:46:12', '2018-02-23 11:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_table_bookings`
--

CREATE TABLE IF NOT EXISTS `restaurant_table_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `restaurant_table_ids` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `name` varchar(255) NOT NULL,
  `book_by` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text,
  `mobile` varchar(15) NOT NULL,
  `no_of_pax` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `booking_status` int(3) NOT NULL COMMENT '0-attending, 1-booking confirm,2-booking cancel',
  `advanced_payment` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_waiters`
--

CREATE TABLE IF NOT EXISTS `restaurant_waiters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `property_ids` varchar(255) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `restaurant_waiters`
--

INSERT INTO `restaurant_waiters` (`id`, `name`, `property_ids`, `status`, `created`, `modified`) VALUES
(1, 'Bahubali', '1,6', 1, '2018-02-20 07:35:20', '2018-02-20 08:09:41'),
(2, 'katppa', '6', 1, '2018-02-20 07:35:52', '2018-02-20 08:10:13'),
(3, 'ballaldev', '1', 1, '2018-02-20 08:09:58', '2018-02-20 08:09:58'),
(4, 'Banjara', '6', 1, '2018-02-20 08:23:12', '2018-02-20 08:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `images` text NOT NULL,
  `images_dir` varchar(255) NOT NULL,
  `room_occupancy` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `room_status_id` int(11) NOT NULL DEFAULT '1',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `type_2` (`type`),
  KEY `user_id` (`user_id`),
  KEY `property_id` (`property_id`),
  KEY `room_occupancy` (`room_occupancy`),
  KEY `room_status_id` (`room_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `number`, `code`, `type`, `description`, `images`, `images_dir`, `room_occupancy`, `user_id`, `property_id`, `room_status_id`, `status`, `created`, `modified`) VALUES
(3, '01', 'AVPI01', 7, 'cfsdfsdfsddfg', 'b0806d4e3c8f3b18a4f0141330969c99.jpeg,2622179645ae6d4c62686ce9ff961d76.jpeg,3b0a68564ac3e5b909009b046f1eb0fa.jpeg', 'W-AsxxW5Z_XyWLZLRl8P-H42Z', 4, 2, 2, 1, 1, '2018-02-14 09:57:03', '2018-02-21 05:17:20'),
(5, '101', 'R101', 9, 'Room no 101', '', 'N7I3-WyR_-I3x_Lv_Ye8x_ipx', 5, 3, 8, 1, 1, '2018-02-15 06:17:30', '2018-02-17 08:10:57'),
(6, '102', 'R102', 9, 'Room no 102', '', '-1jFD-Ne_-uNexlS5RYJcnh87', 5, 3, 8, 1, 1, '2018-02-15 06:17:48', '2018-02-17 08:12:19'),
(8, '103', 'R103', 10, 'Classic Room', '', 'y7ogAm-j2OFRM5k-xs_p_75Ep', 5, 3, 8, 1, 1, '2018-02-15 07:36:32', '2018-02-17 08:11:24'),
(9, '104', 'R104', 9, 'dfsdf', '', 'WC8KM_AdnK5zlvEXVB_x4KRv4', 5, 3, 8, 1, 1, '2018-02-15 09:16:36', '2018-02-17 08:12:26'),
(12, '105', 'R105', 9, 'dfdgfdg', 'inner-logo.png,20225774-317331188714749-7763899870015913984-n.jpg,Rlogo.png', 'Pm_f_DimzRb5WBr9F8_eGs-F-', 5, 3, 8, 1, 0, '2018-02-15 09:31:37', '2018-02-17 08:12:33'),
(13, '106', 'R106', 9, 'sdfdsf', '', 'L9yipx4_-__vIxb-Y_kPu_X3P', 6, 3, 8, 1, 0, '2018-02-15 10:09:50', '2018-02-17 08:12:39'),
(14, '107', 'R107', 11, '', '620393-padmawati.jpg', 'kH-5-_Jmv3Zs-GWcdmby_MnuU', 6, 3, 8, 1, 1, '2018-02-15 10:14:55', '2018-02-17 08:11:06'),
(15, '108', 'R108', 9, 'dfdsf', '', 'ZRB-y--Y--FW_7x__BEmemQoC', 6, 3, 8, 1, 0, '2018-02-15 10:19:08', '2018-02-17 08:10:34'),
(16, '111', 'R111', 10, 'dsdsf', '23161355-404229249992594-5608519091418562560-n.jpg,1504950761.jpg', 'F-Pvg-xSD8hDJZ-YXnK_7C-wY', 6, 3, 8, 1, 1, '2018-02-15 10:20:23', '2018-02-17 08:11:17'),
(18, '01', 'AVPR01', 5, '', 'adv5.jpg', '_E8r-__2LtkGF-G9G0-RbPVuT', 2, 2, 7, 1, 1, '2018-02-15 11:19:44', '2018-02-21 05:17:54'),
(19, '02', 'AVPI02', 5, 'test\r\ntest\r\ntest\r\nkfgkgn\r\ndfkgfdkgndkfjgn\r\ndfgnfdfkgndf\r\nfdgnfdkgdfl\r\ndfkgndfkjngf\r\ndfkgnfdkgnjkfdjngkdfngkjnfg1\r\n11', 'Radha-Krishna-Temple-ISKCON-4.jpg', 'An_m-FyNVdU-Vmr_h4GB_U-kf', 1, 2, 2, 3, 1, '2018-02-15 12:07:01', '2018-03-08 11:00:07'),
(20, '03', 'AVPI03', 12, '', '', '-qq2z_v2qUta_rN_f_Ry--LGE', 1, 2, 2, 1, 0, '2018-02-19 06:57:09', '2018-02-21 05:17:37'),
(22, '02', 'AVPR02', 5, 'dsd', '', 'sgU__kFSAsGqKXKQc_4quNg_M', 1, 2, 7, 1, 0, '2018-02-19 09:28:27', '2018-02-21 05:18:05'),
(23, '04', 'AVPI04', 7, '', '', 'e-KdAJSIJUsDaHA8W3t-Y-jH0', 1, 2, 2, 3, 1, '2018-02-22 08:12:01', '2018-03-21 11:40:21'),
(24, '05', 'AVPI05', 7, '', '', 'VwF__9Kp-OknT_tKHOZvDGZdX', 4, 2, 2, 1, 1, '2018-02-22 08:12:18', '2018-02-22 08:13:25'),
(25, '06', 'AVPI06', 7, '', '', '_2_P_I4wasY7V1vDEj0m2f-_g', 2, 2, 2, 3, 1, '2018-02-22 08:12:37', '2018-03-08 10:02:04'),
(26, '07', 'AVPI07', 5, '', '', 'xXc6xKiSAedusNs-e-BxgH_98', 2, 2, 2, 1, 1, '2018-02-22 08:13:11', '2018-02-22 08:13:11'),
(27, '08', 'AVPI08', 5, '', '', 'j144_2OO_p0VA7KI1PgIz_Y_X', 4, 2, 2, 3, 1, '2018-02-22 08:13:42', '2018-02-22 08:13:42'),
(28, '09', 'AVPI09', 5, '', '', 'J9U3m_ibW-MFouniZ1uFBD_G_', 2, 2, 2, 1, 1, '2018-02-22 08:14:05', '2018-02-22 08:14:05'),
(29, '10', 'AVPI10', 12, '', '', 'Fgo99YGXEasb3NQiwkaaUdwjr', 4, 2, 2, 1, 1, '2018-02-22 08:14:23', '2018-02-22 08:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `room_occupancies`
--

CREATE TABLE IF NOT EXISTS `room_occupancies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `room_occupancies`
--

INSERT INTO `room_occupancies` (`id`, `name`, `user_id`, `status`, `created`, `modified`) VALUES
(1, 'Single', 2, 1, '2018-02-19 07:29:13', '2018-02-19 07:29:13'),
(2, 'Double', 2, 1, '2018-02-19 07:31:06', '2018-02-19 07:31:06'),
(3, 'Couple', 2, 0, '2018-02-19 07:31:15', '2018-02-19 07:31:15'),
(4, 'Family', 2, 1, '2018-02-19 07:31:23', '2018-02-19 07:31:23'),
(5, 'Single', 3, 1, '2018-02-19 07:32:06', '2018-02-19 07:32:06'),
(6, 'Double', 3, 1, '2018-02-19 07:32:12', '2018-02-19 07:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `room_plans`
--

CREATE TABLE IF NOT EXISTS `room_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `room_plans`
--

INSERT INTO `room_plans` (`id`, `name`, `description`, `user_id`, `status`, `created`, `modified`) VALUES
(1, 'EP', 'European Plan or EP will mostly have the lowest tariff in a rate card simply because it includes only room rent and no meals', 2, 1, '2018-02-19 09:45:35', '2018-02-19 09:50:54'),
(2, 'CP', 'Under Continental or CP Meal Plan, room rent and complimentary free breakfast are included in the tariff.', 2, 1, '2018-02-19 09:54:12', '2018-02-19 09:54:12'),
(3, 'CP', 'Under Continental or CP Meal Plan, room rent and complimentary free breakfast are included in the tariff.', 3, 1, '2018-02-19 09:54:32', '2018-02-19 09:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `room_rates`
--

CREATE TABLE IF NOT EXISTS `room_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `room_plan_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_occupancy_id` int(11) NOT NULL,
  `rate` decimal(11,2) NOT NULL,
  `extra_charge` decimal(11,2) NOT NULL DEFAULT '0.00',
  `for_specific_dates` int(2) NOT NULL DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `min_adult` int(3) NOT NULL,
  `max_adult` int(3) NOT NULL,
  `max_child` int(3) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_plan_id` (`room_plan_id`,`room_type_id`,`room_occupancy_id`),
  KEY `user_id` (`user_id`,`property_id`),
  KEY `property_id` (`property_id`),
  KEY `room_plan_id_2` (`room_plan_id`),
  KEY `room_type_id` (`room_type_id`),
  KEY `room_occupancy_id` (`room_occupancy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `room_rates`
--

INSERT INTO `room_rates` (`id`, `user_id`, `property_id`, `room_plan_id`, `room_type_id`, `room_occupancy_id`, `rate`, `extra_charge`, `for_specific_dates`, `from_date`, `to_date`, `min_adult`, `max_adult`, `max_child`, `status`, `created`, `modified`) VALUES
(1, 2, 2, 1, 5, 1, '3000.00', '0.00', 0, NULL, NULL, 1, 1, 1, 1, '2018-02-19 12:07:23', '2018-02-22 09:26:07'),
(4, 2, 7, 1, 5, 2, '6100.00', '0.00', 0, NULL, NULL, 1, 2, 1, 1, '2018-02-19 13:06:03', '2018-02-20 11:12:13'),
(5, 2, 2, 2, 5, 1, '4000.00', '250.00', 0, NULL, NULL, 1, 1, 1, 1, '2018-02-20 05:11:57', '2018-02-20 05:11:57'),
(6, 2, 2, 1, 7, 1, '1111.00', '0.00', 0, NULL, NULL, 1, 1, 0, 1, '2018-02-20 05:17:39', '2018-02-22 09:20:21'),
(7, 3, 8, 3, 9, 5, '2000.00', '500.00', 0, NULL, NULL, 1, 2, 1, 1, '2018-02-20 05:42:18', '2018-02-20 05:42:18'),
(8, 3, 8, 3, 10, 5, '2200.00', '450.00', 0, NULL, NULL, 1, 1, 1, 1, '2018-02-20 05:42:54', '2018-02-20 05:42:54'),
(9, 3, 8, 3, 11, 5, '3500.00', '550.00', 0, NULL, NULL, 1, 1, 1, 1, '2018-02-20 05:43:33', '2018-02-20 05:43:33'),
(10, 3, 8, 3, 9, 6, '4000.00', '1000.00', 0, NULL, NULL, 2, 3, 1, 1, '2018-02-20 05:44:21', '2018-02-20 05:44:38'),
(11, 3, 8, 3, 10, 6, '4250.00', '1000.00', 0, NULL, NULL, 2, 3, 2, 1, '2018-02-20 05:45:18', '2018-02-20 05:45:18'),
(12, 3, 8, 3, 11, 6, '5000.00', '1050.00', 0, NULL, NULL, 2, 3, 2, 1, '2018-02-20 05:45:46', '2018-02-20 05:45:46'),
(13, 2, 2, 2, 5, 2, '7000.00', '999.98', 0, NULL, NULL, 1, 2, 1, 1, '2018-02-20 11:13:20', '2018-02-20 11:13:20'),
(14, 2, 2, 1, 7, 2, '2250.00', '575.00', 0, NULL, NULL, 2, 3, 1, 1, '2018-02-22 09:17:27', '2018-02-22 09:17:27'),
(15, 2, 2, 1, 7, 4, '4000.00', '500.00', 0, NULL, NULL, 3, 4, 2, 1, '2018-02-22 09:19:02', '2018-02-22 09:19:02'),
(16, 2, 2, 2, 7, 1, '1350.00', '500.00', 0, NULL, NULL, 1, 2, 0, 1, '2018-02-22 09:20:11', '2018-02-22 09:20:11'),
(17, 2, 2, 2, 7, 4, '4500.00', '1200.00', 0, NULL, NULL, 3, 4, 2, 1, '2018-02-22 09:27:08', '2018-02-22 09:27:08'),
(18, 2, 2, 1, 12, 1, '6600.00', '1200.00', 0, NULL, NULL, 1, 2, 1, 1, '2018-02-22 09:27:55', '2018-02-22 09:27:55'),
(19, 2, 2, 2, 12, 1, '7000.00', '1200.00', 0, NULL, NULL, 1, 2, 1, 1, '2018-02-22 09:28:29', '2018-02-22 09:28:29'),
(20, 2, 2, 2, 7, 2, '2500.00', '500.00', 0, NULL, NULL, 1, 2, 2, 1, '2018-02-22 09:30:46', '2018-02-22 09:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `room_statuses`
--

CREATE TABLE IF NOT EXISTS `room_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `room_statuses`
--

INSERT INTO `room_statuses` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Vacant', 1, '2018-02-22 10:21:49', '2018-02-22 10:21:49'),
(2, 'Reserved', 1, '2018-02-22 10:27:12', '2018-02-22 10:27:12'),
(3, 'Dirty', 1, '2018-02-22 10:27:28', '2018-02-22 10:27:28'),
(4, 'Blocked for Maintainance', 1, '2018-02-22 10:27:49', '2018-02-22 10:27:49'),
(5, 'Occupied', 1, '2018-02-22 10:28:48', '2018-02-22 10:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `total_rooms` int(11) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `slug`, `total_rooms`, `status`, `user_id`, `created`, `modified`) VALUES
(4, 'Normal', 'normal', 5, 0, 2, '2018-02-14 09:47:11', '2018-02-15 05:27:21'),
(5, 'Deluxe', 'deluxe', 2, 1, 2, '2018-02-14 09:47:47', '2018-02-14 09:47:47'),
(6, 'sdfsd', 'sdfsd', 3, 0, 2, '2018-02-15 05:30:43', '2018-02-15 05:30:48'),
(7, 'Normal', 'Normal', 10, 1, 2, '2018-02-15 05:31:06', '2018-02-15 05:31:06'),
(9, 'Economic', 'Economic', 3, 1, 3, '2018-02-15 06:15:55', '2018-02-15 06:15:55'),
(10, 'Classic', 'Classic', 3, 1, 3, '2018-02-15 06:16:12', '2018-02-15 06:16:12'),
(11, 'Platinum', 'Platinum', 4, 1, 3, '2018-02-15 06:16:30', '2018-02-15 06:16:30'),
(12, 'Royal', 'Royal', 5, 1, 2, '2018-02-19 06:08:40', '2018-02-22 08:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `parent_id`, `name`, `notes`, `status`, `created`, `modified`) VALUES
(1, 0, 'Hotel Services', '', 1, '2018-02-08 17:27:25', '2018-02-17 10:56:55'),
(2, 1, 'Room Reservation', '', 1, '2018-02-08 17:28:20', '2018-02-08 17:28:20'),
(3, 1, 'House Keeping', '', 1, '2018-02-08 17:30:50', '2018-02-08 17:33:02'),
(6, 0, 'Restaurant Services', '', 1, '2018-02-08 18:38:52', '2018-02-08 18:38:52'),
(7, 6, 'KOT', 'KOT generations', 1, '2018-02-12 12:55:38', '2018-02-17 10:58:51'),
(8, 1, 'Front Office', 'Front Office', 1, '2018-02-17 10:59:25', '2018-02-17 10:59:25');

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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `parent`, `status`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$93Lpx8ijg/ymzpTUAGuADOQ4ymk7sGvKbj7xlN7a70NkhT4UWmJ8.', 1, 0, 1, '2018-01-06 06:08:40', '2018-02-12 11:56:16'),
(2, 'chintan', '$2y$10$jjyjmS1HiSP/.poBel6Wd.T8K3GkgqFQs3uTt1WmMgSR2vYLrCkLe', 2, 1, 1, '2018-01-06 07:15:30', '2018-02-13 05:52:48'),
(3, 'swpl', '$2y$10$1/QUF5Undj1Fwi/T0YZlue/cbbwwcJsNofyGGpJPWn4zK3i/OVb4S', 2, 1, 1, '2018-01-29 06:37:52', '2018-02-12 12:42:53'),
(10, 'superhotels', '$2y$10$FunlXuCrcG3x8Lde28MAQuid/zoC3/KHHGEB1GeIdsyK1OIQ/74Ky', 2, 1, 0, '2018-02-07 06:16:35', '2018-02-17 10:45:27'),
(12, 'superhotels12', '$2y$10$zemMh.s8Ican6XWkdOWW0up3/1At23VNwnnRy1EdC61z/nhjDlEKa', 2, 1, 0, '2018-02-07 06:19:59', '2018-02-17 10:44:29'),
(13, 'yoursclub', '$2y$10$fApbzYi7xRTlPIRjQ9NCOurYjnvVAHhD13c5NKCOAILp/6jrCxD7K', 2, 1, 0, '2018-02-07 06:21:36', '2018-02-17 10:44:22'),
(15, 'fsdf', '$2y$10$ZapEck17luuqvlXWBdPb3OjHhot6ntC/83.ejYRxzU/7Tjii1nHfC', 2, 1, 0, '2018-02-07 07:06:15', '2018-02-17 10:44:08'),
(29, 'arvind', '$2y$10$2FqPgaWtFMvR5JlHq9ybDOUKdN8s4uIbcropj/J6dloGCpfd/zGye', 2, 1, 0, '2018-02-08 10:48:56', '2018-02-17 10:47:06'),
(30, 'fgdfg', '$2y$10$YR/eyJiUu7VeZa1UcLgYuegdK4oN7rxJhr7w.lM0x3HGSXu6rqKru', 2, 3, 0, '2018-02-12 12:43:15', '2018-02-12 12:43:15'),
(31, 'Suppp', '$2y$10$GGZFutIJWSkfPj8Y7tqlwuDxLZfOZ3yUnJqNJL/04cHb0kevHY0Ca', 3, 3, 1, '2018-02-12 12:52:45', '2018-02-12 12:52:45'),
(32, 'sdfdglkdfmg', '$2y$10$EaLVlWl6.8Ws9ehXykzQ6Omfb9oE//7PNLO57zotWe5HdTfDIirQS', 2, 3, 0, '2018-02-12 12:55:10', '2018-02-12 12:55:10'),
(33, 'chintan_manager', '$2y$10$2fgWGx/LripYBKejZfNuU.4sv5jDizsKTJseoei5Wn0pPnaJsyMgm', 3, 2, 1, '2018-02-17 11:00:54', '2018-02-17 11:00:54'),
(34, 'jollyclub', '$2y$10$qtcFNXi4l/ZbM6qkqvg4Zeej67gxJIEUxgR8boJOwpKXY/4vRA4Sq', 2, 1, 0, '2018-03-13 04:26:06', '2018-03-13 04:31:49');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `last_name`, `city`, `state`, `country`, `pincode`, `address`, `profile_pic`, `profile_pic_dir`, `created`, `modified`) VALUES
(1, 2, 'Avirat', 'Group', 1, 1, 1, '382415', '', 'avirat.png', '38c1ea74-709a-499a-9b2b-6607078e6e1e', '2018-02-07 00:00:00', '2018-02-13 05:52:48'),
(8, 3, 'SWPL', 'Hotels', 1, 1, 1, '321520', 'test addreesss', '21484056_300x300', '2cfa8437-5dbe-474a-87e0-6eb635a857b8', '2018-02-07 05:49:20', '2018-02-12 12:42:53'),
(10, 12, 'Super', 'Hotels', 1, 1, 1, '985521', 'test addd', NULL, NULL, '2018-02-07 06:19:59', '2018-02-07 06:19:59'),
(11, 13, 'Yours', 'Hotel', 1, 1, 1, '987542', 'test addreesss 123', NULL, NULL, '2018-02-07 06:21:36', '2018-02-12 10:51:23'),
(12, 15, 'Prince', 'Narula', 1, 1, 1, '985521', '', NULL, NULL, '2018-02-07 07:06:15', '2018-02-17 10:44:08'),
(13, 10, 'Mehul', 'Bhide', 1, 2, 1, '98745', '', '', NULL, '2018-02-07 08:07:01', '2018-02-17 10:45:27'),
(15, 29, 'Arvind', 'Kejriwal', 5, 3, 1, '989898', 'fgfdgfdgdfg', NULL, NULL, '2018-02-08 10:48:56', '2018-02-17 10:43:39'),
(16, 1, 'Super', 'Admin', 1, 1, 1, '98765422', '', 'cake.jpg', '261aa530-b1f2-4f31-9b32-78c00ec458d8', '2018-02-08 11:24:15', '2018-02-12 11:56:16'),
(17, 30, 'dfgdfg', 'dfgfghfghg', 1, 1, 1, '123456', '', NULL, NULL, '2018-02-12 12:43:15', '2018-02-12 12:43:15'),
(18, 31, 'ldfkgmdlfkgm', 'ldfgmfdlmg', 1, 1, 1, '789546', '', NULL, NULL, '2018-02-12 12:52:45', '2018-02-12 12:52:45'),
(19, 32, 'lkdfgmldfkm', 'flgmfglm', 1, 1, 1, '9878954', 'dfgfdlkm', NULL, NULL, '2018-02-12 12:55:10', '2018-02-12 12:55:10'),
(20, 33, 'Chintan', 'Manager', 1, 1, 1, '382000', 'some address', NULL, NULL, '2018-02-17 11:00:54', '2018-02-17 11:00:54'),
(21, 34, 'Jolly', 'Club', 1, 1, 1, '380015', 'jolly enjoy club', 'jolly-food.png', 'e19ff367-5534-4a53-a7bf-e62323d11bf9', '2018-03-13 04:26:06', '2018-03-13 04:31:49');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_services`
--

CREATE TABLE IF NOT EXISTS `user_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `services` varchar(255) NOT NULL,
  `status` int(3) NOT NULL COMMENT '0:Draft;1:Published;2:Deleted;',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_services`
--

INSERT INTO `user_services` (`id`, `user_id`, `services`, `status`, `created`, `modified`) VALUES
(1, 2, '7', 1, '2018-02-14 16:57:31', '2018-02-14 16:57:31'),
(5, 33, '2,3,8,7', 1, '2018-02-17 11:12:18', '2018-02-17 12:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_belts`
--

CREATE TABLE IF NOT EXISTS `waterpark_belts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` int(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `waterpark_belts`
--

INSERT INTO `waterpark_belts` (`id`, `user_id`, `property_id`, `code`, `status`, `created`, `modified`) VALUES
(1, 34, 9, 'JBELT1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 34, 9, 'JBELT2', 0, '2018-03-15 13:14:50', '2018-03-15 13:14:50'),
(4, 34, 9, 'JBELT3', 1, '2018-03-15 13:21:39', '2018-03-15 13:25:14'),
(5, 34, 9, 'JBELT4', 1, '2018-03-16 05:23:27', '2018-03-16 05:23:27'),
(6, 34, 9, 'JBELT5', 1, '2018-03-16 05:23:27', '2018-03-16 05:23:27'),
(9, 34, 9, 'JBELT6', 1, '2018-03-16 05:53:38', '2018-03-16 05:53:38'),
(10, 34, 9, 'JBELT7', 1, '2018-03-16 05:53:38', '2018-03-16 05:53:38'),
(11, 34, 9, 'JBELT8', 1, '2018-03-16 05:53:38', '2018-03-16 05:53:38'),
(12, 34, 9, 'JBELT9', 1, '2018-03-16 05:53:38', '2018-03-16 05:53:38'),
(13, 34, 9, 'JBELT10', 1, '2018-03-16 05:53:38', '2018-03-16 05:53:38'),
(14, 34, 9, 'JBELT11', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(15, 34, 9, 'JBELT12', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(16, 34, 9, 'JBELT13', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(17, 34, 9, 'JBELT14', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(18, 34, 9, 'JBELT15', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(19, 34, 9, 'JBELT16', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(20, 34, 9, 'JBELT17', 0, '2018-03-16 05:57:23', '2018-03-16 05:57:44'),
(21, 34, 9, 'JBELT18', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(22, 34, 9, 'JBELT19', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(23, 34, 9, 'JBELT20', 1, '2018-03-16 05:57:23', '2018-03-16 05:57:23'),
(24, 34, 9, 'JBELT21', 0, '2018-03-16 06:00:46', '2018-03-16 06:00:46'),
(25, 34, 9, 'JBELT22', 0, '2018-03-16 06:00:46', '2018-03-16 06:00:46'),
(26, 34, 9, 'JBELT23', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(27, 34, 9, 'JBELT24', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(28, 34, 9, 'JBELT25', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(29, 34, 9, 'JBELT26', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(30, 34, 9, 'JBELT27', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(31, 34, 9, 'JBELT28', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(32, 34, 9, 'JBELT29', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(33, 34, 9, 'JBELT30', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(34, 34, 9, 'JBELT31', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(35, 34, 9, 'JBELT32', 1, '2018-03-16 06:02:46', '2018-03-16 06:02:46'),
(36, 34, 9, 'JBELT33', 1, '2018-03-17 13:14:37', '2018-03-17 13:14:37'),
(37, 34, 9, 'JBELT34', 1, '2018-03-17 13:14:37', '2018-03-17 13:14:37'),
(38, 34, 9, 'JBELT35', 1, '2018-03-17 13:14:37', '2018-03-17 13:14:37'),
(39, 34, 9, 'JBELT36', 1, '2018-03-17 13:14:37', '2018-03-17 13:14:37'),
(40, 34, 9, 'JBELT37', 1, '2018-03-17 13:14:37', '2018-03-17 13:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_belt_transactions`
--

CREATE TABLE IF NOT EXISTS `waterpark_belt_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `belt_id` int(11) NOT NULL,
  `kot_billing_id` int(11) DEFAULT NULL,
  `transaction_type` int(3) NOT NULL DEFAULT '0' COMMENT '0:food;1:other;',
  `bill_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(11,2) NOT NULL,
  `status` int(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`,`belt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_costumelockers`
--

CREATE TABLE IF NOT EXISTS `waterpark_costumelockers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `costume_price` decimal(11,2) NOT NULL,
  `locker_price` decimal(11,2) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `waterpark_costumelockers`
--

INSERT INTO `waterpark_costumelockers` (`id`, `user_id`, `property_id`, `costume_price`, `locker_price`, `status`, `created`, `modified`) VALUES
(1, 34, 9, '150.00', '300.00', 1, '2018-03-14 13:18:01', '2018-03-14 13:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_issued_belts`
--

CREATE TABLE IF NOT EXISTS `waterpark_issued_belts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `belt_id` int(11) NOT NULL,
  `issued_date` date NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '0:issued;1:closed;',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`,`ticket_id`,`belt_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `belt_id` (`belt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_kots`
--

CREATE TABLE IF NOT EXISTS `waterpark_kots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `restaurant_kitchen_id` int(11) DEFAULT '0',
  `waterpark_kot_no` int(11) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `kot_status` tinyint(3) NOT NULL COMMENT '0-default, 1-generate kot, 2-billing, 3-cancel, 4-bill paid',
  `kot_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_kitchen_id` (`restaurant_kitchen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_kot_billings`
--

CREATE TABLE IF NOT EXISTS `waterpark_kot_billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `waterpark_kot_id` int(11) NOT NULL,
  `waterpark_belt_id` int(11) DEFAULT '0',
  `restaurant_kitchen_id` int(11) DEFAULT '0',
  `waterpark_kot_no` int(11) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_cgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total_sgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `bill_status` tinyint(3) NOT NULL COMMENT '0-generate, 1-paid',
  `bill_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_kitchen_id` (`restaurant_kitchen_id`),
  KEY `waterpark_kot_id` (`waterpark_kot_id`),
  KEY `waterpark_belt_id` (`waterpark_belt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_kot_items`
--

CREATE TABLE IF NOT EXISTS `waterpark_kot_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `waterpark_kot_id` int(11) NOT NULL,
  `waterpark_kot_no` int(11) NOT NULL,
  `restaurant_kitchen_id` int(11) DEFAULT '0',
  `restaurant_menu_id` int(11) NOT NULL,
  `restaurant_menu_type_id` int(11) DEFAULT '0',
  `menu_code` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `kot_item_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `restaurant_menu_id` (`restaurant_menu_id`),
  KEY `waterpark_kot_id` (`waterpark_kot_id`),
  KEY `restaurant_kitchen_id` (`restaurant_kitchen_id`),
  KEY `restaurant_menu_type_id` (`restaurant_menu_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_kot_item_billings`
--

CREATE TABLE IF NOT EXISTS `waterpark_kot_item_billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `waterpark_kot_id` int(11) NOT NULL,
  `waterpark_kot_billing_id` int(11) DEFAULT '0',
  `waterpark_kot_no` int(11) NOT NULL,
  `restaurant_kitchen_id` int(11) DEFAULT '0',
  `restaurant_menu_id` int(11) NOT NULL,
  `menu_code` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `qty` int(3) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `cgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `kot_item_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `restaurant_menu_id` (`restaurant_menu_id`),
  KEY `waterpark_kot_id` (`waterpark_kot_id`),
  KEY `restaurant_kitchen_id` (`restaurant_kitchen_id`),
  KEY `waterpark_kot_billing_id` (`waterpark_kot_billing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_prices`
--

CREATE TABLE IF NOT EXISTS `waterpark_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `monday_total_price` decimal(11,2) NOT NULL,
  `monday_ticket_price` decimal(11,2) NOT NULL,
  `tuesday_total_price` decimal(11,2) NOT NULL,
  `tuesday_ticket_price` decimal(11,2) NOT NULL,
  `wednesday_total_price` decimal(11,2) NOT NULL,
  `wednesday_ticket_price` decimal(11,2) NOT NULL,
  `thursday_total_price` decimal(11,2) NOT NULL,
  `thursday_ticket_price` decimal(11,2) NOT NULL,
  `friday_total_price` decimal(11,2) NOT NULL,
  `friday_ticket_price` decimal(11,2) NOT NULL,
  `saturday_total_price` decimal(11,2) NOT NULL,
  `saturday_ticket_price` decimal(11,2) NOT NULL,
  `sunday_total_price` decimal(11,2) NOT NULL,
  `sunday_ticket_price` decimal(11,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `waterpark_prices`
--

INSERT INTO `waterpark_prices` (`id`, `user_id`, `property_id`, `monday_total_price`, `monday_ticket_price`, `tuesday_total_price`, `tuesday_ticket_price`, `wednesday_total_price`, `wednesday_ticket_price`, `thursday_total_price`, `thursday_ticket_price`, `friday_total_price`, `friday_ticket_price`, `saturday_total_price`, `saturday_ticket_price`, `sunday_total_price`, `sunday_ticket_price`, `created`, `modified`) VALUES
(7, 34, 9, '3000.00', '1500.00', '3000.00', '1500.00', '3000.00', '1500.00', '3000.00', '1500.00', '3000.00', '1500.00', '3000.00', '1500.00', '3000.00', '1500.00', '2018-03-15 07:21:00', '2018-03-17 13:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_recharges`
--

CREATE TABLE IF NOT EXISTS `waterpark_recharges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`property_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `waterpark_recharges`
--

INSERT INTO `waterpark_recharges` (`id`, `user_id`, `property_id`, `code`, `amount`, `status`, `created`, `modified`) VALUES
(2, 34, 9, 'JWRC1', 100, 1, '2018-03-15 07:37:02', '2018-03-15 07:47:19'),
(3, 34, 9, 'JWRC2', 200, 0, '2018-03-15 07:44:06', '2018-03-15 07:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_settings`
--

CREATE TABLE IF NOT EXISTS `waterpark_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `belt_code_prefix` varchar(5) DEFAULT NULL,
  `ticket_code_prefix` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`property_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `waterpark_settings`
--

INSERT INTO `waterpark_settings` (`id`, `user_id`, `property_id`, `belt_code_prefix`, `ticket_code_prefix`, `created`, `modified`) VALUES
(2, 34, 9, 'JBELT', 'JWW_TKT_', '2018-03-15 10:45:52', '2018-03-19 08:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_specific_prices`
--

CREATE TABLE IF NOT EXISTS `waterpark_specific_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `single_date` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `ticket_price` decimal(11,2) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `waterpark_specific_prices`
--

INSERT INTO `waterpark_specific_prices` (`id`, `user_id`, `property_id`, `type`, `single_date`, `from_date`, `to_date`, `total_price`, `ticket_price`, `status`, `created`, `modified`) VALUES
(14, 34, 9, 0, '2018-04-01', NULL, NULL, '3200.00', '1600.00', 1, '2018-03-14 08:19:20', '2018-03-14 08:19:20'),
(15, 34, 9, 1, NULL, '2018-05-01', '2018-05-31', '3500.00', '2000.00', 1, '2018-03-14 12:34:51', '2018-03-14 12:37:09'),
(16, 34, 9, 1, NULL, '2018-06-01', '2018-06-15', '3500.00', '2000.00', 1, '2018-03-17 13:12:49', '2018-03-17 13:12:49'),
(17, 34, 9, 0, '2018-03-20', '2018-03-20', '2018-03-25', '2900.00', '1500.00', 0, '2018-03-20 05:55:33', '2018-03-20 06:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_taxes`
--

CREATE TABLE IF NOT EXISTS `waterpark_taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `restaurant_menu_type_id` int(11) NOT NULL,
  `cgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sgst` decimal(11,2) NOT NULL DEFAULT '0.00',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurant_menu_type_id` (`restaurant_menu_type_id`),
  KEY `waterpark_taxes_ibfk_1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `waterpark_taxes`
--

INSERT INTO `waterpark_taxes` (`id`, `user_id`, `restaurant_menu_type_id`, `cgst`, `sgst`, `created`, `modified`) VALUES
(5, 34, 3, '5.00', '5.00', '2018-03-15 12:38:16', '2018-03-15 12:38:16'),
(6, 34, 5, '5.00', '4.00', '2018-03-15 12:38:32', '2018-03-15 12:38:32'),
(7, 34, 6, '3.00', '3.00', '2018-03-15 12:39:02', '2018-03-15 12:39:02'),
(8, 34, 7, '7.00', '7.00', '2018-03-15 12:39:23', '2018-03-15 12:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `waterpark_tickets`
--

CREATE TABLE IF NOT EXISTS `waterpark_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `no_of_persons` int(3) NOT NULL DEFAULT '1',
  `no_of_adults` int(3) DEFAULT NULL,
  `no_of_childs` int(3) DEFAULT NULL,
  `issued_by` varchar(100) NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `member_type` varchar(50) DEFAULT NULL,
  `mobileno` varchar(20) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `hold_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `discount_code` varchar(100) DEFAULT NULL,
  `discount_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(11,2) NOT NULL,
  `payment_mode` int(3) NOT NULL DEFAULT '0' COMMENT '0:cash;1:card;',
  `card_number` varchar(20) DEFAULT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`,`member_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `waterpark_tickets`
--

INSERT INTO `waterpark_tickets` (`id`, `property_id`, `user_id`, `code`, `no_of_persons`, `no_of_adults`, `no_of_childs`, `issued_by`, `member_id`, `member_type`, `mobileno`, `total_amount`, `hold_amount`, `balance`, `discount_code`, `discount_amount`, `net_amount`, `payment_mode`, `card_number`, `card_holder`, `status`, `created`, `modified`) VALUES
(9, 9, 34, 'JWW_TKT_5', 1, NULL, NULL, 'Jolly Club', 0, '', '65465465465', '3000.00', '0.00', '1500.00', '', '100.00', '2900.00', 0, '', '', 3, '2018-03-20 11:51:01', '2018-03-22 07:17:21'),
(10, 9, 34, 'JWW_TKT_6', 2, 2, NULL, 'Jolly Club', 0, '', '8855522314', '6000.00', '0.00', '3000.00', '', '0.00', '6000.00', 0, '', '', 2, '2018-03-21 08:15:33', '2018-03-22 07:11:26'),
(12, 9, 34, 'JWW_TKT_9', 5, NULL, NULL, 'Jolly Club', 42, 'member', '9855555556', '15000.00', '0.00', '7500.00', '', '1000.00', '14000.00', 1, '4242424242424242', 'Sureshkumar R', 3, '2018-03-21 09:24:50', '2018-03-22 07:18:07'),
(13, 9, 34, 'JWW_TKT_10', 3, 2, 1, 'Jolly Club', 0, '', '7878454566', '9000.00', '0.00', '4500.00', '', '0.00', '9000.00', 0, '', '', 1, '2018-03-22 07:22:53', '2018-03-22 07:22:53'),
(14, 9, 34, 'JWW_TKT_11', 2, 2, 0, 'Jolly Club', 0, '', '8900001234', '6000.00', '0.00', '3000.00', '', '0.00', '6000.00', 1, '4240424042404240', 'Sanjay Patel', 1, '2018-03-22 13:15:32', '2018-03-22 13:15:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `checkins_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkins_ibfk_5` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkins_ibfk_6` FOREIGN KEY (`checkin_status_id`) REFERENCES `checkin_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkin_billings`
--
ALTER TABLE `checkin_billings`
  ADD CONSTRAINT `checkin_billings_ibfk_1` FOREIGN KEY (`checkin_id`) REFERENCES `checkins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkin_rooms_rates`
--
ALTER TABLE `checkin_rooms_rates`
  ADD CONSTRAINT `checkin_rooms_rates_ibfk_1` FOREIGN KEY (`checkin_id`) REFERENCES `checkins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkin_rooms_rates_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkin_rooms_rates_ibfk_3` FOREIGN KEY (`room_rate_id`) REFERENCES `room_rates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kots`
--
ALTER TABLE `kots`
  ADD CONSTRAINT `kots_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kots_ibfk_2` FOREIGN KEY (`restaurant_table_id`) REFERENCES `restaurant_tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kot_items`
--
ALTER TABLE `kot_items`
  ADD CONSTRAINT `kot_items_ibfk_1` FOREIGN KEY (`kot_id`) REFERENCES `kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kot_items_ibfk_2` FOREIGN KEY (`restaurant_menu_id`) REFERENCES `restaurant_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kot_items_ibfk_3` FOREIGN KEY (`restaurant_table_id`) REFERENCES `restaurant_tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kot_items_ibfk_4` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kot_items_ibfk_5` FOREIGN KEY (`restaurant_waiter_id`) REFERENCES `restaurant_waiters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`type`) REFERENCES `property_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_5` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_6` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  ADD CONSTRAINT `reservation_rooms_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_rooms_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  ADD CONSTRAINT `restaurant_menus_ibfk_1` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_menus_ibfk_2` FOREIGN KEY (`restaurant_menu_type_id`) REFERENCES `restaurant_menu_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_menus_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_menu_types`
--
ALTER TABLE `restaurant_menu_types`
  ADD CONSTRAINT `restaurant_menu_types_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  ADD CONSTRAINT `restaurant_tables_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_table_bookings`
--
ALTER TABLE `restaurant_table_bookings`
  ADD CONSTRAINT `restaurant_table_bookings_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`type`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_4` FOREIGN KEY (`room_occupancy`) REFERENCES `room_occupancies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_5` FOREIGN KEY (`room_status_id`) REFERENCES `room_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_occupancies`
--
ALTER TABLE `room_occupancies`
  ADD CONSTRAINT `room_occupancies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_plans`
--
ALTER TABLE `room_plans`
  ADD CONSTRAINT `room_plans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_rates`
--
ALTER TABLE `room_rates`
  ADD CONSTRAINT `room_rates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_rates_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_rates_ibfk_3` FOREIGN KEY (`room_plan_id`) REFERENCES `room_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_rates_ibfk_4` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_rates_ibfk_5` FOREIGN KEY (`room_occupancy_id`) REFERENCES `room_occupancies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `waterpark_belts`
--
ALTER TABLE `waterpark_belts`
  ADD CONSTRAINT `waterpark_belts_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_belts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_costumelockers`
--
ALTER TABLE `waterpark_costumelockers`
  ADD CONSTRAINT `waterpark_costumelockers_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_costumelockers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_issued_belts`
--
ALTER TABLE `waterpark_issued_belts`
  ADD CONSTRAINT `waterpark_issued_belts_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_issued_belts_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `waterpark_tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_issued_belts_ibfk_3` FOREIGN KEY (`belt_id`) REFERENCES `waterpark_belts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_kots`
--
ALTER TABLE `waterpark_kots`
  ADD CONSTRAINT `waterpark_kots_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kots_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kots_ibfk_3` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_kot_billings`
--
ALTER TABLE `waterpark_kot_billings`
  ADD CONSTRAINT `waterpark_kot_billings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_billings_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_billings_ibfk_3` FOREIGN KEY (`waterpark_kot_id`) REFERENCES `waterpark_kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_billings_ibfk_5` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_kot_items`
--
ALTER TABLE `waterpark_kot_items`
  ADD CONSTRAINT `waterpark_kot_items_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_items_ibfk_3` FOREIGN KEY (`restaurant_menu_id`) REFERENCES `restaurant_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_items_ibfk_4` FOREIGN KEY (`waterpark_kot_id`) REFERENCES `waterpark_kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_items_ibfk_5` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_items_ibfk_6` FOREIGN KEY (`restaurant_menu_type_id`) REFERENCES `restaurant_menu_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_kot_item_billings`
--
ALTER TABLE `waterpark_kot_item_billings`
  ADD CONSTRAINT `waterpark_kot_item_billings_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_item_billings_ibfk_2` FOREIGN KEY (`waterpark_kot_id`) REFERENCES `waterpark_kots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_item_billings_ibfk_3` FOREIGN KEY (`waterpark_kot_billing_id`) REFERENCES `waterpark_kot_billings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_item_billings_ibfk_4` FOREIGN KEY (`restaurant_kitchen_id`) REFERENCES `restaurant_kitchens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_kot_item_billings_ibfk_5` FOREIGN KEY (`restaurant_menu_id`) REFERENCES `restaurant_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_prices`
--
ALTER TABLE `waterpark_prices`
  ADD CONSTRAINT `waterpark_prices_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_prices_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_recharges`
--
ALTER TABLE `waterpark_recharges`
  ADD CONSTRAINT `waterpark_recharges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_recharges_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_settings`
--
ALTER TABLE `waterpark_settings`
  ADD CONSTRAINT `waterpark_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_settings_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_specific_prices`
--
ALTER TABLE `waterpark_specific_prices`
  ADD CONSTRAINT `waterpark_specific_prices_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_specific_prices_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_taxes`
--
ALTER TABLE `waterpark_taxes`
  ADD CONSTRAINT `waterpark_taxes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_taxes_ibfk_2` FOREIGN KEY (`restaurant_menu_type_id`) REFERENCES `restaurant_menu_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `waterpark_tickets`
--
ALTER TABLE `waterpark_tickets`
  ADD CONSTRAINT `waterpark_tickets_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `waterpark_tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
