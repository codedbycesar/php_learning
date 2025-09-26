<?php

// Enable error reporting for debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

const BASE_PATH = __DIR__ . '/../';

// echo "Debug: BASE_PATH = " . BASE_PATH . "<br>";

require BASE_PATH . 'Core/functions.php';
// echo "Debug: functions.php loaded<br>";

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    // echo "Debug: Loading class $class<br>";
    require base_path("{$class}.php");
});

// echo "Debug: About to require bootstrap<br>";
require base_path('bootstrap.php');
// echo "Debug: Bootstrap loaded<br>";

$router = new \Core\Router();
// echo "Debug: Router created<br>";

$routes = require base_path('routes.php');
// echo "Debug: Routes loaded<br>";

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// echo "Debug: URI = $uri, Method = $method<br>";

$router->route($uri, $method);
// echo "Debug: Router finished<br>";