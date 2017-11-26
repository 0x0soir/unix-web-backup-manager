<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Loader {

    function __construct()
    {
    }

    function view($view, $data)
    {
        foreach ($data as $id_assoc => $value)
        {
            ${$id_assoc} = $value;
        }

        require_once(BASE_PATH.'/views/'.$view.'.php');
    }
}
