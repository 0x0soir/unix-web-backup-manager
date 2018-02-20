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

    public function user_save($user_id)
    {
        $user = User::find_by_id($user_id);

        $hash_options = [
            'cost' => 6,
        ];

        if ($user)
        {
            $new_username   = $this->load->post_value('username');
            $new_email      = $this->load->post_value('email');
            $new_password   = $this->load->post_value('password');

            if (isset($new_username) && isset($new_email))
            {
                $user->username = $new_username;
                $user->email = $new_email;
            }

            if (isset($new_password) && ( ! empty($new_password)) )
            {
                $user->password = password_hash($new_password, PASSWORD_BCRYPT, $hash_options);
            }

            if ($user->save())
            {
                $this->load->view("common/success", array('message' => 'Datos actualizados correctamente.'));
            }
        }

        $this->load->view("common/error", array('message' => 'No se han podido actualizar los datos.'));
    }
}
