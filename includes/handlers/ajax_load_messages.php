<?php  
include('../classes/Config.php');
include('../classes/User.php');
include('../classes/Post.php');
include('../classes/Message.php');
$limit =6;//messages to load

$message = new Message($con, $_REQUEST['userLoggedIn']);

echo $message->getConversationsDropdown($_REQUEST, $limit);



?>