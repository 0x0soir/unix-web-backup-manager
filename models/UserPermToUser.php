<?php

class UserPermToUser extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('user'),
    );

    
}
