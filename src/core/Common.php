<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

$loaded_classes = array();

function load_class($class, $directory)
{
    require_once(BASE_PATH.'/'.$directory.'/'.$class.'.php');

    $loaded_classes[$class] = new $class();

    return $loaded_classes[$class];
}
