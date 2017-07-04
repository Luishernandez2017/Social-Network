<?php 

require ('../classes/Config.php');
include_once('../classes/functions.php');//require cuae redeclaration of function
require('../classes/User.php');
require('../classes/Post.php');
?>
<html lang="en">
<head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <!--<title></title>    -->
<link rel="stylesheet" type="text/css" href="http://localhost/PHP-course/Udemy%20PHP/SOCIAL_NETWORK/assets/css/main.css"/>

    </head>
    
    <body>
        <style>


        
        	* {
		font-family: Arial, Helvetica, Sans-serif;
	}
	body {
		background-color: #fff;
	}

	form {
		position: absolute;
		top: 0;
	}


.comment_like {
    background-color: #fff;
    font-size: 14px;
    border: none;
    color: #3498db;
    padding: 0;
}

.like_value {
    display: inline;
    font-size: 14px;
        line-height: 1.8;
    
}

        
        </style>

<?php
// session_destroy();

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query =mysqli_query($con, "SELECT *FROM users WHERE username='$userLoggedIn'");

    $user = mysqli_fetch_array( $user_details_query);

   $user_firstname= $user['first_name'];
}else{
    header('location: register.php');
}




   //get id of post
    if(isset($_GET['post_id'])){
        $post_id =$_GET['post_id'];
    }

//Like query
$sql ="SELECT likes, added_by FROM posts WHERE id='$post_id'";
    $get_likes = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($get_likes);
    $total_likes = $row['likes'];
    $user_liked = $row['added_by'];
    
    //echo    $total_likes = $row['likes'];
   $user_liked = $row['added_by'];
    


//User details
    $details_sql = "SELECT * FROM users WHERE username = '$user_liked'";
    $user_details_query= mysqli_query($con, $details_sql );
    $userRow= mysqli_fetch_array($user_details_query);
    $total_user_likes= $userRow['num_likes'];
//echo $total_likes;
    //like button 
    if(isset($_POST['like_button'])){
        $total_likes++ ;
        $query= mysqli_query($con,  "UPDATE posts SET likes= '$total_likes' WHERE id= '$post_id'");
        
        $total_user_likes++;
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes= '$total_user_likes' WHERE username= '$user_liked'");
        $insert_user = mysqli_query($con, "INSERT INTO likes (username, post_id ) VALUES ('$userLoggedIn', '$post_id')");
        echo ($insert_user);
        //insert notification
  }

    //unlike button
        //like button 
    if(isset($_POST['unlike_button'])){
        $total_likes-- ;
        $query= mysqli_query($con,  "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
        
        $total_user_likes--;
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($con,  "DELETE FROM  likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
        
        //insert notification
  }



    //check for previous likes
    $check_sql="SELECT * FROM likes WHERE username ='$userLoggedIn' AND post_id='$post_id' ";
    $check_like_query = mysqli_query($con, $check_sql);
    $num_rows = mysqli_num_rows($check_like_query);
    $output = '';
    if($num_rows > 0){
        
        $output .= "<form action='http://localhost/PHP-course/Udemy%20PHP/SOCIAL_NETWORK/includes/handlers/like.php?post_id=".$post_id."' method='POST'>";
        $output .=      "<input type='submit' class='comment_like' name='unlike_button' value='Unlike '>";
        $output .=      "<div class='like_value'>".$total_likes." Likes</div>";
        $output .= "</form>";
     
     
    }else{
       
        $output .= "<form action='http://localhost/PHP-course/Udemy%20PHP/SOCIAL_NETWORK/includes/handlers/like.php?post_id=".$post_id."' method='POST'>";
        $output .=      "<input type='submit' class='comment_like' name='like_button' value='Like '>";
        $output .=      "<div class='like_value'>".$total_likes." Likes </div>";
        $output .= "</form>";
     

    }
    echo $output;


    ?>

    </body>
    </html>