-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 06:14 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.6.5-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ermile`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'test comment',
  `account_title` varchar(50) NOT NULL,
  `account_slug` varchar(50) NOT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `account_branch` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_card` varchar(30) DEFAULT NULL,
  `account_primarybalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `account_desc` varchar(200) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`account_slug`),
  UNIQUE KEY `cardnumber_unique` (`account_card`),
  UNIQUE KEY `accountnumber_unique` (`account_number`),
  KEY `bank_id` (`bank_id`),
  KEY `accounts_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_title`, `account_slug`, `bank_id`, `account_branch`, `account_number`, `account_card`, `account_primarybalance`, `account_desc`, `user_id`, `date_modified`) VALUES
(10, 'test2', 'test2', 1, 'test', '123', '456', 0.0000, NULL, 15, '2014-11-07 22:52:43'),
(11, 'a1', 'a1', 100, NULL, '23', NULL, 500.0000, NULL, 150, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE IF NOT EXISTS `addons` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(50) NOT NULL,
  `addon_slug` varchar(50) NOT NULL,
  `addon_desc` varchar(999) DEFAULT NULL,
  `addon_status` enum('enable','disable','expire','goingtoexpire') NOT NULL DEFAULT 'enable',
  `addon_expire` datetime DEFAULT NULL,
  `addon_installdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`addon_slug`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachmentmetas`
--

CREATE TABLE IF NOT EXISTS `attachmentmetas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_id` int(10) unsigned NOT NULL,
  `attachmentmeta_cat` varchar(50) NOT NULL,
  `attachmentmeta_name` varchar(100) NOT NULL,
  `attachmentmeta_value` varchar(200) DEFAULT NULL,
  `attachmentmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `attachmentmetas_attachments_id` (`attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned DEFAULT NULL,
  `attachment_title` varchar(100) DEFAULT NULL,
  `attachment_type` enum('productcategory','product','admin','banklogo','post','system','other','file','folder') NOT NULL,
  `attachment_addr` varchar(1000) DEFAULT NULL,
  `attachment_name` varchar(50) DEFAULT NULL,
  `attachment_ext` varchar(255) DEFAULT NULL,
  `attachment_size` float(12,0) DEFAULT NULL,
  `attachment_desc` varchar(200) DEFAULT NULL,
  `attachment_parent` int(10) unsigned DEFAULT NULL,
  `attachment_depth` smallint(5) unsigned DEFAULT NULL,
  `attachment_count` smallint(5) unsigned DEFAULT NULL,
  `attachment_order` smallint(5) DEFAULT NULL,
  `attachment_status` enum('normal','trash','deleted') NOT NULL DEFAULT 'normal',
  `user_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `attachments_users_id` (`user_id`) USING BTREE,
  KEY `attachments_files_id` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `file_id`, `attachment_title`, `attachment_type`, `attachment_addr`, `attachment_name`, `attachment_ext`, `attachment_size`, `attachment_desc`, `attachment_parent`, `attachment_depth`, `attachment_count`, `attachment_order`, `attachment_status`, `user_id`, `date_modified`) VALUES
(4, NULL, 'folder1', 'folder', NULL, NULL, NULL, NULL, NULL, 8, 1, NULL, 1, 'normal', 190, '2015-01-29 21:06:30'),
(6, NULL, 'Folder2', 'folder', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 'normal', 190, '2015-02-01 15:39:53'),
(7, NULL, 'File1', 'file', NULL, NULL, 'jpeg', NULL, NULL, 8, 1, NULL, 0, 'normal', 190, '2015-01-29 20:56:47'),
(8, NULL, 'Folder4', 'folder', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, 'normal', 190, '2015-02-01 15:39:55'),
(9, NULL, '123', 'folder', '/', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'normal', 190, NULL),
(10, NULL, '1233', 'folder', '/123', NULL, NULL, NULL, NULL, 9, 1, NULL, NULL, 'normal', 190, NULL),
(11, NULL, 'qqqq', 'folder', '/123/1233', NULL, NULL, NULL, NULL, 10, 2, NULL, NULL, 'normal', 190, NULL),
(12, NULL, 'rrrrr', 'folder', '/123/1233/qqqq', NULL, NULL, NULL, NULL, 11, 3, NULL, NULL, 'normal', 190, NULL),
(13, NULL, '123', 'folder', '/123', NULL, NULL, NULL, NULL, 9, 1, NULL, NULL, 'normal', 190, NULL),
(14, NULL, 'فففف', 'folder', '/', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'normal', 190, NULL),
(15, NULL, 'ssss', 'folder', '/', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'normal', 190, NULL),
(16, NULL, 'adasd', 'folder', '/', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'normal', 190, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bank_title` varchar(50) NOT NULL,
  `bank_slug` varchar(50) NOT NULL,
  `bank_website` varchar(50) DEFAULT NULL,
  `bank_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`bank_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_title`, `bank_slug`, `bank_website`, `bank_status`, `date_modified`) VALUES
