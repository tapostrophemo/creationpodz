<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_TestController extends Controller
{
  var $modelname;

  function MY_TestController($name) {
    parent::Controller();
    $this->load->library('unit_test');
    $this->modelname = $name;
  }

  function index() {
    $this->_runAll();
    $data['modelname'] = $this->modelname;
    $data['results'] = $this->unit->result();
    if ($_SERVER['SCRIPT_NAME'] == 'cmdline.php') {
      $this->load->view('test/simpleResults', $data);
    }
    else {
      $this->load->view('test/results', $data);
    }
  }

  /** override if you need stuff run before each of your tests */
  function setup() {}

  /** override if you need stuff run after each of your tests */
  function teardown() {}

  function _runAll() {
    foreach ($this->_getTestMethods() as $method) {
      $this->setup();
      $this->$method();
      $this->teardown();
    }
  }

  function _getTestMethods() {
    $methods = get_class_methods($this);
    $testMethods = array();
    foreach ($methods as $method) {
      if (substr(strtolower($method), 0, 4) == 'test') {
        $testMethods[] = $method;
      }
    }
    return $testMethods;
  }
}

