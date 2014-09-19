<?php

// Configuración básica
include('conf.php');
define('GOB_BANNER', $GOB_BANNER);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//$yii=dirname(__FILE__).'/protected/vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//require_once($yii);
require(dirname(__FILE__).'/protected/vendor/autoload.php');

Yii::createWebApplication($config)->run();
Yii::app()->user->setReturnUrl($BASE_URL);