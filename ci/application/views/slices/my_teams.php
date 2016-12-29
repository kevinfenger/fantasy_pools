<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">FP
          <small>Join/Create</small>
      </h1>
  </div>
</div>
<div class="row">
    <div class="col-sm-5"> 
      <a href="league/join" class="btn btn-default btn-block">Join Existing</a>
    </div>
</div> 
<div class="row top10">
  <div class="col-sm-5">
    <a href="league/create_pff_league" class="btn btn-default btn-block">Create New</a>
  </div> 
</div>
<?php if (count($user_teams) > 0): ?>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">FP
          <small>My Teams</small>
      </h1>
  </div>
</div>
<?php foreach($user_teams as $team): ?>
<div class="row">  
    <div class="col-md-3">
      <a href="league?league_id=<?php echo $team['league_id']?>">
        <img class="img-responsive" src="../assets/img/default_fb_league.jpg" alt="">
      </a>
    </div>
    <div class="col-md-4">
        <h3><?php print $team['name']; ?></h3> 
        <h4><?php print $team['team_name'];?></h4>
        <div class="row"> 
          <div class="col-sm-6">
            <a class="btn btn-default btn-block" href="league?league_id=<?php echo $team['league_id']?>">View League</a>
          </div>
        </div>
        <div class="row top10"> 
          <div class="col-sm-6">
            <a class="btn btn-default btn-block" href="team?team_id=<?php echo $team['team_id'];?>">View Team</a>
          </div>
        </div>
    </div> 
</div>
<hr>
<?php endforeach; ?> 
<?php endif; ?> 
