<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
         <!--a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	 </a-->
	 <a class="brand" href="<?php echo base_url(); ?>">Home</a>
	    <!--div class="nav-collapse"-->
	       <!--ul class="nav">
	          <li class="left"><?php echo anchor('home/groups', 'Groups'); ?></li>
		  <li class="left"><?php echo anchor('home/standings', 'Standings'); ?></li>
		  <li class="left"><?php echo anchor('home/subpage', 'History'); ?></li>
		  <li class="left"><?php echo anchor('home/contact', 'Contact'); ?></li>
	      </ul-->
              <ul class="nav pull-right">
		  <li class="right">
                      <?php 
                          if(!empty($this->session->userdata['id']))
                          {
                             $avatar_url = isset($this->session->userdata['avatar_url']) ? $this->session->userdata['avatar_url'] : null;
                             $first_name = isset($this->session->userdata['first_name']) ? $this->session->userdata['first_name'] : null;
                             echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' id='dropdownMenu1'>";  
                             echo "<img class='small_photo' src='$avatar_url'>";
                             echo "<span class='header_name'>$first_name</span>";
                             echo "<span class='caret'></span>";
                             echo "</a>";
                             echo "<ul class='dropdown-menu' role='menu' aria-labeledby='dropdownMenu1'>"; 
                             echo "<li role='presentation'><a role='menuitem' href='#'>Groups</a></li>";
                             echo "<li role='presentation'><a role='menuitem' href='#'>Games</a></li>";
                             echo "<li role='presentation'><a role='menuitem' href='#'>Player Lists</a></li>";
                             echo "<li role='presentation' class='divider'></li>"; 
                             echo "<li role='presentation' id='logout'><a role='menuitem' href='#'>Logout</a></li>"; 
                             echo "</ul>";                              
                          }
                          else 
                              echo anchor(base_url('login'), 'Login'); 
                      ?>
                  </li>
              </ul>
	    <!--/div--><!--/.nav-collapse -->
     </div>
</div>
