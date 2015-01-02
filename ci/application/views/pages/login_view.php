<div class="login-unit" id="loginModal">
  <!--div class="modal-body modal-noscrollbar"-->
  <div class="row">
    <div class="well">
      <ul class="nav nav-tabs">
        <li id="login_tab" class="active"><a href="#login" data-toggle="tab">Login</a></li>
	<li id="ca_tab"><a href="#create" data-toggle="tab">Create Account</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="login">
	  <form action='javascript:void(0);'>
	    <h5>Social Login</h5>
            <a href='#' id='fb_login'><img src='/assets/img/fb_login.png'></img></a>
	    <h5>Or</h5>
	    <div class="control-group">
	      <label class="control-label"  for="username">Email</label>
	      <div class="controls">
	        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
	      </div>
	    </div>
	    <div class="control-group">
	      <label class="control-label" for="password_local_login">Password</label>
	      <div class="controls">
	        <input type="password" id="password_local_login" name="password_local_login" placeholder="" class="input-xlarge">
	      </div>
   	    </div>
	    <div class="control-group">
              <span id="unable_to_login_txt" class="verify" style="padding-bottom:10px"></span>
	      <div class="controls">
	          <button id="local_login_button" class="btn btn-success">Login</button>
                  <a href="#" data-toggle="tab">Forgot Password?</a>
	      </div>
	    </div>
	  </form>                
	</div>
	<div class="tab-pane fade" id="create">
          <div class="image-vertical-group">
          <ul>
          <li><a href='#' id='fb_login_two'><img src='/assets/img/fb_login.png'></img></a></li>
          <li><a href='#' id='login_with_us'><img src='/assets/img/fp_login.png'></img></a></li>
          </ul>
          </div>
          <div id="fp_login" class="hidden own-login">
	  <form class="form-horizontal" action='javascript:void(0);'>
            
            <div class="login-control-group"> 
	    <label for="first_name">First Name</label>
	    <input type="text" id='first_name' name='first_name' pattern="[A-Za-z-0-9]+" value="<?php echo set_value('first_name'); ?>" class="input-xlarge" />
            <span id="first_name_verify_txt" class="verify"></span>
            </div>

	    <label>Last Name</label>
	    <input type="text" id='last_name' name='last_name' value="<?php echo set_value('last_name'); ?>" class="input-xlarge" />
            <span id="last_name_verify_txt" class="verify"></span>

	    <label for="email">Email</label>
	    <input type="email" id='email' name='email' value="<?php echo set_value('email'); ?>" class="input-xlarge" />
            <span id="email_verify_txt" class="verify"></span>
	    
            <label>Password</label>
	    <input type="password" id='password_one' name='password' value="<?php echo set_value('password'); ?>" class="input-xlarge" />
            <span id="password_verify_txt" class="verify"></span>
	    
            <label>Confirm Password</label>
	    <input type="password" id='confirm_password' name='confirm_password' value="<?php echo set_value('confirm_password'); ?>" class="input-xlarge" />
            <span id="confirm_password_verify_txt" class="verify"></span>
	    <div>
              <br />
	      <p><button id='create_local_account_button' class="btn btn-primary">Create Account</button></p>
	    </div>
	  </form>
          </div>
	</div>
      </div>
    </div>
  </div>
</div>
