<?php

class UserPerm extends ActiveRecord\Model
{
    static $has_many = array(
        array('user_perm_to_users')
    );


}
