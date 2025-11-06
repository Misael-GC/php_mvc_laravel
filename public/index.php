<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


define('BASE_PATH', dirname(__DIR__));
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/'); 
if ($requestUri === '') $requestUri = '/';

$routes = require BASE_PATH . '/routes/web.php';

$route = $routes[$requestUri] ?? null;

if ($route) {
    require BASE_PATH . '/' . $route;
} else {
    http_response_code(404);
    echo '404 Not Found';
}
