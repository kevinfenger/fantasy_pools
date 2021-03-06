<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Create a League</h1>
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
      <div class="form-group">
        <div class="row">  
          <div class="col-sm-6"> 
            <input id="league_name" type="text" placeholder="League Name" tabindex="1" class="form-control">
            <span id="league_name_verify_txt" class="verify"></span>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-4">
          <h5>League Visibility</h5>
        </div>
      </div>  
      <div class="form-group"> 
        <div class="row">  
          <div class="col-sm-1 col-sm-offset-1"> 
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>Public
            </label> 
            <label class="radio">
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">Private
            </label>
          </div>
        </div>
      </div>
      <div class="form-group" id="league_password_control_group" style="display:none">
        <div class="row">  
          <div class="col-sm-6"> 
            <input type="text" id="league_password" placeholder="League Password" class="form-control">
            <span id="league_password_verify_txt" class="verify"></span>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-4">
          <h5>Max Members</h5>
        </div>
      </div>  
      <div class="form-group">
        <div class="row">  
          <div class="col-sm-6">
            <input type="number" id="league_max_members" min="1" max="100" value="20" class="form-control"> 
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-7">
          <h4>Payouts - place each payout in an input, click + to add more.</h4>
        </div>
      </div>  
      <div class="form-group"> 
        <div class="row">
          <div class="controls"> 
            <form role="form" autocomplete="off"> 
              <?php 
               $payouts = array('120', '50', '10'); 
               foreach ($payouts as $p): 
              ?>
                <div class="entry input-group col-sm-4">
                  <input class="form-control" name="po_fields" autocomplete="off" type="text" value=<?php echo $p ?> />
                  <span class="input-group-btn"> 
                    <button class="btn btn-danger btn-remove" type="button">
                      <span class="glyphicon glyphicon-minus"></span>
                    </button>
                  </span>
                </div>
              <?php endforeach; ?>
              <div class="entry input-group col-sm-4">
                <input class="form-control" name="po_fields" autocomplete="off" type="text" placeholder="$$$" />
                <span class="input-group-btn"> 
                  <button class="btn btn-success btn-add" type="button">
                    <span class="glyphicon glyphicon-plus"></span>
                  </button>
                </span>
              </div>
            </form> 
          </div> 
        </div>
      </div> 
    </div>
  </div>
  <div class="row"> 
    <div class="col-lg-12">
      <h4>Team Information</h4>
    </div>
  </div>  
  <div class="row">
    <div class="col-lg-12">
      <div class="form-group"> 
        <div class="row">  
          <div class="col-sm-6"> 
            <input type="text" id="team_name" placeholder="Team Name" class="form-control">
            <span id="team_name_verify_txt" class="verify"></span>
          </div>
        </div>
      </div>
      <div class="form-group"> 
        <div class="row">
          <div class="col-sm-6"> 
            <button id="create_league_button" type="submit" class="btn btn-primary">Create League</button>
          </div>
        </div>
      </div>
    </div>
  </div>    
</div>
  <!--fieldset>
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
  </form-->
