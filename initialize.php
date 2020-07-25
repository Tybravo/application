<?php

//Define the core paths

//DRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for windows, /for unix)
defined('DS')? null: define('DS', DIRECTORY_SEPARATOR);
//defined('SITE_ROOT')? null: define('SITE_ROOT', ''.DS.'home'.DS.'resultant');
defined('SITE_ROOT')? null: define('SITE_ROOT', 'C:'.DS.'wamp'.DS.'www'.DS.'application');

//$config_basedir = "http://www.resultant.com/";

defined('LIB_PATH')? null: define('LIB_PATH', SITE_ROOT.DS.'includes');
require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'functions.php');
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');

//load database related classes

require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'applicant.php');
require_once(LIB_PATH.DS.'image_school.php');

?>