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

    public function register()
    {
        $this->load->view('register', array());
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

        if ( ! check_perm('ADMIN'))
        {
            $this->load->redirect();
            exit;
        }

        $data['users'] = User::find_all_by_active(true, array(
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

    public function users_register()
    {
        $data = array();

        if ( ! check_perm('ADMIN'))
        {
            $this->load->redirect();
            exit;
        }

        $data['users'] = User::find_all_by_active(false);

        $this->load->view('users/users_register', $data);
    }

    public function user($user_id)
    {
        $user = User::find_by_id(intval($user_id));

        if ($user)
        {
            if ((get_actual_user()->id != intval($user_id)) && ( ! check_perm('ADMIN')))
            {
                $this->load->redirect();
                exit;
            }

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

    public function user_config($user_id)
    {
        $user = User::find_by_id($user_id);
        if ($user)
        {
            if ((get_actual_user()->id != intval($user_id)) && ( ! check_perm('ADMIN')))
            {
                $this->load->redirect();
                exit;
            }

            $data = array();

            $data['user_info'] = $user;

            $this->load->view('users/user_config', $data);
        }
        else
        {
            $this->load->redirect("Users/users");
            exit;
        }
    }

    public function user_new()
    {
        if ( ! check_perm('ADMIN'))
        {
            exit;
        }
        else
        {
            $this->load->view('users/new_user', array());
        }
    }

    public function user_save($user_id = 0)
    {
        if (intval($user_id) > 0)
        {
            $user = User::find_by_id($user_id);

            if ((get_actual_user()->id != intval($user_id)) && ( ! check_perm('ADMIN')))
            {
                $this->load->redirect();
                exit;
            }
        }
        else
        {
            // Create
            if ( ! check_perm('ADMIN') )
            {
                $this->load->redirect();
                exit;
            }

            $user = new User();
        }

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

    public function register_data()
    {
        $username   = $this->load->post_value('username');
        $email      = $this->load->post_value('email');
        $password   = $this->load->post_value('password');
        $password2  = $this->load->post_value('password2');

        if ((isset($username)) && (isset($email)) && (isset($password)) && (isset($password2)))
        {
            if ((filter_var($email, FILTER_VALIDATE_EMAIL)) && ($password == $password2))
            {
                $user = new User();

                $hash_options = [
                    'cost' => 6,
                ];

                $user->username     = $username;
                $user->email        = $email;
                $user->password     = password_hash($password, PASSWORD_BCRYPT, $hash_options);
                $user->max_size     = 50000;

                try {
                    if ($user->save())
                    {
                        $data = array(
                            'register_status'   => TRUE,
                            'url'               => DEFAULT_URL
                        );

                        echo json_encode($data);
                        exit;
                    }
                }
                catch (Exception $e)
                {
                }
            }
        }

        $data = array(
            'register_status'   => FALSE,
            'url'               => DEFAULT_URL
        );

        echo json_encode($data);
        exit;
    }

    public function user_config_save($user_id = 0)
    {
        if (intval($user_id) > 0)
        {
            $user = User::find_by_id($user_id);

            if ((get_actual_user()->id != intval($user_id)) && ( ! check_perm('ADMIN')))
            {
                $this->load->redirect();
                exit;
            }
        }

        if ($user)
        {
            $new_notification_memory        = $this->load->post_value('memory');
            $new_notification_new_backup    = $this->load->post_value('new_backup');

            if (( $new_notification_memory == NULL) OR ($new_notification_memory != "on"))
            {
                $user->send_memory_mails = FALSE;
            }
            else
            {
                $user->send_memory_mails = TRUE;
            }

            if (( $new_notification_new_backup == NULL) OR ($new_notification_new_backup != "on"))
            {
                $user->send_backup_done_mails = FALSE;
            }
            else
            {
                $user->send_backup_done_mails = TRUE;
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

        $this->user_config($user->id);
    }

    public function user_accept($user_id)
    {
        $user = User::find_by_id($user_id);

        if ($user)
        {
            if ( ! check_perm('ADMIN') )
            {
                $this->load->redirect();
                exit;
            }

            if ($user->id == $this->auth->get_actual_user()->id)
            {
                $this->load->new_notification('No puedes aceptarte a ti mismo.', 'danger');
            }
            else
            {
                $user->active = TRUE;

                if ($user->save())
                {
                    $this->load->new_notification('Los datos del usuario han sido actualizados correctamente.', 'success');
                }
                else
                {
                    $this->load->new_notification('No se han podido actualizar los datos.', 'danger');
                }
            }
        }

        $this->users();
    }
    public function user_delete($user_id)
    {
        $user = User::find_by_id($user_id);

        if ($user)
        {
            if ( ! check_perm('ADMIN') )
            {
                $this->load->redirect();
                exit;
            }

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

    public function user_delete_backups($user_id, $redirect = TRUE)
    {
        if ($user_id)
        {
            $user = User::find_by_id($user_id, array(
                    'include' => array('backups' => array('backup_files'))
                )
            );

            if ($user)
            {
                if ( ! check_perm('ADMIN') )
                {
                    $this->load->redirect();
                    exit;
                }

                foreach($user->backups as $script)
                {
                    foreach($script->backup_files as $backup_file)
                    {
                        $backup_real_file = DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$backup_file->url;

                        if (file_exists($backup_real_file)) {
                            $user->used_size = $user->used_size - filesize($backup_real_file);
                            if ($user->save())
                            {
                                if ($backup_file->delete())
                                {
                                    unlink($backup_real_file);
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($redirect)
        {
            $this->load->redirect('Users/users');
        }
    }

    public function user_delete_scripts($user_id, $redirect = TRUE)
    {
        if ($user_id)
        {
            $user = User::find_by_id($user_id, array(
                    'include' => array('backups' => array('backup_files'))
                )
            );

            if ($user)
            {
                if ( ! check_perm('ADMIN') )
                {
                    $this->load->redirect();
                    exit;
                }

                foreach($user->backups as $script)
                {
                    foreach($script->backup_files as $backup_file)
                    {
                        $backup_real_file = DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$backup_file->url;

                        if (file_exists($backup_real_file)) {
                            $user->used_size = $user->used_size - filesize($backup_real_file);
                            if ($user->save())
                            {
                                if ($backup_file->delete())
                                {
                                    unlink($backup_real_file);
                                }
                            }
                        }
                    }
                    $script->delete();
                }
            }
        }

        if ($redirect)
        {
            $this->load->redirect('Users/users');
        }
    }
}
