<?php

require_once __DIR__ . '/site_config.php';

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_LOGIN', $_ENV['DB_LOGIN']);
define('DB_PWD', $_ENV['DB_PWD']);
define('DB_NAME', $_ENV['DB_NAME']);

//подключение к базе  
if (in_array('database', MODULES)) {
    $con = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
    if (!$con) { die('Ошибка подключения к базе данных! '.mysqli_error($con)); }

    mysqli_set_charset($con, 'utf8');
}
	
?>