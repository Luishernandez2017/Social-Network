<?php

   //Declaring variables to prevent errors
    $fname= "";
    $lname="";
    $email="";
    $email2="";
    $password="";
    $password2="";
    $date="";
    $error_array= array();
 
    
    if(isset($_POST['register_button'])){
       
        //Registration form values
        $fname= strip_tags($_POST['reg_fname']);//remove html tags
        $fname = str_replace(' ', '', $fname);//remove spaces
        $fname = ucfirst(strtolower($fname));//uppercase first letter

        $_SESSION['reg_fname'] = $fname;//store first name in session

        $lname= strip_tags($_POST['reg_lname']);//remove html tags
        $lname = str_replace(' ', '', $lname);//remove spaces
        $lname = ucfirst(strtolower($lname));//uppercase first letter 
        $_SESSION['reg_lname'] = $lname;//store last name in session 

        $email= strip_tags($_POST['reg_email']);//remove html tags
        $email = str_replace(' ', '', $email);//remove spaces
        $_SESSION['reg_email'] = $email;//store first name in session

        
        $email2= strip_tags($_POST['reg_email2']);//remove html tags
        $email2 = str_replace(' ', '', $email2);//remove spaces
        $_SESSION['reg_email2'] = $email2;//store first name in session
        
        $password= strip_tags($_POST['reg_password']);//remove html tags
        $password = str_replace(' ', '', $password);//remove spaces

        
        $password2= strip_tags($_POST['reg_password2']);//remove html tags
        $password2 = str_replace(' ', '', $password2);//remove spaces

        $date = date("Y-m-d");//current date

        if($email === $email2){


                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);//validated email

                    //check if email already exists
                    $e_check= mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                   $num_rows = mysqli_num_rows($e_check);//number of rows returned

                   if($num_rows > 0){
                       array_push($error_array , "Email already in use");
                   }




                }else{
                     array_push($error_array ,"Invalid Format");
                }//current if block
                
        }else{//email comparison block

            echo "Emails do not match";
        }

        if(strlen($fname)> 25 || strlen($fname)<2){
             array_push($error_array , "Your first name must be between 2 and 25 characters");
        }//end of fname check

        if(strlen($lname)> 25 || strlen($lname)<2){
             array_push($error_array , "Your first name must be between 2 and 25 characters");
        }//end of lname check

  

        if($password != $password2 ){
             array_push($error_array , "Your passwords do not match!");
        }else{
            if(preg_match('/[^A-Za-z0-9]]/', $password)){
                 array_push($error_array , "Your password can only contain english characters or numbers");

            }
        }//end of password and pass2 check
        
        if(strlen($password) > 30 || strlen($password) < 5){
           
             array_push($error_array , "password must be between 5 -30 characters");
        }
      
        if(empty($error_array)){

            $password = md5($password);//has password

            $username = strtolower($fname."_".$lname);
            $check_username_query = mysqli_query($con, "SELECT username From users WHERE username = 'username'");

            $i=0;

            //if username exists add number to username

            while(mysqli_num_rows($check_username_query) != 0){
                $i++;
                $username = $username."_". $i;

                $check_username_query = mysqli_query($con, "SELECT username From users WHERE username = 'username'");

                



            }
   $defaultPics = array(
	   "alizarin", "amethyst", "belize_hole", "carrot", "deep_blue", "emerald", "green_sea", "nephritis",
		"pete_river", "pomegranate", "pumpkin", "red", "sun_flower", "turqoise", "wet_asphalt", "wisteria"
   );

		$profile_pic = "assets/images/profile_pics/defaults/head_".$defaultPics[array_rand($defaultPics, 1)].".png";
			
        $query = mysqli_query($con, "INSERT INTO users (first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes)
        VALUES ('$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0','0' )");

            $_SESSION['req_fname']="";
            $_SESSION['req_lname']="";
            $_SESSION['req_email']="";

            $success = "New user created !";



        }

    }


?>