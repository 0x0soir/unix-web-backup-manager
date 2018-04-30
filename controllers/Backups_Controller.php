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
            $data['backup_files']   = BackupFile::find_all_by_backup_id($backup->id);

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
            $backup->excluded_extensions    = $this->load->post_value('excluded_extensions');
            $backup->excluded_directories   = $this->load->post_value('excluded_directories');

            $cronjob = array(
                'cron_hours'        => $this->load->post_value('selectHours'),
                'cron_minutes'      => $this->load->post_value('selectMinutes'),
                'cron_days'         => $this->load->post_value('selectDays'),
                'cron_months'       => $this->load->post_value('selectMonths'),
                'cron_week_days'    => $this->load->post_value('selectWeekDays'),
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

                $cronjob_string = $backup->build_cronjob($cronjob);

                if ($cronjob_string != NULL)
                {
                    $backup->cronjob = $cronjob_string;

                    try {
                        if ($backup->save())
                        {
                            if (intval($backup_id) > 0)
                            {
                                $this->load->new_notification('Se han actualizado los datos correctamente.', 'success');

                                if ($this->check_operating_system(TRUE))
                                {
                                    $this->cronjob_add($backup_id);
                                }
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
                else
                {
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

    private function _get_directory_iterator_to_array(DirectoryIterator $iterator)
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
        $target_dir = ! empty($this->load->post_value('target_dir')) ? $this->load->post_value('target_dir') : BASE_DIRECTORY_NEW_SCRIPT;
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

    public function cronjob($id)
    {
        $id = intval($id);

        if (($id > 0) && $this->check_operating_system(TRUE))
        {
            // get script by id
            $script = Backup::find_by_id($id);

            // check if script exists
            if ($script)
            {
                // check if can write destiny
                if ($script->source_directory)
                {
                    $source_directory = realpath(trim($script->source_directory));
                    $excluded_extensions = explode(" ", $script->excluded_extensions);
                    $excluded_extensions = array_map('strtolower', $excluded_extensions);
                    $excluded_directories = explode(" ", $script->excluded_directories);
                    $excluded_directories = array_map('strtolower', $excluded_directories);

                    if (is_dir($source_directory) && is_readable($source_directory) && is_dir(DIRECTORY_TARGET_BACKUPS) && is_writable(DIRECTORY_TARGET_BACKUPS))
                    {
                        $path = realpath($source_directory);

                        $innerIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
                            $path,
                            RecursiveDirectoryIterator::SKIP_DOTS
                        ));

                        // do backup
                        if (!file_exists(DIRECTORY_TARGET_BACKUPS.'/'.$script->id)) {
                            mkdir(DIRECTORY_TARGET_BACKUPS.'/'.$script->id, 0777, true);
                        }

                        $target_file = md5($script->source_directory).'_'.date('d_m_Y_H_i_s', time());
                        $target_compress_data = new PharData(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar');

                        try {
                            foreach ($innerIterator as $directory)
                            {
                                if ($directory->isFile())
                                {
                                    if (count($excluded_directories) > 1)
                                    {
                                        $dir_parts = explode($source_directory, $directory->getPath());
                                        $dir_parts = explode("/", $dir_parts[1]);
                                        $dir_parts = array_map('strtolower', $dir_parts);

                                        if (count(array_diff($dir_parts, $excluded_directories)) != count($dir_parts))
                                        {
                                            continue;
                                        }
                                    }
                                    // --> ignore extensions
                                    if ( ! in_array(strtolower($directory->getExtension()), $excluded_extensions))
                                    {
                                        $target_compress_data->addFile($directory);
                                    }

                                }
                            }

                            // save backup tar gz
                            $target_compress_data->compress(Phar::GZ);

                            if (file_exists(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar'))
                            {
                                BackupLog::new_log($script->id, 'Copia de seguridad generada '.$target_file);
                                BackupFile::new_file($script->id, $target_file.'.tar', '.tar', filesize(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar'));

                                $user = get_actual_user();
                                $user->used_size = get_actual_user()->used_size + filesize(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar');
                                $user->save();
                            }
                            else
                            {
                                BackupLog::new_log($script->id, 'No se ha podido generar la copia '.$target_file);
                            }

                            if (file_exists(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar.gz'))
                            {
                                BackupLog::new_log($script->id, 'Copia de seguridad generada '.$target_file);
                                BackupFile::new_file($script->id, $target_file.'.tar.gz', '.tar.gz', filesize(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar.gz'));

                                $user = get_actual_user();
                                $user->used_size = get_actual_user()->used_size + filesize(DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$target_file.'.tar.gz');
                                $user->save();
                            }
                            else
                            {
                                BackupLog::new_log($script->id, 'No se ha podido generar la copia '.$target_file);
                            }
                        }
                        catch (Exception $e)
                        {
                            echo "error";
                        }
                    }
                    else
                    {
                        // no puede escribir ni leer
                        echo "error";
                    }
                }
            }

            // insert into historic data
            // generate rsa protection
            // send email with key to user
        }
    }

    public function cronjob_delete($id)
    {
        $id = intval($id);

        if ($id > 0)
        {
            $script = Backup::find_by_id($id);

            if ($script)
            {
                if ($this->cronjob_check_exists($id))
                {
                    $actual_crons = shell_exec('crontab -l');

                    file_put_contents('/tmp/crontab.txt', $actual_crons.PHP_EOL);

                    $tmp_contents = file('/tmp/crontab.txt', FILE_SKIP_EMPTY_LINES);

                    foreach($tmp_contents as $key => $line) {
                        if (strpos($line, '# TFG Admin Script '.$id) !== false) {
                            unset($tmp_contents[$key]);
                        }
                    }

                    $cron_clean = implode(PHP_EOL, $tmp_contents);

                    $cron_clean = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $cron_clean);

                    file_put_contents('/tmp/crontab.txt', $cron_clean);

                    exec('crontab /tmp/crontab.txt');
                }
            }
        }
    }

    private function cronjob_get_all()
    {
        exec('crontab -l', $crontab);
        print_r($crontab);
    }

    private function cronjob_remove_all()
    {
        exec('crontab -r');
    }

    private function cronjob_add($id){
        $id = intval($id);
        $cronjob_added = false;

        if ($id > 0)
        {
            $script = Backup::find_by_id($id);

            if ($script)
            {
                $this->cronjob_delete($id);

                if (is_string($script->get_custom_cronjob()) && ( ! empty($script->get_custom_cronjob())) && ($this->cronjob_check_exists($id, $script->get_custom_cronjob())===FALSE))
                {
                    $actual_crons = shell_exec('crontab -l');
                    file_put_contents('/tmp/crontab.txt', $actual_crons.$script->get_custom_cronjob().PHP_EOL);
                    exec('crontab /tmp/crontab.txt');

                    $cronjob_added = true;
                }
                else {
                    echo "no mete";
                    $test_output = shell_exec('crontab -l');
                    echo $test_output;
                }
            }
        }

        return $cronjob_added;
    }

    private function cronjob_check_exists($id, $command = NULL)
    {
        $id = intval($id);
        $cronjob_exists = false;

        if ($id > 0)
        {
            $script = Backup::find_by_id($id);

            if ($script)
            {
                exec('crontab -l', $crontab);

                if (isset($crontab) && is_array($crontab)){

                    if ($command)
                    {
                        $crontab = array_flip($crontab);

                        if(isset($crontab[$command])){
                            $cronjob_exists = true;
                        }
                    }
                    else
                    {
                        foreach ($crontab as $cron) {
                            if (strpos($cron, '# TFG Admin Script '.$id) !== false) {
                                $cronjob_exists = true;
                                break;
                            }
                        }
                    }
                }
            }
        }

        return $cronjob_exists;
    }

    public function download_backup($backup_id, $backup_file_id)
    {
        // TODO: Comprobar que el fichero pertence al script y a la cuenta logeada
        $script = Backup::find_by_id(intval($backup_id));

        if ($script)
        {
            $backup_file = BackupFile::find_by_id($backup_file_id);

            if ($backup_file)
            {
                $backup_file = DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$backup_file->url;

                if (file_exists($backup_file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.basename($backup_file).'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($backup_file));
                    readfile($backup_file);
                    exit;
                }
            }
        }
    }

    public function remove_backup($backup_id, $backup_file_id)
    {
        // TODO: Comprobar que el fichero pertence al script y a la cuenta logeada
        $script = Backup::find_by_id(intval($backup_id));

        if ($script)
        {
            $backup_file = BackupFile::find_by_id($backup_file_id);

            if ($backup_file)
            {
                $backup_real_file = DIRECTORY_TARGET_BACKUPS.'/'.$script->id.'/'.$backup_file->url;

                if (file_exists($backup_real_file)) {
                    if ($backup_file->delete())
                    {
                        unlink($backup_real_file);
                    }
                }
            }
        }

        $this->load->redirect('backups/backups');
    }
}
