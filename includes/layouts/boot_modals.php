<!-- Modal Posting-->
<div class="modal fade" id="myPostModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Post Something</h4>
      </div>
      <div class="modal-body">
        <p>This will appear on the user's profile page and also on their newsfeed for your friends to see!</p>
        <form class="profile_post" action="" method="POST">
            <div class="form-group">
                <textarea class="form-control" name="post_body"></textarea>
                <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
                 <input type="hidden" name="user_to" value="<?php echo $username; ?>">
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="submitProfilePost" name="post_button" class="btn btn-primary">Post</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for Mutual Friends-->
<div class="modal fade" id="mutualFriendsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mutual Friends</h4>
      </div>
      <div class="modal-body">
    
              <?php 
            
              $mutualFriendsArray=$logged_in_user_obj->getMutualFriends($username);
              echo "<ul class='mutualFriendList'>";
              foreach($mutualFriendsArray as $mutualFriend){
                  $username= $mutualFriend;//to hold usernames
                  $mutual_friend_obj= new User($con, $mutualFriend);

                  echo "<li><a href='$username'><img src='".$mutual_friend_obj->getUserPic()."' /><span>&nbsp;&nbsp;&nbsp;". $mutual_friend_obj->getFullName()."</span></a></li>";
              }
              echo "</ul>";
              
               ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
      <!--<button type="button" id="submitProfilePost" name="post_button" class="btn btn-primary">Ok</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal Own Friends-->
<div class="modal fade" id="friendsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">My Friends</h4>
      </div>
      <div class="modal-body">
    
           <?php 
            
              $modalUser= new User($con, $userLoggedIn);
              $friendsArray = $modalUser->getfriends();
              echo "<ul class='mutualFriendList'>";
              foreach($friendsArray as $friend){
                  $username= $friend;//to hold usernames
                  $friend_obj= new User($con, $friend);

                  echo "<li><a href='$username'><img src='".$friend_obj->getUserPic()."' /><span>&nbsp;&nbsp;&nbsp;". $friend_obj->getFullName()."</span></a></li>";
              }
              echo "</ul>";
              
               ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
      <!--<button type="button" id="submitProfilePost" name="post_button" class="btn btn-primary">Ok</button>-->
      </div>
    </div>
  </div>
</div>