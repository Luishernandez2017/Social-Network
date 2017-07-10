


CREATE DATABASE IF NOT EXISTS social DEFAULT CHARSET = utf8;
USE social;

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `body` text NOT NULL,
 `added_by` varchar(60) NOT NULL,
 `user_to` varchar(60) NOT NULL,
 `date_added` datetime NOT NULL,
 `user_closed` tinyint(1) NOT NULL,
 `deleted` tinyint(1) NOT NULL,
 `likes` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1