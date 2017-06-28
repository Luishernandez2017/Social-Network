<?php 
ob_start();//Turns on output buffering
session_start();//starts session

$timezone = date_default_timezone_set("Europe/Amsterdam");
$con = mysqli_connect("localhost", "Alexander","Great", "social");

if(mysqli_connect_errno()){
    echo "Error:". mysqli_connect_errno();
}else{

}


?>
