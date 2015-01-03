  <div class="span3">
    <h2>My Teams</h2>
    <ul class="thumbnails">
      <?php foreach($user_teams as $team): ?>
      <li class="row" style="clear:left">  
          <a class="pull-left thumbnail" href="#"><img data-src="holder.js/64x64" style="width:64px; height:64px"></a>
          <div class="pull-left caption"> 
              <h4><a href="league?league_id=<?php echo $team['league_id']?>"><?php print $team['name']; ?></a></h4>
              <h6 class="header-tab-left"><a href="team?team_id=<?php echo $team['team_id'];?>"><?php print $team['team_name']; ?></a></h6>
          </div> 
      </li>
      <br />
      <?php endforeach; ?> 
    </ul>  
  </div>
