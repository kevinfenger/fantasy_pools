<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
         <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	 </a>
	 <a class="brand" href="<?php echo base_url(); ?>">Home</a>
	    <div class="nav-collapse">
	       <ul class="nav">
	          <li class="left"><?php echo anchor('home/groups', 'Groups'); ?></li>
		  <li class="left"><?php echo anchor('home/standings', 'Standings'); ?></li>
		  <li class="left"><?php echo anchor('home/subpage', 'History'); ?></li>
		  <li class="left"><?php echo anchor('home/contact', 'Contact'); ?></li>
	      </ul>
              <ul class="nav pull-right">
		  <li class="right">
                      <?php 
                          if($is_logged_in)
                          {
                             echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";  
                             echo "<img class='small_photo' src='$avatar'>";
                             echo "<span class='header_name'>$name</span>";
                             echo "</a>"; 
                          }
                          else 
                              echo anchor(base_url('login'), 'Login'); 
                      ?>
                  </li>
              </ul>
	    </div><!--/.nav-collapse -->
	 </div>
     </div>
</div>
