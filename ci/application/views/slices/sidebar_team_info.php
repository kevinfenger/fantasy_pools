  <div class="span6">
    <h3>My Team</h3>
    <div id="team_id_holder" style="display:none" value=<?php echo $team_id;?>></div>
    <div id="no-more-tables"> 
    <table id="team_info" class="table table-striped">
      <thead>
        <tr>
          <th>Position</th>
          <th>Name</th>
          <th>Team</th>
          <th>W1</th>
          <th>W2</th>
          <th>W3</th>
          <th>W4</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($my_team as $tm):?>
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
          <td data-title="W1"><?php echo $tm['player']['week_one_points']; ?></td>  
          <td data-title="W2"><?php echo $tm['player']['week_two_points']; ?></td>  
          <td data-title="W3"><?php echo $tm['player']['week_three_points']; ?></td>  
          <td data-title="W4"><?php echo $tm['player']['week_four_points']; ?></td>  
          <td data-title="Total"><?php echo $tm['player']['week_one_points'] + $tm['player']['week_two_points'] + $tm['player']['week_three_points'] + $tm['player']['week_four_points']; ?></td> 
          <?php if (strtotime(PLAYERS_VIEWABLE_DATETIME) > time(null)): ?>
          <td><?php if ($tm['player']): ?>
                <button class="btn btn-primary btn-mini sel_play" data-toggle="modal" data-target="#choose_player_modal" type="button">Change</button>
              <?php else: ?> 
                <button class="btn btn-primary btn-mini sel_play" data-toggle="modal" data-target="#choose_player_modal" type="button" value=<?php echo $tm['position']['position_short_description']?>>Select</button>
              <?php endif; ?> 
          </td>
        </tr>
          <?php endif;?> 
        <?php endforeach; ?>
      </tbody>
    </table>
    </div> 
  </div>
<div class="modal fade" id="choose_player_modal" tabindex="-1" role="dialog" aria-labelledby="choose_player_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="choose_player_modalLabel">New message</h4>
      </div>
      <div class="modal-body">
          <table class="table table-striped" id="modal_table">
            <thead>
              <tr>
                <th>Team</th><th>Full Name</th><th>Notes</th>
              </tr>
            </thead>
            <tbody> 
               <p id="loading" style="display:none">Loading</p> 
            </tbody> 
          </table>
      </div>
    </div>
  </div>
</div>
