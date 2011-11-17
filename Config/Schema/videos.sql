/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50515
 Source Host           : localhost
 Source Database       : scraper

 Target Server Version : 50515
 File Encoding         : utf-8

 Date: 11/17/2011 03:01:51 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `vid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minutes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seconds` int(11) NOT NULL,
  `uploader` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  `rates` decimal(5,2) NOT NULL DEFAULT '0.00',
  `votes` int(11) unsigned NOT NULL DEFAULT '0',
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `videos`
-- ----------------------------
BEGIN;
INSERT INTO `videos` VALUES ('4ec4c3dd-1d54-47da-83a9-2e2a173e866a', 'ILaxpa982FA', 'Iron Maiden- Run To The Hills official video', 'iron-maiden-run-to-the-hills-official-video', 'Run to the hills music video', 'http://i.ytimg.com/vi/ILaxpa982FA/0.jpg', 'iron,maiden,run,to,the,hills,official,video', '03:53', '233', 'TheSuperLmenGuns', '7', '0.00', '0', '0.00', '1', '2011-11-17 02:20:45', '2011-11-17 02:20:45'), ('4ec4c420-95f8-47a7-b47e-2e43173e866a', 'XQu1YwfqTkY', 'Monster Energy\'s Harry Main in North Carolina', 'monster-energy-s-harry-main-in-north-carolina', 'Monster Energy\'s Harry Main doesn\'t play around when it comes to filming banger videos. Harry spent 3 days filming this edit around North Carolina and delivered the goods. www.monsterenergy.com http www.facebook.com Music: \"Belong\" The Pains at Being Pure at Heart Filmed and Edited by Will Stroud ninetofivefilms.com', 'http://i.ytimg.com/vi/XQu1YwfqTkY/0.jpg', 'monster,energy,s,harry,main,in,north,carolina', '03:14', '194', 'monsterenergy', '0', '0.00', '0', '0.00', '1', '2011-11-17 02:21:52', '2011-11-17 02:21:52'), ('4ec4c445-04c4-42b1-b638-2e43173e866a', 'Cj6ho1-G6tw', 'Danny MacAskill - \"Way Back Home\"', 'danny-macaskill-way-back-home', 'Way Back Home is the incredible new riding clip from Danny MacAskill, it follows him on a journey from Edinburgh back to his hometown Dunvegan, in the Isle of Skye. You can read about it and watch the interviews with Danny at www.redbull.co.uk The music is Loch Lomond \"Wax and Wire\" and The Jezabels \"A Little Piece\". www.myspace.com | www.thejezabels.com', 'http://i.ytimg.com/vi/Cj6ho1-G6tw/0.jpg', 'danny,macaskill,way,back,home', '07:43', '463', 'redbull', '0', '0.00', '0', '0.00', '1', '2011-11-17 02:22:29', '2011-11-17 02:22:29');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
