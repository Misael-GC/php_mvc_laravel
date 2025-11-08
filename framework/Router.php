<?php

class Router
{
    protected $routes = [];

    public function __construct(){
        $this->loadRoutes('web');
    }

    public function get(string $uri, array $action){
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, array $action){
        $this->routes['POST'][$uri] = $action;
    }
        public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // $uri = rtrim($uri, '/');
        // $uri = $uri === '' ? '/' : $uri;
        $method = $_SERVER['REQUEST_METHOD'];
        $action = $this->routes[$method][$uri] ?? null;

        /*
         */
        // echo "<pre>";
        // var_dump($this->routes);
        // echo "</pre>";
        // die();

        if(!$action){
            exit('Route Not Found: ' . $method . ' ' . $uri);
        }

        [$controller, $method] = $action;

        (new $controller())->$method();
    }

    protected function loadRoutes(string $file){
        $router = $this;
        require BASE_PATH . "/routes/{$file}.php";
    }
}
