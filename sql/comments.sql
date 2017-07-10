USE social;

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `post_body` text NOT NULL,
 `posted_by` varchar(60) NOT NULL,
 `posted_to` varchar(60) NOT NULL,
 `date_added` datetime NOT NULL,
 `removed` tinyint(1) NOT NULL,
 `post_id` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1