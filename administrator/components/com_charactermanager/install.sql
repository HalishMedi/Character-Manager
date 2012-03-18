CREATE TABLE IF NOT EXISTS `#__char_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `type` varchar(25) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__char_characters` (
  `id` int(6) NOT NULL DEFAULT '0',
  `user_id` int(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `guild` int(6) DEFAULT NULL,
  `game` int(6) DEFAULT NULL,
  `allegiance` int(6) DEFAULT NULL,
  `class` int(6) DEFAULT NULL,
  `rosterchecked` date DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `unpublisheddate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `#__char_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;