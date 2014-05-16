<?php
/** global constant **/
define('DS', DIRECTORY_SEPARATOR);
define('WEBROOT', dirname(__FILE__));
define('CLASS_DIR', WEBROOT . DS . 'includes' . DS . 'classes');
define('TPL_DIR', WEBROOT . DS . 'includes' . DS . 'templates');
define('CACHE_DIR', WEBROOT . DS . 'cache');
define('LIB_DIR', WEBROOT . DS . 'includes' . DS . 'libraries');
define('MSG_ERROR', 'danger');
define('MSG_WARNING', 'warning');
define('MSG_SUCCESS', 'success');

// error reporting
error_reporting(E_DEPRECATED | E_USER_DEPRECATED | E_STRICT | E_ALL);

//-- load system configuration from yml file 
// include the library to parse yml file
require('includes' . DS . 'libraries' . DS . 'spyc' . DS . 'spyc.php');

// parse yml file
// $conf will be available globally for all controllers/functions to use
global $conf;
$conf = Spyc::YAMLLoad('settings.yml'); // settings
$conf = array_merge($conf, Spyc::YAMLLoad('routing.yml')); // rounting configurations

//-- include functions 
require('includes' . DS . 'functions.inc.php');

//-- auto load classes
set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);
spl_autoload_register('custom_loader');

//-- sanity check
app_requirement_check();

//-- initialize MySQL
// $mysqli will be available globally for all controllers/ function s to use
global $mysqli;
$mysqli = new mysqli($conf['mysql_host'], $conf['mysql_user'], $conf['mysql_pass'], $conf['mysql_db']);
if ($mysqli->connect_errno) {
  printf("Connect failed: %s", $mysqli->connect_error);
  exit;
}

//-- default timezone
date_default_timezone_set('Australia/Sydney');

//-- session
session_start();






// populate db
 Category::populateDB();