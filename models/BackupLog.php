<?php

class BackupLog extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('backup'),
    );

    public static function new_log($backup_id, $log)
    {
        $ip = 0;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $backup = Backup::find_by_id(intval($backup_id));
        
        if (count($backup) > 0)
        {
            return BackupLog::create(array(
                    'backup_id'     => $backup->id,
                    'history'       => $log,
                    'ip'            => $ip
                )
            );
        }
        else
        {
            return FALSE;
        }
    }
}
