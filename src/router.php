<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/contact' => 'controllers/contact.php',
    '/notes' => 'controllers/notes.php',
    '/note' => 'controllers/note.php'
    // '/notes' => 'controllers/notes/index.php',
    // '/note' => 'controllers/notes/show.php',
    // '/notes/create' => 'controllers/notes/create.php',
];

function abort($code = 404){

    http_response_code($code);

    require "views/{$code}.php";

}

function routeToController($uri, $routes){
    if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
    } else {
        abort();
    }
}

routeToController($uri, $routes);