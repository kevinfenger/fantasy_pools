  <fieldset>
    <legend>Create a League</legend>
  </fieldset>
  <form class="form-horizontal" action='javascript:void(0);'>
  <h6>League Information</h6> 
  <div class="control-group">
    <label class="control-label" for="league_name">League Name</label>
    <div class="controls">
      <input type="text" id="league_name" placeholder="type league name">
      <span id="league_name_verify_txt" class="verify"></span>
    </div>
  </div>    
  <div class="control-group">
    <label class="control-label" for="inputLeagueImage">League Image</label>
    <div class="controls">
      <input type="file" id="inputLeagueImage">
    </div>
  </div>
  <div class="control-group"> 
    <label class="control-label" for="league_vis">League Visibility</label>
    <div class="controls"> 
      <label class="radio">
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>Public
      </label>
      <label class="radio">
        <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">Private
      </label>
    </div> 
  </div> 
  <div class="control-group" id="league_password_control_group" style="display:none">
    <label class="control-label" for="league_password">League Password</label>
    <div class="controls">
      <input type="text" id="league_password">
      <span id="league_password_verify_txt" class="verify"></span>
    </div>
  </div>
  <h6>Your Team Information</h6> 
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
    <button id="create_league_button" type="submit" class="btn btn-primary">Create League</button>
  </div> 
  </div> 
  </form>
