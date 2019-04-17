<?php

$container = new DIContainer();

$container->register('dbconfig', function (DIContainer $container) {
    $path = __DIR__ . '/' . 'dbconfig.ini';
    if (file_exists($path)) {
        return parse_ini_file(__DIR__ . '/' . 'dbconfig.ini');
    } else {
        throw new FileExistException('{$path} does not exist');
    }
});

$container->register('PDO', function (DIContainer $container) {
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

$container->register('studentsDataGateway', function (DIContainer $container) {
    $pdo = $container->get('PDO');
    $studentsDataGateway = new \model\StudentsDataGateway($pdo);
    return $studentsDataGateway;
});

$container->register('validator', function (DIContainer $container) {
    $studentsDataGateway = $container->get('studentsDataGateway');
    $validator = new \model\StudentValidator($studentsDataGateway);
    return $validator;
});