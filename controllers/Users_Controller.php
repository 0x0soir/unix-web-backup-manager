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

        $data['users'] = User::find('all', array(
                'include' => array('backups' => array('backup_files'))
            )
        );

        $user_backup_files_count = array();

        foreach($data['users'] as $user)
        {
            foreach($user->backups as $backup)
            {
                if (array_key_exists($user->id, $user_backup_files_count))
                {
                    $user_backup_files_count[$user->id] += count($backup->backup_files);
                }
                else
                {
                    $user_backup_files_count[$user->id] = count($backup->backup_files);
                }
            }
        }

        $data['user_backup_files_count'] = $user_backup_files_count;

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
            $new_max_size   = $this->load->post_value('max_size');

            if (isset($new_username) && isset($new_email) && isset($new_max_size))
            {
                $user->username = $new_username;
                $user->email = $new_email;
                $user->max_size = $new_max_size;
            }

            if (isset($new_password) && ( ! empty($new_password)) )
            {
                $user->password = password_hash($new_password, PASSWORD_BCRYPT, $hash_options);
            }

            if ($user->save())
            {
                $this->load->new_notification('Se han actualizado los datos correctamente.', 'success');
            }
            else
            {
                $this->load->new_notification('No se han podido actualizar los datos.', 'danger');
            }
        }

        $this->user($user->id);
    }

    public function user_delete($user_id)
    {
        $user = User::find_by_id($user_id);

        if ($user)
        {
            if ($user->id == $this->auth->get_actual_user()->id)
            {
                $this->load->new_notification('No puedes eliminarte a ti mismo.', 'danger');
            }
            else
            {
                if ($user->delete())
                {
                    $this->load->new_notification('Los datos del usuario han sido eliminados correctamente.', 'success');
                }
                else
                {
                    $this->load->new_notification('No se han podido eliminar los datos.', 'danger');
                }
            }
        }

        $this->users();
    }
}
