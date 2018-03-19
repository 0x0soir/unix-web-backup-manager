<?php

class BackupLog extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('backup'),
    );

    public static function new_log($backup_id, $log, $ip)
    {
        $backup = Backup::find_by_id(intval($backup_id));
        if (count($backup) > 0)
        {
            return BackupLog::create(array(
                    'user_id'   => $backup->id,
                    'history'   => $log,
                    'ip'        => $ip
                )
            );
        }
        else
        {
            return FALSE;
        }
    }
}
