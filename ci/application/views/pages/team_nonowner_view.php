<div class="row">
  <div class="span8">
    <h3><a href="league?league_id=<?php echo $league_id?>"><?php echo $league_name; ?></a></h3>
    <h4><?php echo $team_details->team_name . ' (' . $team_details->first_name . ' ' . $team_details->last_name . ')'; ?></h4>
    <div id="no-more-tables"> 
    <table id="team_info" class="table table-striped">
      <thead>
        <tr>
          <th>Position</th>
          <th>Name</th>
          <th>Team</th>
          <th>W1 Pts</th>
          <th>W2 Pts</th>
          <th>W3 Pts</th>
          <th>W4 Pts</th>
          <th>Total Pts</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($team_players as $tm):?>
        <?php if ($tm['player']['eliminated']): ?> 
        <tr class="player_position danger" value=<?php echo $tm['player']['player_id']; ?>> 
        <?php else:?> 
        <tr class="player_position" value=<?php echo $tm['player']['player_id']; ?>> 
        <?php endif;?> 
          <td data-title="Position" class="player_position"><?php echo $tm['position']['position_short_description']; ?></td> 
          <td data-title="Name" class="player_name"><?php if ($tm['player']): ?>
              <p><?php echo $tm['player']['full_name']; ?></p>
              <?php else: ?> 
              <strong>Not Yet Selected</strong>              
              <?php endif; ?> 
          </td>
          <td data-title="Team" class="player_team"><?php echo $tm['player']['pro_team']; ?></td> 
          <td data-title="W1 Points"><?php echo $tm['player']['week_one_points']; ?></td>  
          <td data-title="W2 Points"><?php echo $tm['player']['week_two_points']; ?></td>  
          <td data-title="W3 Points"><?php echo $tm['player']['week_three_points']; ?></td>  
          <td data-title="W4 Points"><?php echo $tm['player']['week_four_points']; ?></td>  
          <td data-title="Total Points"><?php echo $tm['player']['week_one_points'] + $tm['player']['week_two_points'] + $tm['player']['week_three_points'] + $tm['player']['week_four_points']; ?></td> 
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div> 
  </div>
</div> 
