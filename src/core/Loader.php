<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Loader {

    function __construct()
    {
    }

    function view($view, $data = array())
    {
        foreach ($data as $id_assoc => $value)
        {
            ${$id_assoc} = $value;
        }

        $this->load = $this;

        require_once(BASE_PATH.'/views/'.$view.'.php');
    }

    function redirect($url = '')
    {
        header('Location: /'.$url);
    }
}
