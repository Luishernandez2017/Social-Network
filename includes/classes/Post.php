<?php
include_once('functions.php');

class Post{
    private $user_obj;
    private $con;


    public function __construct($con, $user){
        $this->con=$con;
        $this->user_obj = new User($con, $user);

    }

public function submitPost($body, $user_to){
    $body = strip_tags($body);//remove html tags
    $body = mysqli_real_escape_string($this->con, $body);
    $check_empty = preg_replace('/\s+/', '', $body);//deletes spaces

    if($check_empty != ""){

        //Current date and time
        $date_added =date("Y-m-d H:i:s");

        //Get username
        $added_by = $this->user_obj->getUsername();

        //If user is on own profile, user_to is 'none'
        if($user_to == $added_by){
            $user_to = "none";
        }
        $sql =  "INSERT INTO posts (body, added_by, user_to, date_added, user_closed, deleted, likes) VALUES ('$body', '$added_by', '$user_to', '$date_added', '0', '0', '0')";
        //insert post
        $query = mysqli_query($this->con, $sql);
        $return_id = mysqli_insert_id($this->con);

        //Insert notification


        //Update  post count of user
        $num_posts = $this->user_obj->getNumPosts();
        $num_posts++;
        $update_query = mysqli_query($this->con, "UPDATE users SET num_posts = '$num_posts' WHERE username ='$added_by'");
    }

}

public function loadPostsByFriends($requestData, $limit){
$page = $requestData['page'];

$userLoggedIn = $this->user_obj->getUsername();
	
	if($page == 1){//first item from table 
	$start = 0;
	}else{
		$start = ($page - 1) * $limit;//limit= 10
	}
    $str ="";
    $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted ='0' ORDER BY id DESC");

	
	if(mysqli_num_rows($data_query) > 0){
		
		$num_iterations = 0;//Number of results checked (not necessarily posted)
		
		$count = 1;//results loaded
		
			while($row = mysqli_fetch_array($data_query)){
			  $id =  $row['id'];
			  $body=  $row['body'];
			  $added_by =  $row['added_by'];
			  $date_time= $row['date_added'];
			


			  //prepare user to string so it can be included even if not posted to a user
			  if($row['user_to'] == 'none'){
					$user_to = '';

			  }else{
				  $user_to_obj = new User($this->con, $row['user_to']);
				  $user_full_name= $user_to_obj->getFullName();
				  $user_to=" to <a href='".$row['user_to']."'>". $user_full_name."</a>";


			  }

			  //Check if user who posted, has their account closed
			  $added_by_obj = new User($this->con, $added_by);
			  if($added_by_obj->isClosed()){
				  continue;
			  }
				
				$user_logged_obj = new User($this->con, $userLoggedIn);

			//var_dump($this->user_obj->getUsername());
				if($user_logged_obj->isFriend($added_by)){
			
					
				//interation++ until you reach new start 
					if($num_iterations++ < $start){
						continue;//go back to top
					}
					
				//once 10 post have be loaded break
				
					if($count > $limit){
						break;//stop while
					}else{
	//					
					$count++;//continue to increment post loaded
					}

				  $user_details_query = mysqli_query($this->con, 
				  "SELECT first_name, last_name, profile_pic FROM users
				  WHERE username='$added_by'
				  ");

				  $user_row = mysqli_fetch_array($user_details_query);

				  $first_name = $user_row ['first_name'];
				  $last_name = $user_row ['last_name'];
				  $profile_pic = $user_row ['profile_pic'];


/*****************   Comments  **********************/
?>
<script>

function toggle<?php echo $id; ?>(){
	var target = $(event.target);

	if(!target.is("a")){//if it is a link don't show comments

	
	var element = document.getElementById("toggleComment<?php echo $id; ?>");

		if(element.style.display == "block"){
			element.style.display = "none";
		}else{
			element.style.display = "block";
		}
	}
}


</script>


<?php

					$comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
					$comments_check_num = mysqli_num_rows($comments_check);
					$time_message=	dateAdded($date_time);//functions.php

					$str .="<div class='status_post' onClick='javascript:toggle$id()'>";

					$str .="<div class='post_profile_pic'>";
					$str .="<img src='$profile_pic'>";
					$str .="</div>";

					$str .="<div class='posted_by' style='color: #ACACAC;' >";
					$str .="<a href='$added_by'> $first_name $last_name</a>";
					$str .="$user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message";
					$str .="</div>";

					$str .="<div id='post_body'>$body<br><br><br></div>";

					$str .="<div class='newsFeedPostOptions' >";
					$str .="Comments($comments_check_num) &nbsp;&nbsp;&nbsp;&nbsp;";
					$str .="</div>";

					$str .="</div>";
					$str .="<div class='post_comment' id='toggleComment$id' style='display:none;'>";
					$str .="<iframe src='http://localhost/PHP-course/Udemy%20PHP/SOCIAL_NETWORK/includes/layouts/comment_frame.php?post_id=$id' style='width:100%' id='comment_iframe' frameborder='0'></iframe>";
					$str .="</div>";
				
					$str .="<hr/>";
				}
			}
if($count > $limit){
			$str .= "<input type='hidden' class='nextPage' value='".($page+1)."'/>";
			$str .= "<input type='hidden' class='noMorePosts' value='false'/>";
		}else{
 		    $str .= "<input type='hidden' class='noMorePosts' value='true'/>";
			$str .= "<p class='no-posts' style='color: #ACACAC;'> No more Posts to show!</p>";
		}
     }// end of While Loop
	echo $str;
	
   }//end of loadPostsByFriends block
}


?>