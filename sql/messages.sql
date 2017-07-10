
USE social;

DROP TABLE IF EXISTS `messages`;


CREATE TABLE `messages` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_to` varchar(50) NOT NULL,
 `user_from` varchar(50) NOT NULL,
 `body` text NOT NULL,
 `date` datetime NOT NULL,
 `opened` tinyint(1) NOT NULL,
 `viewed` tinyint(1) NOT NULL,
 `deleted` tinyint(1) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1