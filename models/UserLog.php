<?php

class UserLog extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('user'),
    );
}
