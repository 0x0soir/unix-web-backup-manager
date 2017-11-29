<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Dashboards_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'test'  => 'Prueba de Jorge'
        );

        $this->load->view('dashboards/index', $data);
    }

    public function login()
    {
        print_r($this->load->get_value());
        $this->load->view('common/login', array());
    }
}
