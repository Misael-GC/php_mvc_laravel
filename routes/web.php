<?php

require BASE_PATH . '/app/Controllers/AboutController.php';
require BASE_PATH . '/app/Controllers/HomeController.php';
require BASE_PATH . '/app/Controllers/PostController.php';
require BASE_PATH . '/app/Controllers/LinksControllers.php';


$route->get('/', [HomeController::class, 'index']);
$route->get('/about', [AboutController::class, 'index']);
$route->get('/post', [PostController::class, 'show']);
$route->get('/links', [LinksControllers::class, 'index']);
$route->get('/links/create', [LinksControllers::class, 'create']);
$route->post('/links', [LinksControllers::class, 'store']);