<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Base_Controller {

    function __construct()
    {
        $this->load = & load_class('Loader', 'core');
        $this->auth = & load_class('Auth', 'core');

        $this->initialize();
    }

    private function initialize()
    {
        if ( ! $this->auth->is_logged() )
        {
            $this->load->view('common/login');
            exit;
        }
    }

}
