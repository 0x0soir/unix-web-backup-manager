<?php
require_once('../config/config.global.php');
require_once('../core/Common.php');
require_once('../core/Init.php');
require_once('../core/Base_Controller.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$loader_obj = new Init();

$loader_obj->initialize();

?>
