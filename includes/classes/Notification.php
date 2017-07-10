<?php include_once('functions.php'); ?>
<?php

class Notification extends User{


    public function getUnreadNumber(){
        $userLoggedIn = $this->getUsername();
        
        $unreadSql ="SELECT * FROM notifications WHERE viewed=0 AND user_to='$userLoggedIn'";
        $query = mysqli_query ($this->con, $unreadSql);
        return mysqli_num_rows($query);
    }
    public function insertNotification($post_id, $user_to, $type){
        $userLoggedIn = $this->getUsername();
        $userLoggedInName = $this->getFullName();

        $date_time= date("Y-m-d H:i:s");
        
        switch($type){
            case 'comment':
            //comment on your post
                $notification_message= $userLoggedInName." commented on your post";
                break;
                //like on your post
            case 'like':
                $notification_message= $userLoggedInName." liked your post";
                break;
                //post on your profile 
            case 'profile_post':
                $notification_message =$userLoggedInName." posted on your profile";
                break;
                //comment on a post you commented on
            case 'comment_non_owner':
                $notification_message = $userLoggedInName." commented on a post you commented on";
                break;
                //comment on your profile post
            case 'profile_comment':
                $notification_message = $userLoggedInName." commented on your profile post";
                break;
        }
        $link = "post.php?id=". $post_id;
        $insertSql ="INSERT INTO notifications 
        (user_to, user_from, message, link, datetime, opened, viewed) 
        VALUES ('$user_to', '$userLoggedIn', '$notification_message', '$link', '$date_time', 0, 0) ";

        $insert_query = mysqli_query($this->con, $insertSql);

         var_dump($insert_query);
    }

    public function getNotificationsDropdown($data, $limit){
        $page = $data['page'];

        $userLoggedIn= $this->getUsername();
        $output = "" ;
        
            if($page == 1){
                $start = 0;
                
            }else{
                $start =($page-1) * $limit;
            }
            $viewedSql= "UPDATE notifications SET viewed=1 WHERE user_to='$userLoggedIn'";

            $set_view_query = mysqli_query($this->con, $viewedSql);
        
        $notificationSql = "SELECT * FROM notifications WHERE user_to='$userLoggedIn' ORDER BY id DESC";
        $notification_query= mysqli_query($this->con, $notificationSql);

        if(mysqli_num_rows($notification_query) == 0){
            echo "You have no notifications";
            return;
        }

        $num_iterations= 0;//number of messages checked
        $count= 1;//number of messages posted


        while($row=mysqli_fetch_array($notification_query)){
            if($num_iterations++ < $start){
                continue;
            }
            if($count > $limit){
                break;
            }else{
                $count++;
            }

            $user_from = $row['user_from'];

            $userDataSql="SELECT * FROM users WHERE username='$user_from'";

            $user_data_query= mysqli_query($this->con, $userDataSql);

            $user_data = mysqli_fetch_array($user_data_query);
            
            $date_time= $row['datetime'];


            $time_message = dateAdded($date_time);//from functions
            

            $opened= $row['opened'];
            $class= ($opened == 0)? "opened":"not-opened";


             $output .="<a class='notification_container' href='".$row['link']."'>";
             $output .="<div class='resultDisplay resultDisplayNotification $class'>";
             $output .="<div class='notificationsProfilePic'>";
             $output .="<img src='".$user_data['profile_pic']."'>";
             $output .="<p class='time' id='grey'>".$time_message. "</p>";
             $output .="</div>";
             $output .="<p class='notification_message'>".$row['message']."</p>";
             $output .="</div>";
             $output .="</a>";
                        
        }

        //if Posts were loaded 
        if($count > $limit){
            $output .="<input type='hidden' class='nextPageDropdownData' value='".($page + 1)."'>";
            $output .="<input type='hidden' class='noMoreDropdownData' value='false'>";
        }else{
              //if Posts were loaded 
        

            $output .="<input type='hidden' class='noMoreDropdownData' value='true'>";
            $output .="<p style='text-align: center; color: #D3D3D3;'> No more Notifications to load!</p>";
        
        }

        return $output;
    }

}




?>