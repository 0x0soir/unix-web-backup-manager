<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

define('config_public_urls', array(
        '/users/index',
        '/users/login',
    )
);

define('login_success_url', "/".BASE_CONTROLLER."/".BASE_ACTION);
