<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">FP
          <small>Join/Create</small>
      </h1>
  </div>
</div>
<div class="row">
    <div class="col-sm-3">
      <h5>Join a public or private league.</h5> 
    </div>
    <div class="col-sm-4"> 
      <a href="league/join" class="btn btn-default btn-block">Join Existing</a>
    </div>
</div> 
<div class="row">
  <div class="col-sm-3">
    <h5>Create a new league.</h5> 
  </div>
  <div class="col-sm-4">
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
    <div class="col-md-7">
      <a href="#">
        <img class="img-responsive" src="http://placehold.it/700x300" alt="">
      </a>
    </div>
    <div class="col-md-5">
        <h3><?php print $team['name']; ?></h3> 
        <h4><?php print $team['team_name'];?></h4>
        <p>jibber jabber</p> 
        <a class="btn btn-primary" href="league?league_id=<?php echo $team['league_id']?>">View League</a>
        <a class="btn btn-primary" href="team?team_id=<?php echo $team['team_id'];?>">View Team</a>
    </div> 
</div>
<hr>
<?php endforeach; ?> 
<?php endif; ?> 
