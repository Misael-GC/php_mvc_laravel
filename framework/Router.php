<?php

namespace Framework;

class Router
{
    protected $routes = [];

    public function __construct(){
        $this->loadRoutes('web');
    }

    public function get(string $uri, array $action, string|null $middleware = null){
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function post(string $uri, array $action, string|null $middleware = null){
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function put(string $uri, array $action, string|null $middleware = null){
        $this->routes['PUT'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }
    public function delete(string $uri, array $action, string|null $middleware = null){
        $this->routes['DELETE'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }
        public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //GET, POST, DELETE, PUT
        $action = $this->routes[$method][$uri]['action'] ?? null;

        // echo "<pre>";
        // var_dump($this->routes);
        // echo "</pre>";
        // die();

        if(!$action){
            exit('Route Not Found: ' . $method . ' ' . $uri);
        }

        //middlere: entre el sistema del usuario y el sistema controller
        $middleware = $this->routes[$method][$uri]['middleware'] ?? null;

        if($middleware){
            // (new $middleware())();
            $middleware = new $middleware();
            $middleware();
        }

        [$controller, $method] = $action;

        (new $controller())->$method();
    }

    protected function loadRoutes(string $file){
        $router = $this;
        require BASE_PATH . "/routes/{$file}.php";
    }
}
