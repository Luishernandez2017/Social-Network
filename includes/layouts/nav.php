         <div class="top_bar">
        <div class="logo">
                <a href="index.php">SwirlFeed!</a>
        </div>
     
        
        </div>
        <nav>
        <?php
                //Unread Messages
                $messages = new Message($con, $userLoggedIn);
                $num_messages= $messages->getUnreadMessages();

                //Unread notifications
                $notifications = new Notification($con, $userLoggedIn);
                $num_notifications = $notifications->getUnreadNumber();

                //Unread friend requests
                $user_obj = new User($con, $userLoggedIn);
                $num_friend_requests = $user_obj->getNumOfFriendRequests();


  
        
         ?>
               <a href="<?php echo $userLoggedIn; ?>"> <i id="username"><?php echo $user_firstname; ?></i></a>
                <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
                <a  href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')"><i class="fa fa-envelope-o fa-lg"></i>
                <?php if($num_messages > 0){?>
                <span class="notification_badge" id="unread_messages">
                  <?php  echo $num_messages; ?></span>
                <?php }; ?>
                  </a>
               <a  href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')"><i class="fa fa-bell-o fa-lg"></i>
                        <?php if($num_notifications > 0){?>
                <span class="notification_badge" id="unread_notifications">
                  <?php  echo $num_notifications; ?></span>
                <?php }; ?>
                </a>
                <a href="requests.php" ><i class="fa fa-users fa-lg"></i>
                 <?php if($num_friend_requests > 0){?>
                <span class="notification_badge" id="unread_requests">
                  <?php  echo $num_friend_requests; ?></span>
                <?php }; ?>
                
                </a>
                <a href="#" ><i class="fa fa-cog fa-lg"></i></a>
                <a href="includes/handlers/logout_handler.php" ><i class="fa fa-sign-out fa-lg"></i></a>


        </nav>
        <?php 

        // $ajaxVar = true;
// $ajaxUrl= "includes/handlers/";
$ajaxData= "$userLoggedIn";



?>
      <div class="dropdown_data_window" style="height: 0px;"> </div>
            <input type="hidden" id="dropdown_data_type" value="">
 </div>
        
<?php require('./assets/js/test2.php');?>
    
<script>


function getDropdownData(user, type){
        //depeding on type it will load that type of data
       
       
         if(!$(".dropdown_data_window").hasClass("showDropdown")){     
                var pageName;
                if(type == 'notification'){
                
               pageName='ajax_load_notifications.php';
                $('span').remove("#unread_notifications");

               //message page is ajax php
                }else if(type == 'message'){

                        pageName='ajax_load_messages.php';

                        $('span').remove("#unread_messages");
                }

                //ajx request
                var ajaxreq = $.ajax({
                        url:"includes/handlers/"+ pageName,
                        type:"POST",
                        data:"page=1&userLoggedIn="+user,
                        cache: false, 
                        success: function(response){
                                //create dropdown table
                                $(".dropdown_data_window").html(response);
                               
                              $(".dropdown_data_window").toggleClass("showDropdown");
                                $("#dropdown_data_type").val(type);
                                  
                        }
                });
        }else{

                //hide drop down menu
                $(".dropdown_data_window").html("");
             
                $(".dropdown_data_window").toggleClass("showDropdown");
       
        }
}

</script>

