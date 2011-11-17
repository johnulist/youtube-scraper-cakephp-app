#S1KendeLocal sql generated on: 2011-11-17 02:58:15 : 1321520295

DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `videos`;


CREATE TABLE `users` (
	`id` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`created` datetime NOT NULL COMMENT '',
	`modified` datetime NOT NULL COMMENT '',	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

CREATE TABLE `videos` (
	`id` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`vid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`minutes` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`seconds` int(11) NOT NULL COMMENT '',
	`uploader` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '',
	`views` int(11) NOT NULL COMMENT '',
	`rates` float(5,2) DEFAULT '0.00' NOT NULL COMMENT '',
	`votes` int(11) DEFAULT 0 NOT NULL COMMENT '',
	`rating` float(5,2) DEFAULT '0.00' NOT NULL COMMENT '',
	`is_active` tinyint(1) NOT NULL COMMENT '',
	`created` datetime NOT NULL COMMENT '',
	`modified` datetime NOT NULL COMMENT '',	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

