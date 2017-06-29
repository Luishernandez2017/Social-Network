     <div class="top_bar">
        <div class="logo">
                <a href="index.php">SwirlFeed!</a>
        </div>
        <nav>
               <a href="<?php echo $userLoggedIn; ?>"> <i id="username"><?php echo $user_firstname; ?></i></a>
                <a href="index.php" ><i class="fa fa-home fa-lg"></i></a>
                <a href="#" ><i class="fa fa-envelope-o fa-lg"></i></a>
                <a href="#" ><i class="fa fa-bell-o fa-lg"></i></a>
                <a href="#" ><i class="fa fa-users fa-lg"></i></a>
                <a href="#" ><i class="fa fa-cog fa-lg"></i></a>
                <a href="includes/handlers/logout_handler.php" ><i class="fa fa-sign-out fa-lg"></i></a>


        </nav>
     </div>
     <div class="wrapper">