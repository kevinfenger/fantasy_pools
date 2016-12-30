<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dropdownMenu2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> 
      <a href="<?php echo base_url('league?league_id='.$league_details['league_id']); ?>">Overview</a>
    </div>
    <div class="collapse navbar-collapse" id="dropdownMenu2"> 
       <ul class="nav navbar-nav"> 
         <?php
             if ($this->session->userdata['id'] == $league_details['commissioner_id']): 
         ?>
                 <li><a href="<?php echo base_url('league/edit_settings?league_id='.$league_details['league_id']) ?>">Edit League Settings</a></li>
         <?php endif;?>
         <li><a href="<?php echo base_url('league/view_settings?league_id='.$league_details['league_id']) ?>">View League Settings</a></li>
         <li><a href="#" data-toggle="modal" data-target="#league_payout_modal">Payouts</a></li>
         <li><a href="#">Payouts</a></li>
       </ul> 
    </div> 
  </div> 
</nav>

<!--div class="navbar navbar-static-top navbar-inverse">
  <?php print_r($league_details); print_r($teams)?>
  <div class="navbar-inner">
  <div class ="container"> 
    <ul class="nav">
      <li><a data-toggle="modal" data-target="#league_scoring_modal" style="cursor:pointer">Scoring</a></li>
      <li><a data-toggle="modal" data-target="#league_payout_modal" style="cursor:pointer">Payouts</a></li>
    </ul>
  </div> 
  </div>
</div>
<div class="modal fade" id="league_scoring_modal" tabindex="-1" role="dialog" aria-labelledby="league_scoring_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_scoring_modalLabel">League Scoring</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped" id="modal_table">
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
</div-->
<div class="modal fade" id="league_payout_modal" tabindex="-1" role="dialog" aria-labelledby="league_payout_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="league_payout_modalLabel">League Payouts</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped" id="modal_table">
            <p id="loading" style="display:none">Loading</p>
            <thead>
              <tr>
                <td><strong>Place</strong></td>
                <td><strong>Payout</strong></td>
              </tr>
            </thead>
	    <tbody>
              <tr><td>1st</td><td>$130</td></tr>
              <tr><td>2nd</td><td>$20</td></tr>
              <tr><td>3rd</td><td>$10</td></tr>
            </tbody> 
          </table>
      </div>
    </div>
  </div>
</div-->
