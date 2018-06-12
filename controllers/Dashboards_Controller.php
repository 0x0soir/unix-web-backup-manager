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

            $data['chart_last_days'] = $this->_generate_statistics_last_days(7);
        }

        $data['size_percent'] = (get_actual_user()->used_size / get_actual_user()->max_size) * 100;


        $this->load->view('dashboards/index', $data);
    }

    public function rgpd()
    {
        $this->load->view('dashboards/rgpd', array());
    }

    public function login()
    {
        $this->load->view('login', array());
    }

    private function _generate_statistics_last_days($days)
    {
        $format = 'Y-m-d';
        $m  = date("m");
        $de = date("d");
        $y  = date("Y");
        $dateArray = array();
        for($i=0; $i<=$days-1; $i++){
            $dateArray[] = '' . date($format, mktime(0,0,0,$m,($de-$i),$y)) . '';
        }

        $dateArray = array_reverse($dateArray);
        $total_used = 0;
        $used_sizes = array();
        $backups_count = array();

        foreach ($dateArray as $date)
        {
            $day_size = 0;
            $backups = BackupFile::find('all', array('conditions' => array('backup_id IN (?) AND created_at like ?', get_all_scripts_id(), $date.' %')));
            foreach ($backups as $file)
            {
                $day_size += $file->size;
                $total_used += $day_size;
            }

            array_push($used_sizes, $day_size);
            array_push($backups_count, count($backups));
        }

        return array(
            'dates' => $dateArray,
            'used_sizes' => $used_sizes,
            'backups' => $backups_count,
            'total_used' => $total_used
        );
    }
}
