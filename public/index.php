<?php
define('APP_PATH', dirname(__DIR__));
define('CONFIG_PATH', APP_PATH . "/config");
define("LIB_PATH", APP_PATH . "/lib");
define('VIEW_PATH', APP_PATH . "/app/view");
include LIB_PATH . "/app.php";
$config = include CONFIG_PATH . "/application.php";
$app = new App($config);
$app->bootstrap()->run();