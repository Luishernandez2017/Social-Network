<?php require('./includes/layouts/header.php'); ?>
<style>

    h4, p{
        margin-left: 10px;
    }
    h4{
        font-size: 25px;
    }
    p{
        font-size: 20px;
    }

</style>

<div class="main-column column" id="main_column">
    <h4>Friend Request</h4>
    <?php
 
 $user = new User($con, $userLoggedIn);
 $sql = "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'";

    $friendRequests= mysqli_query($con, $sql );

    if(mysqli_num_rows($friendRequests) == 0){
        echo "<p> You have no friend requests at thie time!</p>";
    }else{
        while($row = mysqli_fetch_array($friendRequests)){
            $user_from = $row['user_from'];
            $user_from_obj = new User($con, $user_from);

      
          
          $user_from_friend_array = $user_from_obj->getfriends();
          
          if(isset($_POST['accept_request'.$user_from])){
              $accept = $_POST['accept_request'.$user_from];
 
        $user->handleFriendRequest($user_from, $accept);
      

            
            header("Refresh: 3; url=requests.php");
            
            echo '<p> You are now friends with '.$user_from_obj->getFullName($user_from)."!<p>"; 


          }
            if(isset($_POST['ignore_request'. $user_from] )){
                $Ignore= $_POST['ignore_request'.$user_from];
                
                header("Refresh: 3; url=requests.php");
                 echo "<p>".$user_from_obj->getFullName($user_from)."'s request will be ignored.</p>"; 



        $user->handleFriendRequest($user_from, $Ignore);
              
          }
               echo "<p>".$user_from_obj->getFullName($user_from)." sent you a friend request!</p>";
          ?>
          <form action="requests.php" method="POST"> 
                <input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
                <input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
          </form>
          
          <?php

        }
    }

    ?>

</div>

<?php require('./includes/layouts/footer.php'); ?>