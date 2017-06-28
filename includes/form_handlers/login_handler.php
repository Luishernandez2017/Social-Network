<?php

if(isset($_POST['login_button'])){
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);//sanitize email
    
    $_SESSION['log_email']= $email;//store email into session variable

    $password = md5($_POST['log_password']);//get and hash post password

    $check_database_query = mysqli_query($con, "SELECT * From users WHERE email='$email' AND password='$password'");

    $check_login_query = mysqli_num_rows($check_database_query);
    // var_dump($check_login_query);

    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);//row returned
        $username = $row['username'];//username from return
     
         $_SESSION['username']= $username;
        // username session
          $success= "Login was Successful !";

$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed= 1");
       
if(mysqli_num_rows($user_closed_query)==1){
    $reopen_account = mysqli_query($con, "UPDATE users SET user_closed=0 WHERE email='$email'");

// $_SESSION['username']= $username;
}
  
       header("Refresh:2; index.php");//redirect to index.php
     
    }else{
        array_push($error_array, "Email or password was incorrect<br/>");
        

    }

  

    

}


?>