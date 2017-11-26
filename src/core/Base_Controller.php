<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Base_Controller {

    function __construct()
    {
        $this->load = & load_class('Loader', 'core');
    }

}
