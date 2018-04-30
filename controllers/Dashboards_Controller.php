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
            'max_size'      => get_bytes_correct_format(get_actual_user()->max_size),
            'used_size'     => get_bytes_correct_format(get_actual_user()->used_size),
            'scripts'       => Backup::find_all_by_user_id(get_actual_user()->id),
            'backups'       => 0
        );

        if (count($data['scripts']) > 0)
        {
            foreach ($data['scripts'] as $script) {
                $data['backups'] += count(BackupFile::find_all_by_backup_id($script->id));
            }
        }

        $this->load->view('dashboards/index', $data);
    }

    public function login()
    {
        $this->load->view('login', array());
    }
}
