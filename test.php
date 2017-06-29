<?php 
require('includes/classes/Config.php'); 
require('includes/classes/User.php');
require('includes/classes/Post.php');

?>


<?php
$user = new User($con, 'juan_masa');
$username= $user->getUsername();

//$sql = mysqli_query($con, "SELECT friend_array FROM users WHERE username = '$username'");
//$row = mysqli_fetch_array($sql);
//$friends = $row[0];
//echo $friends;
//$friendsArray =explode(", ",$friends);
//
//foreach($friendsArray as $friend){
//	echo "<br/>".$friend."<br/>";
//}
//
//if(in_array('john_doe', $friendsArray)){
//	echo "yes";
//}

if($user->isFriend('john_doe')){
	echo "yes";
}else{
	echo "no";
}
//$getTable = mysqli_query($con, "SHOW CREATE TABLE users");
//
//while($row =mysqli_fetch_row($getTable)){
//    var_dump ($row);
//};

   

?>

