
INSERT INTO `modules` VALUES ('7', 'articles', 'dev', '5', '15', 'appenddiv', '7', '120', '8', 'articles', 'and', 'articles', '2009-08-27 12:26:53', '2009-08-27 12:26:56');
INSERT INTO `modules` VALUES ('8', 'jobs', 'dev', '5', '100', 'appenddiv', '8', '1000', '9', 'jobs', 'and', 'jobs', '2009-08-27 12:27:57', '2009-08-27 12:28:00');




DROP TABLE IF EXISTS `datafeeds`;
CREATE TABLE `datafeeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contentType` enum('url','plaintext','html','xml') NOT NULL DEFAULT 'url',
  `updateFreqInMinutes` int(11) NOT NULL DEFAULT '0' COMMENT '0 means never update automatically',
  `defaultTags` varchar(255) NOT NULL COMMENT 'Empty uses all search tags, quoted comma delimited list of tag IDs will be automatically applied',
  `authType` enum('none','htauth','apikey') NOT NULL DEFAULT 'none',
  `authUserName` varchar(255) NOT NULL,
  `authPassword` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `crawlerStatus` enum('none','crawling') NOT NULL DEFAULT 'none',
  `crawlerID` varchar(255) NOT NULL,
  `sources` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of datafeeds
-- ----------------------------
INSERT INTO `datafeeds` VALUES ('1', 'twitter', 'plaintext', '2', '', 'none', '', '', '2009-06-02 04:55:54', '2009-06-17 14:18:37', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('2', 'youtube', 'url', '100', '', 'none', '', '', '2009-06-08 18:49:06', '2009-06-17 14:14:23', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('3', 'news', 'url', '3', '', 'none', '', '', '2009-06-11 15:37:54', '2009-06-17 14:18:59', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('4', 'blogs', 'url', '5', '', 'none', '', '', '2009-06-11 20:41:24', '2009-06-17 14:19:36', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('5', 'bubble', 'url', '1', '', 'none', '', '', '2009-06-16 15:35:40', '2009-06-16 15:35:44', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('6', 'quicktwitter', 'url', '1', '', 'none', '', '', '2009-06-22 11:16:58', '2009-06-22 11:17:02', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('7', 'bingnews', 'url', '3', '', 'none', '', '', '2009-07-01 12:57:05', '2009-07-01 12:57:10', 'none', '', '');
INSERT INTO `datafeeds` VALUES ('8', 'articles', 'url', '6', '', 'none', '', '', '2009-08-27 10:56:54', '2009-08-27 10:56:58', 'none', '', '3,4');
INSERT INTO `datafeeds` VALUES ('9', 'jobs', 'url', '100', '', 'none', '', '', '2009-08-27 12:30:56', '2009-08-27 12:31:00', 'none', '', '');






INSERT INTO `tags` VALUES ('2005', 'qlX9Vfw6', '1', 'client', '5', ',9,', 'crawlable', '2009-08-27 13:00:49', '2009-08-27 13:00:52');