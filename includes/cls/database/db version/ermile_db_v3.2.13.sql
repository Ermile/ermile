-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2015 at 09:28 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
`id` smallint(5) unsigned NOT NULL,
  `account_title` varchar(50) NOT NULL,
  `account_slug` varchar(50) NOT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `account_branch` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_card` varchar(30) DEFAULT NULL,
  `account_primarybalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `account_desc` varchar(200) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_title`, `account_slug`, `bank_id`, `account_branch`, `account_number`, `account_card`, `account_primarybalance`, `account_desc`, `user_id`, `date_modified`) VALUES
(10, 'test2', 'test2', 1, 'test', '123', '456', '0.0000', NULL, 150, '2015-02-11 14:46:12'),
(11, 'a1', 'a1', 100, NULL, '23', NULL, '500.0000', NULL, 150, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
`id` smallint(5) unsigned NOT NULL,
  `bank_title` varchar(50) NOT NULL,
  `bank_slug` varchar(50) NOT NULL,
  `bank_website` varchar(50) DEFAULT NULL,
  `bank_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

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
`id` int(10) unsigned NOT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `comment_author` varchar(50) DEFAULT NULL,
  `comment_email` varchar(100) DEFAULT NULL,
  `comment_url` varchar(100) DEFAULT NULL,
  `comment_content` varchar(999) NOT NULL DEFAULT '',
  `comment_status` enum('approved','unapproved','spam','deleted') NOT NULL DEFAULT 'unapproved',
  `comment_parent` smallint(5) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `Visitor_id` int(10) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `costcats`
--

