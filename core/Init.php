<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Init {
    function initialize()
    {
        if (isset($_GET['params']))
        {
            $params = explode( "/", $_GET['params']);

            $controller = $params[0];

            $action = isset($params[1]) ? $params[1] : '';

            $other_params = array_slice($params, 2);
        }

        $controller_obj = $this->_load_controller(isset($controller) ? $controller : BASE_CONTROLLER);
        $this->_load_action($controller_obj, isset($action) ? $action : BASE_ACTION, isset($other_params) ? $other_params : array());
    }

    private function _load_controller($controller_var)
    {
        $controller = ucwords($controller_var).'_Controller';

        $controller_file = $controller.'.php';

        if (file_exists(BASE_PATH.'/controllers/'.$controller_file) && ctype_alpha($controller_var))
        {
            require_once(BASE_PATH.'/controllers/'.$controller_file);

            $controller_obj = new $controller();
        }
        else
        {
            require(BASE_PATH.'/views/404.php');
            exit;
        }

        return $controller_obj;
    }

    private function _load_action($controller_obj, $action, $other_params = NULL)
    {
        if(isset($action) && method_exists($controller_obj, $action))
        {
            call_user_func_array(array($controller_obj, $action), $other_params);
        }
    }
}
