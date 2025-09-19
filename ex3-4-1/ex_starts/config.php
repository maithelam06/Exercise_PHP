<?php
// khai báo data
const _HOST   = 'localhost';
const _DB     = 'baitap4';
const _USER   = 'root';
const _PASS   = '';
const _DRIVER = 'mysql';

// debug error
const _DEBUG = true;

// thiết lập host
define('_HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/baitap4');
define('_HOST_URL_TEMPLATES', _HOST_URL . '/templates');

// thiết lập path
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', _PATH_URL . '/templates');
?>
