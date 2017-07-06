         <div class="top_bar">
        <div class="logo">
                <a href="index.php">SwirlFeed!</a>
        </div>
        <nav>
        <?php
                $messages = new Message($con, $userLoggedIn);
                $num_messages= $messages->getUnreadMessages();
  
        
         ?>
               <a href="<?php echo $userLoggedIn; ?>"> <i id="username"><?php echo $user_firstname; ?></i></a>
                <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
                <a id="dropdownBtn" href="javascript:void(0)" onclick="getDropDownData('<?php echo $userLoggedIn; ?>', 'message')"><i class="fa fa-envelope-o fa-lg"></i>
                <?php if($num_messages > 0){?>
                <span class="notification_badge" id="unreadMessages">
                  <?php  echo $num_messages; ?></span>
                <?php }; ?>
                  </a>
                <a href="#" ><i class="fa fa-bell-o fa-lg"></i></a>
                <a href="requests.php" ><i class="fa fa-users fa-lg"></i></a>
                <a href="#" ><i class="fa fa-cog fa-lg"></i></a>
                <a href="includes/handlers/logout_handler.php" ><i class="fa fa-sign-out fa-lg"></i></a>


        </nav>
        <?php 

        $ajaxVar = true;
$ajaxUrl= "includes/handlers/";
$ajaxData= "$userLoggedIn";



?>
      <div class="dropdown_data_window" style="height: 0px;"> 
            <input type="hidden" id="dropdown_data_type" value="">

        </div>
<?php require('./assets/js/test2.php');?>
     </div>
<script>


function getDropDownData(user, type){
        //depeding on type it will load that type of data
       
       
                    if(!$(".dropdown_data_window").hasClass("showDropdown")){     
                var pageName;
                if(type == 'notification'){

               //message page is ajax php
                }else if(type == 'message'){

                        pageName='ajax_load_messages.php';

                        $('spam').remove("#unread_message");
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