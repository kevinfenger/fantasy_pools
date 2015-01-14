<?php foreach ($units as $unit):?> 
    <p class="lead"><?php print('Running ' . $unit['total_tests'] . ($unit['total_tests'] > 1 ? ' tests from ' : ' test from ') . $unit['unit_name']); ?></p>
    <hr></hr>
    <?php foreach ($unit['test_cases'] as $tc): ?>
        <ul class="list-unstyled"> 
           <?php if($tc['test_failed']): ?>
              <li>
                 <div class="test-case-holder test-case-holder-danger"> 
                 <p><strong>[FAILED]</strong> <?php print $tc['test_case_name']; ?></p>
                 <div class="assert-holder-danger">
                    <ul class="list-asserts list-unstyled">
                    <?php foreach ($tc['asserts'] as $assert): ?>
                       <?php if (!$assert['success']): ?> 
                           <li>
                           <?php print('Failed assert -- ' . $assert['message']['calling_class'] . ':' . $assert['message']['calling_function'] . ':' . $assert['message']['line'] ); ?>                    
                            </li>
                        <?php endif; ?>
                    <?php endforeach; //asserts end foreach?>
                    </ul>
                 </div>
                 </div> 
              </li> 
	   <?php else: ?>
                 <div class="test-case-holder test-case-holder-ok"> 
                 <p><strong>[&nbsp&nbsp&nbspOK&nbsp&nbsp&nbsp&nbsp]</strong> <?php print $tc['test_case_name']; ?></p>
                 </div>
           <?php endif; //test failed if?>
        </ul>
    <?php endforeach; //test_cases end foreach?>
    <hr></hr>
    <p class="lead"><?php print($unit['total_tests'] . ($unit['total_tests'] > 1 ? ' Tests ran from ' : ' Test ran from ') . $unit['unit_name'] . 
                                      ' (Successes = ' . $unit['successful_tests'] . ' : ' . 'Failures = ' . $unit['failed_tests'] . ')'); ?></p>
<?php endforeach; //units end foreach?>
