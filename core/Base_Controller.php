<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Base_Controller {

    function __construct()
    {
        $this->load = load_class('Loader', 'core');
        $this->auth = load_class('Auth', 'core');
        load_class('ActiveRecord', 'core', TRUE);
        load_active_record();
        load_config();

        $this->_load_helpers();

        $this->_initialize();
    }

    private function _load_helpers($helpers = array())
    {
        foreach (glob(BASE_PATH.'/helpers/*.php') as $helper)
        {
            include_once($helper);
        }
    }

    private function _initialize()
    {
        if ( ( ! $this->auth->is_logged() ) && (! $this->_check_public_url()) )
        {
            $this->load->redirect('users/index');
        }
    }

    private function _check_public_url()
    {
        $actual_uri = explode('/', $_SERVER['REQUEST_URI']);
        if (count($actual_uri)>2)
        {
            return in_array('/'.$actual_uri[1].'/'.$actual_uri[2], config_public_urls);
        }

        return FALSE;
    }

}
