-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2022 at 04:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_mahateli`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_shop_own`
--

CREATE TABLE `about_shop_own` (
  `website_id` int(11) NOT NULL,
  `website_number` varchar(100) NOT NULL,
  `website_name` varchar(200) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `website_contact` varchar(20) NOT NULL,
  `website_contact1` varchar(20) DEFAULT NULL,
  `website_email` varchar(100) NOT NULL,
  `website_email1` varchar(200) DEFAULT NULL,
  `website_address` text NOT NULL,
  `website_address1` varchar(255) DEFAULT NULL,
  `website_gstno` varchar(50) NOT NULL,
  `website_url` text NOT NULL,
  `website_van` varchar(50) NOT NULL,
  `website_pan` varchar(50) NOT NULL,
  `website_terms_conditions` longtext NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `admin` int(11) NOT NULL,
  `print_flag` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1-Horizontal / 2- Vertical',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- deactive/ 1- activeshop',
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_shop_own`
--

INSERT INTO `about_shop_own` (`website_id`, `website_number`, `website_name`, `owner_name`, `website_contact`, `website_contact1`, `website_email`, `website_email1`, `website_address`, `website_address1`, `website_gstno`, `website_url`, `website_van`, `website_pan`, `website_terms_conditions`, `bank_name`, `account_name`, `account_number`, `ifsc_code`, `admin`, `print_flag`, `status`, `logo`) VALUES
(1, '7391915164', 'Mahateli', '', '7620508512', '', 'dipaklokhande81800@gmail.com', 'dipaklokhande81@gmail.com', '', '', '', '', '', '', 'http://localhost/mahateli/terms_conditions', '', '', '', '', 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `authenticate`
--

CREATE TABLE `authenticate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `random_no` varchar(20) NOT NULL,
  `start_number` int(20) NOT NULL,
  `end_number` int(20) NOT NULL,
  `valid_upto` datetime NOT NULL,
  `flag` tinyint(4) NOT NULL COMMENT '0-Admin, 1-users, 2- sunscribe_user',
  `user_level` varchar(50) NOT NULL,
  `status` int(4) NOT NULL DEFAULT 1 COMMENT '1-Activate / 2- Inactivate',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `caste`
--

CREATE TABLE `caste` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `family_id` int(11) NOT NULL,
  `caste_name` varchar(500) NOT NULL,
  `sub_caste_name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caste`
--

INSERT INTO `caste` (`id`, `user_id`, `family_id`, `caste_name`, `sub_caste_name`, `status`, `created_by`, `created_date`, `added_by`, `added_date`, `update_by`, `update_date`) VALUES
(1, '3', 0, 'Teli', 'Savji', 1, 0, '2022-02-07 16:19:01', 0, NULL, 0, '2022-03-07 15:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(80) NOT NULL,
  `status_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('71s7hc8m7k2jt8k3plql17pkg7iadial', '::1', 1644243657, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234333635373b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('ngirhs4sr6i98tdbaqcqikt7doi8oqk4', '::1', 1644244306, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234343330363b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('8s66hrq3al0tm8q4n48gcllhjefektvc', '::1', 1644244633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234343633333b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('c7jd4j0oan3rtpbvqr7fmdsgv7cvi58v', '::1', 1644244982, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234343938323b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('egpes3p5hq2230qa81b9hv1b368n195r', '::1', 1644245681, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234353638313b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('ep18tc2ftcvg167on1kgujq199o5d7ag', '::1', 1644245993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234353939333b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('2j9a2kaj2mpq3fh0j0e5t79e2s63f3s7', '::1', 1644246374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234363337343b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('tekcompgbm0s4hgulafgiu3egu49hi3o', '::1', 1644246680, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234363638303b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('27mndu04c3hr7bj9c09pif3cf01o26i7', '::1', 1644248630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234383633303b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('p56renjd64lhcakhn2b4ia6jruiiopn5', '::1', 1644249117, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234393131373b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('5s5v6o5ghnokirg626oelbf64q5bjm53', '::1', 1644249604, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343234393630343b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('9p5iv80tvj26f9ctlbdju0a6427i0m5k', '::1', 1644250242, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235303234323b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('0m16ba2i6jif3o6bhke8ne988hcbf9d8', '::1', 1644250703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235303730333b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('igk09aidgq9cva6m98bdhgeq2c8cmhog', '::1', 1644251040, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235313034303b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('fqlhv3rtnhf0j28c0bo6ughnh8m0ravo', '::1', 1644251635, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235313633353b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('ed67k764k07pqk389g3r36skiov2h9h1', '::1', 1644252338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235323333383b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('va5ljhakqgcv6hquuhr32ndk86n6hjlq', '::1', 1644252642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235323634323b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('nd1sqavnrdtil1v759gj2nr4a5gv3s89', '::1', 1644253069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235333036393b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('tmauojgr5memo5vcecq4f5fp58n2atb7', '::1', 1644253121, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343235333036393b70726f66696c657c733a303a22223b),
('1c01uahpjf9canbdqvc3c8trudc88e0s', '::1', 1644747796, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634343734373733323b757365725f70726f66696c657c733a303a22223b70726f66696c657c733a303a22223b),
('nkrsbg0138ptgffttg3e9kkgs7n9k1er', '::1', 1646665478, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634363636353437383b70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2232223b733a353a22656d61696c223b733a31383a2261646d696e406d61686174656c692e636f6d223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237333931393135313634223b733a353a22696d616765223b733a303a22223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a303a22223b733a31303a2276616c69645f74696c6c223b733a31393a22303030302d30302d30302030303a30303a3030223b733a343a22666c6167223b733a313a2230223b733a31303a22757365725f6c6576656c223b733a303a22223b7d),
('onvjdcs8n32gnmhvov2e2ae0gg7hplaj', '::1', 1646665810, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634363636353831303b70726f66696c657c733a303a22223b757365725f70726f66696c657c4f3a383a22737464436c617373223a31303a7b733a323a226964223b733a313a2233223b733a353a22656d61696c223b733a303a22223b733a383a2270617373776f7264223b733a33323a223231323332663239376135376135613734333839346130653461383031666333223b733a373a22636f6e74616374223b733a31303a2237383735383032383638223b733a353a22696d616765223b733a39303a22313634333437333137315f73637265656e636170747572652d6170702d636c69636b75702d31303630313737382d64617368626f617264732d613368396a2d3132342d323032322d30312d31322d31385f34305f30302e706e67223b733a393a227374617475735f6964223b733a313a2231223b733a393a2272616e646f6d5f6e6f223b733a363a22353030303032223b733a31303a2276616c69645f74696c6c223b733a31393a22323032322d30312d32392032313a35393a3331223b733a343a22666c6167223b733a313a2233223b733a31303a22757365725f6c6576656c223b733a303a22223b7d73657373696f6e5f69647c733a313a2233223b),
('0ujmtsan6a4ahsndb1eidgs3gp1sac6e', '::1', 1646666058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634363636353831303b70726f66696c657c733a303a22223b757365725f70726f66696c657c733a303a22223b);

-- --------------------------------------------------------

--
-- Table structure for table `correspondence_address`
--

CREATE TABLE `correspondence_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(500) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `added_date` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-Active, 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `status_id` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_code`, `status_id`) VALUES
(1, 'Afghanistan', '+93', 1),
(2, 'Albania', '+355', 1),
(3, 'Algeria', '+213', 1),
(4, 'American Samoa', '+1-684', 1),
(5, 'Andorra', '+376', 1),
(6, 'Angola', '+244', 1),
(7, 'Anguilla', '+1-264', 1),
(8, 'Antarctica', '+672', 1),
(9, 'Antigua', '+1-268', 1),
(10, 'Argentina', '+54', 1),
(11, 'Armenia', '+374', 1),
(12, 'Aruba', '+297', 1),
(13, 'Ascension', '+247', 1),
(14, 'Australia', '+61', 1),
(15, 'Australian External Territories', '+672', 1),
(16, 'Austria', '+43', 1),
(17, 'Azerbaijan', '+994', 1),
(18, 'Bahamas', '+1-242', 1),
(19, 'Bahrain', '+973', 1),
(20, 'Bangladesh', '+880', 1),
(21, 'Barbados', '+1-246', 1),
(22, 'Barbuda', '+1-268', 1),
(23, 'Belarus', '+375', 1),
(24, 'Belgium', '+32', 1),
(25, 'Belize', '+501', 1),
(26, 'Benin', '+229', 1),
(27, 'Bermuda', '+1-441', 1),
(28, 'Bhutan', '+975', 1),
(29, 'Bolivia', '+591', 1),
(30, 'Bosnia & Herzegovina', '+387', 1),
(31, 'Botswana', '+267', 1),
(32, 'Brazil', '+55', 1),
(33, 'British Virgin Islands', '+1-284', 1),
(34, 'Brunei Darussalam', '+673', 1),
(35, 'Bulgaria', '+359', 1),
(36, 'Burkina Faso', '+226', 1),
(37, 'Burundi', '+257', 1),
(38, 'Cambodia', '+855', 1),
(39, 'Cameroon', '+237', 1),
(40, 'Canada', '+1', 1),
(41, 'Cape Verde Islands', '+238', 1),
(42, 'Cayman Islands', '+1-345', 1),
(43, 'Central African Republic', '+236', 1),
(44, 'Chad', '+235', 1),
(45, 'Chatham Island (New Zealand)', '+64', 1),
(46, 'Chile', '+56', 1),
(47, 'China (PRC)', '+86', 1),
(48, 'Christmas Island', '+61-8', 1),
(49, 'Cocos-Keeling Islands', '+61', 1),
(50, 'Colombia', '+57', 1),
(51, 'Comoros', '+269', 1),
(52, 'Congo', '+242', 1),
(53, 'Congo, Dem. Rep. of  (former Zaire)', '+243', 1),
(54, 'Cook Islands', '+682', 1),
(55, 'Costa Rica', '+506', 1),
(56, 'Croatia', '+385', 1),
(57, 'Cuba', '+53', 1),
(58, 'Cuba (Guantanamo Bay)', '+5399', 1),
(59, 'Curaçao', '+599', 1),
(60, 'Cyprus', '+357', 1),
(61, 'Czech Republic', '+420', 1),
(62, 'Denmark', '+45', 1),
(63, 'Diego Garcia', '+246', 1),
(64, 'Djibouti', '+253', 1),
(65, 'Dominica', '+1-767', 1),
(66, 'Dominican Republic', '+1-809 and +1-829', 1),
(67, 'East Timor', '+670', 1),
(68, 'Easter Island', '+56', 1),
(69, 'Ecuador', '+593', 1),
(70, 'Egypt', '+20', 1),
(71, 'El Salvador', '+503', 1),
(72, 'Ellipso (Mobile Satellite service)', '+8812, +8813', 1),
(73, 'EMSAT (Mobile Satellite service)', '+88213', 1),
(74, 'Equatorial Guinea', '+240', 1),
(75, 'Eritrea', '+291', 1),
(76, 'Estonia', '+372', 1),
(77, 'Ethiopia', '+251', 1),
(78, 'Falkland Islands (Malvinas)', '+500', 1),
(79, 'Faroe Islands', '+298', 1),
(80, 'Fiji Islands', '+679', 1),
(81, 'Finland', '+358', 1),
(82, 'France', '+33', 1),
(83, 'French Antilles', '+596', 1),
(84, 'French Guiana', '+594', 1),
(85, 'French Polynesia', '+689', 1),
(86, 'Gabonese Republic', '+241', 1),
(87, 'Gambia', '+220', 1),
(88, 'Georgia', '+995', 1),
(89, 'Germany', '+49', 1),
(90, 'Ghana', '+233', 1),
(91, 'Gibraltar', '+350', 1),
(92, 'Global Mobile Satellite System (GMSS)', '+881', 1),
(93, 'Globalstar (Mobile Satellite Service)', '+8818, +8819', 1),
(94, 'Greece', '+30', 1),
(95, 'Greenland', '+299', 1),
(96, 'Grenada', '+1-473', 1),
(97, 'Guadeloupe', '+590', 1),
(98, 'Guam', '+1-671', 1),
(99, 'Guantanamo Bay', '+5399', 1),
(100, 'Guatemala', '+502', 1),
(101, 'Guinea-Bissau', '+245', 1),
(102, 'Guinea', '+224', 1),
(103, 'Guyana', '+592', 1),
(104, 'Haiti', '+509', 1),
(105, 'Honduras', '+504', 1),
(106, 'Hong Kong', '+852', 1),
(107, 'Hungary', '+36', 1),
(108, 'ICO Global (Mobile Satellite Service)', '+8810, +8811', 1),
(109, 'Iceland', '+354', 1),
(110, 'India', '+91', 1),
(111, 'Indonesia', '+62', 1),
(112, 'Inmarsat (Atlantic Ocean - East)', '+871', 1),
(113, 'Inmarsat (Atlantic Ocean - West)', '+874', 1),
(114, 'Inmarsat (Indian Ocean)', '+873', 1),
(115, 'Inmarsat (Pacific Ocean)', '+872', 1),
(116, 'Inmarsat SNAC\nNote: Inmarsat plans to shift all other codes to this Single Network Access Code by 20', '+870', 1),
(117, 'International Freephone Service', '+800', 1),
(118, 'International Shared Cost Service (ISCS)', '+808', 1),
(119, 'Iran', '+98', 1),
(120, 'Iraq', '+964', 1),
(121, 'Ireland', '+353', 1),
(122, 'Iridium (Mobile Satellite service)', '+8816, +8817', 1),
(123, 'Israel', '+972', 1),
(124, 'Italy', '+39', 1),
(125, 'Jamaica', '+1-876', 1),
(126, 'Japan', '+81', 1),
(127, 'Jordan', '+962', 1),
(128, 'Kazakhstan', '+7', 1),
(129, 'Kenya', '+254', 1),
(130, 'Kiribati', '+686', 1),
(131, 'Korea (North)', '+850', 1),
(132, 'Korea (South)', '+82', 1),
(133, 'Kuwait', '+965', 1),
(134, 'Kyrgyz Republic', '+996', 1),
(135, 'Laos', '+856', 1),
(136, 'Latvia', '+371', 1),
(137, 'Lebanon', '+961', 1),
(138, 'Lesotho', '+266', 1),
(139, 'Liberia', '+231', 1),
(140, 'Libya', '+218', 1),
(141, 'Liechtenstein', '+423', 1),
(142, 'Lithuania', '+370', 1),
(143, 'Luxembourg', '+352', 1),
(144, 'Macao', '+853', 1),
(145, 'Macedonia (Former Yugoslav Rep of.)', '+389', 1),
(146, 'Madagascar', '+261', 1),
(147, 'Malawi', '+265', 1),
(148, 'Malaysia', '+60', 1),
(149, 'Maldives', '+960', 1),
(150, 'Mali Republic', '+223', 1),
(151, 'Malta', '+356', 1),
(152, 'Marshall Islands', '+692', 1),
(153, 'Martinique', '+596', 1),
(154, 'Mauritania', '+222', 1),
(155, 'Mauritius', '+230', 1),
(156, 'Mayotte Island', '+269', 1),
(157, 'Mexico', '+52', 1),
(158, 'Micronesia, (Federal States of)', '+691', 1),
(159, 'Midway Island', '+1-808', 1),
(160, 'Moldova', '+373', 1),
(161, 'Monaco', '+377', 1),
(162, 'Mongolia', '+976', 1),
(163, 'Montenegro', '+382', 1),
(164, 'Montserrat', '+1-664', 1),
(165, 'Morocco', '+212', 1),
(166, 'Mozambique', '+258', 1),
(167, 'Myanmar', '+95', 1),
(168, 'Namibia', '+264', 1),
(169, 'Nauru', '+674', 1),
(170, 'Nepal', '+977', 1),
(171, 'Netherlands', '+31', 1),
(172, 'Netherlands Antilles', '+599', 1),
(173, 'Nevis', '+1-869', 1),
(174, 'New Caledonia', '+687', 1),
(175, 'New Zealand', '+64', 1),
(176, 'Nicaragua', '+505', 1),
(177, 'Niger', '+227', 1),
(178, 'Nigeria', '+234', 1),
(179, 'Niue', '+683', 1),
(180, 'Norfolk Island', '+672', 1),
(181, 'Northern Marianas Islands \n(Saipan, Rota, & Tinian)', '+1-670', 1),
(182, 'Norway', '+47', 1),
(183, 'Oman', '+968', 1),
(184, 'Pakistan', '+92', 1),
(185, 'Palau', '+680', 1),
(186, 'Palestinian Settlements', '+970', 1),
(187, 'Panama', '+507', 1),
(188, 'Papua New Guinea', '+675', 1),
(189, 'Paraguay', '+595', 1),
(190, 'Peru', '+51', 1),
(191, 'Philippines', '+63', 1),
(192, 'Poland', '+48', 1),
(193, 'Portugal', '+351', 1),
(194, 'Puerto Rico', '+1-787 or +1-939', 1),
(195, 'Qatar', '+974', 1),
(196, 'Réunion Island', '+262', 1),
(197, 'Romania', '+40', 1),
(198, 'Russia', '+7', 1),
(199, 'Rwandese Republic', '+250', 1),
(200, 'St. Helena', '+290', 1),
(201, 'St. Kitts/Nevis', '+1-869', 1),
(202, 'St. Lucia', '+1-758', 1),
(203, 'St. Pierre & Miquelon', '+508', 1),
(204, 'St. Vincent & Grenadines', '+1-784', 1),
(205, 'Samoa', '+685', 1),
(206, 'San Marino', '+378', 1),
(207, 'São Tomé and Principe', '+239', 1),
(208, 'Saudi Arabia', '+966', 1),
(209, 'Senegal', '+221', 1),
(210, 'Serbia', '+381', 1),
(211, 'Seychelles Republic', '+248', 1),
(212, 'Sierra Leone', '+232', 1),
(213, 'Singapore', '+65', 1),
(214, 'Slovak Republic', '+421', 1),
(215, 'Slovenia', '+386', 1),
(216, 'Solomon Islands', '+677', 1),
(217, 'Somali Democratic Republic', '+252', 1),
(218, 'South Africa', '+27', 1),
(219, 'Spain', '+34', 1),
(220, 'Sri Lanka', '+94', 1),
(221, 'Sudan', '+249', 1),
(222, 'Suriname', '+597', 1),
(223, 'Swaziland', '+268', 1),
(224, 'Sweden', '+46', 1),
(225, 'Switzerland', '+41', 1),
(226, 'Syria', '+963', 1),
(227, 'Taiwan', '+886', 1),
(228, 'Tajikistan', '+992', 1),
(229, 'Tanzania', '+255', 1),
(230, 'Thailand', '+66', 1),
(231, 'Thuraya (Mobile Satellite service)', '+88216', 1),
(232, 'Timor Leste', '+670', 1),
(233, 'Togolese Republic', '+228', 1),
(234, 'Tokelau', '+690', 1),
(235, 'Tonga Islands', '+676', 1),
(236, 'Trinidad & Tobago', '+1-868', 1),
(237, 'Tunisia', '+216', 1),
(238, 'Turkey', '+90', 1),
(239, 'Turkmenistan', '+993', 1),
(240, 'Turks and Caicos Islands', '+1-649', 1),
(241, 'Tuvalu', '+688', 1),
(242, 'Uganda', '+256', 1),
(243, 'Ukraine', '+380', 1),
(244, 'United Arab Emirates', '+971', 1),
(245, 'United Kingdom', '+44', 1),
(246, 'United States of America', '+1', 1),
(247, 'US Virgin Islands', '+1-340', 1),
(248, 'Universal Personal Telecommunications (UPT)', '+878', 1),
(249, 'Uruguay', '+598', 1),
(250, 'Uzbekistan', '+998', 1),
(251, 'Vanuatu', '+678', 1),
(252, 'Vatican City', '+39, +379', 1),
(253, 'Venezuela', '+58', 1),
(254, 'Vietnam', '+84', 1),
(255, 'Wake Island', '+808', 1),
(256, 'Wallis and Futuna Islands', '+681', 1),
(257, 'Yemen', '+967', 1),
(258, 'Zambia', '+260', 1),
(259, 'Zanzibar', '+255', 1),
(260, 'Zimbabwe', '+263', 1);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_name` varchar(80) NOT NULL,
  `status_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `country_id`, `state_id`, `district_name`, `status_id`) VALUES
(1, 110, 32, 'North and Middle Andaman', 1),
(2, 110, 32, 'South Andaman', 1),
(3, 110, 32, 'Nicobar', 1),
(4, 110, 1, 'Adilabad', 1),
(5, 110, 1, 'Anantapur', 1),
(6, 110, 1, 'Chittoor', 1),
(7, 110, 1, 'East Godavari', 1),
(8, 110, 1, 'Guntur', 1),
(9, 110, 1, 'Hyderabad', 1),
(10, 110, 1, 'Kadapa', 1),
(11, 110, 1, 'Karimnagar', 1),
(12, 110, 1, 'Khammam', 1),
(13, 110, 1, 'Krishna', 1),
(14, 110, 1, 'Kurnool', 1),
(15, 110, 1, 'Mahbubnagar', 1),
(16, 110, 1, 'Medak', 1),
(17, 110, 1, 'Nalgonda', 1),
(18, 110, 1, 'Nellore', 1),
(19, 110, 1, 'Nizamabad', 1),
(20, 110, 1, 'Prakasam', 1),
(21, 110, 1, 'Rangareddi', 1),
(22, 110, 1, 'Srikakulam', 1),
(23, 110, 1, 'Vishakhapatnam', 1),
(24, 110, 1, 'Vizianagaram', 1),
(25, 110, 1, 'Warangal', 1),
(26, 110, 1, 'West Godavari', 1),
(27, 110, 3, 'Anjaw', 1),
(28, 110, 3, 'Changlang', 1),
(29, 110, 3, 'East Kameng', 1),
(30, 110, 3, 'Lohit', 1),
(31, 110, 3, 'Lower Subansiri', 1),
(32, 110, 3, 'Papum Pare', 1),
(33, 110, 3, 'Tirap', 1),
(34, 110, 3, 'Dibang Valley', 1),
(35, 110, 3, 'Upper Subansiri', 1),
(36, 110, 3, 'West Kameng', 1),
(37, 110, 2, 'Barpeta', 1),
(38, 110, 2, 'Bongaigaon', 1),
(39, 110, 2, 'Cachar', 1),
(40, 110, 2, 'Darrang', 1),
(41, 110, 2, 'Dhemaji', 1),
(42, 110, 2, 'Dhubri', 1),
(43, 110, 2, 'Dibrugarh', 1),
(44, 110, 2, 'Goalpara', 1),
(45, 110, 2, 'Golaghat', 1),
(46, 110, 2, 'Hailakandi', 1),
(47, 110, 2, 'Jorhat', 1),
(48, 110, 2, 'Karbi Anglong', 1),
(49, 110, 2, 'Karimganj', 1),
(50, 110, 2, 'Kokrajhar', 1),
(51, 110, 2, 'Lakhimpur', 1),
(52, 110, 2, 'Marigaon', 1),
(53, 110, 2, 'Nagaon', 1),
(54, 110, 2, 'Nalbari', 1),
(55, 110, 2, 'North Cachar Hills', 1),
(56, 110, 2, 'Sibsagar', 1),
(57, 110, 2, 'Sonitpur', 1),
(58, 110, 2, 'Tinsukia', 1),
(59, 110, 4, 'Araria', 1),
(60, 110, 4, 'Aurangabad', 1),
(61, 110, 4, 'Banka', 1),
(62, 110, 4, 'Begusarai', 1),
(63, 110, 4, 'Bhagalpur', 1),
(64, 110, 4, 'Bhojpur', 1),
(65, 110, 4, 'Buxar', 1),
(66, 110, 4, 'Darbhanga', 1),
(67, 110, 4, 'Purba Champaran', 1),
(68, 110, 4, 'Gaya', 1),
(69, 110, 4, 'Gopalganj', 1),
(70, 110, 4, 'Jamui', 1),
(71, 110, 4, 'Jehanabad', 1),
(72, 110, 4, 'Khagaria', 1),
(73, 110, 4, 'Kishanganj', 1),
(74, 110, 4, 'Kaimur', 1),
(75, 110, 4, 'Katihar', 1),
(76, 110, 4, 'Lakhisarai', 1),
(77, 110, 4, 'Madhubani', 1),
(78, 110, 4, 'Munger', 1),
(79, 110, 4, 'Madhepura', 1),
(80, 110, 4, 'Muzaffarpur', 1),
(81, 110, 4, 'Nalanda', 1),
(82, 110, 4, 'Nawada', 1),
(83, 110, 4, 'Patna', 1),
(84, 110, 4, 'Purnia', 1),
(85, 110, 4, 'Rohtas', 1),
(86, 110, 4, 'Saharsa', 1),
(87, 110, 4, 'Samastipur', 1),
(88, 110, 4, 'Sheohar', 1),
(89, 110, 4, 'Sheikhpura', 1),
(90, 110, 4, 'Saran', 1),
(91, 110, 4, 'Sitamarhi', 1),
(92, 110, 4, 'Supaul', 1),
(93, 110, 4, 'Siwan', 1),
(94, 110, 4, 'Vaishali', 1),
(95, 110, 4, 'Pashchim Champaran', 1),
(96, 110, 36, 'Bastar', 1),
(97, 110, 36, 'Bilaspur', 1),
(98, 110, 36, 'Dantewada', 1),
(99, 110, 36, 'Dhamtari', 1),
(100, 110, 36, 'Durg', 1),
(101, 110, 36, 'Jashpur', 1),
(102, 110, 36, 'Janjgir-Champa', 1),
(103, 110, 36, 'Korba', 1),
(104, 110, 36, 'Koriya', 1),
(105, 110, 36, 'Kanker', 1),
(106, 110, 36, 'Kawardha', 1),
(107, 110, 36, 'Mahasamund', 1),
(108, 110, 36, 'Raigarh', 1),
(109, 110, 36, 'Rajnandgaon', 1),
(110, 110, 36, 'Raipur', 1),
(111, 110, 36, 'Surguja', 1),
(112, 110, 29, 'Diu', 1),
(113, 110, 29, 'Daman', 1),
(114, 110, 25, 'Central Delhi', 1),
(115, 110, 25, 'East Delhi', 1),
(116, 110, 25, 'New Delhi', 1),
(117, 110, 25, 'North Delhi', 1),
(118, 110, 25, 'North East Delhi', 1),
(119, 110, 25, 'North West Delhi', 1),
(120, 110, 25, 'South Delhi', 1),
(121, 110, 25, 'South West Delhi', 1),
(122, 110, 25, 'West Delhi', 1),
(123, 110, 26, 'North Goa', 1),
(124, 110, 26, 'South Goa', 1),
(125, 110, 5, 'Ahmedabad', 1),
(126, 110, 5, 'Amreli District', 1),
(127, 110, 5, 'Anand', 1),
(128, 110, 5, 'Banaskantha', 1),
(129, 110, 5, 'Bharuch', 1),
(130, 110, 5, 'Bhavnagar', 1),
(131, 110, 5, 'Dahod', 1),
(132, 110, 5, 'The Dangs', 1),
(133, 110, 5, 'Gandhinagar', 1),
(134, 110, 5, 'Jamnagar', 1),
(135, 110, 5, 'Junagadh', 1),
(136, 110, 5, 'Kutch', 1),
(137, 110, 5, 'Kheda', 1),
(138, 110, 5, 'Mehsana', 1),
(139, 110, 5, 'Narmada', 1),
(140, 110, 5, 'Navsari', 1),
(141, 110, 5, 'Patan', 1),
(142, 110, 5, 'Panchmahal', 1),
(143, 110, 5, 'Porbandar', 1),
(144, 110, 5, 'Rajkot', 1),
(145, 110, 5, 'Sabarkantha', 1),
(146, 110, 5, 'Surendranagar', 1),
(147, 110, 5, 'Surat', 1),
(148, 110, 5, 'Vadodara', 1),
(149, 110, 5, 'Valsad', 1),
(150, 110, 6, 'Ambala', 1),
(151, 110, 6, 'Bhiwani', 1),
(152, 110, 6, 'Faridabad', 1),
(153, 110, 6, 'Fatehabad', 1),
(154, 110, 6, 'Gurgaon', 1),
(155, 110, 6, 'Hissar', 1),
(156, 110, 6, 'Jhajjar', 1),
(157, 110, 6, 'Jind', 1),
(158, 110, 6, 'Karnal', 1),
(159, 110, 6, 'Kaithal', 1),
(160, 110, 6, 'Kurukshetra', 1),
(161, 110, 6, 'Mahendragarh', 1),
(162, 110, 6, 'Mewat', 1),
(163, 110, 6, 'Panchkula', 1),
(164, 110, 6, 'Panipat', 1),
(165, 110, 6, 'Rewari', 1),
(166, 110, 6, 'Rohtak', 1),
(167, 110, 6, 'Sirsa', 1),
(168, 110, 6, 'Sonepat', 1),
(169, 110, 6, 'Yamuna Nagar', 1),
(170, 110, 6, 'Palwal', 1),
(171, 110, 7, 'Bilaspur', 1),
(172, 110, 7, 'Chamba', 1),
(173, 110, 7, 'Hamirpur', 1),
(174, 110, 7, 'Kangra', 1),
(175, 110, 7, 'Kinnaur', 1),
(176, 110, 7, 'Kulu', 1),
(177, 110, 7, 'Lahaul and Spiti', 1),
(178, 110, 7, 'Mandi', 1),
(179, 110, 7, 'Shimla', 1),
(180, 110, 7, 'Sirmaur', 1),
(181, 110, 7, 'Solan', 1),
(182, 110, 7, 'Una', 1),
(183, 110, 8, 'Anantnag', 1),
(184, 110, 8, 'Badgam', 1),
(185, 110, 8, 'Bandipore', 1),
(186, 110, 8, 'Baramula', 1),
(187, 110, 8, 'Doda', 1),
(188, 110, 8, 'Jammu', 1),
(189, 110, 8, 'Kargil', 1),
(190, 110, 8, 'Kathua', 1),
(191, 110, 8, 'Kupwara', 1),
(192, 110, 8, 'Leh', 1),
(193, 110, 8, 'Poonch', 1),
(194, 110, 8, 'Pulwama', 1),
(195, 110, 8, 'Rajauri', 1),
(196, 110, 8, 'Srinagar', 1),
(197, 110, 8, 'Samba', 1),
(198, 110, 8, 'Udhampur', 1),
(199, 110, 34, 'Bokaro', 1),
(200, 110, 34, 'Chatra', 1),
(201, 110, 34, 'Deoghar', 1),
(202, 110, 34, 'Dhanbad', 1),
(203, 110, 34, 'Dumka', 1),
(204, 110, 34, 'Purba Singhbhum', 1),
(205, 110, 34, 'Garhwa', 1),
(206, 110, 34, 'Giridih', 1),
(207, 110, 34, 'Godda', 1),
(208, 110, 34, 'Gumla', 1),
(209, 110, 34, 'Hazaribagh', 1),
(210, 110, 34, 'Koderma', 1),
(211, 110, 34, 'Lohardaga', 1),
(212, 110, 34, 'Pakur', 1),
(213, 110, 34, 'Palamu', 1),
(214, 110, 34, 'Ranchi', 1),
(215, 110, 34, 'Sahibganj', 1),
(216, 110, 34, 'Seraikela and Kharsawan', 1),
(217, 110, 34, 'Pashchim Singhbhum', 1),
(218, 110, 34, 'Ramgarh', 1),
(219, 110, 9, 'Bidar', 1),
(220, 110, 9, 'Belgaum', 1),
(221, 110, 9, 'Bijapur', 1),
(222, 110, 9, 'Bagalkot', 1),
(223, 110, 9, 'Bellary', 1),
(224, 110, 9, 'Bangalore Rural District', 1),
(225, 110, 9, 'Bangalore Urban District', 1),
(226, 110, 9, 'Chamarajnagar', 1),
(227, 110, 9, 'Chikmagalur', 1),
(228, 110, 9, 'Chitradurga', 1),
(229, 110, 9, 'Davanagere', 1),
(230, 110, 9, 'Dharwad', 1),
(231, 110, 9, 'Dakshina Kannada', 1),
(232, 110, 9, 'Gadag', 1),
(233, 110, 9, 'Gulbarga', 1),
(234, 110, 9, 'Hassan', 1),
(235, 110, 9, 'Haveri District', 1),
(236, 110, 9, 'Kodagu', 1),
(237, 110, 9, 'Kolar', 1),
(238, 110, 9, 'Koppal', 1),
(239, 110, 9, 'Mandya', 1),
(240, 110, 9, 'Mysore', 1),
(241, 110, 9, 'Raichur', 1),
(242, 110, 9, 'Shimoga', 1),
(243, 110, 9, 'Tumkur', 1),
(244, 110, 9, 'Udupi', 1),
(245, 110, 9, 'Uttara Kannada', 1),
(246, 110, 9, 'Ramanagara', 1),
(247, 110, 9, 'Chikballapur', 1),
(248, 110, 9, 'Yadagiri', 1),
(249, 110, 10, 'Alappuzha', 1),
(250, 110, 10, 'Ernakulam', 1),
(251, 110, 10, 'Idukki', 1),
(252, 110, 10, 'Kollam', 1),
(253, 110, 10, 'Kannur', 1),
(254, 110, 10, 'Kasaragod', 1),
(255, 110, 10, 'Kottayam', 1),
(256, 110, 10, 'Kozhikode', 1),
(257, 110, 10, 'Malappuram', 1),
(258, 110, 10, 'Palakkad', 1),
(259, 110, 10, 'Pathanamthitta', 1),
(260, 110, 10, 'Thrissur', 1),
(261, 110, 10, 'Thiruvananthapuram', 1),
(262, 110, 10, 'Wayanad', 1),
(263, 110, 11, 'Alirajpur', 1),
(264, 110, 11, 'Anuppur', 1),
(265, 110, 11, 'Ashok Nagar', 1),
(266, 110, 11, 'Balaghat', 1),
(267, 110, 11, 'Barwani', 1),
(268, 110, 11, 'Betul', 1),
(269, 110, 11, 'Bhind', 1),
(270, 110, 11, 'Bhopal', 1),
(271, 110, 11, 'Burhanpur', 1),
(272, 110, 11, 'Chhatarpur', 1),
(273, 110, 11, 'Chhindwara', 1),
(274, 110, 11, 'Damoh', 1),
(275, 110, 11, 'Datia', 1),
(276, 110, 11, 'Dewas', 1),
(277, 110, 11, 'Dhar', 1),
(278, 110, 11, 'Dindori', 1),
(279, 110, 11, 'Guna', 1),
(280, 110, 11, 'Gwalior', 1),
(281, 110, 11, 'Harda', 1),
(282, 110, 11, 'Hoshangabad', 1),
(283, 110, 11, 'Indore', 1),
(284, 110, 11, 'Jabalpur', 1),
(285, 110, 11, 'Jhabua', 1),
(286, 110, 11, 'Katni', 1),
(287, 110, 11, 'Khandwa', 1),
(288, 110, 11, 'Khargone', 1),
(289, 110, 11, 'Mandla', 1),
(290, 110, 11, 'Mandsaur', 1),
(291, 110, 11, 'Morena', 1),
(292, 110, 11, 'Narsinghpur', 1),
(293, 110, 11, 'Neemuch', 1),
(294, 110, 11, 'Panna', 1),
(295, 110, 11, 'Rewa', 1),
(296, 110, 11, 'Rajgarh', 1),
(297, 110, 11, 'Ratlam', 1),
(298, 110, 11, 'Raisen', 1),
(299, 110, 11, 'Sagar', 1),
(300, 110, 11, 'Satna', 1),
(301, 110, 11, 'Sehore', 1),
(302, 110, 11, 'Seoni', 1),
(303, 110, 11, 'Shahdol', 1),
(304, 110, 11, 'Shajapur', 1),
(305, 110, 11, 'Sheopur', 1),
(306, 110, 11, 'Shivpuri', 1),
(307, 110, 11, 'Sidhi', 1),
(308, 110, 11, 'Singrauli', 1),
(309, 110, 11, 'Tikamgarh', 1),
(310, 110, 11, 'Ujjain', 1),
(311, 110, 11, 'Umaria', 1),
(312, 110, 11, 'Vidisha', 1),
(313, 110, 12, 'Ahmednagar', 1),
(314, 110, 12, 'Akola', 1),
(315, 110, 12, 'Amravati', 1),
(316, 110, 12, 'Aurangabad', 1),
(317, 110, 12, 'Bhandara', 1),
(318, 110, 12, 'Beed', 1),
(319, 110, 12, 'Buldhana', 1),
(320, 110, 12, 'Chandrapur', 1),
(321, 110, 12, 'Dhule', 1),
(322, 110, 12, 'Gadchiroli', 1),
(323, 110, 12, 'Gondiya', 1),
(324, 110, 12, 'Hingoli', 1),
(325, 110, 12, 'Jalgaon', 1),
(326, 110, 12, 'Jalna', 1),
(327, 110, 12, 'Kolhapur', 1),
(328, 110, 12, 'Latur', 1),
(329, 110, 12, 'Mumbai City', 1),
(330, 110, 12, 'Mumbai suburban', 1),
(331, 110, 12, 'Nandurbar', 1),
(332, 110, 12, 'Nanded', 1),
(333, 110, 12, 'Nagpur', 1),
(334, 110, 12, 'Nashik', 1),
(335, 110, 12, 'Osmanabad', 1),
(336, 110, 12, 'Parbhani', 1),
(337, 110, 12, 'Pune', 1),
(338, 110, 12, 'Raigad', 1),
(339, 110, 12, 'Ratnagiri', 1),
(340, 110, 12, 'Sindhudurg', 1),
(341, 110, 12, 'Sangli', 1),
(342, 110, 12, 'Solapur', 1),
(343, 110, 12, 'Satara', 1),
(344, 110, 12, 'Thane', 1),
(345, 110, 12, 'Wardha', 1),
(346, 110, 12, 'Washim', 1),
(347, 110, 12, 'Yavatmal', 1),
(348, 110, 13, 'Bishnupur', 1),
(349, 110, 13, 'Churachandpur', 1),
(350, 110, 13, 'Chandel', 1),
(351, 110, 13, 'Imphal East', 1),
(352, 110, 13, 'Senapati', 1),
(353, 110, 13, 'Tamenglong', 1),
(354, 110, 13, 'Thoubal', 1),
(355, 110, 13, 'Ukhrul', 1),
(356, 110, 13, 'Imphal West', 1),
(357, 110, 14, 'East Garo Hills', 1),
(358, 110, 14, 'East Khasi Hills', 1),
(359, 110, 14, 'Jaintia Hills', 1),
(360, 110, 14, 'Ri-Bhoi', 1),
(361, 110, 14, 'South Garo Hills', 1),
(362, 110, 14, 'West Garo Hills', 1),
(363, 110, 14, 'West Khasi Hills', 1),
(364, 110, 15, 'Aizawl', 1),
(365, 110, 15, 'Champhai', 1),
(366, 110, 15, 'Kolasib', 1),
(367, 110, 15, 'Lawngtlai', 1),
(368, 110, 15, 'Lunglei', 1),
(369, 110, 15, 'Mamit', 1),
(370, 110, 15, 'Saiha', 1),
(371, 110, 15, 'Serchhip', 1),
(372, 110, 16, 'Dimapur', 1),
(373, 110, 16, 'Kohima', 1),
(374, 110, 16, 'Mokokchung', 1),
(375, 110, 16, 'Mon', 1),
(376, 110, 16, 'Phek', 1),
(377, 110, 16, 'Tuensang', 1),
(378, 110, 16, 'Wokha', 1),
(379, 110, 16, 'Zunheboto', 1),
(380, 110, 17, 'Angul', 1),
(381, 110, 17, 'Boudh', 1),
(382, 110, 17, 'Bhadrak', 1),
(383, 110, 17, 'Bolangir', 1),
(384, 110, 17, 'Bargarh', 1),
(385, 110, 17, 'Baleswar', 1),
(386, 110, 17, 'Cuttack', 1),
(387, 110, 17, 'Debagarh', 1),
(388, 110, 17, 'Dhenkanal', 1),
(389, 110, 17, 'Ganjam', 1),
(390, 110, 17, 'Gajapati', 1),
(391, 110, 17, 'Jharsuguda', 1),
(392, 110, 17, 'Jajapur', 1),
(393, 110, 17, 'Jagatsinghpur', 1),
(394, 110, 17, 'Khordha', 1),
(395, 110, 17, 'Kendujhar', 1),
(396, 110, 17, 'Kalahandi', 1),
(397, 110, 17, 'Kandhamal', 1),
(398, 110, 17, 'Koraput', 1),
(399, 110, 17, 'Kendrapara', 1),
(400, 110, 17, 'Malkangiri', 1),
(401, 110, 17, 'Mayurbhanj', 1),
(402, 110, 17, 'Nabarangpur', 1),
(403, 110, 17, 'Nuapada', 1),
(404, 110, 17, 'Nayagarh', 1),
(405, 110, 17, 'Puri', 1),
(406, 110, 17, 'Rayagada', 1),
(407, 110, 17, 'Sambalpur', 1),
(408, 110, 17, 'Subarnapur', 1),
(409, 110, 17, 'Sundargarh', 1),
(410, 110, 27, 'Karaikal', 1),
(411, 110, 27, 'Mahe', 1),
(412, 110, 27, 'Puducherry', 1),
(413, 110, 27, 'Yanam', 1),
(414, 110, 18, 'Amritsar', 1),
(415, 110, 18, 'Bathinda', 1),
(416, 110, 18, 'Firozpur', 1),
(417, 110, 18, 'Faridkot', 1),
(418, 110, 18, 'Fatehgarh Sahib', 1),
(419, 110, 18, 'Gurdaspur', 1),
(420, 110, 18, 'Hoshiarpur', 1),
(421, 110, 18, 'Jalandhar', 1),
(422, 110, 18, 'Kapurthala', 1),
(423, 110, 18, 'Ludhiana', 1),
(424, 110, 18, 'Mansa', 1),
(425, 110, 18, 'Moga', 1),
(426, 110, 18, 'Mukatsar', 1),
(427, 110, 18, 'Nawan Shehar', 1),
(428, 110, 18, 'Patiala', 1),
(429, 110, 18, 'Rupnagar', 1),
(430, 110, 18, 'Sangrur', 1),
(431, 110, 19, 'Ajmer', 1),
(432, 110, 19, 'Alwar', 1),
(433, 110, 19, 'Bikaner', 1),
(434, 110, 19, 'Barmer', 1),
(435, 110, 19, 'Banswara', 1),
(436, 110, 19, 'Bharatpur', 1),
(437, 110, 19, 'Baran', 1),
(438, 110, 19, 'Bundi', 1),
(439, 110, 19, 'Bhilwara', 1),
(440, 110, 19, 'Churu', 1),
(441, 110, 19, 'Chittorgarh', 1),
(442, 110, 19, 'Dausa', 1),
(443, 110, 19, 'Dholpur', 1),
(444, 110, 19, 'Dungapur', 1),
(445, 110, 19, 'Ganganagar', 1),
(446, 110, 19, 'Hanumangarh', 1),
(447, 110, 19, 'Juhnjhunun', 1),
(448, 110, 19, 'Jalore', 1),
(449, 110, 19, 'Jodhpur', 1),
(450, 110, 19, 'Jaipur', 1),
(451, 110, 19, 'Jaisalmer', 1),
(452, 110, 19, 'Jhalawar', 1),
(453, 110, 19, 'Karauli', 1),
(454, 110, 19, 'Kota', 1),
(455, 110, 19, 'Nagaur', 1),
(456, 110, 19, 'Pali', 1),
(457, 110, 19, 'Pratapgarh', 1),
(458, 110, 19, 'Rajsamand', 1),
(459, 110, 19, 'Sikar', 1),
(460, 110, 19, 'Sawai Madhopur', 1),
(461, 110, 19, 'Sirohi', 1),
(462, 110, 19, 'Tonk', 1),
(463, 110, 19, 'Udaipur', 1),
(464, 110, 20, 'East Sikkim', 1),
(465, 110, 20, 'North Sikkim', 1),
(466, 110, 20, 'South Sikkim', 1),
(467, 110, 20, 'West Sikkim', 1),
(468, 110, 21, 'Ariyalur', 1),
(469, 110, 21, 'Chennai', 1),
(470, 110, 21, 'Coimbatore', 1),
(471, 110, 21, 'Cuddalore', 1),
(472, 110, 21, 'Dharmapuri', 1),
(473, 110, 21, 'Dindigul', 1),
(474, 110, 21, 'Erode', 1),
(475, 110, 21, 'Kanchipuram', 1),
(476, 110, 21, 'Kanyakumari', 1),
(477, 110, 21, 'Karur', 1),
(478, 110, 21, 'Madurai', 1),
(479, 110, 21, 'Nagapattinam', 1),
(480, 110, 21, 'The Nilgiris', 1),
(481, 110, 21, 'Namakkal', 1),
(482, 110, 21, 'Perambalur', 1),
(483, 110, 21, 'Pudukkottai', 1),
(484, 110, 21, 'Ramanathapuram', 1),
(485, 110, 21, 'Salem', 1),
(486, 110, 21, 'Sivagangai', 1),
(487, 110, 21, 'Tiruppur', 1),
(488, 110, 21, 'Tiruchirappalli', 1),
(489, 110, 21, 'Theni', 1),
(490, 110, 21, 'Tirunelveli', 1),
(491, 110, 21, 'Thanjavur', 1),
(492, 110, 21, 'Thoothukudi', 1),
(493, 110, 21, 'Thiruvallur', 1),
(494, 110, 21, 'Thiruvarur', 1),
(495, 110, 21, 'Tiruvannamalai', 1),
(496, 110, 21, 'Vellore', 1),
(497, 110, 21, 'Villupuram', 1),
(498, 110, 22, 'Dhalai', 1),
(499, 110, 22, 'North Tripura', 1),
(500, 110, 22, 'South Tripura', 1),
(501, 110, 22, 'West Tripura', 1),
(502, 110, 33, 'Almora', 1),
(503, 110, 33, 'Bageshwar', 1),
(504, 110, 33, 'Chamoli', 1),
(505, 110, 33, 'Champawat', 1),
(506, 110, 33, 'Dehradun', 1),
(507, 110, 33, 'Haridwar', 1),
(508, 110, 33, 'Nainital', 1),
(509, 110, 33, 'Pauri Garhwal', 1),
(510, 110, 33, 'Pithoragharh', 1),
(511, 110, 33, 'Rudraprayag', 1),
(512, 110, 33, 'Tehri Garhwal', 1),
(513, 110, 33, 'Udham Singh Nagar', 1),
(514, 110, 33, 'Uttarkashi', 1),
(515, 110, 23, 'Agra', 1),
(516, 110, 23, 'Allahabad', 1),
(517, 110, 23, 'Aligarh', 1),
(518, 110, 23, 'Ambedkar Nagar', 1),
(519, 110, 23, 'Auraiya', 1),
(520, 110, 23, 'Azamgarh', 1),
(521, 110, 23, 'Barabanki', 1),
(522, 110, 23, 'Badaun', 1),
(523, 110, 23, 'Bagpat', 1),
(524, 110, 23, 'Bahraich', 1),
(525, 110, 23, 'Bijnor', 1),
(526, 110, 23, 'Ballia', 1),
(527, 110, 23, 'Banda', 1),
(528, 110, 23, 'Balrampur', 1),
(529, 110, 23, 'Bareilly', 1),
(530, 110, 23, 'Basti', 1),
(531, 110, 23, 'Bulandshahr', 1),
(532, 110, 23, 'Chandauli', 1),
(533, 110, 23, 'Chitrakoot', 1),
(534, 110, 23, 'Deoria', 1),
(535, 110, 23, 'Etah', 1),
(536, 110, 23, 'Kanshiram Nagar', 1),
(537, 110, 23, 'Etawah', 1),
(538, 110, 23, 'Firozabad', 1),
(539, 110, 23, 'Farrukhabad', 1),
(540, 110, 23, 'Fatehpur', 1),
(541, 110, 23, 'Faizabad', 1),
(542, 110, 23, 'Gautam Buddha Nagar', 1),
(543, 110, 23, 'Gonda', 1),
(544, 110, 23, 'Ghazipur', 1),
(545, 110, 23, 'Gorkakhpur', 1),
(546, 110, 23, 'Ghaziabad', 1),
(547, 110, 23, 'Hamirpur', 1),
(548, 110, 23, 'Hardoi', 1),
(549, 110, 23, 'Mahamaya Nagar', 1),
(550, 110, 23, 'Jhansi', 1),
(551, 110, 23, 'Jalaun', 1),
(552, 110, 23, 'Jyotiba Phule Nagar', 1),
(553, 110, 23, 'Jaunpur District', 1),
(554, 110, 23, 'Kanpur Dehat', 1),
(555, 110, 23, 'Kannauj', 1),
(556, 110, 23, 'Kanpur Nagar', 1),
(557, 110, 23, 'Kaushambi', 1),
(558, 110, 23, 'Kushinagar', 1),
(559, 110, 23, 'Lalitpur', 1),
(560, 110, 23, 'Lakhimpur Kheri', 1),
(561, 110, 23, 'Lucknow', 1),
(562, 110, 23, 'Mau', 1),
(563, 110, 23, 'Meerut', 1),
(564, 110, 23, 'Maharajganj', 1),
(565, 110, 23, 'Mahoba', 1),
(566, 110, 23, 'Mirzapur', 1),
(567, 110, 23, 'Moradabad', 1),
(568, 110, 23, 'Mainpuri', 1),
(569, 110, 23, 'Mathura', 1),
(570, 110, 23, 'Muzaffarnagar', 1),
(571, 110, 23, 'Pilibhit', 1),
(572, 110, 23, 'Pratapgarh', 1),
(573, 110, 23, 'Rampur', 1),
(574, 110, 23, 'Rae Bareli', 1),
(575, 110, 23, 'Saharanpur', 1),
(576, 110, 23, 'Sitapur', 1),
(577, 110, 23, 'Shahjahanpur', 1),
(578, 110, 23, 'Sant Kabir Nagar', 1),
(579, 110, 23, 'Siddharthnagar', 1),
(580, 110, 23, 'Sonbhadra', 1),
(581, 110, 23, 'Sant Ravidas Nagar', 1),
(582, 110, 23, 'Sultanpur', 1),
(583, 110, 23, 'Shravasti', 1),
(584, 110, 23, 'Unnao', 1),
(585, 110, 23, 'Varanasi', 1),
(586, 110, 24, 'Birbhum', 1),
(587, 110, 24, 'Bankura', 1),
(588, 110, 24, 'Bardhaman', 1),
(589, 110, 24, 'Darjeeling', 1),
(590, 110, 24, 'Dakshin Dinajpur', 1),
(591, 110, 24, 'Hooghly', 1),
(592, 110, 24, 'Howrah', 1),
(593, 110, 24, 'Jalpaiguri', 1),
(594, 110, 24, 'Cooch Behar', 1),
(595, 110, 24, 'Kolkata', 1),
(596, 110, 24, 'Malda', 1),
(597, 110, 24, 'Midnapore', 1),
(598, 110, 24, 'Murshidabad', 1),
(599, 110, 24, 'Nadia', 1),
(600, 110, 24, 'North 24 Parganas', 1),
(601, 110, 24, 'South 24 Parganas', 1),
(602, 110, 24, 'Purulia', 1),
(603, 110, 24, 'Uttar Dinajpur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `family_relation`
--

CREATE TABLE `family_relation` (
  `id` int(11) NOT NULL,
  `family_relation_name` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family_relation`
--

INSERT INTO `family_relation` (`id`, `family_relation_name`, `status`, `added_by`, `added_date`, `updated_by`, `updated_date`) VALUES
(1, 'Father', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Mother', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Son', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Daughter', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Husband', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Wife', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Brother', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'Sister', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Grandfather', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Grandmother', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'grandson', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'granddaughter', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `foundation`
--

CREATE TABLE `foundation` (
  `id` int(11) NOT NULL,
  `foundation_name` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foundation`
--

INSERT INTO `foundation` (`id`, `foundation_name`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Sri Shani-Shaneswar Foundation ', 1, 0, '2022-02-07 16:12:24', NULL, '2022-02-07 16:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `mail_sms` tinyint(4) NOT NULL COMMENT '1- Mail / 2- SMS',
  `total_users` int(20) NOT NULL,
  `message` text NOT NULL,
  `status_id` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Send/ 2- Failed',
  `job_id` varchar(20) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `language_name` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language_name`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'English', 1, 0, '2022-02-07 14:58:58', NULL, NULL),
(2, 'Hindi', 1, 0, '2022-02-07 14:59:06', NULL, NULL),
(3, 'Marathi', 1, 0, '2022-02-07 14:59:19', NULL, '2022-02-07 15:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `id` int(11) NOT NULL,
  `marital_status_name` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `marital_status_name`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Separated', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Divorcee', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Widow/Widower', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Unmarried', 1, 0, '0000-00-00 00:00:00', 0, '2022-02-02 13:54:12'),
(5, 'Married', 1, 0, '0000-00-00 00:00:00', 0, '2022-02-01 15:41:24'),
(6, 'Grooms', 1, 0, '2022-02-02 13:06:52', NULL, NULL),
(7, 'Brides', 1, 0, '2022-02-02 13:07:34', NULL, '2022-02-02 16:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-Customer order, 2-customer invoice, 3-dealer invoice, 4- Dealer product order, 5- Customer payment, 6- Employee payment, 7- Dealer payment, 8- Employee expenses, 9- customer birthday, 10- dealer birthday, 11- employee birthday, 12- customer anni, 13- dealer anni, 14- employee anni',
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL,
  `notify_for` int(11) NOT NULL COMMENT '0 / 1 -Admin / 2-Sub-User/ 3- CNF/ 4- SuperStockist/ 5-Stockist/ 6-Dealer/ 7- Sales Executive',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `status_id` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0-deleted, 1-active, 2-inactive',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `status_id` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `id` int(11) NOT NULL,
  `religion` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active, 2-Inactive,',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `religion`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Hindu', 1, 0, '2022-02-07 15:52:27', NULL, '2022-02-07 15:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `resident_address`
--

CREATE TABLE `resident_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `landmark` varchar(500) NOT NULL,
  `country` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  `pincode` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-Active, 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `status_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `state_name`, `status_id`) VALUES
(1, 110, 'ANDHRA PRADESH', 1),
(2, 110, 'ASSAM', 1),
(3, 110, 'ARUNACHAL PRADESH', 1),
(4, 110, 'BIHAR', 1),
(5, 110, 'GUJRAT', 1),
(6, 110, 'HARYANA', 1),
(7, 110, 'HIMACHAL PRADESH', 1),
(8, 110, 'JAMMU & KASHMIR', 1),
(9, 110, 'KARNATAKA', 1),
(10, 110, 'KERALA', 1),
(11, 110, 'MADHYA PRADESH', 1),
(12, 110, 'MAHARASHTRA', 1),
(13, 110, 'MANIPUR', 1),
(14, 110, 'MEGHALAYA', 1),
(15, 110, 'MIZORAM', 1),
(16, 110, 'NAGALAND', 1),
(17, 110, 'ORISSA', 1),
(18, 110, 'PUNJAB', 1),
(19, 110, 'RAJASTHAN', 1),
(20, 110, 'SIKKIM', 1),
(21, 110, 'TAMIL NADU', 1),
(22, 110, 'TRIPURA', 1),
(23, 110, 'UTTAR PRADESH', 1),
(24, 110, 'WEST BENGAL', 1),
(25, 110, 'DELHI', 1),
(26, 110, 'GOA', 1),
(27, 110, 'PONDICHERY', 1),
(28, 110, 'LAKSHDWEEP', 1),
(29, 110, 'DAMAN & DIU', 1),
(30, 110, 'DADRA & NAGAR', 1),
(31, 110, 'CHANDIGARH', 1),
(32, 110, 'ANDAMAN & NICOBAR', 1),
(33, 110, 'UTTARANCHAL', 1),
(34, 110, 'JHARKHAND', 1),
(35, 110, 'CHATTISGARH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status_id` tinyint(4) NOT NULL COMMENT '1-Active, 2-Inactive',
  `random_no` varchar(20) DEFAULT NULL,
  `valid_till` datetime DEFAULT NULL,
  `flag` tinyint(4) NOT NULL COMMENT '0-Admin, 1-subadmin, 2- Expert, 3- user',
  `user_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `contact`, `image`, `status_id`, `random_no`, `valid_till`, `flag`, `user_level`) VALUES
(1, 'dipaklokhande81@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '7620508512', '1642610616_IMG-20200909-WA0001.jpg', 1, '585659', '2022-01-19 22:20:02', 2, ''),
(2, 'admin@mahateli.com', '21232f297a57a5a743894a0e4a801fc3', '7391915164', '', 1, '', '0000-00-00 00:00:00', 0, ''),
(3, '', '21232f297a57a5a743894a0e4a801fc3', '7875802868', '1643473171_screencapture-app-clickup-10601778-dashboards-a3h9j-124-2022-01-12-18_40_00.png', 1, '500002', '2022-01-29 21:59:31', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(15) NOT NULL,
  `foundation` varchar(800) NOT NULL,
  `first` varchar(200) NOT NULL,
  `middle` varchar(230) NOT NULL,
  `last` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contry_code` varchar(20) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `religion` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `marital_status` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-Active, 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_family_details`
--

CREATE TABLE `user_family_details` (
  `id` int(11) NOT NULL,
  `user_id` int(15) NOT NULL,
  `relation_id` int(12) NOT NULL,
  `first` varchar(200) NOT NULL,
  `middle` varchar(250) NOT NULL,
  `last` varchar(250) NOT NULL,
  `email` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contry_code` varchar(20) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `religion` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `marital_status` varchar(250) NOT NULL,
  `relation` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1-Active, 2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_shop_own`
--
ALTER TABLE `about_shop_own`
  ADD PRIMARY KEY (`website_id`);

--
-- Indexes for table `authenticate`
--
ALTER TABLE `authenticate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caste`
--
ALTER TABLE `caste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `correspondence_address`
--
ALTER TABLE `correspondence_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_relation`
--
ALTER TABLE `family_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foundation`
--
ALTER TABLE `foundation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident_address`
--
ALTER TABLE `resident_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_family_details`
--
ALTER TABLE `user_family_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_shop_own`
--
ALTER TABLE `about_shop_own`
  MODIFY `website_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `authenticate`
--
ALTER TABLE `authenticate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caste`
--
ALTER TABLE `caste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `correspondence_address`
--
ALTER TABLE `correspondence_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_relation`
--
ALTER TABLE `family_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `foundation`
--
ALTER TABLE `foundation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincode`
--
ALTER TABLE `pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resident_address`
--
ALTER TABLE `resident_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_family_details`
--
ALTER TABLE `user_family_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
