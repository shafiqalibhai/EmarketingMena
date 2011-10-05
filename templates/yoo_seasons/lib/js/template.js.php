<?php 

if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) @ob_start('ob_gzhandler');
header('Content-type: application/x-javascript');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__) . DS);

/* reflection */
include(PATH_ROOT . 'reflection/reflection.js');

/* lightbox */
include(PATH_ROOT . 'lightbox/slimbox.js');

/* yootools */
include(PATH_ROOT . 'addons/base.js');
include(PATH_ROOT . 'addons/fancymenu.js');
include(PATH_ROOT . 'addons/accordionmenu.js');
include(PATH_ROOT . 'addons/slidepanel.js');
include(PATH_ROOT . 'addons/styleswitcher.js');
include(PATH_ROOT . 'addons/spotlight.js');
include(PATH_ROOT . 'yt_tools.js');

/* ie browser */
if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
	$is_ie7 = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie 7') !== false;	
	$is_ie6 = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie 6') !== false;
	if ($is_ie6 && !$is_ie7) include(PATH_ROOT . 'yt_ie6fix.js');
}

?>