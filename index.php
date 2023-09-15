<?php
$isLocalhost = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1') || ($_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1');
//
if (!defined('ENVIRONMENT')) define('ENVIRONMENT', $isLocalhost ? 'dev' : 'prod');

echo ENVIRONMENT;
?>