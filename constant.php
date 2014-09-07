<?php
//-----------------------------------------------
// USER CONFIGURABLE ELEMENTS
//-----------------------------------------------
// Root path
define ( 'ROOT_PATH'		, "./" );
define ( 'SOURCE_PATH'		, "./sources/" );
define ( 'UPLOAD_PATH'		, "./uploads/" );
define ( 'INC_PATH'			, ROOT_PATH ."includes/" );
define ( 'SYS_PATH'			, ROOT_PATH ."system/" );
define ( 'UTILS_PATH'		, SOURCE_PATH . 'utils/' );
define ( 'LIBS_PATH'		, SOURCE_PATH . 'libs/' );
define ( 'COM_PATH'			, ROOT_PATH . 'components/' );
define ( 'MODS_PATH'		, ROOT_PATH . 'modules/' );
define ( 'CORE_PATH'		, MODS_PATH . 'cores/' );
define ( 'EXTEND_PATH'		, MODS_PATH . 'extends/' );
define ( "CACHE_PATH"		, ROOT_PATH . 'cache/' );
define ( "JAVASCRIPT_PATH"	, ROOT_PATH .'javascripts/');




define ( "SKIN_CACHE", 1);
define ( "TIMTHUMB"	, 2);
define ("SETTINGS_CACHE",1);
// Enable module usage?
// (Vital for some mods and VSF enhancements)
define ( 'USE_MODULES', 1 );
// Enable shut down features?
// low priority tasks until end of exec
define ( 'RELOAD_CACHE', 1 );
define ( 'USE_SHUTDOWN', 1 );
define("MAX_FILE_SIZE", 100*1024*1024);

define ( "USER_TYPE_NORMAL", 1);
define ( "USER_TYPE_VIP", 2);

define ( "POST_STATUS_GUEST", 1);
define ( "POST_STATUS_VIP", 2);


/////////////////////////////SHOW SQL ERROR
///////////fore debug set to 1 then for run on host set to 0
define ( "SHOW_SQL_ERROR"	, 0);
define ( "ERROR_LOG_FILE"		, ROOT_PATH . 'cache/.ERROR_LOG' );
//-----------------------------------------------
// NO USER EDITABLE SECTIONS BELOW
//-----------------------------------------------
define ( 'IN_VSF', 1 );
/*
 * In Developing?
 * @param int
 * 1: Being in Develope
 * 0: Running site
 */
define ( 'IN_DEV', 1);

// PHP Configuration
error_reporting ( E_ERROR | E_WARNING | E_PARSE | E_ALL );
error_reporting(1);
set_magic_quotes_runtime ( 0 );
?>