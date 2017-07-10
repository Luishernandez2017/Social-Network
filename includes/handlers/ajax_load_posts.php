<?php 
include('../classes/Config.php');
include('../classes/User.php');
include('../classes/Post.php');
include('../classes/Notification.php');

$limit = 10;//limit number of posts

$posts = new Post($con, $_REQUEST['userLoggedIn']);

$posts->loadPostsByFriends($_REQUEST, $limit);

//echo $_REQUEST['userLoggedIn'];

?>