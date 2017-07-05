<?php 

require('includes/classes/Config.php'); 
require('includes/classes/User.php');
require('includes/classes/Post.php');
require('includes/classes/Message.php');

?>


<?php
//$user = new User($con, 'juan_masa');
$message_obj= new Message($con, 'juan_masa');
$userLoggedIn = 'thomas_ruiz';
$user_to ="jane_doe";
 $date= date("Y-m-d H:i:s");
 $body="Test message";
 $body = mysqli_escape_string($con, $body);
        // echo "$body, $date";
 //$message_obj->sendMessage($user_to, $body, $date);



 

?>

