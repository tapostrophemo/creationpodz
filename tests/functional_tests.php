<?php
// based on example from: http://simpletest.org/en/web_tester_documentation.html

require_once('../lib/simpletest_1.0.1/autorun.php');
require_once('../lib/simpletest_1.0.1/web_tester.php');
SimpleTest::prefer(new TextReporter());

define('CPODZ_BASE_URL', 'http://dev.creationpodz.com/');

class WebTests extends TestSuite
{
  function WebTests() {
    $this->TestSuite('creationpodz functional tests'); // TODO: label not working...hmm
    $this->addFile(dirname(__FILE__) . '/cpodz_test.php');
  }
}

