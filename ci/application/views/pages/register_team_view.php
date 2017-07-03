<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header"><?php echo ucfirst($league_name);?>
          <small>Team Registration</small>
      </h1>
  </div>
</div>
<div class="panel-body">
  <div class="row"> 
    <div class="col-lg-12">
      <h4>Team Information</h4>
    </div>
  </div>  
  <div class="row">
    <div class="col-lg-12">
      <form action='javascript:void(0);'>
        <input id="league_id" value=<?php echo $league_id;?> type=hidden> 
        <div class="form-group">
          <div class="row">  
            <div class="col-sm-6"> 
              <input id="team_name" type="text" placeholder="Team Name" tabindex="1" class="form-control">
              <span id="team_name_verify_txt" class="verify"></span>
            </div>
          </div>
        </div>
        <div class="form-group"> 
          <div class="row">
            <div class="col-sm-6"> 
              <span id="unable_to_register_txt" class="verify" style="padding-bottom:10px"></span>
              <button id="register_team_button" type="submit" class="btn btn-primary">Register Team</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>  
