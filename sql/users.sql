
CREATE DATABASE IF NOT EXISTS social DEFAULT CHARSET = utf8;
USE social;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(25) NOT NULL,
 `last_name` varchar(25) NOT NULL,
 `username` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `password` varchar(255) NOT NULL,
 `signup_date` date NOT NULL,
 `profile_pic` varchar(255) NOT NULL,
 `num_posts` int(11) NOT NULL,
 `num_likes` int(11) NOT NULL,
 `user_closed` tinyint(1) NOT NULL,
 `friend_array` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1
