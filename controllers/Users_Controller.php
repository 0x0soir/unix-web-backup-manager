<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Users_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login', array());
    }

    public function login()
    {
        $username = $this->load->post_value('username');
        $pasword = $this->load->post_value('password');

        $data = array(
            'loggin_status' => $this->auth->check_user_password($username, $pasword),
            'url'           => login_success_url
        );

        echo json_encode($data);
        exit;
    }

    public function users()
    {
        $data = array();

        $data['users'] = User::all();

        $this->load->view('users/users', $data);
    }
}
