<?php  
include('../classes/Config.php');
include('../classes/User.php');
include('../classes/Post.php');
include('../classes/Notification.php');

$limit =6;//messages to load

$notification = new Notification($con, $_REQUEST['userLoggedIn']);

echo $notification->getNotificationsDropdown($_REQUEST, $limit);



?>