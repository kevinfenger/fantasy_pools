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
      <h4>League Information</h4>
    </div>
  </div>  
  <div class="row">
    <div class="col-lg-12">
      <form action='javascript:void(0);'>
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
              <button id="register_team_button" type="submit" class="btn btn-primary">Create League</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>  

<!--fieldset>
    <legend><?php echo ucfirst($league_name);?> Team Registration</legend>
  </fieldset>
  <form class="form-horizontal" action='javascript:void(0);'>
  <input id="league_id" value=<?php echo $league_id;?> type=hidden> 
  <div class="control-group">
    <label class="control-label" for="team_name">Team Name</label>
    <div class="controls">
      <input type="text" id="team_name" placeholder="type team name">
      <span id="team_name_verify_txt" class="verify"></span>
    </div>
  </div>    
  <div class="control-group">
    <label class="control-label" for="team_image">Team Image</label>
    <div class="controls">
      <input type="file" id="team_image">
    </div>
  </div>
  <div class="controls"> 
    <span id="unable_to_register_txt" class="verify" style="padding-bottom:10px"></span>
    <button id="register_team_button" type="submit" class="btn btn-primary">Register</button>
  </div> 
  </div> 
  </form-->
