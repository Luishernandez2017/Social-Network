
<?php require('./includes/layouts/header.php'); ?>


<?php 

        if(isset($_POST['post'])){
                $post = new Post($con, $userLoggedIn);
               $post->submitPost($_POST['post_text'], 'none');
			
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

<div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
                <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
       <input type="submit" name="post" id="post_button"  value="post"/>
        </form>


	<div class="posts_area"></div>
	<img id="loading"  src="assets/images/icons/loading.gif"/>

</div>

<?php require('./assets/js/infinite_scroll.php');?>
<!--

<script type="text/javascript" src="assets/js/ininite_scroll.js">
	
</script>
-->





<?php require('./includes/layouts/footer.php'); ?>
        
