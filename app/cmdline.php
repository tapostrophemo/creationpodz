<?php
error_reporting(E_ALL);

$system_folder       ='../lib/ci-1.7.2';
$application_folder = '../app';

if (strpos($system_folder, '/') === FALSE) {
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE) {
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else {
	$system_folder = str_replace("\\", "/", $system_folder);
}

define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
define('FCPATH', __FILE__);
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_folder.'/');

if (is_dir($application_folder)) {
	define('APPPATH', $application_folder.'/');
}
else {
	if ($application_folder == '') {
		$application_folder = 'application';
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}

if ( ! defined('E_STRICT')) {
	define('E_STRICT', 2048);
}

$_SERVER['PATH_INFO'] = $argv[1];

$params = array_slice($argv, 2);
//print "PARAMS: "; print_r($params);

while (count($params) > 0) {
  $param = array_shift($params);
  list($name, $value) = explode('=', $param, 2);
  $_POST[$name] = $value;
}
//print "POST: "; print_r($_POST);

require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;

