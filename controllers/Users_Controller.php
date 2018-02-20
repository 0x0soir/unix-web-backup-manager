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
        sleep(1);
        $data = array(
            'loggin_status' => $this->auth->check_user_password($username, $pasword),
            'url'           => DEFAULT_URL
        );

        echo json_encode($data);
        exit;
    }

    public function logout()
    {
        $this->auth->logout();

        $this->load->redirect();
        exit;
    }

    public function users()
    {
        $data = array();

        $data['users'] = User::all();

        $this->load->view('users/users', $data);
    }

    public function user($user_id)
    {
        $user = User::find_by_id($user_id);
        if ($user)
        {
            $data = array();

            $data['user_info'] = $user;
            $data['user_history'] = UserLog::find_all_by_user_id($user->id);

            $this->load->view('users/user_info', $data);
        }
        else
        {
            $this->load->redirect("Users/users");
            exit;
        }
    }
}
