<?php

define('ROOT_PATH', dirname(__DIR__));
define('UPLOAD_JURNAL_PATH', ROOT_PATH . '/uploads/jurnal/');
define('UPLOAD_JURNAL_URL', 'uploads/jurnal/');
define('APP_LOGO', 'assets/img/logo-unpatti.png');

require_once ROOT_PATH . '/config/database.php';
require_once ROOT_PATH . '/config/helpers.php';
require_once ROOT_PATH . '/config/pagination.php';
require_once ROOT_PATH . '/config/auth.php';

mulai_sesi();
