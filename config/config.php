<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

require(BASE_PATH.'secrets.php');

define('config_public_urls', array(
        '/users/index',
        '/users/login',
        '/users/register',
        '/users/register_data',
    )
);

define('DEFAULT_URL', "/".BASE_CONTROLLER."/".BASE_ACTION);

define('WEBSITE_HOST', 'http://localhost/');

// PHP_OS values = [CYGWIN_NT-5.1, Darwin, FreeBSD, HP-UX, IRIX64, Linux, NetBSD, OpenBSD, SunOS, Unix, WIN32, WINNT, Windows]
define('ALLOWED_OPERATING_SYSTEM', array('Linux'));

define('BASE_DIRECTORY_NEW_SCRIPT', '/home');

define('DIRECTORY_TARGET_BACKUPS', '/home/soir/Documentos/comprimidos');
