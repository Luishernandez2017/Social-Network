
<?php $title= "Messgaes"; ?>
<?php require('./includes/layouts/header.php'); ?>
<?php 
$message_obj = new Message($con, $userLoggedIn);


if(isset($_GET['u'])){
    $user_to = $_GET['u'];

}else{
    //check most recent user messaging activity
    $user_to = $message_obj->getMostRecentUser();
    if($user_to == false){//if none
        $user_to = 'new';//current user is new
    }

    }

    if($user_to != 'new'){
        $user_to_obj = new User($con, $user_to);
    }
if(isset($_POST['post_message'])){
    if(isset($_POST['message_body'])){
        $body= mysqli_real_escape_string($con, $_POST['message_body']);
        $date= date("Y-m-d H:i:s");
      //  echo "$body, $date";
     $message_obj->sendMessage($user_to, $body, $date);
        
    }
}


?>
<div class="user_details column"> 
        <a href="<?php echo $userLoggedIn; ?>"><img  src="<?php echo $user['profile_pic'];    ?>"/></a>

        <div class="user_details_left_right">
                <a href="<?php echo $userLoggedIn; ?>">
                <?php   echo $user['first_name']. " " .$user['last_name']; ?>

                </a>
                <br/>
                <?php echo "Posts: ".$user['num_posts'] ."<br/> Likes: ".$user['num_likes']; ?>
        </div>

</div>

    <div class="user_details column message-column" id="conversations">
        <h4>Recent Converstions</h4>
        <div class="loaded_conversations">
        <?php echo $message_obj->getConversations(); ?>


     <a href="messages.php?u=new" class="new-message">New Message</a>
     </div>
 </div>
    <div class="main_column column message-box ">
        <?php 
        if( $user_to != "new"){
          
        echo "<h4>You and <a href='$user_to'>".$user_to_obj->getFullName()."</a></h4><hr>";
        echo "<div class='loaded_messages' id='scroll_messages'>";
        echo $message_obj->getMessages($user_to);
        echo"</div>";
       }else{
           echo "<h4>New Message</h4>";
       }
        ?>
    <div class="message_post">
       <form action="" method="POST">
           <?php if($user_to == "new"){?>
              <div class="to-box"> Select the friend you would like to messages <br><br>
                To: <input type='text' onkeyup="getUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Name" autocomplete="off" id="search_text_input" >
                </div>
               <div class="results"></div>
          <?php  }else{?>
            <textarea name="message_body" id="message_textarea" placeholder="Write your message.."></textarea>
            <input type="submit" name="post_message" class="info" id="message_submit" value='send'>
         <?php }
            
            ?>
         </form>

        <div>
     
    
     </div>

<script type="text/javascript">

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

<?php require('./includes/layouts/footer.php'); ?>

