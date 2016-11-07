<?php

ob_start();
session_start();

defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);

// Define absolute path to server root
define('SITE_ROOT', dirname(dirname(__FILE__)).DS);

// Define absolute path to includes
defined('INCLUDE_PATH') ? NULL : define('INCLUDE_PATH', SITE_ROOT.'includes'.DS);
defined('FUNCTION_PATH') ? NULL : define('FUNCTION_PATH', INCLUDE_PATH.'functions'.DS);
defined('CONSTANTS_PATH') ? NULL : define('CONSTANTS_PATH', INCLUDE_PATH.'constants'.DS);
defined('LIB_PATH') ? NULL : define('LIB_PATH', INCLUDE_PATH.'libraries'.DS);

////////////////////////////////////////////////////////////////////////////////a
// Include library, helpers, functions
////////////////////////////////////////////////////////////////////////////////
require_once(FUNCTION_PATH.'functions.php');
require_once(FUNCTION_PATH.'permissions.php');
require_once(FUNCTION_PATH.'notifications.php');
require_once(FUNCTION_PATH.'rssgenerator.php');
require_once(FUNCTION_PATH.'writing.php');
require_once(LIB_PATH.'database.php');
require_once(CONSTANTS_PATH.'constants.php');

spl_autoload_register(function($className) {
    $fileName = "./" . str_replace("\\", "/", $className) . ".php";
    if(!is_readable($fileName)) {
        return false;
    }
    require_once $fileName;
    return true;
});

require_once "route.php";