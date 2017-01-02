<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dropdownMenu2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('league?league_id='.$league_details['league_id']);?>">League Overview</a>
    </div>
    <div class="collapse navbar-collapse" id="dropdownMenu2"> 
       <ul class="nav navbar-nav"> 
         <?php
             if ($this->session->userdata['id'] == $league_details['commissioner_id']): 
         ?>
                 <li><a href="<?php echo base_url('league/edit_settings?league_id='.$league_details['league_id']) ?>">Edit League Settings</a></li>
         <?php endif;?>
         <li><a href="#" data-toggle="modal" data-target="#league_settings_modal">View League Settings</a></li>
         <li><a href="#" data-toggle="modal" data-target="#league_invite_modal">Invite</a></li>
         <li><a href="#" data-toggle="modal" data-target="#league_payout_modal">Payouts</a></li>
         <li><a href="#" data-toggle="modal" data-target="#league_scoring_modal">Scoring</a></li>
       </ul> 
    </div> 
  </div> 
</nav>

<div class="modal fade" id="league_scoring_modal" tabindex="-1" role="dialog" aria-labelledby="league_scoring_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_scoring_modalLabel">League Scoring</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
            <p id="loading" style="display:none">Loading</p>
            <thead>
              <tr>
                <td><strong>Offense</strong></td>
                <td><strong>League Value</strong></td>
              </tr>
            </thead>
	    <tbody>
	      <tr><td>Passing Yards</td><td>25 yards per point</td></tr>
	      <tr><td>Passing Touchdowns</td><td>4</td></tr>
	      <tr><td>Interceptions</td><td>-1</td></tr>
	      <tr><td>Rushing Yards</td><td>10 yards per point</td></tr>
	      <tr><td>Rushing Touchdowns</td><td>6</td></tr>
	      <tr><td>Reception Yards</td><td>10 yards per point</td></tr>
	      <tr><td>Reception Touchdowns</td><td>6</td></tr>
	      <tr><td>Return Touchdowns</td><td>6</td></tr>
	      <tr><td>2-Point Conversions</td><td>2</td></tr>
	      <tr><td>Fumbles Lost</td><td>-2</td></tr>
	      <tr><td>Offensive Fumble Return TD</td><td>6</td></tr>
	      <tr><td></td><td></td></tr>
	    </tbody>
            <thead>
              <tr>
                <td><strong>Kickers</strong></td>
                <td><strong>League Value</strong></td>
              </tr>
            </thead>
            <tbody> 
              <tr><td>Field Goal Made</td><td>3</td></tr>
              <tr><td>Extra Point Made</td><td>1</td></tr>
              <tr><td></td><td></td></tr>
            </tbody> 
            <thead>
              <tr>
                <td><strong>Defense/Special Teams</strong></td>
                <td><strong>League Value</strong></td>
              </tr>
            </thead>
            <tbody> 
              <tr><td>Sack</td><td>1</td></tr>
              <tr><td>Interception</td><td>2</td></tr>
              <tr><td>Fumble Recovery</td><td>2</td></tr>
              <tr><td>Touchdown</td><td>6</td></tr>
              <tr><td>Safety</td><td>2</td></tr>
              <tr><td>Block Kick</td><td>2</td></tr>
              <tr><td>Kickoff and Punt Return Touchdowns</td><td>6</td></tr>
            </tbody> 
          </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="league_payout_modal" tabindex="-1" role="dialog" aria-labelledby="league_payout_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_payout_modalLabel">League Payouts</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
            <p id="loading" style="display:none">Loading</p>
            <thead>
              <tr>
                <td><strong>Place</strong></td>
                <td><strong>Payout</strong></td>
              </tr>
            </thead>
	    <tbody>
            <?php $count = 0; 
                  $sploded = explode(',', $league_details['payouts']); 
                  foreach ($sploded as $s): 
                      $count += 1; 
            ?>
              <tr><td><?php echo $count; ?></td><td>$<?php echo $s; ?></td></tr>
            <?php endforeach; ?>
            </tbody> 
          </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="league_settings_modal" tabindex="-1" role="dialog" aria-labelledby="league_settings_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_payout_modalLabel">League Settings</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped">
            <p id="loading" style="display:none">Loading</p>
            <thead>
              <tr>
                <td><strong>Setting</strong></td>
                <td><strong>Value</strong></td>
              </tr>
            </thead>
	    <tbody>
              <tr><td>League Name</td><td><?php echo $league_details['name']; ?></td></tr>
              <tr><td>League ID</td><td><?php echo $league_details['league_id']; ?></td></tr>
              <tr><td>League Password</td><td><?php echo $league_details['league_password']; ?></td></tr>
              <tr><td>Number of Members</td><td><?php echo $league_details['number_of_members']; ?></td></tr>
              <tr><td>Maximum Members</td><td><?php echo $league_details['max_members']; ?></td></tr>
              <tr><td>Commissioner</td><td><?php echo $league_details['commissioner_id']; ?></td></tr>
              <tr><td>Created</td><td><?php echo $league_details['created']; ?></td></tr>
            </tbody> 
          </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="league_invite_modal" tabindex="-1" role="dialog" aria-labelledby="league_invite_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_invite_modalLabel">Invite Owners</h4>
      </div>
      <div class="modal-body">
          <ul> 
            <li>First have future owners head to <a href="/league/join">Here</a></li> 
            <li>Provide them with the League ID : <?php echo $league_details['league_id']; ?> </li> 
            <li>Provide them with the password : <?php echo $league_details['league_password']; ?> </li>
            <li>If the password is blank (Public League), they will still be able to join with just a league ID </li> 
            <li>Enter the information above, and click Join League</li> 
          </ul> 
      </div>
    </div>
  </div>
</div>