(1, 'پارسیان', 'parsian', 'http://parsian-bank.com', 'enable', '2015-01-22 13:31:40'),
(2, 'ملی', 'melli', NULL, 'enable', '2015-01-22 13:31:44'),
(3, 'ملت', 'mellat', NULL, 'disable', '2015-01-23 21:23:09'),
(4, 'پاسارگاد', 'pasargad', NULL, 'enable', '2015-01-23 23:03:52'),
(100, 'reba', 'reba', NULL, 'expire', '2015-01-25 01:04:55'),
(101, 'asfasfsf', 'asfasfsf', NULL, 'enable', NULL),
(102, '325asfasfsf', '325asfasfsf', NULL, 'enable', NULL),
(103, '325asfasfsf', '325asfasfsf5123', NULL, 'enable', NULL),
(104, '342t', '342t', NULL, 'enable', NULL),
(105, '342twefwet', '342twefwet', NULL, 'enable', NULL),
(106, '342twefwetdsag', '342twefwetdsag', NULL, 'enable', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` smallint(5) unsigned DEFAULT NULL COMMENT 'if comment for post',
  `product_id` smallint(5) unsigned DEFAULT NULL COMMENT 'if comment for product',
  `comment_author` varchar(50) DEFAULT NULL,
  `comment_email` varchar(100) DEFAULT NULL,
  `comment_url` varchar(100) DEFAULT NULL,
  `comment_content` varchar(999) NOT NULL DEFAULT '',
  `comment_status` enum('approved','unapproved','spam','deleted') NOT NULL DEFAULT 'unapproved',
  `comment_parent` smallint(5) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `Visitor_id` int(10) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comments_posts_id` (`post_id`) USING BTREE,
  KEY `comments_users_id` (`user_id`) USING BTREE,
  KEY `comments_products_id` (`product_id`) USING BTREE,
  KEY `comments_visitors_id` (`Visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `costcats`
--

CREATE TABLE IF NOT EXISTS `costcats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `costcat_title` varchar(50) NOT NULL,
  `costcat_slug` varchar(50) NOT NULL,
  `costcat_desc` varchar(200) DEFAULT NULL,
  `costcat_parent` smallint(5) DEFAULT NULL,
  `costcat_order` smallint(5) DEFAULT NULL,
  `costcat_type` enum('income','outcome') DEFAULT NULL,
  `costcat_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`costcat_slug`),
  KEY `type` (`costcat_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `costcats`
--

INSERT INTO `costcats` (`id`, `costcat_title`, `costcat_slug`, `costcat_desc`, `costcat_parent`, `costcat_order`, `costcat_type`, `costcat_status`, `date_modified`) VALUES
(3, 'test', 'tt', 'eee', NULL, NULL, 'outcome', 'enable', '0000-00-00 00:00:00'),
(4, 'test2', 'tt2', 'tt2', NULL, NULL, 'income', 'enable', '0000-00-00 00:00:00'),
(5, 'test3', 't3', 'tt3', 3, 4, 'income', 'enable', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE IF NOT EXISTS `costs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cost_title` varchar(50) NOT NULL,
  `cost_price` decimal(13,4) NOT NULL,
  `costcat_id` smallint(5) unsigned NOT NULL,
  `account_id` smallint(5) unsigned NOT NULL,
  `cost_date` datetime NOT NULL,
  `cost_desc` varchar(200) DEFAULT NULL,
  `cost_type` enum('income','outcome') NOT NULL DEFAULT 'outcome',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type_index` (`cost_type`) USING BTREE,
  KEY `costs_costcats_id` (`costcat_id`) USING BTREE,
  KEY `costs_accounts_id` (`account_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `errorlogs`
--

CREATE TABLE IF NOT EXISTS `errorlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `errorlog_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `errorlogs_users_id` (`user_id`) USING BTREE,
  KEY `errorlogs_errors_id` (`errorlog_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` smallint(5) unsigned NOT NULL,
  `error_title` varchar(100) NOT NULL,
  `error_solution` varchar(999) DEFAULT NULL,
  `error_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priotity_index` (`error_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fileparts`
--

CREATE TABLE IF NOT EXISTS `fileparts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `filepart_part` smallint(5) unsigned NOT NULL,
  `filepart_code` varchar(64) DEFAULT NULL,
  `filepart_status` enum('awaiting','start','inprogress','appended','failed','finished') NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fileparts_files_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_server` smallint(5) unsigned NOT NULL,
  `file_folder` smallint(5) unsigned NOT NULL,
  `file_code` varchar(64) DEFAULT NULL,
  `file_size` float(12,0) NOT NULL,
  `file_status` enum('inprogress','ready','temp') NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE IF NOT EXISTS `funds` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `fund_title` varchar(100) NOT NULL,
  `fund_slug` varchar(100) NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `fund_initialbalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `fund_desc` varchar(200) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`fund_slug`),
  KEY `funds_locations_id` (`location_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_title`, `fund_slug`, `location_id`, `fund_initialbalance`, `fund_desc`, `date_modified`) VALUES
(2, 'Main', 'main', 1, 0.0000, NULL, '0000-00-00 00:00:00'),
(3, 'werew', 'wqrwer', 1, 9999999999.9999, NULL, '0000-00-00 00:00:00');

--
-- Triggers `funds`
--
DROP TRIGGER IF EXISTS `funds_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `funds_BD_inline_block` BEFORE DELETE ON `funds`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `location_title` varchar(100) NOT NULL,
  `location_slug` varchar(100) NOT NULL,
  `location_desc` varchar(200) DEFAULT NULL,
  `location_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`location_slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_title`, `location_slug`, `location_desc`, `location_status`, `date_modified`) VALUES
(1, 'Main Location', 'main', NULL, 'enable', '2014-11-07 18:21:17'),
(2, 'test', 't', NULL, 'enable', '0000-00-00 00:00:00');

--
-- Triggers `locations`
--
DROP TRIGGER IF EXISTS `locations_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `locations_BD_inline_block` BEFORE DELETE ON `locations`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_sender` smallint(5) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `notification_title` varchar(50) NOT NULL,
  `notification_content` varchar(200) DEFAULT NULL,
  `notification_url` varchar(100) DEFAULT NULL,
  `notification_status` enum('read','unread','expire') NOT NULL DEFAULT 'unread',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status_index` (`notification_status`),
  KEY `notifications_users_idsender` (`user_id_sender`) USING BTREE,
  KEY `notifications_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `option_cat` varchar(50) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_value` varchar(200) DEFAULT NULL,
  `option_extra` varchar(400) DEFAULT NULL,
  `option_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat+name+value` (`option_cat`,`option_name`,`option_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_cat`, `option_name`, `option_value`, `option_extra`, `option_status`, `date_modified`) VALUES
(1, 'global', 'language', 'fa', NULL, '', '2014-05-01 08:18:41'),
(2, 'global', 'language', 'en', NULL, '', '2014-05-01 08:18:42'),
(3, 'global', 'title', 'Jibres', NULL, '', '2014-11-07 17:29:37'),
(4, 'global', 'desc', 'Jibres for all', NULL, '', '2014-11-07 17:29:46'),
(5, 'global', 'keyword', 'Jibres, store, online store', NULL, '', '2014-11-07 17:30:07'),
(6, 'global', 'url', 'http://jibres.ir', NULL, '', '2014-11-07 17:30:18'),
(7, 'global', 'email', 'info@jibres.ir', NULL, '', '2014-11-07 17:30:22'),
(8, 'global', 'auto_mail', 'no-reply@jibres.ir', NULL, '', '2014-11-07 17:30:27'),
(9, 'users', 'user_degree', 'under diploma', NULL, '', '0000-00-00 00:00:00'),
(10, 'users', 'user_degree', 'diploma', NULL, '', '0000-00-00 00:00:00'),
(11, 'users', 'user_degree', '2-year collage', NULL, '', '0000-00-00 00:00:00'),
(12, 'users', 'user_degree', 'bachelor', NULL, '', '0000-00-00 00:00:00'),
(13, 'users', 'user_degree', 'master', NULL, '', '0000-00-00 00:00:00'),
(14, 'users', 'user_degree', 'doctorate', NULL, '', '0000-00-00 00:00:00'),
(15, 'users', 'user_degree', 'religious', NULL, '', '0000-00-00 00:00:00'),
(16, 'users', 'user_activity', 'employee', NULL, '', '0000-00-00 00:00:00'),
(17, 'users', 'user_activity', 'housekeeper ', NULL, '', '0000-00-00 00:00:00'),
(18, 'users', 'user_activity', 'free lance', NULL, '', '0000-00-00 00:00:00'),
(19, 'users', 'user_activity', 'retired', NULL, '', '0000-00-00 00:00:00'),
(20, 'users', 'user_activity', 'student', NULL, '', '0000-00-00 00:00:00'),
(21, 'users', 'user_activity', 'unemployed', NULL, '', '0000-00-00 00:00:00'),
(22, 'users', 'user_activity', 'seminary student', NULL, '', '0000-00-00 00:00:00'),
(23, 'permissions', 'permission_name', 'admin', NULL, '', '2014-11-07 17:30:55'),
(24, 'permissions', 'permission_name', 'reseller', NULL, '', '2014-11-07 17:30:56'),
(26, 'ships', 'post', '1', NULL, '', '2014-11-07 17:30:56'),
(27, 'ships', 'tipax', '2', NULL, '', '2014-11-07 17:30:57'),
(28, 'units', 'money_unit', 'toman', NULL, '', '2014-11-07 17:31:08'),
(29, 'units', 'product_unit', 'adad', NULL, '', '2014-11-07 17:31:29'),
(30, 'permissions', 'permission_name', 'viewer', NULL, '', '2014-05-17 21:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `paper_type` varchar(50) DEFAULT NULL,
  `paper_number` varchar(20) DEFAULT NULL,
  `paper_date` datetime DEFAULT NULL,
  `paper_price` decimal(13,4) DEFAULT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `paper_holder` varchar(100) DEFAULT NULL,
  `paper_desc` varchar(200) DEFAULT NULL,
  `paper_status` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id+bankid_unique` (`id`,`bank_id`) USING BTREE,
  KEY `bank_id` (`bank_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `paper_type`, `paper_number`, `paper_date`, `paper_price`, `bank_id`, `paper_holder`, `paper_desc`, `paper_status`, `date_modified`) VALUES
(1, NULL, '123', NULL, 500.0000, 1, NULL, NULL, NULL, '0000-00-00 00:00:00');

--
-- Triggers `papers`
--
DROP TRIGGER IF EXISTS `cheques_AU_outline_copy`;
DELIMITER //
CREATE TRIGGER `cheques_AU_outline_copy` BEFORE UPDATE ON `papers`
 FOR EACH ROW IF coalesce(OLD.paper_date , '') <> coalesce(NEW.paper_date , '') or
    coalesce(OLD.paper_price , '') <> coalesce(NEW.paper_price , '') or
    coalesce(OLD.paper_status , '') <> coalesce(NEW.paper_status , '')
THEN

  Update receipts 
    SET receipt_paperdate = NEW.paper_date, receipt_price = NEW.paper_price, receipt_paperstatus = NEW.paper_status
    WHERE paper_id = NEW.id;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `permission_title` varchar(50) NOT NULL,
  `Permission_module` varchar(50) NOT NULL,
  `permission_view` enum('yes','no') NOT NULL DEFAULT 'yes',
  `permission_add` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `permission_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name+module_unique` (`permission_title`,`Permission_module`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_title`, `Permission_module`, `permission_view`, `permission_add`, `permission_edit`, `permission_delete`, `permission_status`, `date_modified`) VALUES
(1, 'admin', 'banks', 'yes', 'yes', 'yes', 'yes', '', '2014-11-08 14:08:16'),
(2, 'reseller', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 'admin2', '', 'yes', 'no', 'no', 'no', '', '2014-11-08 09:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `postmetas`
--

CREATE TABLE IF NOT EXISTS `postmetas` (
  `id` int(10) NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `postmeta_cat` varchar(50) NOT NULL,
  `postmeta_name` varchar(100) NOT NULL,
  `postmeta_value` varchar(999) DEFAULT NULL,
  `postmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `postmeta_posts_id` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_language` char(2) DEFAULT NULL,
  `post_cat` varchar(50) DEFAULT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_slug` varchar(100) NOT NULL,
  `post_content` text,
  `post_type` enum('post','page') NOT NULL DEFAULT 'post',
  `post_comment` enum('open','closed','','') NOT NULL DEFAULT 'open',
  `post_count` smallint(5) unsigned DEFAULT NULL,
  `post_status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `post_parent` smallint(5) unsigned DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `post_publishdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug+catslug_unique` (`post_cat`,`post_slug`),
  KEY `posts_users_id` (`user_id`) USING BTREE,
  KEY `posts_attachments_id` (`attachment_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_language`, `post_cat`, `post_title`, `post_slug`, `post_content`, `post_type`, `post_comment`, `post_count`, `post_status`, `post_parent`, `user_id`, `attachment_id`, `post_publishdate`, `date_modified`) VALUES
(1, 'fa', NULL, 'test1', 'page1', 'salam. in test 1 ast', 'page', 'open', NULL, 'publish', NULL, 14, NULL, NULL, '2015-01-19 07:19:51'),
(2, 'en', 'test', 'post1', 'post1', 'salam. post1 ast', 'post', 'open', NULL, 'publish', NULL, 14, NULL, NULL, '2015-01-18 15:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `productcats`
--

CREATE TABLE IF NOT EXISTS `productcats` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `productcat_title` varchar(50) NOT NULL,
  `productcat_slug` varchar(50) NOT NULL,
  `productcat_desc` varchar(200) DEFAULT NULL,
  `productcat_parent` smallint(5) unsigned DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `productcat_order` smallint(5) unsigned DEFAULT NULL,
  `productcat_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `productcat_count` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`productcat_slug`) USING BTREE,
  KEY `productcats_attachments_id` (`attachment_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `productcats`
--

INSERT INTO `productcats` (`id`, `productcat_title`, `productcat_slug`, `productcat_desc`, `productcat_parent`, `attachment_id`, `productcat_order`, `productcat_status`, `productcat_count`, `date_modified`) VALUES
(1, 'general', 'general', NULL, NULL, NULL, 0, 'enable', NULL, '2014-11-07 18:11:58');

--
-- Triggers `productcats`
--
DROP TRIGGER IF EXISTS `productcats_BD_inline_block`;
DELIMITER //
CREATE TRIGGER `productcats_BD_inline_block` BEFORE DELETE ON `productcats`
 FOR EACH ROW IF old.id = 1 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'delete blocked';
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productmetas`
--

CREATE TABLE IF NOT EXISTS `productmetas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_cat` varchar(50) NOT NULL,
  `productmeta_name` varchar(100) NOT NULL,
  `productmeta_value` varchar(999) DEFAULT NULL,
  `productmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product+cat+name_unique` (`product_id`,`productmeta_cat`,`productmeta_name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `productmetas`
--

INSERT INTO `productmetas` (`id`, `product_id`, `productmeta_cat`, `productmeta_name`, `productmeta_value`, `productmeta_status`, `date_modified`) VALUES
(21, 1, 'price_white', 'product_price', '600', 'enable', '2014-11-07 16:49:50'),
(22, 1, 'price_white', 'product_buy_price', '5000', 'enable', '2014-11-07 16:49:51'),
(39, 1, 'price1', 'product_vat', '11', 'enable', '2014-11-07 16:33:34'),
(73, 1, 'price1', 'product_discount', '20', 'enable', '2014-11-07 16:49:52');

--
-- Triggers `productmetas`
--
DROP TRIGGER IF EXISTS `ProductMeta_AI_outline_copy`;
DELIMITER //
CREATE TRIGGER `ProductMeta_AI_outline_copy` AFTER INSERT ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buyprice" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"  or
      New.productmeta_name = "product_vat"
  THEN
    # if our valid price data inserted

    IF ( Select count(*) from productprices
      WHERE (product_id = NEW.product_id and productprice_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3) ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.product_id and productprice_cat = New.productmeta_cat and (productprice_enddate is null);

      INSERT INTO productprices ( product_id, productmeta_id, productprice_cat, productprice_startdate)
        VALUES(NEW.product_id, NEW.id ,NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_vat"
    THEN
      UPDATE productprices SET productprice_vat = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

  End if;
End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `ProductMeta_AU_outline_copy2`;
DELIMITER //
CREATE TRIGGER `ProductMeta_AU_outline_copy2` AFTER UPDATE ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_name = "product_buyprice" or
      New.productmeta_name = "product_price"         or
      New.productmeta_name = "product_discount"  or
      New.productmeta_name = "product_vat"
  THEN
    # if our valid price data inserted

    IF ( Select count(*) from productprices
      WHERE (product_id = NEW.product_id and productprice_cat = New.productmeta_cat) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3) ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.product_id and productprice_cat = New.productmeta_cat and (productprice_enddate is null);

      INSERT INTO productprices ( product_id, productmeta_id, productprice_cat, productprice_startdate)
        VALUES(NEW.product_id, NEW.id ,NEW.productmeta_cat, NOW());

    End if;
    # now record is exit this is the time of update price_archive table with valid data


    IF New.productmeta_name = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_name = "product_vat"
    THEN
      UPDATE productprices SET productprice_vat = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

  End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productprices`
--

CREATE TABLE IF NOT EXISTS `productprices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` smallint(5) unsigned NOT NULL,
  `productmeta_id` int(10) unsigned DEFAULT NULL,
  `productprice_cat` varchar(50) DEFAULT NULL,
  `productprice_startdate` datetime NOT NULL,
  `productprice_enddate` datetime DEFAULT NULL,
  `productprice_buyprice` decimal(13,4) DEFAULT NULL,
  `productprice_price` decimal(13,4) DEFAULT NULL,
  `productprice_discount` decimal(13,4) DEFAULT NULL,
  `productprice_vat` decimal(6,4) DEFAULT NULL,
  `productprice_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `startdate` (`productprice_startdate`),
  KEY `enddate` (`productprice_enddate`),
  KEY `productprices_products_id` (`product_id`) USING BTREE,
  KEY `productprices_productmetas_id` (`productmeta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `product_title` varchar(100) NOT NULL,
  `product_slug` varchar(50) NOT NULL,
  `productcat_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `product_barcode` varchar(20) DEFAULT NULL,
  `product_barcode2` varchar(20) DEFAULT NULL,
  `product_buyprice` decimal(13,4) DEFAULT NULL,
  `product_price` decimal(13,4) NOT NULL,
  `product_discount` decimal(13,4) DEFAULT NULL,
  `product_vat` decimal(6,4) DEFAULT NULL,
  `product_initialbalance` int(10) DEFAULT '0',
  `product_mininventory` int(10) DEFAULT NULL,
  `product_status` enum('unset','available','soon','discontinued','unavailable','expire') DEFAULT 'unset',
  `product_sold` int(10) DEFAULT '0',
  `product_stock` int(10) DEFAULT '0',
  `product_carton` int(10) DEFAULT NULL,
  `attachment_id` int(10) unsigned DEFAULT NULL,
  `product_service` enum('yes','no') NOT NULL DEFAULT 'no',
  `product_sellin` enum('store','online','both') NOT NULL DEFAULT 'both',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`product_slug`) USING BTREE,
  UNIQUE KEY `barcode_unique` (`product_barcode`) USING BTREE,
  UNIQUE KEY `barcode2_unique` (`product_barcode2`) USING BTREE,
  KEY `products_attachments_id` (`attachment_id`) USING BTREE,
  KEY `products_productcats_id` (`productcat_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_slug`, `productcat_id`, `product_barcode`, `product_barcode2`, `product_buyprice`, `product_price`, `product_discount`, `product_vat`, `product_initialbalance`, `product_mininventory`, `product_status`, `product_sold`, `product_stock`, `product_carton`, `attachment_id`, `product_service`, `product_sellin`, `date_modified`) VALUES
(1, 'aa', 'aa', 1, NULL, NULL, 890.0000, 960.0000, 10.0000, 2.0000, 0, NULL, 'unset', 5, NULL, NULL, NULL, 'yes', 'both', '2014-11-07 14:42:53'),
(2, 'bb', 'bb', 1, NULL, NULL, NULL, 400.0000, 0.0000, NULL, 0, NULL, 'unset', 0, 20, NULL, NULL, 'yes', 'both', '2014-11-07 14:43:31'),
(3, 'cc', 'cc', 1, NULL, NULL, NULL, 0.0000, 0.0000, 1.0000, 0, NULL, 'unset', 90, 40, NULL, NULL, 'yes', 'both', '2014-06-12 08:56:25'),
(4, 'dd', 'dd', 1, NULL, NULL, 90.0000, 200.0000, 10.0000, NULL, 0, NULL, 'unset', 8, 42, NULL, NULL, 'yes', 'both', '2014-05-30 22:01:45'),
(5, 'ee', 'ee', 1, NULL, NULL, 100.0000, 120.0000, 5.0000, NULL, 0, NULL, 'unset', 0, 50, NULL, NULL, 'yes', 'both', '2014-05-30 21:42:55');

--
-- Triggers `products`
--
DROP TRIGGER IF EXISTS `products_AI_outline_copy`;
DELIMITER //
CREATE TRIGGER `products_AI_outline_copy` AFTER INSERT ON `products`
 FOR EACH ROW INSERT INTO productprices
    (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
    
    VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `products_AU_copy2`;
DELIMITER //
CREATE TRIGGER `products_AU_copy2` AFTER UPDATE ON `products`
 FOR EACH ROW IF coalesce(OLD.product_buyprice , '')   <> coalesce(NEW.product_buyprice , '')   or
    coalesce(OLD.product_price , '')          <> coalesce(NEW.product_price , '')         or
    coalesce(OLD.product_discount , '')   <> coalesce(NEW.product_discount , '')   or
    coalesce(OLD.product_vat , '')             <> coalesce(NEW.product_vat , '')

  Then
    IF
      (Select count(*) from productprices 
        WHERE (product_id = NEW.id and productmeta_id is null ) and (TIMESTAMPDIFF(MINUTE, productprice_startdate, NOW() ) < 3)
        ) = 0
    Then
      # if record does not exist or higher than 3 minutes after old insert, then insert new record in archive table and set end time for older price

      UPDATE productprices SET productprice_enddate = now()
        WHERE product_id = NEW.id 
          and productmeta_id is null
          and productprice_enddate is null;

      INSERT INTO productprices (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
      VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat);

    ELSE

      UPDATE productprices SET 
          productprice_buyprice   = NEW.product_buyprice,
          productprice_price          = new.product_price,
          productprice_discount   = new.product_discount,
          productprice_vat             = new.product_vat
        WHERE  product_id = NEW.id and productmeta_id is null and productprice_enddate is null;

  End if;
End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_code` varchar(30) DEFAULT NULL,
  `receipt_type` enum('income','outcome') DEFAULT 'income',
  `receipt_price` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `receipt_date` datetime NOT NULL,
  `paper_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_paperdate` datetime DEFAULT NULL,
  `receipt_paperstatus` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `receipt_desc` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `fund_id` smallint(5) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `user_id_customer` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipts_papers_id` (`paper_id`) USING BTREE,
  KEY `receipts_transactions_id` (`transaction_id`) USING BTREE,
  KEY `receipts_funds_id` (`fund_id`) USING BTREE,
  KEY `receipts_users_id` (`user_id`),
  KEY `receipts_users_idcustomer` (`user_id_customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_code`, `receipt_type`, `receipt_price`, `receipt_date`, `paper_id`, `receipt_paperdate`, `receipt_paperstatus`, `receipt_desc`, `transaction_id`, `fund_id`, `user_id`, `user_id_customer`, `date_modified`) VALUES
(6, '123', 'income', 0.0000, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 2, 14, 15, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `smss`
--

CREATE TABLE IF NOT EXISTS `smss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sms_from` varchar(15) DEFAULT NULL,
  `sms_to` varchar(15) DEFAULT NULL,
  `sms_message` varchar(255) DEFAULT NULL,
  `sms_messageid` int(10) unsigned DEFAULT NULL,
  `sms_deliverystatus` tinyint(4) unsigned DEFAULT NULL,
  `sms_method` enum('post','get') NOT NULL DEFAULT 'post',
  `sms_type` enum('receive','delivery') NOT NULL DEFAULT 'delivery',
  `sms_createdate` datetime NOT NULL,
  `sms_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `term_language` char(2) DEFAULT NULL,
  `term_title` varchar(50) NOT NULL,
  `term_slug` varchar(50) NOT NULL,
  `term_desc` varchar(200) NOT NULL,
  `term_parent` smallint(5) unsigned DEFAULT NULL,
  `term_type` enum('cat','tag') NOT NULL DEFAULT 'cat',
  `term_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `term_count` smallint(5) unsigned DEFAULT NULL,
  `term_order` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`term_slug`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_language`, `term_title`, `term_slug`, `term_desc`, `term_parent`, `term_type`, `term_status`, `term_count`, `term_order`, `date_modified`) VALUES
(1, NULL, 'news', 'news', '', NULL, 'cat', 'enable', NULL, NULL, '0000-00-00 00:00:00'),
(5, NULL, 'test', 'test', 't', NULL, 'cat', 'enable', NULL, NULL, '2015-01-18 13:33:13'),
(6, NULL, 'news2', 'news2', 'news 2', 1, 'cat', 'enable', NULL, NULL, '2015-01-18 15:45:20'),
(7, NULL, 'tag1', 'tag1', '', NULL, 'tag', 'enable', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE IF NOT EXISTS `termusages` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` smallint(5) unsigned NOT NULL,
  `post_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `term+post_unique` (`term_id`,`post_id`) USING BTREE,
  KEY `termusages_posts_id` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetails`
--

CREATE TABLE IF NOT EXISTS `transactiondetails` (
  `transactiondetail_row` smallint(5) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` smallint(5) unsigned NOT NULL,
  `transactiondetail_quantity` int(10) NOT NULL DEFAULT '0',
  `transactiondetail_price` decimal(13,4) NOT NULL,
  `transactiondetail_discount` decimal(13,4) DEFAULT NULL,
  UNIQUE KEY `sale+product_unique` (`transaction_id`,`product_id`),
  KEY `transactiondetails_products_id` (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactiondetails`
--

INSERT INTO `transactiondetails` (`transactiondetail_row`, `transaction_id`, `product_id`, `transactiondetail_quantity`, `transactiondetail_price`, `transactiondetail_discount`) VALUES
(NULL, 2, 1, 20, 0.0000, NULL),
(NULL, 2, 2, 20, 0.0000, NULL),
(NULL, 2, 5, 1, 50.0000, NULL),
(NULL, 3, 2, 1, 100.0000, NULL);

--
-- Triggers `transactiondetails`
--
DROP TRIGGER IF EXISTS `TransactionDetails_AI_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AI_outline_update` AFTER INSERT ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + NEW.transactiondetail_quantity),
  product_stock = (coalesce(product_stock, 0) - NEW.transactiondetail_quantity)
Where
  id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = new.transaction_id)
Where
  id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_AU_outline_update` AFTER UPDATE ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold , 0) + (NEW.transactiondetail_quantity - OLD.transactiondetail_quantity) ),
  product_stock = (coalesce(product_stock, 0) - (NEW.transactiondetail_quantity - OLD.transactiondetail_quantity) )
Where
  id = NEW.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = new.transaction_id)
Where
  id = new.transaction_id;


End if
//
DELIMITER ;
DROP TRIGGER IF EXISTS `TransactionDetails_BD_outline_update`;
DELIMITER //
CREATE TRIGGER `TransactionDetails_BD_outline_update` BEFORE DELETE ON `transactiondetails`
 FOR EACH ROW IF TRUE THEN

Update products
Set
  product_sold = (coalesce(product_sold, 0) -OLD.transactiondetail_quantity),
  product_stock = (coalesce(product_stock, 0) + OLD.transactiondetail_quantity)
Where
  id = OLD.product_id;
# --------------------------------------------------------------------

Update transactions
Set
  transaction_sum = (select sum((transactiondetail_price-coalesce(transactiondetail_discount,0)) * transactiondetail_quantity) from transactiondetails where id = OLD.transaction_id)
Where
  id = OLD.transaction_id;


End if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactionmetas`
--

CREATE TABLE IF NOT EXISTS `transactionmetas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `transactionmeta_cat` varchar(50) NOT NULL,
  `transactionmeta_name` varchar(100) NOT NULL,
  `transactionmeta_value` varchar(200) DEFAULT NULL,
  `transactionmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactionmetas_transactions_id` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` enum('sale','purchase','customertostore','storetocompany','anbargardani','install','repair','chqeuebackfail') NOT NULL DEFAULT 'sale',
  `user_id` smallint(5) unsigned NOT NULL,
  `user_id_customer` smallint(5) unsigned NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_sum` decimal(13,4) NOT NULL,
  `transaction_remained` decimal(13,4) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transactions_users_id` (`user_id`) USING BTREE,
  KEY `transactions_users_idcustomer` (`user_id_customer`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `user_id`, `user_id_customer`, `transaction_date`, `transaction_sum`, `transaction_remained`, `date_modified`) VALUES
(2, 'sale', 15, 15, '0000-00-00 00:00:00', 50.0000, NULL, '2014-05-30 21:42:55'),
(3, 'sale', 15, 16, '0000-00-00 00:00:00', 240.0000, NULL, '2014-05-30 21:41:20'),
(5, 'sale', 15, 14, '0000-00-00 00:00:00', 10000.0000, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE IF NOT EXISTS `userlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userlog_title` varchar(50) DEFAULT NULL,
  `userlog_desc` varchar(999) DEFAULT NULL,
  `userlog_priority` enum('high','medium','low') NOT NULL DEFAULT 'medium',
  `userlog_type` enum('forgetpassword') DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priority_index` (`userlog_priority`),
  KEY `type_index` (`userlog_type`),
  KEY `userlogs_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usermetas`
--

CREATE TABLE IF NOT EXISTS `usermetas` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) unsigned NOT NULL,
  `usermeta_cat` varchar(50) NOT NULL,
  `usermeta_name` varchar(100) NOT NULL,
  `usermeta_value` varchar(500) DEFAULT NULL,
  `usermeta_extra` varchar(500) DEFAULT NULL,
  `usermeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usermeta_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'use char(36) if i want use uuid',
  `user_type` enum('storeadmin','storeemployee','storesupplier','storecustomer','admin','user') DEFAULT 'user',
  `user_mobile` varchar(15) NOT NULL COMMENT 'Mobile',
  `user_pass` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Password',
  `user_email` varchar(50) DEFAULT NULL,
  `user_gender` enum('male','female') DEFAULT NULL COMMENT 'Gender',
  `user_nickname` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(50) DEFAULT NULL COMMENT 'First Name',
  `user_lastname` varchar(50) DEFAULT NULL COMMENT 'Last Name',
  `user_birthday` datetime DEFAULT NULL,
  `user_status` enum('active','awaiting','deactive','removed','filter') DEFAULT 'awaiting' COMMENT 'Status',
  `user_credit` enum('yes','no') DEFAULT 'no',
  `permission_id` smallint(5) unsigned DEFAULT NULL,
  `user_createdate` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE,
  UNIQUE KEY `email_unique` (`user_email`) USING BTREE,
  KEY `users_permissions_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `user_mobile`, `user_pass`, `user_email`, `user_gender`, `user_nickname`, `user_firstname`, `user_lastname`, `user_birthday`, `user_status`, `user_credit`, `permission_id`, `user_createdate`, `date_modified`) VALUES
(14, 'user', '+989357269758', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', 'eee2', 'male', 'J.Evazzadeh', 'Javad', 'Evazzadeh', NULL, 'active', 'no', 1, '0000-00-00 00:00:00', '2015-01-27 09:46:54'),
(15, 'storeadmin', '+989113334444', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', NULL, NULL, 'Test1', 'Test', NULL, NULL, 'awaiting', 'no', 1, '0000-00-00 00:00:00', '2015-01-27 09:46:52'),
(16, 'storeadmin', '+989357269750', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', 'aaa2', NULL, 'Test3', NULL, 'Test last', NULL, 'active', 'no', 1, '0000-00-00 00:00:00', '2015-01-27 09:46:50'),
(150, 'storeadmin', '+989357269790', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '0000-00-00 00:00:00', '2015-01-27 09:46:49'),
(190, 'storeadmin', '989357269759', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2015-01-25 04:52:07', NULL),
(191, 'storeadmin', '1234-238-9685', '$2y$07$943YcByRoEuIv730KaGvpetc.CYT2qoTANZrUFFwV0kpAbaCSkcIu', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2015-01-28 21:50:33', NULL),
(192, 'storeadmin', '1564-865-7965', '$2y$07$YhzlYzn3waKtDzwmml6G/OdRDDEbe4wraw3yoXPbLwQTbhZbreyAa', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2015-01-28 23:08:42', NULL),
(193, 'storeadmin', '143298935726975', '$2y$07$ghmWnyyCTbApe/B4edRhO.VKK.0OAv0jUl7S3xGJXO8TnChFGKeGO', NULL, NULL, NULL, NULL, NULL, NULL, 'awaiting', 'no', NULL, '2015-01-29 04:18:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `verification_type` enum('emailsignup','emailchangepass','emailrecovery','mobilesignup','mobilechangepass','mobilerecovery') NOT NULL,
  `verification_value` varchar(50) NOT NULL,
  `verification_code` varchar(32) NOT NULL,
  `verification_url` varchar(100) DEFAULT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `verification_verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `verification_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `verification_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_unique` (`verification_url`,`verification_value`) USING BTREE,
  KEY `verifications_users_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=468 ;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_type`, `verification_value`, `verification_code`, `verification_url`, `user_id`, `verification_verified`, `verification_status`, `verification_createdate`, `date_modified`) VALUES
(463, 'mobilesignup', '989357269759', '2255', NULL, 190, 'no', 'enable', '2015-01-25 04:52:07', '2015-01-25 01:48:46'),
(464, 'mobilerecovery', '989357269759', '6282', NULL, 190, 'no', 'expire', NULL, '2015-01-25 01:56:55'),
(465, 'mobilesignup', '1234-238-9685', '4293', NULL, 191, 'no', 'enable', '2015-01-28 21:50:33', NULL),
(466, 'mobilesignup', '1564-865-7965', '5947', NULL, 192, 'no', 'enable', '2015-01-28 23:08:42', NULL),
(467, 'mobilesignup', '1432989357269759', '7944', NULL, 193, 'no', 'enable', '2015-01-29 04:18:06', NULL);

--
-- Triggers `verifications`
--
DROP TRIGGER IF EXISTS `verification_AU_outline_update`;
DELIMITER //
CREATE TRIGGER `verification_AU_outline_update` AFTER UPDATE ON `verifications`
 FOR EACH ROW IF NEW.verification_verified <> OLD.verification_verified THEN
   if new.verification_verified = 'yes' then
       UPDATE users SET user_status = 'active' WHERE id = New.user_id;
   END IF;
END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_ip` int(10) unsigned NOT NULL COMMENT 'use the INET_ATON() and INET_NTOA() functions to return the IP address from its numeric value, and vice versa.',
  `visitor_url` varchar(255) NOT NULL,
  `visitor_agent` varchar(255) NOT NULL,
  `visitor_referer` varchar(255) DEFAULT NULL,
  `visitor_robot` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `visitor_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visitors_users_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_banks_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `accounts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `attachmentmetas`
--
ALTER TABLE `attachmentmetas`
  ADD CONSTRAINT `attachmentmetas_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_files_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `attachments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `comments_visitors_id` FOREIGN KEY (`Visitor_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_accounts_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `costs_costcats_id` FOREIGN KEY (`costcat_id`) REFERENCES `costcats` (`id`);

--
-- Constraints for table `errorlogs`
--
ALTER TABLE `errorlogs`
  ADD CONSTRAINT `errorlogs_errors_id` FOREIGN KEY (`errorlog_id`) REFERENCES `errors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `errorlogs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fileparts`
--
ALTER TABLE `fileparts`
  ADD CONSTRAINT `fileparts_files_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `funds`
--
ALTER TABLE `funds`
  ADD CONSTRAINT `funds_locations_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_users_idsender` FOREIGN KEY (`user_id_sender`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `papers_banks_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`);

--
-- Constraints for table `postmetas`
--
ALTER TABLE `postmetas`
  ADD CONSTRAINT `postmeta_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `productcats`
--
ALTER TABLE `productcats`
  ADD CONSTRAINT `productcats_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `productmetas`
--
ALTER TABLE `productmetas`
  ADD CONSTRAINT `productmetas_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `productprices`
--
ALTER TABLE `productprices`
  ADD CONSTRAINT `productprices_productmetas_id` FOREIGN KEY (`productmeta_id`) REFERENCES `productmetas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productprices_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_attachments_id` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_productcats_id` FOREIGN KEY (`productcat_id`) REFERENCES `productcats` (`id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_funds_id` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
  ADD CONSTRAINT `receipts_papers_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`),
  ADD CONSTRAINT `receipts_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `receipts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `receipts_users_idcustomer` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`id`);

--
-- Constraints for table `termusages`
--
ALTER TABLE `termusages`
  ADD CONSTRAINT `termusages_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `termusages_terms_id` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactiondetails`
--
ALTER TABLE `transactiondetails`
  ADD CONSTRAINT `transactiondetails_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transactiondetails_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
  ADD CONSTRAINT `transactionmetas_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_users_idcustomer` FOREIGN KEY (`user_id_customer`) REFERENCES `users` (`id`);

--
-- Constraints for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD CONSTRAINT `userlogs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `usermetas`
--
ALTER TABLE `usermetas`
  ADD CONSTRAINT `usermetas_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_permissions_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
