<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Edit League</h1>
  </div>
</div>
<input id="league_id" value=<?php echo $league_details['league_id'];?> type=hidden>
<div class="panel-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="row"> 
        <div class="col-sm-4">
          <h4>League Name</h4>
        </div>
      </div>  
      <div class="form-group">
        <div class="row">  
          <div class="col-sm-6"> 
            <input id="league_name" type="text" value=<?php echo $league_details['name']; ?> tabindex="1" class="form-control valid">
            <span id="league_name_verify_txt" class="verify"></span>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-4">
          <h4>League Visibility</h4>
        </div>
      </div>  
      <div class="form-group"> 
        <div class="row">  
          <div class="col-sm-1 col-sm-offset-1"> 
            <label class="radio">
              <?php if ($league_details['visibility'] == 1): ?> 
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>Public
              <?php else: ?>  
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="1">Public
              <?php endif; ?> 
            </label> 
            <label class="radio">
              <?php if ($league_details['visibility'] == 0): ?> 
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="2" checked>Private
              <?php else: ?>  
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">Private
              <?php endif; ?> 
            </label>
          </div>
        </div>
      </div>
      <div class="form-group" id="league_password_control_group" style=<?php if ($league_details['visibility'] == 1) echo "display:none"; ?>>
        <div class="row"> 
          <div class="col-sm-4">
            <h4>League Password</h4>
          </div>
        </div>  
        <div class="row">  
          <div class="col-sm-6"> 
            <input type="text" id="league_password" placeholder="League Password" 
                   value=<?php echo (isset($league_details['league_password']) && strlen($league_details['league_password']) > 0) ? $league_details['league_password'] : ""; ?> 
                   class="form-control valid">
            <span id="league_password_verify_txt" class="verify"></span>
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-4">
          <h4>Max Members</h4>
        </div>
      </div>  
      <div class="form-group">
        <div class="row">  
          <div class="col-sm-6">
            <input type="number" id="league_max_members" min="1" max="100" value=<?php echo $league_details['max_members']; ?> class="form-control"> 
          </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-sm-7">
          <h4>Payouts - place each payout in an input, click + to add more.</h4>
        </div>
      </div>  
      <div class="form-group"> 
        <div class="row">
          <div class="controls"> 
            <form role="form" autocomplete="off"> 
              <?php 
               $payouts = explode(',',$league_details['payouts']); 
               foreach ($payouts as $p): 
              ?>
                <div class="entry input-group col-sm-4">
                  <input class="form-control" name="po_fields" autocomplete="off" type="text" value=<?php echo $p ?> />
                  <span class="input-group-btn"> 
                    <button class="btn btn-danger btn-remove" type="button">
                      <span class="glyphicon glyphicon-minus"></span>
                    </button>
                  </span>
                </div>
              <?php endforeach; ?>
              <div class="entry input-group col-sm-4">
                <input class="form-control" name="po_fields" autocomplete="off" type="text" placeholder="$$$" />
                <span class="input-group-btn"> 
                  <button class="btn btn-success btn-add" type="button">
                    <span class="glyphicon glyphicon-plus"></span>
                  </button>
                </span>
              </div>
            </form> 
          </div> 
        </div>
      </div> 
      <div class="form-group"> 
        <div class="row">
          <div class="col-sm-6"> 
            <button id="update_league_button" type="submit" class="btn btn-primary">Update League</button>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6"> 
            <span id="update_status" class="status"></span>
          </div>
        </div>
      </div>
    </div>
  </div>    
</div>
