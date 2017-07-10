

USE social;

DROP TABLE IF EXISTS `notifications`;


CREATE TABLE `notifications` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_to` varchar(50) NOT NULL,
 `user_from` varchar(50) NOT NULL,
 `message` text NOT NULL,
 `link` varchar(100) NOT NULL,
 `datetime` datetime NOT NULL,
 `opened` tinyint(1) NOT NULL,
 `viewed` tinyint(1) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1