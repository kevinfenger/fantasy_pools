      <?php foreach($user_teams as $team): ?>
      <div class="row">  
          <div class="col-md-7">
            <a href="#">
              <img class="img-responsive" src="http://placehold.it/700x300" alt="">
            </a>
          </div>
          <div class="col-md-7">
              <h3><?php print $team['name']; ?></h3> 
              <h4><?php print $team['team_name'];?></h4>
              <p>jibber jabber</p> 
              <a class="btn btn-primary" href="league?league_id=<?php echo $team['league_id']?>">View League</a>
              <a class="btn btn-primary" ref="team?team_id=<?php echo $team['team_id'];?>">View Team</a>
          </div> 
      </div>
      <hr>
      <?php endforeach; ?> 
