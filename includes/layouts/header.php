<?php
 require ('includes/classes/Config.php');
 require('includes/classes/User.php');
  require('includes/classes/Post.php');

// session_destroy();

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query =mysqli_query($con, "SELECT *FROM users WHERE username='$userLoggedIn'");

    $user = mysqli_fetch_array( $user_details_query);

   $user_firstname= $user['first_name'];
}else{
    header('location: register.php');
}


 $title = (isset($title)?$title:'Home');

function setTitle($title){
echo  "<title>{$title}</title>";
}



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
 <html class="no-js"> <!--<![endif]-->

    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title><?php echo (isset($title)?$title: 'Home'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
     
    </head>
    <body>

    <?php 
    $addNav=(isset($addNav)?$addNav:true) ;
    if($addNav){?>
         <div class="top_bar">
        <div class="logo">
                <a href="index.php">SwirlFeed!</a>
        </div>
        <nav>
               <a href="<?php echo $userLoggedIn; ?>"> <i id="username"><?php echo $user_firstname; ?></i></a>
                <a href="index.php" ><i class="fa fa-home fa-lg"></i></a>
                <a href="#" ><i class="fa fa-envelope-o fa-lg"></i></a>
                <a href="#" ><i class="fa fa-bell-o fa-lg"></i></a>
                <a href="requests.php" ><i class="fa fa-users fa-lg"></i></a>
                <a href="#" ><i class="fa fa-cog fa-lg"></i></a>
                <a href="includes/handlers/logout_handler.php" ><i class="fa fa-sign-out fa-lg"></i></a>


        </nav>
     </div>
     <div class="wrapper">

    
    
    
    <?php  }; ?>

    

     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->