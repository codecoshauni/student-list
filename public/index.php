<?php

require_once('../src/autoloader.php');
spl_autoload_register('autoloader');

require_once('../src/bootstrap.php');

$router = new Router();
$router->run();