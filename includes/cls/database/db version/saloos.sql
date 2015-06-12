-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2015 at 10:20 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saloos`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `comment_author` varchar(50) DEFAULT NULL,
  `comment_email` varchar(100) DEFAULT NULL,
  `comment_url` varchar(100) DEFAULT NULL,
  `comment_content` varchar(999) NOT NULL DEFAULT '',
  `comment_status` enum('approved','unapproved','spam','deleted') NOT NULL DEFAULT 'unapproved',
  `comment_parent` smallint(5) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `visitor_id` bigint(20) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logitems`
--

CREATE TABLE IF NOT EXISTS `logitems` (
`id` smallint(5) unsigned NOT NULL,
  `logitem_title` varchar(100) NOT NULL,
  `logitem_desc` varchar(999) DEFAULT NULL,
  `logitem_priority` enum('critical','high','medium','low') NOT NULL DEFAULT 'medium',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logitems`
--

INSERT INTO `logitems` (`id`, `logitem_title`, `logitem_desc`, `logitem_priority`, `date_modified`) VALUES
(1, 'account/login', NULL, 'medium', NULL),
(2, 'account/signup', NULL, 'high', NULL),
(3, 'account/recovery', NULL, 'medium', NULL),
(4, 'account/change password', NULL, 'low', NULL),
(5, 'db/error', NULL, 'medium', NULL),
(6, 'php/error', NULL, 'high', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id` bigint(20) unsigned NOT NULL,
  `logitem_id` smallint(5) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `log_status` varchar(50) DEFAULT NULL,
  `log_createdate` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
`id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `option_cat` varchar(50) NOT NULL,
  `option_key` varchar(50) NOT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `option_extra` text,
  `option_status` enum('enable','disable','expire') NOT NULL DEFAULT 'enable',
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `user_id`, `option_cat`, `option_key`, `option_value`, `option_extra`, `option_status`, `date_modified`) VALUES
(1, NULL, 'global', 'email', 'info@ermile.com', NULL, '', NULL),
(2, NULL, 'global', 'auto_mail', 'no-reply@ermile.com', NULL, '', NULL),
(3, NULL, 'user_degree', 'under diploma', NULL, NULL, '', NULL),
(4, NULL, 'user_degree', 'diploma', NULL, NULL, '', NULL),
(5, NULL, 'user_degree', '2-year collage', NULL, NULL, '', NULL),
(6, NULL, 'user_degree', 'bachelor', NULL, NULL, '', NULL),
(7, NULL, 'user_degree', 'master', NULL, NULL, '', NULL),
(8, NULL, 'user_degree', 'doctorate', NULL, NULL, '', NULL),
(9, NULL, 'user_degree', 'religious', NULL, NULL, '', NULL),
(10, NULL, 'user_activity', 'employee', NULL, NULL, '', NULL),
(11, NULL, 'user_activity', 'housekeeper ', NULL, NULL, '', NULL),
(12, NULL, 'user_activity', 'free lance', NULL, NULL, '', NULL),
(13, NULL, 'user_activity', 'retired', NULL, NULL, '', NULL),
(14, NULL, 'user_activity', 'student', NULL, NULL, '', NULL),
(15, NULL, 'user_activity', 'unemployed', NULL, NULL, '', NULL),
(16, NULL, 'user_activity', 'seminary student', NULL, NULL, '', NULL),
(17, NULL, 'ships', 'post', NULL, NULL, '', NULL),
(18, NULL, 'ships', 'tipax', NULL, NULL, '', NULL),
(19, NULL, 'permission_id', '1', 'admin', NULL, '', NULL),
(20, NULL, 'permission_id', '2', 'editor', NULL, '', NULL),
(21, NULL, 'permission_id', '3', 'viewer', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `postmetas`
--

CREATE TABLE IF NOT EXISTS `postmetas` (
`id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `postmeta_cat` varchar(50) NOT NULL,
  `postmeta_key` varchar(100) NOT NULL,
  `postmeta_value` text,
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
  `post_title` varchar(100) NOT NULL,
  `post_slug` varchar(100) NOT NULL,
  `post_url` varchar(255) NOT NULL,
  `post_content` text,
  `post_excerpt` varchar(300) DEFAULT NULL,
  `post_type` varchar(50) NOT NULL DEFAULT 'post',
  `post_comment` enum('open','closed') DEFAULT NULL,
  `post_count` smallint(5) unsigned DEFAULT NULL,
  `post_status` enum('publish','draft','schedule','deleted','expire') NOT NULL DEFAULT 'draft',
  `post_parent` bigint(20) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_publishdate` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_language`, `post_title`, `post_slug`, `post_url`, `post_content`, `post_excerpt`, `post_type`, `post_comment`, `post_count`, `post_status`, `post_parent`, `user_id`, `post_publishdate`, `date_modified`) VALUES
