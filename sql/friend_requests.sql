
USE social;

DROP TABLE IF EXISTS `friend_requests`;



CREATE TABLE `friend_requests` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_to` VARCHAR(50) NOT NULL,
    `user_from` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`) ) 
     ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1
    