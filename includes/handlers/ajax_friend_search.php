<?php
include('../classes/Config.php');
include('../classes/User.php');

$query = $_POST['query'];
$userLoggedIn= $_POST['userLoggedIn'];

$names= explode(" ", $query);


//same typ == (string)
if(strpos($query, "_") !== false){//searching for username
$userReturned= mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed=0 LIMIT 8");

}elseif(count($names)==2){//searching by first or last names
    
$userReturned= mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%')  AND user_closed=0 LIMIT 8");

}else{
$userReturned= mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%')  AND user_closed=0 LIMIT 8");

}

if($query !=""){
    while($row= mysqli_fetch_array($userReturned)){
        $user= new User($con, $userLoggedIn);
        if($row['username'] != $userLoggedIn){
            $mutual_friends = count($user->getMutualFriends($row['username']))." friends in common";
        }else{
            $mutual_friends="";
        }
        if($user->isFriend($row['username'])){
            $username= new User($con, $row['username']);
            echo "<div class='resultDisplay'>";
            echo "<a href='messages.php?u=".$username->getUsername()."' >";
            echo "<div class='liveSearchProfilePic'>";
            echo "<img src='".$username->getUserpic()."'>";
            echo "</div>";//end of liveSearchProfilePic
            echo "<div class='liveSearchText'><p class='name'>".$username->getFullName();
            echo "</p><p class='username'>".$username->getUsername()."</p>";
            echo "<p class='grey'>".$mutual_friends."</p>";
            echo "</div>";//end of liveSearchText div
            echo "</a>";
            echo "</div>";//en of resultDisplay div    
                
        }
    }
}
// (strpos($query, "@") !==false)//by email
//$userReturned= mysqli_query($con, "SELECT * FROM users WHERE email LIKE '$query%' AND user_closed=0 LIMIT 1");

 ?>