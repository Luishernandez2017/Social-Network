USE social;

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, 
`username` varchar(60) NOT NULL, 
`post_id` int(11) NOT NULL, 
 PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1
