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
	          <li><?php echo anchor('home/groups', 'Groups'); ?></li>
		  <li><?php echo anchor('home/standings', 'Standings'); ?></li>
		  <li><?php echo anchor('home/subpage', 'History'); ?></li>
		  <li><?php echo anchor('home/contact', 'Contact'); ?></li>
	      </ul>
	    </div><!--/.nav-collapse -->
	 </div>
     </div>
</div>
