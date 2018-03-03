-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2018 at 06:40 PM
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
  `status` int(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`,`property_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `package_id`, `parent`, `member_type`, `code`, `first_name`, `last_name`, `nick_name`, `application_no`, `member_group_id`, `occupation`, `organization`, `designation`, `birth_date`, `anniversary_date`, `blood_group`, `pancard`, `aadharcard`, `remark`, `gender`, `marrital_status`, `cor_address`, `cor_city`, `cor_state`, `cor_country`, `cor_pincode`, `res_address`, `res_city`, `res_state`, `res_country`, `res_pincode`, `email`, `phone`, `mobile`, `images`, `images_dir`, `services`, `discount`, `status`, `created`, `modified`) VALUES
(1, 1, 2, 'member', '3170', 'Viveka', 'Acharyaa', '1', '10473192', 1, 'Jobtitle', 'Seawindsol', 'SR. PHP Developer', '1985-05-22', '2010-04-22', 'B+', 'AKIPA0147B', '012425781241', 'Remark', '0', '0', 'Corr Add', 5, 2, 1, '789456', 'Res address', '6', '3', '1', '987654', 'projectdeska@seawindsolution.com', '8471281435', '1234567890', 'Test Image', NULL, '2,3,7', 10, 1, '2018-02-15 11:45:30', '2018-02-15 12:08:09'),
(2, 2, 3, 'guest', '104', 'chintan', 'seawind', 'chinta ', '123784565596', 2, 'job', 'Seawind', 'PHP Developer', '1970-01-01', '1970-01-01', 'B', 'AKIPA0147A', '012425781245', 'Test remark', '0', '0', 'as', 1, 1, 1, '380008', 'assdf', '1', '1', '1', '124578', 'projectdesk@seawindsolution.com', '8471281435', '1234567890', 'sdfsdf', NULL, 'as', 15, 0, '2018-02-16 07:32:01', '2018-02-16 07:32:01'),
(3, 1, 3, 'guest', '104', 'chintan', 'acharya', '1', '10473191', 3, 'Job', 'Seawind', 'PHP Developer', '1970-01-01', '1970-01-01', 'B', 'AKIPA0147A', '012425781245', 'asasasas', '1', '0', 'sdsdsd', 1, 1, 1, '380008', 'sdsdsd', '1', '1', '1', '124578', 'projectdesksa@seawindsolution.com', '8471281435', '1234567890', '', NULL, 'as', 13, 0, '2018-02-16 07:42:17', '2018-02-16 07:42:17'),
(4, 1, 2, 'guest', '65465', 'DFDFDSF', 'DSFSDFDF', '', '6546546554654555', 2, 'Job', 'Seawind', '', '1970-01-01', '1970-01-01', '', '5465465464', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '0', '0', 'Lorem Ipsum is simply dummy text o\r\nthe printing and typesetting industry. \r\nLorem Ipsum\r\n has been ', 1, 1, 1, '380008', '', '1', '1', '1', '', 'ach222arya.vivek1@gmail.com', '', '999888885555', 'banner.png.jpg', '55838b1e-f1b1-4e0c-8d28-be26def4cfb3', '', NULL, 0, '2018-02-16 08:18:09', '2018-02-17 12:43:46'),
(5, 1, 3, 'guest', '123', 'acharya', 'Acharyaa', 'vivek', '10473191', 3, 'Job', 'Seawind', 'PHP Developer', NULL, NULL, 'A', 'AKIPA0147B', '012425781245', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '0', '0', 'Lorem Ipsum is simply dummy text\r\n of the printing and typesetting industry.\r\n Lorem Ipsum has been the industry''s \r\nstandard dummy text ev', 1, 1, 1, '380005', '', '1', '1', '1', '', 'asdabc@sasa.com', '', '999888885555', 'banner.jpg', 'b5e5e32c-563c-4c4a-9943-9ee5598f62f6', '', 12, 0, '2018-02-16 10:56:45', '2018-02-16 12:09:12'),
(6, 0, 2, 'guest', 'NA', 'Farhan', 'Khan', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'test@jsdfh.com', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-17 06:38:28', '2018-03-01 12:21:07'),
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
(38, 0, 2, 'guest', 'NA', 'Farhan', 'Khan', NULL, 'NA', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', NULL, NULL, 'NA', NULL, 'test address', 1, 1, 1, '382411', NULL, NULL, NULL, NULL, NULL, 'test@jsdfh1.co', '9876543210', '9876543210', NULL, NULL, NULL, NULL, 1, '2018-02-28 07:21:27', '2018-02-28 07:21:27');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `code`, `name`, `type`, `user`, `address`, `images`, `images_dir`, `start_time`, `end_time`, `sunday_open`, `monday_open`, `tuesday_open`, `wednesday_open`, `thursday_open`, `friday_open`, `saturday_open`, `notes`, `status`, `created`, `modified`) VALUES
(1, 'SW001', 'Swad Restaurant', 2, 3, 'maninagar , ahmedabad', '', '1sC-58qTU0Y2', '11:30:00', '23:59:00', 1, 1, 1, 1, 1, 1, 1, 'test notes', 1, '2018-02-13 05:10:00', '2018-02-13 05:10:00'),
(2, 'AVPI', 'Palace Inn', 1, 2, 'S.g Highway, Ahmedabad', '20225774-317331188714749-7763899870015913984-n.jpg,Rlogo.png', 'ed6fb62b-4324-4d17-80bb-0caedc151b43', '10:30:00', '23:59:00', 1, 0, 0, 1, 1, 1, 1, '', 1, '2018-02-13 06:00:51', '2018-02-14 07:52:10'),
(6, 'AVYS', 'Yummy Sizzlers', 2, 2, 'ahmedabad', 'Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images5.jpg,Panasonic-LUMIX-G-Macro-30mm-f2-8-Lens-Sample-Images.jpg', 'w_po-TT7-TtVG-YOw_T63LH-O', '07:59:00', '07:59:00', 1, 0, 0, 0, 0, 0, 1, '', 1, '2018-02-14 08:00:06', '2018-02-14 08:00:06'),
(7, 'AVPR', 'Palace Resort', 1, 2, 'test addresss', 'Cb-logo-sans-words-transparent-bg.png,padman-story-647-080317061310.jpg', 'LgtwP7rEfk__a3Wqwhf_T_PLt', '08:25:00', '08:25:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-02-14 08:26:01', '2018-02-15 11:17:03'),
(8, 'svas', 'Suvas Hotel', 1, 3, 'testnskdjfn\r\nsdfnj''kjhsdf\r\nAhmedabad', 'New-Zealand-ZM2V-DX-News.jpg', 'ZEFoXd4y2-dB---Kbi9r2nPFx', '05:56:00', '15:56:00', 1, 1, 1, 1, 1, 1, 1, '', 1, '2018-02-15 05:57:34', '2018-02-15 05:57:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `member_type`, `member_id`, `first_name`, `last_name`, `address`, `city_id`, `state_id`, `country_id`, `pincode`, `phone`, `mobile`, `email`, `property_id`, `reservation_type`, `start_date`, `end_date`, `no_of_adult`, `no_of_child`, `no_of_rooms`, `comments`, `rate`, `discount`, `total_cost`, `created`, `modified`) VALUES
(19, 'guest', 33, 'Suresh', 'Raina', 'jhbfdjhbsdfb', 1, 1, 1, '123456', '9878451232', '9878451232', 'raina@mailinator.com', 2, 'inquiry', '2018-02-27', '2018-02-28', 2, 0, 2, 'celeb', '8111.00', '5.00', '7611.00', '2018-02-22 05:39:25', '2018-02-22 05:39:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `reservation_rates`
--

INSERT INTO `reservation_rates` (`id`, `reservation_id`, `room_rate_id`, `no_of_adult`, `no_of_child`, `no_of_rooms`) VALUES
(1, 19, 6, 1, 0, 1),
(2, 19, 13, 1, 0, 1);

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
(19, '02', 'AVPI02', 5, 'test\r\ntest\r\ntest\r\nkfgkgn\r\ndfkgfdkgndkfjgn\r\ndfgnfdfkgndf\r\nfdgnfdkgdfl\r\ndfkgndfkjngf\r\ndfkgnfdkgnjkfdjngkdfngkjnfg1\r\n11', 'Radha-Krishna-Temple-ISKCON-4.jpg', 'An_m-FyNVdU-Vmr_h4GB_U-kf', 1, 2, 2, 1, 1, '2018-02-15 12:07:01', '2018-02-21 05:17:29'),
(20, '03', 'AVPI03', 12, '', '', '-qq2z_v2qUta_rN_f_Ry--LGE', 1, 2, 2, 1, 0, '2018-02-19 06:57:09', '2018-02-21 05:17:37'),
(22, '02', 'AVPR02', 5, 'dsd', '', 'sgU__kFSAsGqKXKQc_4quNg_M', 1, 2, 7, 1, 0, '2018-02-19 09:28:27', '2018-02-21 05:18:05'),
(23, '04', 'AVPI04', 7, '', '', 'e-KdAJSIJUsDaHA8W3t-Y-jH0', 1, 2, 2, 1, 1, '2018-02-22 08:12:01', '2018-02-22 08:12:01'),
(24, '05', 'AVPI05', 7, '', '', 'VwF__9Kp-OknT_tKHOZvDGZdX', 4, 2, 2, 1, 1, '2018-02-22 08:12:18', '2018-02-22 08:13:25'),
(25, '06', 'AVPI06', 7, '', '', '_2_P_I4wasY7V1vDEj0m2f-_g', 2, 2, 2, 1, 1, '2018-02-22 08:12:37', '2018-02-22 08:13:16'),
(26, '07', 'AVPI07', 5, '', '', 'xXc6xKiSAedusNs-e-BxgH_98', 2, 2, 2, 1, 1, '2018-02-22 08:13:11', '2018-02-22 08:13:11'),
(27, '08', 'AVPI08', 5, '', '', 'j144_2OO_p0VA7KI1PgIz_Y_X', 4, 2, 2, 1, 1, '2018-02-22 08:13:42', '2018-02-22 08:13:42'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

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
(33, 'chintan_manager', '$2y$10$2fgWGx/LripYBKejZfNuU.4sv5jDizsKTJseoei5Wn0pPnaJsyMgm', 3, 2, 1, '2018-02-17 11:00:54', '2018-02-17 11:00:54');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(20, 33, 'Chintan', 'Manager', 1, 1, 1, '382000', 'some address', NULL, NULL, '2018-02-17 11:00:54', '2018-02-17 11:00:54');

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `checkins_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkins_ibfk_5` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
