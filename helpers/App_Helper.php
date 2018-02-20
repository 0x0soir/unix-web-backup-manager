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
