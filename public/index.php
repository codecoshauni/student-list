<?php

require_once('../src/autoloader.php');
spl_autoload_register('autoloader');

set_exception_handler(function ($exception) {
    error_log($exception->__toString());
    header("HTTP/1.0 503 Service Unavailable");
    include_once('../templates/error.php');
    die();
});

require_once('../src/bootstrap.php');

$router = new Students\Routs\Router($container);
$router->run();