<?php

error_reporting(E_ALL);

// TODO: config for PROD deploy
$system_folder      = '../lib/ci-1.7.2';
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

require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;
