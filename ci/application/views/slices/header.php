<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Home</a>
    </div> 
       <ul class="nav pull-right">
		  <li class="right">
               <?php 
                   if(!empty($this->session->userdata['id']))
                   {
                      $avatar_url = isset($this->session->userdata['avatar_url']) ? $this->session->userdata['avatar_url'] : null;
                      $first_name = isset($this->session->userdata['first_name']) ? $this->session->userdata['first_name'] : null;
                      echo "<button class='navbar-toggle' data-toggle='collapse' data-target='dropdownMenu1'>";  
                      echo "<img class='small_photo' src='$avatar_url'>";
                      echo "<span class='header_name'>$first_name</span>";
                      echo "<span class='caret'></span>";
                      echo "</button>";
                      echo "<div class='collapse navbar-collapse' id=dropdownMenu1";
                      echo "<ul class='dropdown-menu' role='menu' aria-labeledby='dropdownMenu1'>"; 
                      echo "<li role='presentation'><a role='menuitem' href='#'>Groups</a></li>";
                      echo "<li role='presentation'><a role='menuitem' href='#'>Games</a></li>";
                      echo "<li role='presentation'><a role='menuitem' href='#'>Player Lists</a></li>";
                      echo "<li role='presentation' class='divider'></li>"; 
                      echo "<li role='presentation' id='logout'><a role='menuitem' href='#'>Logout</a></li>"; 
                      echo "</ul>";                              
                      echo "</div>";
                   }
                   else 
                       echo anchor(base_url('login'), 'Login', array('class' => 'navbar-brand')); 
               ?>
           </li>
       </ul>
  </div> 
</div>
