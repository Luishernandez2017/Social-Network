<?php 
require('includes/classes/Config.php'); 
require('includes/classes/User.php');
require('includes/classes/Post.php');

?>


<?php
$user = new User($con, 'juan_masa');
$username= $user->getUsername();
$id =5;

$str = "<div class='post_comment' id='toggleComment$id' style='display:block;'>";
					$str .="<iframe src='http://localhost/PHP-course/Udemy%20PHP/SOCIAL_NETWORK/includes/classes/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>";
					$str .="</div>";
				
	echo $str;
   

?>

