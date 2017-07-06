<?php include_once('functions.php'); ?>
<?php

class Message extends User{

    public function getMostRecentuser(){

        $userLoggedIn = $this->getUsername();//access parents functions
    
        $sql= "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1";
    
     $query = mysqli_query($this->con, $sql);

    
        if(mysqli_num_rows($query)== 0){
            return false;
        }else{
            $row= mysqli_fetch_array($query);
            $user_to =$row['user_to'];
            $user_from= $row['user_from'];

            if($user_to != $userLoggedIn){
                return $user_to;
            }else{
                return $user_from;
            }
        }
    
    }
    public function sendMessage($user_to, $body, $date){
        if($body != ""){
            $userLoggedIn = $this->getUsername();
            $sql="INSERT INTO  messages (user_to, user_from, body, `date`, opened, viewed, deleted) 
            VALUES ('$user_to', '$userLoggedIn', '$body', '$date','0', '0', '0') ";
            $query = mysqli_query($this->con, $sql);

            //var_dump($query);
        }
    }
    public function getMessages($otherUser){
        $userLoggedIn= $this->getUsername();

        $data= "";
        $updateSql= "UPDATE messages SET opened=1 WHERE user_to='$userLoggedIn' AND user_from='$otherUser'";
       
        $getSql = "SELECT * FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$otherUser') 
        OR (user_from='$userLoggedIn' AND user_to='$otherUser')";

        $update_query= mysqli_query($this->con, $updateSql);

        $get_messages_query = mysqli_query($this->con, $getSql);

        while($row= mysqli_fetch_array($get_messages_query)){
            $user_to= $row['user_to'];
            $user_from= $row['user_from'];
            $body= $row['body'];

            $div_top= ($user_to == $userLoggedIn)?"<div class='message' id='green'>":"<div class='message' id='blue'>";
            $data .=  $div_top. "<p>".$body. "</p></div>";

        }
        return $data;
    }
    public function getLatestMessage($userLoggedIn, $otherUser){
        $details_array = array();

        $messageSql= "SELECT body, user_to, date FROM messages 
        WHERE (user_to='$userLoggedIn' AND user_from='$otherUser')
         OR (user_to='$otherUser' AND user_from='$userLoggedIn') ORDER BY id DESC LIMIT 1";

         $message_query = mysqli_query($this->con, $messageSql);

         $row= mysqli_fetch_array($message_query);

         $sent_by= ($row['user_to']== $userLoggedIn)?"Sent: ": "You said: ";
        $date_time= $row['date'];

         $time_message= dateAdded($date_time);//function from functions
               
               //push to array 
                array_push($details_array, $sent_by);
                array_push($details_array, $row['body']);
                array_push($details_array, $time_message);

                return $details_array;//return array
    
    }
    public function getConversations(){
        $userLoggedIn= $this->getUsername();
        $output = "" ;
        $convos = array();
        $conSql="SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC";

        $con_query= mysqli_query($this->con, $conSql);

        while($row = mysqli_fetch_array($con_query)){
            $user_to_push =($row['user_to'] != $userLoggedIn)?$row['user_to']: $row['user_from'];
         
            if(!in_array($user_to_push, $convos)){
                array_push($convos, $user_to_push);

            }
        }
        foreach($convos as $username){
            $user_found_obj = new Message($this->con, $username);
            $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

            $dots = (strlen($latest_message_details[1])>=10)?"...": "";//check if body is longer than 12characters

            $split = str_split($latest_message_details[1], 10);//split content after 12 characters
            
            $split = $split[0].$dots;//split message and append 3 dots

            $output .="<a href='messages.php?u=$username'>
                        <div class='user_found_messages'>
                        <img src='".$user_found_obj->getUserPic()."' class='conversation-pic'> "."<span class='username'>".$user_found_obj->getFullName()."</span>".
                        " <br><span class'timestamp_smaller grey' >".$latest_message_details[2]."</span>".
                        "<p class='latest-message grey' >".$latest_message_details[0].$split."</p>".
                        "</div>".
                        "</a>";
                        
        }
        return $output;
    }
    public function getConversationsDropdown($data, $limit){
        $page = $data['page'];

        $userLoggedIn= $this->getUsername();
        $output = "" ;
        $convos = array();
        
            if($page == 1){
                $start = 0;
                
            }else{
                $start =($page-1)*$limit;
            }
            $viewedSql= "UPDATE messages SET viewed=1 WHERE user_to='$userLoggedIn'";

            $set_view_query = mysqli_query($this->con, $viewedSql);
$conSql="SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC";
        $con_query= mysqli_query($this->con, $conSql);

        while($row = mysqli_fetch_array($con_query)){
            $user_to_push =($row['user_to'] != $userLoggedIn)?$row['user_to']: $row['user_from'];
         
            if(!in_array($user_to_push, $convos)){
                array_push($convos, $user_to_push);

            }
        }
        $num_iterations= 0;//number of messages checked
        $count= 1;//number of messages posted


        foreach($convos as $username){
            if($num_iterations++ < $start){
                continue;
            }
            if($count > $limit){
                break;
            }else{
                $count++;
            }

            $unreadSql="SELECT opened FROM messages WHERE user_to='$userLoggedIn' AND user_from='$username' ORDER BY id DESC ";
            $is_unread_query= mysqli_query($this->con, $unreadSql);
            $row=mysqli_fetch_array($is_unread_query);
            $class= ($row['opened'] == 0)? "opened":"";




            $user_found_obj = new Message($this->con, $username);
            $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

            $dots = (strlen($latest_message_details[1])>=10)?"...": "";//check if body is longer than 12characters

            $split = str_split($latest_message_details[1], 10);//split content after 12 characters
            
            $split = $split[0].$dots;//split message and append 3 dots

             $output .="<a href='messages.php?u=$username'>";
             $output .="<div class='user_found_messages ".$class."' >";
             $output .="<img src='".$user_found_obj->getUserPic()."' class='conversation-pic'> "."<span class='username'>".$user_found_obj->getFullName()."</span>";
             $output .="<span class='time grey' >".$latest_message_details[2]."</span>";
             $output  .="<p class='latest-message grey' >".$latest_message_details[0].$split;
             if($class=="opened"){
                $output .="<span class='opened-message'>responded</span>";
             }else{
                  $output .="<span class='unopened-message'>unaswered</span>";
             }
             $output .="</p>";
             $output .="</div>";
             $output .="</a>";
                        
        }

        //if Posts were loaded 
        if($count > $limit){
            $output .="<input type='hidden' class='nextPageDropdownData' value='".($page+1)."'>";
            $output .="<input type='hidden' class='noMoreDropdownData' value='false'>";
        }else{
              //if Posts were loaded 
        if($count > $limit){

            $output .="<input type='hidden' class='noMoreDropdownData' value='true'>";
            $output .="<p style='text-align: center;'> No more messages to load!</p>";
        }
        }

        return $output;

    }
    public function getUnreadMessages(){
        $userLoggedIn = $this->getUsername();
       
        $readSql = "SELECT * FROM messages WHERE viewed=0 AND user_to='$userLoggedIn'";
       
        $read_query = mysqli_query($this->con, $readSql);
       
        return mysqli_num_rows($read_query);

    }



}


?>