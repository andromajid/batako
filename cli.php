<?php

date_default_timezone_set('Asia/Jakarta');
defined('YII_DEBUG') or define('YII_DEBUG', true);

$yii = dirname(__FILE__) . '/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/console.php';

require_once($yii);
// creating and running console application
Yii::createConsoleApplication($config)->run();
