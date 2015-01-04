<div class="row">
  <h2><?php echo $name ?></h2>
  <div class="span6">
    <h3>Standings</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Name</th>
          <th>Points</th>
          <th>Players Left</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach($teams as $team): ?> 
        <tr> 
          <td><?php echo $i; ?></td>
          <td><a href="team?team_id=<?php echo $team['team_id']?>"><?php echo $team['team_name']; ?></a></td> 
          <td><?php echo $team['total_points']; ?></td> 
          <td><?php echo $team['remaining_players']; ?></td> 
          <?php $i++;?> 
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php echo $sidebar; ?>
</div> 
