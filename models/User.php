<?php

class User extends ActiveRecord\Model
{
    static $has_many = array(
		array('user_logs'),
        array('user_perm_to_users'),
        array('backups'),
        array('backup_files', 'through' => array('backups')) ,
    );

    public static function check_permission($user_id, $permission)
    {
        if (
            ($perm = UserPerm::find_by_name($permission))
            &&
            ($user = User::find_by_id($user_id))
        )
        {
            return UserPermToUser::find_by_perm_id_and_user_id($perm->id, $user->id);
        }
        return FALSE;
    }
}
