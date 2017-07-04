<?php 

require('includes/classes/Config.php'); 
require('includes/classes/User.php');
require('includes/classes/Post.php');

?>


<?php
$user = new User($con, 'juan_masa');

$userLoggedIn = 'thomas_ruiz';
 $user = new User($con, $userLoggedIn);
 $sql = "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'";

    $friendRequests= mysqli_query($con, $sql );

   if(mysqli_num_rows($friendRequests) == 0){
        echo "You have no friend requests at thie time!";
    }else{
        while($row = mysqli_fetch_array($friendRequests)){
            $user_from = $row['user_from'];
            $user_from_obj = new User($con, $user_from);

            echo $user_from_obj->getFullName($user_from)." sent you a friend request!";
          
          $user_from_friend_array = $user_from_obj->getfriends();
          
          if(isset($_POST['accept_request'.$user_from])){
              $user->addFriend($user_from);
              echo "You are now friends!";
            //   header("Refresh: 2, requests.php");


          }
            if(isset($_POST['ignore_request'. $user_from] )){
              
          }
          ?>
          <form action="requests.php" method="POST"> 
                <input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
                <input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
          </form>
          
          <?php

        }
    }

?>

