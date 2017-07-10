<?php 
 $title = 'Post';
require('./includes/layouts/header.php');
 ?>
<?php 

if(isset($_GET['id'])){
    $id=$_GET['id'];
}else{
    $id=0;
}
$user = new User($con, $userLoggedIn);
?>
        <div class="user_details column"> 
                <a href="<?php echo $user->getUsername(); ?>"><img  src="<?php echo $user->getUserPic(); ?>"/></a>

                <div class="user_details_left_right">
                        <a href="<?php echo $user->getUsername(); ?>">
                        <?php echo $user->getFullName(); ?>

                        </a>
                        <br/>
                        <?php echo "Posts: " . $user->getNumPosts(). "<br/> Likes: " . $user->getNumLikes(); ?>
                </div><!--end of user_details_left-->
        </div><!--end of user_details-->
        <div class="main_column column">
            <div class="post_area">
                <?php 

                $post = new Post($con, $userLoggedIn);
                $post->getSinglePost($id);

                ?>


            
            
            </div>
        
        </div>




 <?php require('./includes/layouts/footer.php'); ?>