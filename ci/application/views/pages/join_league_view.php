<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Join By League ID</h1>
  </div>
</div>
<div class="panel-body"> 
  <div class="row">
    <div class="col-lg-12">
      <form action='javascript:void(0);'>
        <div class="form-group"> 
          <input id="league_id" type="text" placeholder="League ID" tabindex="1" class="form-control">
        </div> 
        <div class="form-group"> 
          <input id="league_password" type="password" placeholder="Password" tabindex="2" class="form-control">
        </div>
        <div class="form-group"> 
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3"> 
              <button id="join_league_by_id" class="btn btn-block btn-success">Join League</button>
            </div> 
          </div>
        </div>
      </form>
    </div>
  </div> 
</div>
<hr>
<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Public Leagues</h1>
  </div>
</div>
<div class="row"> 
  <div id="no-more-tables"> 
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
  </div> 
</div>
