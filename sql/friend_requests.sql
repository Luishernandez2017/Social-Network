
USE social;

DROP TABLE IF EXISTS `friend_requests`;


CREATE TABLE `friend_requests` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_to` varchar(50) NOT NULL,
 `user_from` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1
