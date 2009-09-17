/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : cpbgroup_structure

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2009-09-16 11:48:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `blocks`
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL auto_increment,
  `datafeed_id` int(11) NOT NULL,
  `uniqueIdentifier` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of blocks
-- ----------------------------

-- ----------------------------
-- Table structure for `datafeeds`
-- ----------------------------
DROP TABLE IF EXISTS `datafeeds`;
CREATE TABLE `datafeeds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `contentType` enum('url','plaintext','html','xml') NOT NULL default 'url',
  `updateFreqInMinutes` int(11) NOT NULL default '0' COMMENT '0 means never update automatically',
  `defaultTags` varchar(255) NOT NULL COMMENT 'Empty uses all search tags, quoted comma delimited list of tag IDs will be automatically applied',
  `authType` enum('none','htauth','apikey') NOT NULL default 'none',
  `authUserName` varchar(255) NOT NULL,
  `authPassword` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `crawlerStatus` enum('none','crawling') NOT NULL default 'none',
  `sources` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datafeeds
-- ----------------------------
INSERT INTO `datafeeds` VALUES ('1', 'twitter', 'plaintext', '2', '', 'none', '', '', '2009-06-02 04:55:54', '2009-06-17 14:18:37', 'none', '');
INSERT INTO `datafeeds` VALUES ('2', 'youtube', 'url', '100', '', 'none', '', '', '2009-06-08 18:49:06', '2009-06-17 14:14:23', 'none', '');
INSERT INTO `datafeeds` VALUES ('3', 'news', 'url', '3', '', 'none', '', '', '2009-06-11 15:37:54', '2009-06-17 14:18:59', 'none', '');
INSERT INTO `datafeeds` VALUES ('4', 'blogs', 'url', '5', '', 'none', '', '', '2009-06-11 20:41:24', '2009-06-17 14:19:36', 'none', '');
INSERT INTO `datafeeds` VALUES ('5', 'bubble', 'url', '1', '', 'none', '', '', '2009-06-16 15:35:40', '2009-06-16 15:35:44', 'none', '');
INSERT INTO `datafeeds` VALUES ('6', 'quicktwitter', 'url', '1', '', 'none', '', '', '2009-06-22 11:16:58', '2009-06-22 11:17:02', 'none', '');
INSERT INTO `datafeeds` VALUES ('7', 'bingnews', 'url', '3', '', 'none', '', '', '2009-07-01 12:57:05', '2009-07-01 12:57:10', 'none', '');
INSERT INTO `datafeeds` VALUES ('8', 'articles', 'url', '6', '', 'none', '', '', '2009-08-27 10:56:54', '2009-08-27 10:56:58', 'none', '3,4');
INSERT INTO `datafeeds` VALUES ('9', 'jobs', 'url', '100', '', 'none', '', '', '2009-08-27 12:30:56', '2009-08-27 12:31:00', 'none', '');
INSERT INTO `datafeeds` VALUES ('10', 'queue', 'url', '100', '', 'none', '', '', '2009-08-31 16:23:39', '2009-08-31 16:23:43', 'none', '2');
INSERT INTO `datafeeds` VALUES ('11', 'featured', 'url', '1', '', 'none', '', '', '2009-08-31 16:24:17', '2009-08-31 16:24:21', 'none', '5');

-- ----------------------------
-- Table structure for `datarows`
-- ----------------------------
DROP TABLE IF EXISTS `datarows`;
CREATE TABLE `datarows` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `datafeed_id` int(11) NOT NULL,
  `topicName` varchar(255) NOT NULL COMMENT 'name from clients',
  `published` datetime NOT NULL,
  `articleId` varchar(255) NOT NULL COMMENT 'unique id tag value',
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `rating` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tags` varchar(255) NOT NULL COMMENT 'tags provided from the datasource',
  `cpbTags` varchar(255) NOT NULL COMMENT 'quoted, spaced tags associated by our crawler',
  `flagged` enum('false','true') NOT NULL default 'false',
  `blocked` enum('true','false') NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `ArticleId_index` (`articleId`)
) ENGINE=MyISAM AUTO_INCREMENT=428420 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of datarows
-- ----------------------------
INSERT INTO `datarows` VALUES ('428419', '1', 'crispin porter', '2009-09-15 21:40:58', 'http://twitter_url1', 'sample twit 1', 'sample twit 1', '/img/failwhale.jpg', 'twitterUser1 (Twitter User 1)', '0', '2009-09-15 21:41:16', '2009-09-15 21:41:16', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('428070', '1', 'crispin porter', '2009-09-15 20:29:27', 'http://twitter_url2', 'sample twit 2', 'sample twit 2', '/img/failwhale.jpg', 'twitterUser2 (Twitter User 2)', '0', '2009-09-15 20:30:22', '2009-09-15 20:30:22', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('427874', '1', 'crispin porter', '2009-09-15 19:50:41', 'http://twitter_url3', 'sample twit 3', 'sample twit 3', '/img/failwhale.jpg', 'twitterUser3 (Twitter User 3)', '0', '2009-09-15 19:57:46', '2009-09-15 19:57:46', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('427875', '1', 'crispin porter', '2009-09-15 19:50:11', 'http://twitter_url4', 'sample twit 4', 'sample twit 4', '/img/failwhale.jpg', 'twitterUser4 (Twitter User 4)', '0', '2009-09-15 19:57:46', '2009-09-15 19:57:46', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('317933', '2', 'crispin porter', '2008-02-05 11:18:21', 'WWzGB3QBRUk', 'Alex Bogusky on creating great ideas', 'http://www.youtube.com/v/WWzGB3QBRUk&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/WWzGB3QBRUk/2.jpg', 'JanDrewniak', '0', '2009-07-22 16:06:45', '2009-07-22 16:06:45', '\"bogusky -RT -CPBShredSchool\"', '\"bogusky -RT -CPBShredSchool\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('427716', '1', 'crispin porter', '2009-09-15 19:17:38', 'http://twitter_url5', 'sample twit 5', 'sample twit 5', '/img/failwhale.jpg', 'twitterUser5 (Twitter User 5)', '0', '2009-09-15 19:27:10', '2009-09-15 19:27:10', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('427347', '3', 'crispin porter', '2009-09-15 17:05:59', 'http://news_url1', 'news article 1', 'news content 1', '', 'Sample Author 1', '0', '2009-09-15 17:57:53', '2009-09-15 17:57:53', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('424749', '3', 'crispin porter', '2009-09-14 22:04:34', 'http://news_url2', 'news article 2', 'news content 2', '', 'Sample Author 2', '0', '2009-09-14 23:34:15', '2009-09-14 23:34:15', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('424393', '3', 'crispin porter', '2009-09-14 21:16:04', 'http://news_url3', 'news article 3', 'news content 3', '', 'Sample Author 3', '0', '2009-09-14 21:50:31', '2009-09-14 21:50:31', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('422724', '3', 'crispin porter', '2009-08-19 02:12:58', 'http://news_url4', 'news article 4', 'news content 4', '', 'Sample Author 4', '0', '2009-09-14 14:55:30', '2009-09-14 14:55:30', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('422268', '3', 'crispin porter', '2009-08-18 13:12:07', 'http://news_url5', 'news article 5', 'news content 5', '', 'Sample Author 5', '0', '2009-09-14 13:11:39', '2009-09-14 13:11:39', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('422480', '4', 'crispin porter', '2009-09-14 12:33:21', 'http://blog_url1', 'blog title 1', 'blog content 1', '', 'Blog Author 1', '0', '2009-09-14 13:58:36', '2009-09-14 13:58:36', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('421862', '4', 'crispin porter', '2009-09-14 08:24:56', 'http://blog_url2', 'blog title 2', 'blog content 2', '', 'Blog Author 2', '0', '2009-09-14 11:28:55', '2009-09-14 11:28:55', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('421480', '4', 'crispin porter', '2009-09-12 16:28:49', 'http://blog_url3', 'blog title 3', 'blog content 3', '', 'Blog Author 3', '0', '2009-09-14 04:21:17', '2009-09-14 04:21:17', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('421395', '4', 'crispin porter', '2009-09-13 16:36:40', 'http://blog_url4', 'blog title 4', 'blog content 4', '', 'Blog Author 4', '0', '2009-09-13 18:36:47', '2009-09-13 18:36:47', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('421356', '4', 'crispin porter', '2009-09-09 12:04:58', 'http://blog_url5', 'blog title 5', 'blog content 5', '', 'Blog Author 5', '0', '2009-09-13 13:41:35', '2009-09-13 13:41:35', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('326583', '5', 'crispin porter', '2009-06-01 15:36:00', 'sample bubble 1', 'bubble title 1', 'http://bubble_url1', '/img/sampleBubble.jpg', 'bubble author 1', '0', '2009-06-20 15:36:00', '2009-06-20 15:36:00', 'CPB', 'CPB', 'false', 'false');
INSERT INTO `datarows` VALUES ('326573', '5', 'crispin porter', '2009-06-11 15:36:00', 'sample bubble 2', 'bubble title 2', 'http://bubble_url2', '/img/sampleBubble.jpg', 'bubble author 2', '0', '2009-06-18 15:36:00', '2009-06-18 15:36:00', 'CPB', 'CPB', 'false', 'false');
INSERT INTO `datarows` VALUES ('326570', '5', 'crispin porter', '2009-06-14 15:36:00', 'sample bubble 3', 'bubble title 3', 'http://bubble_url3', '/img/sampleBubble.jpg', 'bubble author 3', '0', '2009-06-18 15:36:00', '2009-06-18 15:36:00', 'CPB', 'CPB', 'false', 'false');
INSERT INTO `datarows` VALUES ('326569', '5', 'crispin porter', '2009-06-15 15:36:00', 'sample bubble 4', 'bubble title 4', 'http://bubble_url4', '/img/sampleBubble.jpg', 'bubble author 4', '0', '2009-06-18 15:36:00', '2009-06-18 15:36:00', 'CPB', 'CPB', 'false', 'false');
INSERT INTO `datarows` VALUES ('326568', '5', 'crispin porter', '2009-06-16 15:36:00', 'sample bubble 5', 'bubble title 5', 'http://bubble_url5', '/img/sampleBubble.jpg', 'bubble author 5', '0', '2009-06-18 15:36:00', '2009-06-18 15:36:00', 'CPB', 'CPB', 'false', 'false');
INSERT INTO `datarows` VALUES ('425311', '7', 'crispin porter', '2009-09-15 03:17:00', 'http://bingnews_url1', 'Bingnews Title 1', 'bingnews content 1', '', 'Bingnews Author 1', '0', '2009-09-15 03:41:11', '2009-09-15 03:41:11', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('425257', '7', 'crispin porter', '2009-09-15 02:20:00', 'http://bingnews_url2', 'Bingnews Title 2', 'bingnews content 2', '', 'Bingnews Author 2', '0', '2009-09-15 02:54:49', '2009-09-15 02:54:49', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('424655', '7', 'crispin porter', '2009-09-13 18:57:00', 'http://bingnews_url3', 'Bingnews Title 3', 'bingnews content 3', '', 'Bingnews Author 3', '0', '2009-09-14 23:03:03', '2009-09-14 23:03:03', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('424316', '7', 'crispin porter', '2009-09-14 21:05:00', 'http://bingnews_url4', 'Bingnews Title 4', 'bingnews content 4', '', 'Bingnews Author 4', '0', '2009-09-14 21:30:23', '2009-09-14 21:30:23', '\"sample tag\"', '\"sample tag\"', 'false', 'false');
INSERT INTO `datarows` VALUES ('422252', '7', 'crispin porter', '2009-09-14 12:44:00', 'http://bingnews_url5', 'Bingnews Title 5', 'bingnews content 5', '', 'Bingnews Author 5', '0', '2009-09-14 12:59:50', '2009-09-14 12:59:50', '\"sample tag\"', '\"sample tag\"', 'false', 'false');

-- ----------------------------
-- Table structure for `modules`
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `status` enum('dev','inactive','active') NOT NULL default 'dev',
  `minSize` int(11) NOT NULL COMMENT '0 denotes no minimum size',
  `maxSize` int(11) NOT NULL COMMENT '0 defines no maximum size',
  `updateType` enum('prependli','appendli','prependdiv','appenddiv','replace','flashjs','js') NOT NULL,
  `updateid` varchar(255) NOT NULL,
  `updateInSeconds` int(11) NOT NULL default '0' COMMENT '0 defines no client side refresh',
  `datafeed_id` int(11) NOT NULL,
  `datafeed_tags` varchar(255) NOT NULL,
  `datafeed_tag_restriction` enum('or','and','not') NOT NULL,
  `layout_tag` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', 'twitter', 'dev', '5', '15', 'appenddiv', '1', '16', '1', 'twitter', 'and', 'twitter', '2009-06-02 14:16:12', '2009-06-02 14:16:18');
INSERT INTO `modules` VALUES ('3', 'youtube', 'dev', '5', '15', 'appenddiv', '3', '0', '2', 'youtube', 'not', 'youtube', '2009-06-08 18:53:08', '2009-06-08 18:53:12');
INSERT INTO `modules` VALUES ('4', 'news', 'dev', '5', '15', 'appenddiv', '4', '120', '3', 'news', 'and', 'news', '2009-06-11 15:41:53', '2009-06-11 15:41:57');
INSERT INTO `modules` VALUES ('5', 'blogs', 'dev', '5', '15', 'appenddiv', '5', '180', '4', 'blogs', 'and', 'blogs', '2009-06-11 20:40:05', '2009-06-11 20:40:09');
INSERT INTO `modules` VALUES ('6', 'bubble', 'dev', '5', '15', 'appenddiv', '6', '10', '5', 'bubble', 'and', 'bubble', '2009-06-16 15:14:56', '2009-06-16 15:15:00');
INSERT INTO `modules` VALUES ('7', 'articles', 'dev', '5', '15', 'appenddiv', '7', '120', '8', 'articles', 'and', 'articles', '2009-08-27 12:26:53', '2009-08-27 12:26:56');
INSERT INTO `modules` VALUES ('8', 'jobs', 'dev', '5', '100', 'appenddiv', '8', '1000', '9', 'jobs', 'and', 'jobs', '2009-08-27 12:27:57', '2009-08-27 12:28:00');
INSERT INTO `modules` VALUES ('9', 'queue', 'dev', '5', '15', 'appenddiv', '9', '100', '10', 'queue', 'and', 'queue', '2009-08-31 16:25:55', '2009-08-31 16:25:58');
INSERT INTO `modules` VALUES ('10', 'featured', 'dev', '5', '15', 'appenddiv', '10', '10', '11', 'featured', 'and', 'featured', '2009-08-31 16:26:48', '2009-08-31 16:26:52');

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `type` enum('client','search') NOT NULL,
  `Rating` tinyint(4) NOT NULL default '0',
  `datafeed_ids` varchar(255) NOT NULL COMMENT 'Quoted space delimited list of IDs used by crawlType set to sourcelist',
  `status` enum('crawlable','active','disabled') NOT NULL default 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2074 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', 'from:cpbgroup', '1', 'client', '0', ',1,', 'crawlable', '2009-06-11 15:36:00', '2009-07-24 13:36:20');
INSERT INTO `tags` VALUES ('2', 'from:bogusky -RT', '1', 'client', '0', ',1,', 'crawlable', '2009-06-11 15:36:00', '2009-07-23 17:42:51');
INSERT INTO `tags` VALUES ('3', 'from:bogusbogusky -RT', '1', 'client', '0', ',1,', 'crawlable', '2009-06-12 15:36:00', '2009-07-24 16:17:14');
INSERT INTO `tags` VALUES ('4', '@bogusky -RT', '1', 'client', '0', ',1,', 'crawlable', '2009-06-13 15:36:00', '2009-07-24 16:53:43');
INSERT INTO `tags` VALUES ('5', '\"crispin porter bogusky\" -oshyn -CPBShredSchool', '1', 'client', '0', ',1,2,3,4,', 'crawlable', '2009-06-16 15:36:00', '2009-07-23 14:03:44');
INSERT INTO `tags` VALUES ('6', '\"crispin porter\" -ohsyn -CPBShredSchool', '1', 'client', '0', ',1,2,3,4,', 'crawlable', '2009-06-17 15:36:00', '2009-07-24 15:43:44');
INSERT INTO `tags` VALUES ('7', 'bogusky -RT -CPBShredSchool', '1', 'client', '0', ',1,2,3,4,', 'crawlable', '2009-06-18 15:36:00', '2009-07-24 16:52:09');
INSERT INTO `tags` VALUES ('8', '\"alex bogusky\" -CPBShredSchool', '1', 'client', '0', ',1,2,3,4,', 'crawlable', '2009-06-19 15:36:00', '2009-07-24 15:23:27');
INSERT INTO `tags` VALUES ('9', '\"CP+B Europe\"', '1', 'client', '0', ',1,3,4,', 'crawlable', '2009-06-19 15:36:00', '2009-07-24 11:15:59');
INSERT INTO `tags` VALUES ('10', 'bogusbogusky', '1', 'client', '0', ',1,', 'crawlable', '2009-06-19 15:36:00', '2009-07-24 14:27:06');
INSERT INTO `tags` VALUES ('11', 'beta.cpbgroup.com', '1', 'client', '0', ',1,3,4,', 'crawlable', '2009-06-19 15:36:00', '2009-07-24 07:43:37');
INSERT INTO `tags` VALUES ('12', 'cpbgroup.com -CPBShredSchool', '1', 'client', '0', ',1,3,4,', 'crawlable', '2009-06-19 15:36:00', '2009-07-24 16:27:46');

-- ----------------------------
-- Table structure for `topics`
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `abbr` varchar(255) NOT NULL,
  `navIcon` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('1', 'crispin porter', 'cpb', 'none', '2009-06-02 05:11:28', '2009-06-02 05:11:28');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `password` char(50) default NULL,
  `changePassword` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'ecb2175c68bc673c93ea7081053fa81388cdd4a7', '1');
