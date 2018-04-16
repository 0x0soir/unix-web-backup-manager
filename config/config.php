<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

define('config_public_urls', array(
        '/users/index',
        '/users/login',
    )
);

define('DEFAULT_URL', "/".BASE_CONTROLLER."/".BASE_ACTION);

// PHP_OS values = [CYGWIN_NT-5.1, Darwin, FreeBSD, HP-UX, IRIX64, Linux, NetBSD, OpenBSD, SunOS, Unix, WIN32, WINNT, Windows]
define('ALLOWED_OPERATING_SYSTEM', array('Linux'));
