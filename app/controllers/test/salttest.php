<?php

require_once(APPPATH . '/libraries/MY_TestController.php');

class SaltTest extends MY_TestController
{
  function __construct() {
    parent::MY_TestController(__FILE__);
    $this->load->plugin('salt');
  }

  function testSaltsNotSame() {
    $s1 = salt();
    $s2 = salt();
    $this->unit->assert_not_null($s1, 'should generate salt');
    $this->unit->assert_not_null($s2, '(ditto)');
    $this->unit->assert_false($s1 == $s2, 'salts should be unique');
  }
}

