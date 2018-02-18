<?php

class UserLog extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('users'),
    );

    public static function new_log($username, $log, $ip)
    {
        $user = User::find_by_username($username);
        if (count($user) > 0)
        {
            return UserLog::create(array(
                    'user_id' => $user->id,
                    'history' => $log,
                    'ip' => $ip
                )
            );
        }
        else
        {
            return FALSE;
        }
    }
}
