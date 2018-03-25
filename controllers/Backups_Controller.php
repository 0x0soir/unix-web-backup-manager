<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Backups_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->redirect('backups/backups');
    }

    public function backups()
    {
        $data = array();

        $data['backups'] = Backup::find_all_by_user_id($this->auth->get_actual_user()->id);

        $this->load->view('backups/backups', $data);
    }

    public function backup($backup_id)
    {
        $backup = Backup::find_by_id(intval($backup_id));

        if ($backup)
        {
            $data = array();

            $data['backup_info']    = $backup;
            $data['backup_logs']    = BackupLog::find_all_by_backup_id($backup->id);

            $this->load->view('backups/backup_info', $data);
        }
        else
        {
            $this->load->redirect("Backups/backups");
            exit;
        }
    }

    public function backup_save($backup_id = NULL)
    {
        if (intval($backup_id) > 0)
        {
            // Get actual backup and save
            $backup = Backup::find_by_id(intval($backup_id));
        }
        else
        {
            // Create
            $backup = new Backup();
        }

        if ($backup)
        {
            $backup->user_id                = $this->auth->get_actual_user()->id;
            $backup->type                   = intval($this->load->post_value('type'));
            $backup->state                  = intval($this->load->post_value('state'));
            $backup->start_date             = $this->load->post_value('start_date');
            $backup->end_date               = $this->load->post_value('end_date');
            $backup->source_directory       = $this->load->post_value('source_directory');
            $backup->target_directory       = $this->load->post_value('target_directory');
            $backup->excluded_extensions    = $this->load->post_value('excluded_extensions');
            $backup->excluded_directories   = $this->load->post_value('excluded_directories');

            $cronjob = array(
                'cron_hours'        => $this->load->post_value('selectHours'),
                'cron_minutes'      => $this->load->post_value('selectMinutes'),
                'cron_days'         => $this->load->post_value('selectDays'),
                'cron_months'       => $this->load->post_value('selectMonths'),
                'cron_week_days'    => $this->load->post_value('selectWeekDays'),
                'cron_command'      => 'test'
            );

            if (($backup->type <=> 3) && ($backup->state <=> 3))
            {

                $start_date = DateTime::createFromFormat('d/m/Y H:i', $this->load->post_value('start_date'));
                $end_date = DateTime::createFromFormat('d/m/Y H:i', $this->load->post_value('end_date'));

                if ($start_date && $end_date)
                {
                    $backup->start_date = $start_date->format('Y/m/d H:i:s');
                    $backup->end_date = $end_date->format('Y/m/d H:i:s');
                }

                $cronjob_string = $this->_build_cronjob($cronjob);

                if ($cronjob_string != NULL)
                {
                    $backup->cronjob = $cronjob_string;
                }
                else
                {
                    // no guardar
                    exit;
                }

                try {
                    if ($backup->save())
                    {
                        if (intval($backup_id) > 0)
                        {
                            $this->load->new_notification('Se han actualizado los datos correctamente.', 'success');
                        }
                        else
                        {
                            echo json_encode(array(
                                    'status' => '1'
                                )
                            );
                            exit;
                        }
                    }
                } catch (Exception $e) {
                    if (intval($backup_id) > 0)
                    {
                        $this->load->new_notification('No se han podido actualizar los datos.', 'danger');
                    }
                    else
                    {
                        echo json_encode(array(
                                'status' => '0'
                            )
                        );
                        exit;
                    }
                }
            }
        }

        $this->backup(intval($backup_id));
    }

    function _get_directory_iterator_to_array(DirectoryIterator $iterator)
    {
        $result = array();

        sleep(2);

        foreach ($iterator as $key => $directory) {
            if ($directory->isDot()) {
                continue;
            }

            if ($directory->isDir() && $directory->getFilename()[0] != '.') {
                array_push($result, array(
                    'path'          => $directory->getPathname(),
                    'name'          => $directory->getFilename(),
                    'size'          => $directory->getSize(),
                    'last_modify'   => $directory->getMTime()
                ));
            }
        }

        usort($result, function ($item_1, $item_2) {
            return $item_2['last_modify'] <=> $item_1['last_modify'];
        });

        return $result;
    }

    public function get_directories()
    {
        $target_dir = ! empty($this->load->post_value('target_dir')) ? $this->load->post_value('target_dir') : '/Users/soir';
        $files = $this->_get_directory_iterator_to_array(new DirectoryIterator($target_dir));

        $result = '';

        foreach($files as $directory) {
            $result .= '<tr data-path="'.$directory['path'].'"><td><span data-feather="folder"></span>  '.$directory['name'].'</td><td>'.get_bytes_correct_format($directory['size']).'</td><td>'.date("d/m/Y H:i", $directory['last_modify']).'</td></tr>';
        }

        echo json_encode(array(
                'status' => '1',
                'directories' => htmlentities($result),
                'actual_directory' => $target_dir
            )
        );
        exit;
    }

    public function _build_cronjob($cronjob)
    {
        $cron_string = array();

        if (count($cronjob['cron_minutes']) > 0)
        {
            $cron_string['minutes'] = implode(',', $cronjob['cron_minutes']);
        }
        else
        {
            $cron_string['minutes'] = '*';
        }

        if (count($cronjob['cron_hours']) > 0)
        {
            $cron_string['hours'] = implode(',', $cronjob['cron_hours']);
        }
        else
        {
            $cron_string['hours'] = '*';
        }

        if (count($cronjob['cron_days']) > 0)
        {
            $cron_string['days'] = implode(',', $cronjob['cron_days']);
        }
        else
        {
            $cron_string['days'] = '*';
        }

        if (count($cronjob['cron_months']) > 0)
        {
            $cron_string['months'] = implode(',', $cronjob['cron_months']);
        }
        else
        {
            $cron_string['months'] = '*';
        }

        if (count($cronjob['cron_week_days']) > 0)
        {
            $cron_string['week_days'] = implode(',', $cronjob['cron_week_days']);
        }
        else
        {
            $cron_string['week_days'] = '*';
        }

        if (trim($cronjob['cron_command']) != NULL)
        {
            $cron_string['command'] = $cronjob['cron_command'];
        }
        else
        {
            return NULL;
        }

        return implode(' ', $cron_string);
    }

}
