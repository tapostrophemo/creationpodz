<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 

// suggested they make these methods part of the base CI_Unit_test class;
// http://codeigniter.com/forums/viewthread/108922/

class MY_Unit_test extends CI_Unit_test
{
  function assert_true($arg, $name) {
    return $this->run($arg, 'is_true', $name);
  }

  function assert_false($arg, $name) {
    return $this->run($arg, 'is_false', $name);
  }

  function assert_null($arg, $name) {
    return $this->run($arg, 'is_null', $name);
  }

  function assert_not_null($arg, $name) {
    $this->assert_true(isset($arg), $name);
  }
}

