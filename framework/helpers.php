<?php

use Framework\Database;

if(!function_exists('root_path')) {
    function root_path(string $path): string
    {
        return dirname(__DIR__) . '/' . normalize_path($path);
    }
}

if (!function_exists('normalize_path')) {
    function normalize_path(string $path): string
    {
        return trim($path, '/\\');
    }
}

if (!function_exists('view')) {
    function view(string $view, array $data = [])
    {
        extract($data);

        require root_path('resources/' . $view);
    }
}

if(!function_exists('old')){
    function old(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }
}

if(!function_exists('requestIs')){
    function requestIs(string $uri): bool
    {
        return $_SERVER['REQUEST_URI'] === '/' . normalize_path($uri);
    }

    if(!function_exists('config')){
        function config(string $key, mixed $default = null): mixed
        {
            $config = require root_path('config/app.php');
            return $config[$key] ?? $default;
        }
    }
}

if(!function_exists('redirect')){
    function redirect(string $url){
        header('Location: ' . $url);
        exit;
    }
}

if(!function_exists('db')){
    function db(){
        return Database::getInstance();

    }
}

if(!function_exists('partials')){
    function partials(string $partial)
    {
        require root_path('resources/partials/' . $partial);
    }
}