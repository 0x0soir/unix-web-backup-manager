<?php

class BackupFile extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('backup'),
    );

    public static function new_file($backup_id, $file)
    {
        $backup = Backup::find_by_id(intval($backup_id));

        if (count($backup) > 0)
        {
            return BackupFile::create(array(
                    'backup_id'     => $backup->id,
                    'url'           => $file
                )
            );
        }
        else
        {
            return FALSE;
        }
    }
}
