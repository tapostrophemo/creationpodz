<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'cpodz';
$route['scaffolding_trigger'] = '';

$route['signup'] = 'cpodz/signup';
$route['login']  = 'cpodz/login';
$route['logout'] = 'cpodz/logout';
$route['about']  = 'cpodz/about';
$route['help']   = 'cpodz/help';
$route['legal']  = 'cpodz/legal';

$route['user/(:any)']     = 'users/profile/$1';
$route['settings/(:any)'] = 'users/settings/$1';
$route['creation/(:num)'] = 'users/creation/$1';
$route['upload']          = 'users/upload';
$route['blog']            = 'users/blog';

