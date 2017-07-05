<?php


class User{
protected $user;
    public $con;
    private $username;
    private $first_name;
    private $last_name;
    private $email;
    private $num_posts;
    private  $num_likes;
    private $friend_array;
    private $user_closed;


    public function __construct($con, $user){
        $this->con= $con;
     

 

        $user_details_query = mysqli_query($this->con, "SELECT * FROM users WHERE username= '$user'");

            $this->user = mysqli_fetch_array($user_details_query);
       
    }
    public function getUsername(){
        return $this->user['username'];
    }

    public function getUser($property){
       return $this->user[$property];

    }
 

    public function getFullName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username ='$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name']." ".$row['last_name'];
    }

   public function getUserPic(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username ='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
    }

    public function getNumPosts(){
        $username = $this->user['username'];
        $query =  mysqli_query($this->con, "SELECT num_posts FROM users WHERE username ='$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function isClosed(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username ='$username'");
    $row = mysqli_fetch_array($query);

        if($row['user_closed']){
            return true;
            
        }else{
            return false;
        }
    }
	

    public function getfriends(){
        $friends= $this->user['friend_array'];
		
    $friendsArray =explode(",",$friends);//convert to array
    $friendsArray= array_map('trim', $friendsArray);//remove spaces
    $friendsArray = array_filter($friendsArray);//remove emtpy values
       
     return $friendsArray;


    }

    public function didReceiveRequest($user_from){
         $user_to = $this->user['username'];
         $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
         if(mysqli_num_rows($check_request_query) > 0){
             return true;
         }else{
             return false;
         }
   }


     public function didSendRequest($user_to){
         $user_from = $this->user['username'];
         $check_request_query = mysqli_query($this->con, "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
         if(mysqli_num_rows($check_request_query) > 0){
             return true;
         }else{
             return false;
         }
   }
	public function isFriend($username_to_check){
	
        $friendsArray =$this->getfriends();


        if(in_array($username_to_check, $friendsArray) || $username_to_check == $this->user['username']){
                return true;
            }else{
                return false;
                
            }
        }

   
    public function removeFriend($user_to_remove){
        $user_logged_in = $this->user['username'];
        $friend_array = $this->getFriends();
        
     
         if($this->isFriend($user_to_remove)){

            //if in array return key and use it to remove value from friend_array
        if (($key = array_search($user_to_remove, $friend_array)) !== false) unset($friend_array[$key]);
        
        $friend_array= array_map('trim', $friend_array);//remove spaces
        $friend_array = array_filter($friend_array);//remove emtpy values
        
        //convert the new array to string 
        $friend_array_to_string =implode(',', $friend_array);
       
      
        $removeFriendSql ="UPDATE users SET friend_array='$friend_array_to_string' WHERE username ='$user_logged_in'";//query
         $removeSelfSql ="UPDATE users SET friend_array='$friend_array_to_string' WHERE username ='$user_to_remove'";//query

        $remove_friend = mysqli_query($this->con, $removeFriendSql);//remove friend
        $remove_self_from_friend = mysqli_query($this->con, $removeSelfSql);//remove logged In user from friends' friends list

        
        }
    }

    public function sendRequest($user_to){
        $user_from = $this->user['username'];

        $sql ="INSERT INTO friend_requests (user_to, user_from) VALUES ('$user_to', '$user_from')";
        $sendRequest=mysqli_query($this->con, $sql);
   }
   public function handleFriendRequest($friend_to_add, $accept='Accept'){

            $user_logged_in = $this->user['username'];
            $addFriendSql ="UPDATE users SET friend_array=CONCAT(friend_array, '$friend_to_add,') WHERE username ='$user_logged_in'";//query
            $addSelfSql ="UPDATE users SET friend_array=CONCAT(friend_array, '$user_logged_in,') WHERE username ='$friend_to_add'";//query
            $deleteFriendRequestSql =    "DELETE FROM friend_requests WHERE user_to='$user_logged_in' AND user_from= '$friend_to_add'";

     
            if($this->isFriend($friend_to_add)){
                echo "Already Friends!";
            }else{ 
                   if($accept == 'Accept'){

            $add_friend = mysqli_query($this->con, $addFriendSql);//add friend
            $add_self_to_friend = mysqli_query($this->con, $addSelfSql);//add logged In user from friends' friends list
            $delete_request = mysqli_query($this->con, $deleteFriendRequestSql);
        
                   }elseif($accept == 'Ignore'){
                       
            $delete_request = mysqli_query($this->con, $deleteFriendRequestSql);

                   }else{
                       return false;
                   }
        }
               


        }
        public function getMutualFriends($user_to_check){
		
		$mutualFriends ='';//initialize mutual friends to 0
		$friendsArray = $this->getFriends();//userloggedin friends array
	
		$friend= new User($this->con, $user_to_check);//friend

		$friendsFriendsArray=$friend->getfriends();//friend's friends array
		
        $mutualFriends= array_intersect($friendsArray, $friendsFriendsArray);//mutual friends

         return $mutualFriends;
	}

}




?>