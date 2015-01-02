<hr>
<h4>Join By League Id</h4>
<div class="form-inline">
  <input class="input-small" id="league_id" type="text" placeholder="League ID">
  <input class="input-small" id="league_id" type="text" placeholder="Password">
  <button class="btn btn-primary" type="button">Join</button>
</div>
<hr>
<h4>Join Existing Public League</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Name</th>
      <th>Members (current/max)</th>
      <th>Commissioner</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($leagues as $league): ?> 
    <tr> 
      <td><?php echo $league['name']; ?></td> 
      <td><?php echo $league['number_of_members'] . '/' . $league['max_members']; ?></td>
      <td><?php echo $league['first_name'] . ' ' . $league['last_name']; ?></td>
      <td><?php echo 'no notes' ?></td>
      <?php $league_id = $league['league_id']; $league_href="register_team?league_id=$league_id";?>
      <td><a href=<?echo $league_href;?> class="btn btn-primary" type="button">Join</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<hr>
