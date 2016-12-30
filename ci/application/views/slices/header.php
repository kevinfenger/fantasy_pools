<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dropdownMenu1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> 
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="dropdownMenu1">  
       <ul class="nav navbar-nav pull-right">
               <?php 
                   if(!empty($this->session->userdata['id']))
                   {
                      $avatar_url = isset($this->session->userdata['avatar_url']) ? $this->session->userdata['avatar_url'] : null;
                      $first_name = isset($this->session->userdata['first_name']) ? $this->session->userdata['first_name'] : null;
               ?>
                      <li class="dropdown"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <?php echo $first_name; ?>
                          <span class="caret"></span>
                        </a> 
                        <ul class="dropdown-menu">
                          <li id='logout'><a href="#">Logout</a></li>
                        </ul>
                      </li> 
               <?php
                   }
                   else 
                   { 
               ?>
                     <li>
                       <a href="<?php echo base_url('login'); ?>">Login</a>
                     </li>
               <?php 
                   }
               ?>
               
       </ul>
    </div> 
  </div> 
</nav>
