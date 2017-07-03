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
                </div>
                <div class="form-group"> 
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> 
                      <a class="btn btn-block btn-social btn-facebook" href='#' id='fb_login'><span class="fa fa-facebook"></span>Sign in with Facebook</a>
                    </div>
                  </div> 
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="text-center">
                        <a href="/user/forgot_password" tabindex="5" class="forgot-password">Forgot Password?</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <form id="register-form" action='javascript:void(0);' style="display: none;"> 
                <div class="form-group">
	          <input type="text" id='first_name' name='first_name' class="form-control" pattern="[A-Za-z-0-9]+" value="<?php echo set_value('first_name'); ?>" placeholder="First Name" tabindex="1"/>
                  <span id="first_name_verify_txt" class="verify"></span>
                </div> 
                <div class="form-group">
	          <input type="text" id='last_name' name='last_name' class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Last Name" tabindex="2"/>
                  <span id="last_name_verify_txt" class="verify"></span>
                </div> 
                <div class="form-group">
	          <input type="email" id='email' name='email' class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email" tabindex="3"/>
                  <span id="email_verify_txt" class="verify"></span>
                </div> 
                <div class="form-group">
	          <input type="password" id='password_one' name='password' class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password" tabindex="4"/>
                  <span id="password_verify_txt" class="verify"></span>
                </div> 
                <div class="form-group">
	          <input type="password" id='confirm_password' name='confirm_password' class="form-control" value="<?php echo set_value('confirm_password'); ?>" placeholder="Confirm Password" tabindex="5"/>
                  <span id="confirm_password_verify_txt" class="verify"></span>
                </div> 
                <div class="form-group"> 
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> 
                      <button id="create_local_account_button" class="btn btn-block btn-success" tabindex="6">Register</button>
                    </div>
                  </div>
                </div>
                <div class="form-group"> 
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3"> 
                      <a class="btn btn-block btn-social btn-facebook" href='#' id='fb_login_two'><span class="fa fa-facebook"></span>Register with Facebook</a>
                    </div>
                  </div>
                </div>
              </form> 
            </div> 
          </div>
        </div>
      </div>
    </div>   
  </div> 
</div>
