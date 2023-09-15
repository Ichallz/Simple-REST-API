<?php
$isLocalhost = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1') || ($_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1');
//
if (!defined('ENVIRONMENT')) define('ENVIRONMENT', $isLocalhost ? 'dev' : 'prod');

if(ENVIRONMENT=='prod'){
    define('DB_HOST','containers-us-west-116.railway.app');
    define('DB_NAME','railway');
    define('DB_USER','root');
    define('DB_PW','Z4DhUxMHvcmlSxVcHLf0');
    define('DB_PORT','7966');
}else{
    define('DB_HOST','localhost');
    define('DB_NAME','hng.users');
    define('DB_USER','root');
    define('DB_PW','');
    define('DB_PORT','3306');
}
?>