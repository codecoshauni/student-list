<?php

if (file_exists(__DIR__ . '/' . 'dbconfig.ini')) {
    $config = parse_ini_file(__DIR__ . '/' . 'dbconfig.ini');

} else {
    throw new Exception('Database config file missing');
}

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

$dataGateway = new \model\StudentDataGateway($pdo);
$validator = new \model\StudentValidator();