CREATE TABLE IF NOT EXISTS `costcats` (
`id` smallint(5) unsigned NOT NULL,
  `costcat_title` varchar(50) NOT NULL,
  `costcat_slug` varchar(50) NOT NULL,
  `costcat_desc` varchar(200) DEFAULT NULL,
  `costcat_parent` smallint(5) DEFAULT NULL,
  `costcat_order` smallint(5) DEFAULT NULL,
  `costcat_type` enum('income','outcome') DEFAULT NULL,
  `costcat_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
`id` smallint(5) unsigned NOT NULL,
  `cost_title` varchar(50) NOT NULL,
  `cost_price` decimal(13,4) NOT NULL,
  `costcat_id` smallint(5) unsigned NOT NULL,
  `account_id` smallint(5) unsigned NOT NULL,
  `cost_date` datetime NOT NULL,
  `cost_desc` varchar(200) DEFAULT NULL,
  `cost_type` enum('income','outcome') NOT NULL DEFAULT 'outcome',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `errorlogs`
--

CREATE TABLE IF NOT EXISTS `errorlogs` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `errorlog_id` smallint(5) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` smallint(5) unsigned NOT NULL,
  `error_title` varchar(100) NOT NULL,
  `error_solution` varchar(999) DEFAULT NULL,
  `error_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fileparts`
--

CREATE TABLE IF NOT EXISTS `fileparts` (
`id` int(10) unsigned NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `filepart_part` smallint(5) unsigned NOT NULL,
  `filepart_code` varchar(64) DEFAULT NULL,
  `filepart_status` enum('awaiting','start','inprogress','appended','failed','finished') NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(10) unsigned NOT NULL,
  `file_server` smallint(5) unsigned NOT NULL,
  `file_folder` smallint(5) unsigned NOT NULL,
  `file_code` varchar(64) DEFAULT NULL,
  `file_size` float(12,0) NOT NULL,
  `file_status` enum('inprogress','ready','temp') NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE IF NOT EXISTS `funds` (
`id` smallint(5) unsigned NOT NULL,
  `fund_title` varchar(100) NOT NULL,
  `fund_slug` varchar(100) NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `fund_initialbalance` decimal(14,4) NOT NULL DEFAULT '0.0000',
  `fund_desc` varchar(200) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_title`, `fund_slug`, `location_id`, `fund_initialbalance`, `fund_desc`, `date_modified`) VALUES
(2, 'Main', 'main', 1, '0.0000', NULL, '0000-00-00 00:00:00'),
(3, 'werew', 'wqrwer', 1, '9999999999.9999', NULL, '0000-00-00 00:00:00');

--
-- Triggers `funds`
--
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
`id` smallint(5) unsigned NOT NULL,
  `location_title` varchar(100) NOT NULL,
  `location_slug` varchar(100) NOT NULL,
  `location_desc` varchar(200) DEFAULT NULL,
  `location_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_title`, `location_slug`, `location_desc`, `location_status`, `date_modified`) VALUES
(1, 'Main Location', 'main', NULL, 'enable', '2014-11-07 18:21:17'),
(2, 'test', 't', NULL, 'enable', '0000-00-00 00:00:00');

--
-- Triggers `locations`
--
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
`id` bigint(20) unsigned NOT NULL,
  `user_idsender` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `notification_title` varchar(50) NOT NULL,
  `notification_content` varchar(200) DEFAULT NULL,
  `notification_url` varchar(100) DEFAULT NULL,
  `notification_status` enum('read','unread','expire') NOT NULL DEFAULT 'unread',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` smallint(5) unsigned NOT NULL,
  `option_cat` varchar(50) NOT NULL,
  `option_key` varchar(50) NOT NULL,
  `option_value` varchar(200) DEFAULT NULL,
  `option_extra` varchar(400) DEFAULT NULL,
  `option_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_cat`, `option_key`, `option_value`, `option_extra`, `option_status`, `date_modified`) VALUES
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
`id` int(10) unsigned NOT NULL,
  `paper_type` varchar(50) DEFAULT NULL,
  `paper_number` varchar(20) DEFAULT NULL,
  `paper_date` datetime DEFAULT NULL,
  `paper_price` decimal(13,4) DEFAULT NULL,
  `bank_id` smallint(5) unsigned NOT NULL,
  `paper_holder` varchar(100) DEFAULT NULL,
  `paper_desc` varchar(200) DEFAULT NULL,
  `paper_status` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `paper_type`, `paper_number`, `paper_date`, `paper_price`, `bank_id`, `paper_holder`, `paper_desc`, `paper_status`, `date_modified`) VALUES
(1, NULL, '123', NULL, '500.0000', 1, NULL, NULL, NULL, '0000-00-00 00:00:00');

--
-- Triggers `papers`
--
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
-- Table structure for table `postmetas`
--

CREATE TABLE IF NOT EXISTS `postmetas` (
  `id` int(10) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `postmeta_cat` varchar(50) NOT NULL,
  `postmeta_key` varchar(100) NOT NULL,
  `postmeta_value` varchar(999) DEFAULT NULL,
  `postmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` bigint(20) unsigned NOT NULL,
  `post_language` char(2) DEFAULT NULL,
  `post_cat` varchar(50) DEFAULT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_slug` varchar(100) NOT NULL,
  `post_content` text,
  `post_type` varchar(50) NOT NULL DEFAULT 'post',
  `post_url` text,
  `post_comment` enum('open','closed','','') NOT NULL DEFAULT 'open',
  `post_count` smallint(5) unsigned DEFAULT NULL,
  `post_status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `post_parent` smallint(5) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_publishdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_language`, `post_cat`, `post_title`, `post_slug`, `post_content`, `post_type`, `post_url`, `post_comment`, `post_count`, `post_status`, `post_parent`, `user_id`, `post_publishdate`, `date_modified`) VALUES
(1, 'fa', NULL, 'test1', 'page1', 'salam. in test 1 ast', 'page', NULL, 'open', NULL, 'publish', NULL, 150, NULL, '2015-02-11 14:46:49'),
(2, 'en', 'test', 'post1', 'post1', 'salam. post1 ast', 'post', NULL, 'open', NULL, 'publish', NULL, 150, NULL, '2015-02-11 14:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `productmetas`
--

CREATE TABLE IF NOT EXISTS `productmetas` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `productmeta_cat` varchar(50) NOT NULL,
  `productmeta_key` varchar(100) NOT NULL,
  `productmeta_value` varchar(999) DEFAULT NULL,
  `productmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productmetas`
--

INSERT INTO `productmetas` (`id`, `product_id`, `productmeta_cat`, `productmeta_key`, `productmeta_value`, `productmeta_status`, `date_modified`) VALUES
(21, 1, 'price_white', 'product_price', '600', 'enable', '2014-11-07 16:49:50'),
(22, 1, 'price_white', 'product_buy_price', '5000', 'enable', '2014-11-07 16:49:51'),
(39, 1, 'price1', 'product_vat', '11', 'enable', '2014-11-07 16:33:34'),
(73, 1, 'price1', 'product_discount', '20', 'enable', '2014-11-07 16:49:52');

--
-- Triggers `productmetas`
--
DELIMITER //
CREATE TRIGGER `ProductMeta_AI_outline_copy` AFTER INSERT ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_key = "product_buyprice" or
      New.productmeta_key = "product_price"         or
      New.productmeta_key = "product_discount"  or
      New.productmeta_key = "product_vat"
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


    IF New.productmeta_key = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_vat"
    THEN
      UPDATE productprices SET productprice_vat = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

  End if;
End if
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `ProductMeta_AU_outline_copy2` AFTER UPDATE ON `productmetas`
 FOR EACH ROW IF New.productmeta_cat like 'price%'
Then
  # if price cat like price1 or price2 or ...

  IF New.productmeta_key = "product_buyprice" or
      New.productmeta_key = "product_price"         or
      New.productmeta_key = "product_discount"  or
      New.productmeta_key = "product_vat"
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


    IF New.productmeta_key = "product_buyprice"
    THEN
      UPDATE productprices SET productprice_buyprice = NEW.productmeta_value 
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_price"
    THEN
      UPDATE productprices SET productprice_price = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_discount"
    THEN
      UPDATE productprices SET productprice_discount = NEW.productmeta_value
        WHERE  product_id = NEW.product_id and productprice_cat = New.productmeta_cat and productprice_enddate is null;
    End if;

    IF New.productmeta_key = "product_vat"
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
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `productmeta_id` int(10) unsigned DEFAULT NULL,
  `productprice_cat` varchar(50) DEFAULT NULL,
  `productprice_startdate` datetime NOT NULL,
  `productprice_enddate` datetime DEFAULT NULL,
  `productprice_buyprice` decimal(13,4) DEFAULT NULL,
  `productprice_price` decimal(13,4) DEFAULT NULL,
  `productprice_discount` decimal(13,4) DEFAULT NULL,
  `productprice_vat` decimal(6,4) DEFAULT NULL,
  `productprice_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(10) unsigned NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_slug` varchar(50) NOT NULL,
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
  `product_service` enum('yes','no') NOT NULL DEFAULT 'no',
  `product_sellin` enum('store','online','both') NOT NULL DEFAULT 'both',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_slug`, `product_barcode`, `product_barcode2`, `product_buyprice`, `product_price`, `product_discount`, `product_vat`, `product_initialbalance`, `product_mininventory`, `product_status`, `product_sold`, `product_stock`, `product_carton`, `product_service`, `product_sellin`, `date_modified`) VALUES
(1, 'aa', 'aa', NULL, NULL, '890.0000', '960.0000', '10.0000', '2.0000', 0, NULL, 'unset', 5, NULL, NULL, 'yes', 'both', '2014-11-07 14:42:53'),
(2, 'bb', 'bb', NULL, NULL, NULL, '400.0000', '0.0000', NULL, 0, NULL, 'unset', 0, 20, NULL, 'yes', 'both', '2014-11-07 14:43:31'),
(3, 'cc', 'cc', NULL, NULL, NULL, '0.0000', '0.0000', '1.0000', 0, NULL, 'unset', 90, 40, NULL, 'yes', 'both', '2014-06-12 08:56:25'),
(4, 'dd', 'dd', NULL, NULL, '90.0000', '200.0000', '10.0000', NULL, 0, NULL, 'unset', 8, 42, NULL, 'yes', 'both', '2014-05-30 22:01:45'),
(5, 'ee', 'ee', NULL, NULL, '100.0000', '120.0000', '5.0000', NULL, 0, NULL, 'unset', 0, 50, NULL, 'yes', 'both', '2014-05-30 21:42:55');

--
-- Triggers `products`
--
DELIMITER //
CREATE TRIGGER `products_AI_outline_copy` AFTER INSERT ON `products`
 FOR EACH ROW INSERT INTO productprices
    (product_id, productprice_startdate, productprice_buyprice, productprice_price,  productprice_discount, productprice_vat) 
    
    VALUES(NEW.id,  NOW(), NEW.product_buyprice, new.product_price, new.product_discount, new.product_vat)
//
DELIMITER ;
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
`id` int(10) unsigned NOT NULL,
  `receipt_code` varchar(30) DEFAULT NULL,
  `receipt_type` enum('income','outcome') DEFAULT 'income',
  `receipt_price` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `receipt_date` datetime NOT NULL,
  `paper_id` int(10) unsigned DEFAULT NULL,
  `receipt_paperdate` datetime DEFAULT NULL,
  `receipt_paperstatus` enum('pass','recovery','fail','lost','block','delete','inprogress') DEFAULT NULL,
  `receipt_desc` varchar(200) DEFAULT NULL,
  `transaction_id` int(10) unsigned DEFAULT NULL,
  `fund_id` smallint(5) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_idcustomer` int(10) unsigned NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `receipt_code`, `receipt_type`, `receipt_price`, `receipt_date`, `paper_id`, `receipt_paperdate`, `receipt_paperstatus`, `receipt_desc`, `transaction_id`, `fund_id`, `user_id`, `user_idcustomer`, `date_modified`) VALUES
(6, '123', 'income', '0.0000', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 2, 150, 150, '2015-02-11 14:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `smss`
--

CREATE TABLE IF NOT EXISTS `smss` (
`id` int(10) unsigned NOT NULL,
  `sms_from` varchar(15) DEFAULT NULL,
  `sms_to` varchar(15) DEFAULT NULL,
  `sms_message` varchar(255) DEFAULT NULL,
  `sms_messageid` int(10) unsigned DEFAULT NULL,
  `sms_deliverystatus` tinyint(4) unsigned DEFAULT NULL,
  `sms_method` enum('post','get') NOT NULL DEFAULT 'post',
  `sms_type` enum('receive','delivery') NOT NULL DEFAULT 'delivery',
  `sms_createdate` datetime NOT NULL,
  `sms_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
`id` int(10) unsigned NOT NULL,
  `term_language` char(2) DEFAULT NULL,
  `term_cat` varchar(50) NOT NULL,
  `term_title` varchar(50) NOT NULL,
  `term_slug` varchar(50) NOT NULL,
  `term_desc` text NOT NULL,
  `term_parent` int(10) unsigned DEFAULT NULL,
  `term_count` smallint(5) unsigned DEFAULT NULL,
  `term_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_language`, `term_cat`, `term_title`, `term_slug`, `term_desc`, `term_parent`, `term_count`, `term_status`, `date_modified`) VALUES
