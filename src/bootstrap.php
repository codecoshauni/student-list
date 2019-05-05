<?php

use Students\Model\{StudentValidator, StudentsDataGateway};

$container = new Students\DIContainer();

$container->register('dbconfig', function (Students\DIContainer $container) {
    $path = __DIR__ . '/' . 'dbconfig.ini';
    if (file_exists($path)) {
        return parse_ini_file(__DIR__ . '/' . 'dbconfig.ini');
    } else {
        throw new Students\UserExceptions\FileExistException("{$path} does not exist");
    }
});

$container->register('PDO', function (Students\DIContainer $container) {
    $config = $container->get('dbconfig');

    $host = $config['host'];
    $db = $config['database'];
    $user = $config['user'];
    $pass = $config['password'];
    $charset = $config['charset'];

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo;
});

$container->register('studentsDataGateway', function (Students\DIContainer $container) {
    $pdo = $container->get('PDO');
    $studentsDataGateway = new StudentsDataGateway($pdo);
    return $studentsDataGateway;
});

$container->register('validator', function (Students\DIContainer $container) {
    $studentsDataGateway = $container->get('studentsDataGateway');
    $validator = new StudentValidator($studentsDataGateway);
    return $validator;
});