<?php 
 $title = 'Profile';
require('./includes/layouts/header.php');
 ?>

<?php 
   $user = new User($con, $userLoggedIn);

if(isset($_GET['profile_username'])){

    $username= $_GET['profile_username'];
    $sql= "SELECT username FROM users WHERE username='$username'";

$ajaxUrl= "includes/handlers/ajax_load_profile_posts.php";
$ajaxData="$userLoggedIn&profileUsername=$username";

$message_obj = new Message($con, $userLoggedIn);//message object

$user_exists = mysqli_query($con, $sql);
if(mysqli_num_rows($user_exists)> 0){
$profile_user = new User($con, $username);
}else{

 header("Location: index.php");
}


if(isset($_POST['remove_friend'])){
 
    $user->removeFriend($username);
}


if(isset($_POST['remove_friend'])){
    
    $user->removeFriend($username);
}

if(isset($_POST['add_friend'])){
  
    $user->sendRequest($username);
}

if(isset($_POST['respond_request'])){
header("Location: requests.php");
}
$activeTab= "in active";
$changeTab='';

if(isset($_POST['post_message'])){
    if(isset($_POST['message_body'])){
        $body= mysqli_real_escape_string($con, $_POST['message_body']);
        $date= date("Y-m-d H:i:s");
        $message_obj->sendMessage($username, $body, $date);

    }
    $changeTab='in active';//hack to change tabs
    $activeTab='';
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
    </div><!--end of profile info-->
    


    

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
 
 <?php if($user->isFriend($profile_user->getUsername())){ ?>
 <input type="submit" class="deep_blue" data-toggle="modal" data-target="#myPostModalForm" value="Post Something">
  <?php 
 }
    if($userLoggedIn != $username){?>
   <div class='profile_info_bottom' >
    <button type='button' class='mutual_friends_btn' data-toggle='modal' data-target='#mutualFriendsModal'>
        <?php echo count($logged_in_user_obj->getMutualFriends($username))." Mutual Friends"; ?>
     </button>
  </div><!--end of profile_info_bottom-->
  <?php
    }

  
   ?>


  
  </div><!--end of profile_left-->




  <div class="main_column column">
          <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist"  id="profileTabs">
    <li role="presentation" ><a href="#newsfeed" aria-controls="newsfeed" role="tab" data-toggle="tab">Newsfeed</a></li>
    <li role="presentation" ><a href="#messages_div" aria-controls="messages_div" role="tab" data-toggle="tab">Messages</a></li>
  
  </ul>
<div class="tab-content">
  <div role="tabpanel" class="tab-pane  <?php echo $activeTab; ?> fade" id="newsfeed">
      <?php if($user->isFriend($profile_user->getUsername())){ ?>
      <div class="posts_area"></div>
	<img id="loading"  src="assets/images/icons/loading.gif">
   <?php }else{
      echo "<p> Profile is set to private. You must be friends with ".$profile_user->getFullName()." in order to view his posts.</p>";
       }
       ?>

  </div><!--end of newsfeed tabpanel-->
   
  <div role="tabpanel" class="tab-pane <?php echo $changeTab; ?> fade" id="messages_div">

      <?php 
        
  if($user->isFriend($profile_user->getUsername())){ 
        echo "<h4>You and <a href='".$username."'>".$profile_user->getFullName()."</a></h4><hr>";
        echo "<div class='loaded_messages' id='scroll_messages'>";
        echo $message_obj->getMessages($username);
        echo"</div>";//endof load messages div
        ?>
    <div class="message_post">
       <form action="" method="POST">
       
            <textarea name="message_body" id="message_textarea" placeholder="Write your message.."></textarea>
            <input type="submit" name="post_message" class="info" id="message_submit" value='send'>
        
         </form>
    <?php }else{
      echo "<p> Profile is set to private. You must be friends with ".$profile_user->getFullName()." in order to send him messages.</p>";
       }
       ?>

        </div><!--end of  message post-->
<script>

var div = document.querySelector("#scroll_messages");

if(div){
div.scrollTop = div.scrollHeight;
}
function getUsers(value, user) {
    $.post("./includes/handlers/ajax_friend_search.php", { query:value, userLoggedIn:user },
        function(data) {
            $(".results").html(data);

        }
    );
}

</script>
  </div><!--end of tab-->
 
</div><!--end of tab content-->


</div><!--end of -->

<!-- Modals-->
<?php include('includes/layouts/boot_modals.php');?>

</div><!--main-column-->
<script type="text/javascript" src="./assets/js/modal_form.js"></script>


<?php require('./assets/js/infinite_scroll.php');?>
<?php require('./includes/layouts/footer.php'); ?>