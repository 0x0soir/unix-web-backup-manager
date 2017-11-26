<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Loader_Controller {

    function __construct()
    {
        $this->load_helpers();
    }

    function initialize()
    {
        $controller_obj = $this->load_controller();
        $this->load_action($controller_obj);
    }

    function load_helpers($helpers = array())
    {
        foreach (glob(BASE_PATH.'/helpers/*.php') as $helper)
        {
            include_once($helper);
        }
    }

    function load_controller($controller = BASE_CONTROLLER)
    {
        $controller = ucwords($controller).'_Controller';

        $controller_file = $controller.'.php';

        require_once(BASE_PATH.'/controllers/'.$controller_file);

        $controller_obj = new $controller();

        return $controller_obj;
    }

    function load_action($controller_obj, $action = BASE_ACTION)
    {
        if(isset($action) && method_exists($controller_obj, $action))
        {
            $controller_obj->$action();
        }
    }
}
