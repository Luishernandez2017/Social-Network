<?php


class User{
    private $user;
    private $con;


    public function __construct($con, $user){
        $this->con= $con;
        $user_details_query = mysqli_query($this->con, "SELECT * FROM users WHERE username= '$user'");
     
        $this->user = mysqli_fetch_array($user_details_query);
    }
    public function getUsername(){
        return $this->user['username'];
    }

    public function getFullName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username ='$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name']." ".$row['last_name'];
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
	
	public function isFriend($username_to_check){
	
$friends= $this->user['friend_array'];
		
$friendsArray =explode(", ",$friends);

if(in_array($username_to_check, $friendsArray) || $username_to_check == $this->user['username']){
			return true;
		}else{
			return false;
			
		}
	}

}


?>