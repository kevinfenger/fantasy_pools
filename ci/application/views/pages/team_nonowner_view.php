<div class="row">
  <div class="span4">
    <h3><a href="league?league_id=<?php echo $league_id?>"><?php echo $league_name; ?></a></h3>
    <h4><?php echo $team_name; ?></h4>
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
        <tr class="player_position" value=<?php echo $tm['player']['player_id']; ?>> 
          <td class="player_position"><?php echo $tm['position']['position_short_description']; ?></td> 
          <td class="player_name"><?php if ($tm['player']): ?>
              <p><?php echo $tm['player']['full_name']; ?></p>
              <?php else: ?> 
              <strong>Not Yet Selected</strong>              
              <?php endif; ?> 
          </td>
          <td class="player_team"><?php echo $tm['player']['pro_team']; ?></td> 
          <td>0</td>  
          <td>0</td>  
          <td>0</td>  
          <td>0</td>  
          <td>0</td>  
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div> 
