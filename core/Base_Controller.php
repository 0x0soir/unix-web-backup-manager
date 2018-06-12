<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Base_Controller {

    function __construct()
    {
        load_class('ActiveRecord', 'core', TRUE);
        load_class('Exception', 'core/lib/PHPMailer', TRUE);
        load_class('SMTP', 'core/lib/PHPMailer', TRUE);
        load_class('PHPMailer', 'core/lib/PHPMailer', TRUE);
        load_active_record();
        load_config();

        $this->load = load_class('Loader', 'core');
        $this->auth = load_class('Auth', 'core');

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
        $this->check_operating_system();
        $this->check_rgpd_accepted();
    }

    private function _check_public_url()
    {
        $actual_uri = explode('/', $_SERVER['REQUEST_URI']);
        if (count($actual_uri)>2)
        {
            return in_array('/'.strtolower($actual_uri[1]).'/'.($actual_uri[2]), config_public_urls);
        }

        return FALSE;
    }

    public function check_operating_system($with_return = FALSE)
    {
        if ( ! in_array(PHP_OS, ALLOWED_OPERATING_SYSTEM) )
        {
            if (isset($with_return))
            {
                $this->load->new_notification('El sistema operativo actual no está soportado por la plataforma, las copias de seguridad no se realizarán.<br>Los sistemas operativos soportados son: '.implode(", ", ALLOWED_OPERATING_SYSTEM), 'warning');
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            if (isset($with_return))
            {
                return TRUE;
            }
        }
    }

    public function check_rgpd_accepted()
    {
        $actual_uri = explode('/', $_SERVER['REQUEST_URI']);
        if (
            ($this->auth->is_logged())
            && (get_actual_user())
            && (get_actual_user()->rgpd_status == 0)
            && (
                ( ! isset($actual_uri[2]))
                ||
                (
                    ($actual_uri[2] != 'user_config')
                    &&
                    ($actual_uri[2] != 'user_config_save')
                    &&
                    ($actual_uri[2] != 'rgpd')
                )
            )
        )
        {
            $this->load->redirect('users/user_config/'.get_actual_user()->id);
        }
    }

    public function send_mail($to, $subject, $html)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = SMTP_HOST;
        $mail->Username = SMTP_FROM;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = 465;
        $mail->From = SMTP_FROM;
        $mail->FromName = "TFG BACKUPS";
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body = $html;

        if ($mail->Send()){
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}
