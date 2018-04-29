<?php

class BackupFile extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('backup'),
    );

    public static function new_file($backup_id, $file, $type, $size)
    {
        $backup = Backup::find_by_id(intval($backup_id));

        if (count($backup) > 0)
        {
            return BackupFile::create(array(
                    'backup_id'     => $backup->id,
                    'url'           => $file,
                    'type'          => $type,
                    'size'          => $size
                )
            );
        }
        else
        {
            return FALSE;
        }
    }

    public function download_link()
    {
        return WEBSITE_HOST.'Backups/download_backup/'.$this->backup_id.'/'.$this->id;
    }

    public function remove_link()
    {
        return WEBSITE_HOST.'Backups/remove_backup/'.$this->backup_id.'/'.$this->id;
    }
}
