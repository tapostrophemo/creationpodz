<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --- CI-related config ---

$config['base_url'] = "http://dev.creationpodz.com/"; // TODO: set this for PROD deploy
$config['index_page'] = "";
$config['uri_protocol']	= "AUTO";
$config['url_suffix'] = "";

$config['language']	= "english";
$config['charset'] = "UTF-8";

$config['enable_hooks'] = FALSE;

$config['subclass_prefix'] = 'MY_';

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] 	= 'c';
$config['function_trigger'] 	= 'm';
$config['directory_trigger'] 	= 'd'; // experimental not currently in use

/*
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
*/
$config['log_threshold'] = 0;
$config['log_path'] = dirname(realpath(__FILE__)).'/../../log/'; // TODO: set for PROD deploy
$config['log_date_format'] = 'Y-m-d H:i:s';

$config['cache_path'] = '';

$config['encryption_key'] = ''; // TODO: set this for PROD deploy

$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_encrypt_cookie']	= FALSE; // TODO: set this for PROD deploy
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update'] 	= 300;

$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";

$config['global_xss_filtering'] = FALSE;

$config['compress_output'] = FALSE;

$config['time_reference'] = 'local';

$config['rewrite_short_tags'] = FALSE;

$config['proxy_ips'] = '';


// --- application-related config ---

// TODO: set the following for PROD deploy

$config['app_captcha_path'] = '/opt/creationpodz/captcha/';
$config['app_captcha_expire'] = 180; // seconds; expires/60 => 3 minutes

$config['upload_config'] = array(
  'upload_path'   => '/opt/creationpodz/uploads/',
  'allowed_types' => 'gif|jpg|png|bmp',
  'encrypt_name'  => true,
  'max_size'      => 500,
  'max_width'     => 1024,
  'max_height'    => 768);

$config['image_processing_config'] = array(
  'source_image'   => '/opt/creationpodz/uploads/', // NB: filename appended in Controller
  'create_thumb'   => true,
  'thumb_marker'   => '',
  'new_image'      => '/opt/creationpodz/thumbs/', // NB: will match uploaded file name (CI needs only path)
  'quality'        => 68,
  'maintain_ratio' => true,
  'width'          => 100,
  'height'         => 100);

