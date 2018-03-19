<?php

class Backup extends ActiveRecord\Model
{
    private $types = array(
        0 => 'Diario',
        1 => 'Semanal',
        2 => 'Mensual',
    );

    private $states = array(
        0 => 'Funcionando',
        1 => 'Pausado',
        2 => 'Eliminado',
    );

    static $belongs_to = array(
        array('user'),
    );

    /*
    *   Public Methods
    */
    public function get_type_text()
    {
        return $this->types[$this->type];
    }

    public function get_types()
    {
        return $this->types;
    }

    public function get_state_text()
    {
        return $this->states[$this->state];
    }

    public function get_states()
    {
        return $this->states;
    }
}
