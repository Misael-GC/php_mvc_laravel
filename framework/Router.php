<?php

class Router
{
    public function run()
    {
        echo "Running the router...";
    //     define('BASE_PATH', dirname(__DIR__));
    //     $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //     // var_dump($requestUri);
    //     $requestUri = rtrim($requestUri, '/');

    //     // die();

    //     if ($requestUri === '') $requestUri = '/';

    //     $routes = require BASE_PATH . '/routes/web.php';

    //     $route = $routes[$requestUri] ?? null;

    //     if ($route) {
    //         require BASE_PATH . '/' . $route;
    //     } else {
    //         http_response_code(404);
    //         echo '404 Not Found';
    //     }
    }
}
