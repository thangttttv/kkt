<?php                                                   
// change the following paths if necessary
date_default_timezone_set('Asia/Saigon');
session_start();
$yii='/home/kktien/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
//require_once('libraryLogin.php');   

Yii::createWebApplication($config)->run();
