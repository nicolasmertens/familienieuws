<?php

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

//general
define('DEBUG','1');
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR); //root as path
define('ROOT_URL', $protocol.$_SERVER['HTTP_HOST'].'/'); //root as url

//Facebook API
define('FB_APP_ID','249404298556640');
define('FB_APP_SECRET', 'f52086f4a132e0169f611e3351447dd4');
define('FB_SCOPE', 'email,user_photos');
define('FB_REDIRECT', ROOT_URL . 'backend/socialdata/');


if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}else{
    error_reporting(0);
    ini_set('display_errors', '0');
}