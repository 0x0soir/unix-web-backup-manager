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

    if (count(User::find_all_by_username('admin'))==0)
    {
        $opciones = [
            'cost' => 12,
        ];

        $jax = new User(
            array(
                'username' => 'admin',
                'email' => 'admin@tfg.com',
                'password' => password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $opciones)
            )
        );
        $jax->save();
    }
}
