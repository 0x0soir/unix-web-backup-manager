<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

function get_actual_user()
{
    if ($user = is_logged(TRUE))
    {
        return $user;
    }

    return NULL;
}

function is_logged($return_user = FALSE)
{
    if (isset($_COOKIE["lg_id"]))
    {
        $user = User::find_by_session($_COOKIE["lg_id"]);

        if (count($user) > 0)
        {
            if (password_verify($user->id, $user->session))
            {
                if ($return_user)
                {
                    return $user;
                }
                else
                {
                    return TRUE;
                }
            }
        }
    }

    return FALSE;
}

function check_perm($permission)
{
    if ($user = is_logged(TRUE))
    {
        return User::check_permission($user->id, $permission);
    }
    return FALSE;
}

function get_bytes_correct_format($size, $precision = 2)
{
    if (intval($size) != 0)
    {
        $size_base = log($size, 1024);

        $suff = array('bytes', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $size_base - floor($size_base)), $precision) .' '. $suff[floor($size_base)];
    }
    else {
        return '0 bytes';
    }
}

function get_real_date($datetime)
{
    return $datetime->format('d/m/Y H:i');
}

function get_last_backups($limit = 7)
{
    $scripts = Backup::find_all_by_user_id(get_actual_user()->id);

    $backup_files = array();

    if (count($scripts) > 0)
    {
        foreach ($scripts as $script) {
            $backup_files = $backup_files + BackupFile::find_all_by_backup_id($script->id, array('order' => 'id desc', 'limit' => $limit));
        }
    }

    return $backup_files;
}

function get_all_scripts_id()
{
    $scripts = Backup::find_all_by_user_id(get_actual_user()->id);

    $ids = array();

    foreach ($scripts as $script)
    {
        array_push($ids, $script->id);
    }

    return $ids;
}

function check_available_space($user, $needed)
{
    if (($user->used_size + $needed) > $user->max_size)
    {
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}
