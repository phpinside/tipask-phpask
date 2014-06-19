<?php

if(version_compare(PHP_VERSION,'5.0','<'))  die('require PHP > 5.0 !');

/* the tipask entrance */
error_reporting(0);
$starttime =  microtime(TRUE);
define('IN_TIPASK', TRUE);
define('TIPASK_ROOT', dirname(__FILE__));
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, -9));
include TIPASK_ROOT . '/model/tipask.class.php';

$tipask = new tipask();
$tipask->run();
