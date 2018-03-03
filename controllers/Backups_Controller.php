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

        $data['users'] = User::all();

        $this->load->view('users/users', $data);
    }

    public function scripts()
    {
        $data = array();

        $data['backups'] = Backup::all();

        $this->load->view('backups/scripts', $data);
    }

    public function backup_save($backup_id = NULL)
    {
        if (intval($backup_id) > 0)
        {
            // Save
        }
        else
        {
            // Create
            $backup                         = new Backup();
            $backup->user_id                = $this->auth->get_actual_user()->id;
            $backup->type                   = intval($this->load->post_value('type'));
            $backup->status                 = intval($this->load->post_value('status'));
            $backup->start_date             = $this->load->post_value('start_date');
            $backup->end_date               = $this->load->post_value('end_date');
            $backup->source_directory       = $this->load->post_value('source_directory');
            $backup->target_directory       = $this->load->post_value('target_directory');
            $backup->excluded_extensions    = $this->load->post_value('excluded_extensions');
            $backup->excluded_directories   = $this->load->post_value('excluded_directories');

            if (($backup->type <=> 2) && ($backup->status <=> 2))
            {

                $start_date = DateTime::createFromFormat('d/m/Y - H:i', $this->load->post_value('start_date'));
                $end_date = DateTime::createFromFormat('d/m/Y - H:i', $this->load->post_value('end_date'));

                if ($start_date && $end_date)
                {
                    $backup->start_date = $start_date->format('Y/m/d H:i:s');
                    $backup->end_date = $end_date->format('Y/m/d H:i:s');
                }

                if ($backup->save())
                {
                    echo json_encode(array(
                            'status' => '1'
                        )
                    );
                    exit;
                }

                // try {
                //     if ($backup->save())
                //     {
                //         echo json_encode(array(
                //                 'status' => '1'
                //             )
                //         );
                //         exit;
                //     }
                // } catch (Exception $e) {
                //     echo json_encode(array(
                //             'status' => '0'
                //         )
                //     );
                //     exit;
                // }
            }
        }
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

}
