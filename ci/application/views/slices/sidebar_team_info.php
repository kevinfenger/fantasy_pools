  <div class="span4">
    <h3>My Team</h3>
    <div id="team_id_holder" style="display:none" value=<?php echo $team_id;?>></div>
    <table id="team_info" class="table table-striped">
      <thead>
        <tr>
          <th>Position</th>
          <th>Name</th>
          <th>Team</th>
          <th>Points</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($my_team as $tm):?>
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
          <td><?php if ($tm['player']): ?>
                <button class="btn btn-primary btn-mini sel_play" data-toggle="modal" data-target="#choose_player_modal" type="button">Change</button>
              <?php else: ?> 
                <button class="btn btn-primary btn-mini sel_play" data-toggle="modal" data-target="#choose_player_modal" type="button" value=<?php echo $tm['position']['position_short_description']?>>Select</button>
              <?php endif; ?> 
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
  </div>
