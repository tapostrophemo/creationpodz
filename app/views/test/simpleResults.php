=========================================================
Unit test results for <?=$modelname."\n"?>
=========================================================
<?php
foreach ($results as $result) {
  if ($result['Result'] == 'Passed') {
    print "OK: " . $result['Test Name'] . "\n";
  }
  else {
    print "Failed: ";
    print_r($result);
  }
}
?>

All tests completed in <?=$this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end')?> seconds.

