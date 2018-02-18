<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

define('config_public_urls', array(
        '/users/index',
        '/users/login',
    )
);

define('DEFAULT_URL', "/".BASE_CONTROLLER."/".BASE_ACTION);
