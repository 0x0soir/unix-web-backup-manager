<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Auth {

    private $actual_user;

    function __construct()
    {
        $this->generate_session();
    }

    function check_user_password($username, $password)
    {
        if (($username == NULL)||($password == NULL)){
            return FALSE;
        }

        $user_obj = User::find_by_username($username, array('include' => array('user_logs')));

        if (count($user_obj) > 0)
        {
            if (password_verify($password, $user_obj->password))
            {
                $this->loggin($user_obj);
                return TRUE;
            }
        }

        return FALSE;
    }

    function loggin($user_model)
    {
        $ip = 0;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $hash_options = [
            'cost' => 6,
        ];

        $hash_session = password_hash($user_model->id, PASSWORD_BCRYPT, $hash_options);

        // Update session
        $user_model->session = $hash_session;
        $user_model->last_login = new DateTime();
        $user_model->save();

        // Create cookie
        setcookie('lg_id', $hash_session, time() + 60*60*24*365, '/');

        // Create log data
        UserLog::new_log($user_model->username, 'Login: '.$hash_session, $ip);
    }

    function logout()
    {
        $user_model = $this->get_actual_user();

        if ($user_model)
        {
            $ip = 0;
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            // Update session
            $user_model->session = '';
            $user_model->save();

            // Create cookie
            unset($_COOKIE['lg_id']);
            setcookie('lg_id', '', time() - 3600, '/');

            // Create log data
            UserLog::new_log($user_model->username, 'Logout', $ip);
        }
    }

    function is_logged()
    {
        if (isset($this->actual_user))
        {
            return TRUE;
        }

        return FALSE;
    }

    private function generate_session()
    {
        if (isset($_COOKIE["lg_id"]))
        {
            $user = User::find_by_session($_COOKIE["lg_id"]);

            if (count($user) > 0)
            {
                if (password_verify($user->id, $user->session))
                {
                    $this->actual_user = $user;
                }
            }
        }
    }

    public function get_actual_user()
    {
        if (is_logged())
        {
            return $this->actual_user;
        }

        return FALSE;
    }
}
