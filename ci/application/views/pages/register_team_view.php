  <fieldset>
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
  </form>
