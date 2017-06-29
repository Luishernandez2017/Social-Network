
<?php
 $title= 'Login';
 require ('includes/classes/Config.php');
 //require('includes/layouts/header.php');
 require ('includes/form_handlers/register_handler.php');
 require ('includes/form_handlers/login_handler.php');


?>
  <link rel="stylesheet" type="text/css" href="./assets/css/register.css"/>
  
<?php 
$success = (isset($success)?$success: null);
     function displayMessage($error_array, $success){
    if(!empty($error_array)){
    foreach($error_array as $error){
          echo "<p><span style='color: red;'>".$error."</span></p>";
              } 
         }
   if(isset($success)){
         echo "<p><span style='color: green;'>".$success."</span></p>";
         }
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
 
    </head>
    <body>

    <div class="main-wrapper">       
        <div class="login_box">
            <div class="login_header">
                <h1>SwirlFeed!</h1>
                <p>Login or Signup below!</p>
                
            </div><!--end of login-header-->
        
            <div class="login-container">
                <form action="register.php" method="POST">
                    <input type="text" name="log_email" placeholder="Email" 
                    value="<?php if(isset($_SESSION['log_email'])){ echo $_SESSION['log_email']; };?>"/>

                    <input type="password" name="log_password" placeholder="Password" />
                    <br/>
                        <input type="submit" class="submit" name="login_button" value="Login"/>
                    <br/>
                    <div class="error-msg-container">
                 <?php displayMessage($error_array, $success); ?>
                 </div>
                    <a href="#" id="signupLink" class="signup" >Need an account? Register Here!</a>


                </form>
                
            </div><!--end of login-container-->
        
                
            <div id="signup-container" class="signup-container hide" >
                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){  
                        echo $_SESSION['reg_fname'];
                        }; 
                    ?>" required/>
                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){  
                        echo $_SESSION['reg_lname'];
                        }; 
                    ?>" required/>
                    <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){  
                        echo $_SESSION['reg_email'];
                        }; 
                    ?>" required/>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])){  
                        echo $_SESSION['reg_email2'];
                        }; 
                    ?>" required/>
                    <input type="password" name="reg_password" placeholder="Password" required/>
                    <input type="password" name="reg_password2" placeholder="Password2" required/>
                    <br/>
                    <input type="submit" class="submit" name="register_button" value="Register">
                    <br/>
                    <div class="error-msg-container">
                    <?php 
                        displayMessage($error_array, $success); 

                    ?>
                    </div>
                <a href="#" id="loginLink" class="signup" >Need an account? Register Here!</a>

                </form>
            </div> <!--end of signup-container-->
        </div><!--end of login-box-->
    </div><!--end of main-wrapper-->
    
 <script type="text/javascript" src="./assets/js/register.js">
         
     </script>
 <?php require('includes/layouts/footer.php'); ?>