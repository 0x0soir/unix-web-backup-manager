<?php

class Backup extends ActiveRecord\Model
{
    private $types = array(
        0 => 'Diario',
        1 => 'Semanal',
        2 => 'Mensual',
    );

    static $belongs_to = array(
        array('user'),
    );

    public function get_type_text()
    {
        return $this->types[$this->type];
    }
}
