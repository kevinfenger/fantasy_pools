<div class="login-unit" id="loginModal">
  <!--div class="modal-body modal-noscrollbar"-->
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-heading">
	  <div class="row">
	    <div class="col-xs-6">
	      <a href="#" class="active" id="login-form-link">Login</a>
	    </div>
	    <div class="col-xs-6">
	      <a href="#" id="register-form-link">Register</a>
	    </div>
	  </div>
	  <hr>
	</div>
        <div class="panel-body"> 
          <div class="row">
            <div class="col-lg-12">
	      <form id="login-form" action='javascript:void(0);'>
                <div class="form-group"> 
	          <input type="text" id="username" name="username" placeholder="Username" value="" tabindex="1" class="form-control">
                </div> 
                <div class="form-group"> 
	          <input type="password" id="password_local_login" name="password_local_login" tabindex="2" class="form-control" placeholder="Password">
                </div>
                <div class="form-group"> 
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> 
                      <button id="local_login_button" class="btn btn-block btn-success">Login</button>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> 
                      <a class="btn btn-block btn-social btn-facebook" href='#' id='fb_login'><span class="fa fa-facebook"></span>Sign in with Facebook</a>
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <form id"register-form" action='javascript:void(0);'> 
              </form> 
            </div> 
          </div>
        </div>
      </div>
    </div>   
  </div> 
    <!--div class="well">
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
  </div-->
</div>
