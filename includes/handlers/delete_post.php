<?php 

require ('../classes/Config.php');
include_once('../classes/functions.php');//require cuae redeclaration of function



if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}


    if(isset($_POST['result'])){
     
        if($_POST['result']== true){
            $query = mysqli_query($con, "UPDATE posts SET deleted='1' WHERE id='$post_id'");

        }
    
}
?>