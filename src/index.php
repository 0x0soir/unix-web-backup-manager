<?php
require_once('config/config.global.php');
require_once('core/Loader_Controller.php');
require_once('core/Base_Controller.php');

$loader_obj = new Loader_Controller();

$loaded_controller = $loader_obj->initialize();
?>
