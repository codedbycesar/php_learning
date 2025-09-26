<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'mysql',
        'dbname' => $_ENV['DB_DATABASE'] ?? 'php_barebones', 
        'charset' => 'utf8mb4',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? ''
    ]
];

return [$config, $username, $password];