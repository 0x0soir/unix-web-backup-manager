<?php
require_once('config/config.global.php');
require_once('core/Common.php');
require_once('core/Init.php');
require_once('core/Base_Controller.php');

$loader_obj = new Init();

$loaded_controller = $loader_obj->initialize();

?>