(1, NULL, 'سلام', 'hello', 'news/hello', 'سلام. این نوشته تست را ویرایش یا حذف کنید', NULL, 'post', NULL, NULL, 'draft', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
`id` int(10) unsigned NOT NULL,
  `term_language` char(2) DEFAULT NULL,
  `term_type` varchar(50) NOT NULL DEFAULT 'tag',
  `term_title` varchar(50) NOT NULL,
  `term_slug` varchar(50) NOT NULL,
  `term_url` varchar(200) NOT NULL,
  `term_desc` text,
  `term_parent` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_language`, `term_type`, `term_title`, `term_slug`, `term_url`, `term_desc`, `term_parent`, `user_id`, `date_modified`) VALUES
(1, NULL, 'cat', 'news', 'news', 'news', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `termusages`
--

CREATE TABLE IF NOT EXISTS `termusages` (
  `term_id` int(10) unsigned NOT NULL,
  `termusage_id` bigint(20) unsigned NOT NULL,
  `termusage_foreign` enum('posts','products','attachments','comments') DEFAULT NULL,
  `termusage_order` smallint(5) unsigned DEFAULT NULL
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
  `user_permission` smallint(5) unsigned DEFAULT NULL,
  `user_createdate` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_mobile`, `user_email`, `user_pass`, `user_displayname`, `user_status`, `user_permission`, `user_createdate`, `date_modified`) VALUES
(1, '989357269759', 'J.Evazzadeh@gmail.com', '$2y$07$9wj8/jDeQKyY0t0IcUf.xOEy98uf6BaSS7Tg28swrKUDxdKzUVfsy', 'Javad Evazzadeh', 'active', 1, '2015-01-01 00:00:00', NULL),
(2, '989356032043', 'itb.baravak@gmail.com', '$2y$07$ZRUphEsEn9bK8inKBfYt.efVoZDgBaoNfZz0uVRqRGvH9.che.Bqq', 'Hasan Salehi', 'active', 1, '2015-01-02 00:00:00', NULL),
(3, '989120001111', NULL, '$2y$07$QUTZcP7LhWtVfHGINrwSy.VjV2WQN518Z.v16cRb7xEX.kwKj0l06', 'Test 1', 'awaiting', 1, '2015-02-01 00:00:00', NULL),
(4, '989120002222', NULL, '$2y$07$QT5xKQWR8LxTSgDSmK2Wg.b7pK/6slmmFTTqTPq3GGKlj1OpY4gOC', 'Test 2', 'awaiting', 2, '2015-02-01 00:00:00', NULL),
(5, '989120003333', NULL, '$2y$07$QT5xKQWR8LxTSgDSmK2Wg.b7pK/6slmmFTTqTPq3GGKlj1OpY4gOC', 'Test 3', 'awaiting', 3, '2015-02-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
`id` int(10) unsigned NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
`id` bigint(20) unsigned NOT NULL,
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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `comments_posts_id` (`post_id`) USING BTREE, ADD KEY `comments_users_id` (`user_id`) USING BTREE, ADD KEY `comments_visitors_id` (`visitor_id`);

--
-- Indexes for table `logitems`
--
ALTER TABLE `logitems`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id`), ADD KEY `logs_users_id` (`user_id`) USING BTREE, ADD KEY `logs_logitems_id` (`logitem_id`) USING BTREE;

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`), ADD KEY `status_index` (`notification_status`), ADD KEY `notifications_users_idsender` (`user_idsender`) USING BTREE, ADD KEY `notifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cat+key+value` (`option_cat`,`option_key`,`option_value`) USING BTREE, ADD KEY `options_users_id` (`user_id`);

--
-- Indexes for table `postmetas`
--
ALTER TABLE `postmetas`
 ADD PRIMARY KEY (`id`), ADD KEY `postmeta_posts_id` (`post_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url_unique` (`post_url`), ADD KEY `posts_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `termurl_unique` (`term_url`), ADD KEY `terms_users_id` (`user_id`);

--
-- Indexes for table `termusages`
--
ALTER TABLE `termusages`
 ADD UNIQUE KEY `term+type+object_unique` (`term_id`,`termusage_id`,`termusage_foreign`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mobile_unique` (`user_mobile`) USING BTREE, ADD UNIQUE KEY `email_unique` (`user_email`) USING BTREE;

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code_unique` (`verification_url`,`verification_value`) USING BTREE, ADD KEY `verifications_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
 ADD PRIMARY KEY (`id`), ADD KEY `visitors_users_id` (`user_id`), ADD KEY `visitorip_index` (`visitor_ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logitems`
--
ALTER TABLE `logitems`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `postmetas`
--
ALTER TABLE `postmetas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=404;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `comments_visitors_id` FOREIGN KEY (`Visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
ADD CONSTRAINT `logs_logitems_id` FOREIGN KEY (`logitem_id`) REFERENCES `logitems` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `logs_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
ADD CONSTRAINT `notifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
ADD CONSTRAINT `options_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postmetas`
--
ALTER TABLE `postmetas`
ADD CONSTRAINT `postmeta_posts_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
ADD CONSTRAINT `terms_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `termusages`
--
ALTER TABLE `termusages`
ADD CONSTRAINT `termusages_terms_id` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
ADD CONSTRAINT `verifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
ADD CONSTRAINT `visitors_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
