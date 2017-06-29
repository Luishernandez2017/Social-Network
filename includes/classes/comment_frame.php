<?php 

require ('Config.php');
 require('User.php');
  require('Post.php');
?>
<html lang="en">
<head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <!--<title></title>    -->
<link rel="stylesheet" type="text/css" href="../../assets/css/main.css"/>

    </head>
    <body>
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


?>

	<script>
		function toggle() {
			var element = document.getElementById("comment_section");

			if(element.style.display == "block") 
				element.style.display = "none";
			else 
				element.style.display = "block";
		}
	</script>

    <?php
    //get id of post
    if(isset($_GET['post_id'])){
        $post_id =$_GET['post_id'];
    }
    $sql ="SELECT added_by, user_to FROM posts WHERE id='$post_id'";

    $user_query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($user_query);

    $posted_to = $row['added_by'];

if(isset($_POST['postComment'.$post_id])){
    $post_body = $_POST['post_body'];
    $post_body = mysqli_escape_string($con, $post_body);
    $date_time_now = date("Y-m-d H:i:s");

    $sql = "INSERT INTO comments (post_body, posted_by, posted_to, date_added, removed, post_id) 
    VALUES ('$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', '0', '$post_id') ";

    $insert_post = mysqli_query($con, $sql);

    echo "<p>Comment Posted!</p>";
}
?>


    <form action="comment_frame.php?post_id=<?php echo $post_id; ?>"  id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">

<textarea name="post_body" placeholder="post comment"></textarea>

<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">



    </form>

</body>
</html>