(1, NULL, '', 'news', 'news', '', NULL, NULL, 'enable', '0000-00-00 00:00:00'),
(5, NULL, '', 'test', 'test', 't', NULL, NULL, 'enable', '2015-01-18 13:33:13'),
(6, NULL, '', 'news2', 'news2', 'news 2', 1, NULL, 'enable', '2015-01-18 15:45:20'),
(7, NULL, '', 'tag1', 'tag1', '', NULL, NULL, 'enable', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE IF NOT EXISTS `termusages` (
  `term_id` int(10) unsigned NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL,
  `termusage_type` enum('posts','products','attachments','comments') DEFAULT NULL,
  `termusage_order` smallint(5) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetails`
--

CREATE TABLE IF NOT EXISTS `transactiondetails` (
  `transactiondetail_row` smallint(5) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `transactiondetail_quantity` int(10) NOT NULL DEFAULT '0',
  `transactiondetail_price` decimal(13,4) NOT NULL,
  `transactiondetail_discount` decimal(13,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactiondetails`
--

INSERT INTO `transactiondetails` (`transactiondetail_row`, `transaction_id`, `product_id`, `transactiondetail_quantity`, `transactiondetail_price`, `transactiondetail_discount`) VALUES
(NULL, 2, 1, 20, '0.0000', NULL),
(NULL, 2, 2, 20, '0.0000', NULL),
(NULL, 2, 5, 1, '50.0000', NULL),
(NULL, 3, 2, 1, '100.0000', NULL);

--
-- Triggers `transactiondetails`
--
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
`id` int(10) unsigned NOT NULL,
  `transaction_id` int(10) unsigned NOT NULL,
  `transactionmeta_cat` varchar(50) NOT NULL,
  `transactionmeta_key` varchar(100) NOT NULL,
  `transactionmeta_value` varchar(200) DEFAULT NULL,
  `transactionmeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`id` int(10) unsigned NOT NULL,
  `transaction_type` enum('sale','purchase','customertostore','storetocompany','anbargardani','install','repair','chqeuebackfail') NOT NULL DEFAULT 'sale',
  `user_id` int(10) unsigned NOT NULL,
  `user_idcustomer` int(10) unsigned NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_sum` decimal(13,4) NOT NULL,
  `transaction_remained` decimal(13,4) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type`, `user_id`, `user_idcustomer`, `transaction_date`, `transaction_sum`, `transaction_remained`, `date_modified`) VALUES
(2, 'sale', 15, 150, '0000-00-00 00:00:00', '50.0000', NULL, '2015-02-11 14:48:20'),
(3, 'sale', 15, 150, '0000-00-00 00:00:00', '240.0000', NULL, '2015-02-11 14:48:24'),
(5, 'sale', 15, 150, '0000-00-00 00:00:00', '10000.0000', NULL, '2015-02-11 14:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE IF NOT EXISTS `userlogs` (
`id` bigint(20) unsigned NOT NULL,
  `userlog_title` varchar(50) DEFAULT NULL,
  `userlog_desc` varchar(999) DEFAULT NULL,
  `userlog_priority` enum('high','medium','low') NOT NULL DEFAULT 'medium',
  `userlog_type` enum('forgetpassword') DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usermetas`
--

CREATE TABLE IF NOT EXISTS `usermetas` (
`id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `usermeta_cat` varchar(50) NOT NULL,
  `usermeta_key` varchar(100) NOT NULL,
  `usermeta_value` varchar(500) DEFAULT NULL,
  `usermeta_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_pass` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_displayname` varchar(50) DEFAULT NULL,
  `user_status` enum('active','awaiting','deactive','removed','filter') DEFAULT 'awaiting',
  `permission_id` smallint(5) unsigned DEFAULT NULL,
  `user_createdate` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_mobile`, `user_email`, `user_pass`, `user_displayname`, `user_status`, `permission_id`, `user_createdate`, `date_modified`) VALUES
(15, '989356032043', NULL, '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', 'Hasan', 'active', 1, '0000-00-00 00:00:00', NULL),
(150, '989199840989', NULL, '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', 'Mahdi', 'active', 1, '0000-00-00 00:00:00', NULL),
(190, '989357269759', NULL, '$2y$07$9wj8/jDeQKyY0t0IcUf.xOEy98uf6BaSS7Tg28swrKUDxdKzUVfsy', 'javad', 'active', 1, '2015-01-25 04:52:07', '2015-02-25 01:19:43'),
(191, '989357269242', NULL, '$2y$07$csWDOaZJcBVPaTilCz/LbutO5HqBV72YW3HBAbxlvMm50SlzRtQ0W', NULL, 'awaiting', NULL, '2015-02-24 11:59:03', NULL),
(192, '989120001111', NULL, '$2y$07$QUTZcP7LhWtVfHGINrwSy.VjV2WQN518Z.v16cRb7xEX.kwKj0l06', NULL, 'awaiting', 1, '2015-02-25 02:08:40', '2015-02-25 21:24:06'),
(193, '989120002222', NULL, '$2y$07$QT5xKQWR8LxTSgDSmK2Wg.b7pK/6slmmFTTqTPq3GGKlj1OpY4gOC', NULL, 'awaiting', 2, '2015-02-25 02:13:26', '2015-02-25 21:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
`id` smallint(5) unsigned NOT NULL,
  `verification_type` enum('emailsignup','emailchangepass','emailrecovery','mobilesignup','mobilechangepass','mobilerecovery') NOT NULL,
  `verification_value` varchar(50) NOT NULL,
  `verification_code` varchar(32) NOT NULL,
  `verification_url` varchar(100) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `verification_verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `verification_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `verification_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `verifications`
--
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
`id` int(10) unsigned NOT NULL,
  `visitor_ip` int(10) unsigned NOT NULL,
  `visitor_url` varchar(255) NOT NULL,
  `visitor_agent` varchar(255) NOT NULL,
  `visitor_referer` varchar(255) DEFAULT NULL,
  `visitor_robot` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_id` int(10) unsigned DEFAULT NULL,
  `visitor_createdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`account_slug`), ADD UNIQUE KEY `cardnumber_unique` (`account_card`), ADD UNIQUE KEY `accountnumber_unique` (`account_number`), ADD KEY `bank_id` (`bank_id`), ADD KEY `accounts_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`bank_slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `comments_posts_id` (`post_id`) USING BTREE, ADD KEY `comments_users_id` (`user_id`) USING BTREE, ADD KEY `comments_products_id` (`product_id`) USING BTREE, ADD KEY `comments_visitors_id` (`Visitor_id`);

--
-- Indexes for table `costcats`
--
ALTER TABLE `costcats`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`costcat_slug`), ADD KEY `type` (`costcat_type`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
 ADD PRIMARY KEY (`id`), ADD KEY `type_index` (`cost_type`) USING BTREE, ADD KEY `costs_costcats_id` (`costcat_id`) USING BTREE, ADD KEY `costs_accounts_id` (`account_id`) USING BTREE;

--
-- Indexes for table `errorlogs`
--
ALTER TABLE `errorlogs`
 ADD PRIMARY KEY (`id`), ADD KEY `errorlogs_users_id` (`user_id`) USING BTREE, ADD KEY `errorlogs_errors_id` (`errorlog_id`) USING BTREE;

--
-- Indexes for table `errors`
--
ALTER TABLE `errors`
 ADD PRIMARY KEY (`id`), ADD KEY `priotity_index` (`error_priority`);

--
-- Indexes for table `fileparts`
--
ALTER TABLE `fileparts`
 ADD PRIMARY KEY (`id`), ADD KEY `fileparts_files_id` (`file_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`fund_slug`), ADD KEY `funds_locations_id` (`location_id`) USING BTREE;

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`location_slug`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`), ADD KEY `status_index` (`notification_status`), ADD KEY `notifications_users_idsender` (`user_idsender`) USING BTREE, ADD KEY `notifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cat+name+value` (`option_cat`,`option_key`,`option_value`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id+bankid_unique` (`id`,`bank_id`) USING BTREE, ADD KEY `bank_id` (`bank_id`) USING BTREE;

--
-- Indexes for table `postmetas`
--
ALTER TABLE `postmetas`
 ADD PRIMARY KEY (`id`), ADD KEY `postmeta_posts_id` (`post_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug+catslug_unique` (`post_cat`,`post_slug`), ADD KEY `posts_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `productmetas`
--
ALTER TABLE `productmetas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `product+cat+name_unique` (`product_id`,`productmeta_cat`,`productmeta_key`) USING BTREE;

--
-- Indexes for table `productprices`
--
ALTER TABLE `productprices`
 ADD PRIMARY KEY (`id`), ADD KEY `startdate` (`productprice_startdate`), ADD KEY `enddate` (`productprice_enddate`), ADD KEY `productprices_products_id` (`product_id`) USING BTREE, ADD KEY `productprices_productmetas_id` (`productmeta_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`product_slug`) USING BTREE, ADD UNIQUE KEY `barcode_unique` (`product_barcode`) USING BTREE, ADD UNIQUE KEY `barcode2_unique` (`product_barcode2`) USING BTREE;

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `receipts_papers_id` (`paper_id`) USING BTREE, ADD KEY `receipts_transactions_id` (`transaction_id`) USING BTREE, ADD KEY `receipts_funds_id` (`fund_id`) USING BTREE, ADD KEY `receipts_users_id` (`user_id`), ADD KEY `receipts_users_idcustomer` (`user_idcustomer`);

--
-- Indexes for table `smss`
--
ALTER TABLE `smss`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_unique` (`term_slug`) USING BTREE;

--
-- Indexes for table `termusages`
--
ALTER TABLE `termusages`
 ADD UNIQUE KEY `term+type+object_unique` (`term_id`,`object_id`,`termusage_type`) USING BTREE;

--
-- Indexes for table `transactiondetails`
--
ALTER TABLE `transactiondetails`
 ADD UNIQUE KEY `sale+product_unique` (`transaction_id`,`product_id`), ADD KEY `transactiondetails_products_id` (`product_id`) USING BTREE;

--
-- Indexes for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
 ADD PRIMARY KEY (`id`), ADD KEY `transactionmetas_transactions_id` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`), ADD KEY `transactions_users_id` (`user_id`) USING BTREE, ADD KEY `transactions_users_idcustomer` (`user_idcustomer`) USING BTREE;

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
 ADD PRIMARY KEY (`id`), ADD KEY `priority_index` (`userlog_priority`), ADD KEY `type_index` (`userlog_type`), ADD KEY `userlogs_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `usermetas`
--
ALTER TABLE `usermetas`
 ADD PRIMARY KEY (`id`), ADD KEY `usermeta_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE, ADD UNIQUE KEY `email_unique` (`user_email`) USING BTREE, ADD KEY `users_permissions_id` (`permission_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code_unique` (`verification_url`,`verification_value`) USING BTREE, ADD KEY `verifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
 ADD PRIMARY KEY (`id`), ADD KEY `visitors_users_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costcats`
--
ALTER TABLE `costcats`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `errorlogs`
--
ALTER TABLE `errorlogs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fileparts`
--
ALTER TABLE `fileparts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `productmetas`
--
ALTER TABLE `productmetas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `productprices`
--
ALTER TABLE `productprices`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `smss`
--
ALTER TABLE `smss`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transactionmetas`
--
ALTER TABLE `transactionmetas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usermetas`
--
ALTER TABLE `usermetas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `notifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
ADD CONSTRAINT `receipts_funds_id` FOREIGN KEY (`fund_id`) REFERENCES `funds` (`id`),
ADD CONSTRAINT `receipts_papers_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`),
ADD CONSTRAINT `receipts_transactions_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
ADD CONSTRAINT `receipts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `termusages`
--
ALTER TABLE `termusages`
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
ADD CONSTRAINT `transactions_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
