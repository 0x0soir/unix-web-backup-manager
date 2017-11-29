<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

$loaded_classes = array();

function load_class($class, $directory, $mode = FALSE)
{
    require_once(BASE_PATH.'/'.$directory.'/'.$class.'.php');

    if ( ! $mode)
    {
        $loaded_classes[$class] = new $class();

        return $loaded_classes[$class];
    }
}

function load_active_record()
{
    ActiveRecord\Config::initialize(function($cfg)
    {
        $cfg->set_model_directory('../models');
        $cfg->set_connections(array('development' => 'mysql://root:root@localhost/tfg_admin'));
    });

    // create some people
    $jax = new User(array('username' => 'Jorge', 'password' => '1234'));
    $jax->save();
}
