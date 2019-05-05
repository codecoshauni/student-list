<?php

function autoloader($class) {
    $class = str_replace('Students\\', '', $class);
    $classPath =  __DIR__ . "/" . str_replace('\\', '/', $class) . '.php';

    if (file_exists($classPath)) {
        require_once($classPath);
    }
}