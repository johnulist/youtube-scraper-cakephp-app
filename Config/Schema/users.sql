/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50515
 Source Host           : localhost
 Source Database       : scraper

 Target Server Version : 50515
 File Encoding         : utf-8

 Date: 11/17/2011 03:01:45 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('4e800ecf-b5bc-4fc6-b78f-67884317134f', 'admin', '9a0018daef46866a6c65db16d67a46d67d03aebd', '2011-11-17 12:00:00', '2011-11-17 12:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
