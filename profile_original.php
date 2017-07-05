<?php 
 $title = 'Profile';
require('./includes/layouts/header.php');
 ?>

<?php 


if(isset($_GET['profile_username'])){

    $username= $_GET['profile_username'];
    $sql= "SELECT username FROM users WHERE username='$username'";

$ajaxUrl= "includes/handlers/ajax_load_profile_posts.php";
$ajaxData="$userLoggedIn&profileUsername=$username";

$user_exists = mysqli_query($con, $sql);
if(mysqli_num_rows($user_exists)> 0){
$profile_user = new User($con, $username);
}else{

 header("Location: index.php");
}


if(isset($_POST['remove_friend'])){
    $user = new User($con, $userLoggedIn);
    $user->removeFriend($username);
}


if(isset($_POST['remove_friend'])){
    $user = new User($con, $userLoggedIn);
    $user->removeFriend($username);
}

if(isset($_POST['add_friend'])){
    $user = new User($con, $userLoggedIn);
    $user->sendRequest($username);
}

if(isset($_POST['respond_request'])){
header("Location: requests.php");
}




//var_dump($user);
$friendsArray=$profile_user->getFriends();

// var_dump($user);

}


?>
<style>
    
.wrapper{
    top: 0;
    left:0;
    margin-left:0;
}


.column{
    left: 40%;
    top: 50px;
}




</style>
<div class="profile_left">
   <img src='<?php echo $profile_user->getUserPic(); ?>'>
    
    <div class="profile_info">
        <p>Posts: <?php echo  $profile_user->getNumPosts(); ?></p>
        <p>Likes: <?php echo $profile_user->getUser('num_likes'); ?></p>
        
        <?php if($userLoggedIn == $username){ ?>
       
        <input type="submit" id="friendsLink" data-toggle="modal" data-target="#friendsModal" value="Friends: <?php echo count($friendsArray); ?>">
        
        <?php }else{?>
        
        <p>Friends: <?php echo count($friendsArray); ?></p>
       
        <?php }; ?>
    </div>
    


    

<form action="<?php echo $username;?>" method="POST">

     <?php 
  
     if($profile_user->isClosed()){
         header("Location: user_closed.php");
     }
     $logged_in_user_obj = new User($con, $userLoggedIn);
     //logged in user is not the same as $_GET profile user
     if($userLoggedIn != $username){
         if($logged_in_user_obj->isFriend($username)){//userame is friends of logged in user
             echo "<input type='submit'  name='remove_friend' class='danger' value='Remove Friend' >";


         }else if($logged_in_user_obj->didReceiveRequest($username)){
             echo "<input type='submit'  name='respond_request' class='warning' value='Respond to Request' >";

         }else if($logged_in_user_obj->didSendRequest($username)){
            
             echo "<input type='submit'   class='warning' value='Request sent' >";


         }else{

                   echo "<input type='submit'   name='add_friend' class='add_friend success' value='Add Friend' >";

         }
        

     }
    ?>
    
 </form>
 <input type="submit" class="deep_blue" data-toggle="modal" data-target="#myPostModalForm" value="Post Something">
  <?php 
    if($userLoggedIn != $username){?>
   <div class='profile_info_bottom' >
    <button type='button' class='mutual_friends_btn' data-toggle='modal' data-target='#mutualFriendsModal'>
        <?php echo count($logged_in_user_obj->getMutualFriends($username))." Mutual Friends"; ?>
     </button>
  </div>
  <?php
    }

  
   ?>
  <!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#friendsModal">
  Launch demo modal
</button>-->
  
  </div>
  <div class="main_column column">
<div class="posts_area"></div>
	<img id="loading"  src="assets/images/icons/loading.gif"/>

  </div>

<!-- Modals-->
<?php include('includes/layouts/boot_modals.php');?>

</div>

</div>

<script type="text/javascript" src="./assets/js/modal_form.js"></script>


<?php require('./assets/js/infinite_scroll.php');?>
<?php require('./includes/layouts/footer.php'); ?>