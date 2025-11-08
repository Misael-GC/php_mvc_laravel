<?php

require BASE_PATH . '/app/Controllers/AboutController.php';
require BASE_PATH . '/app/Controllers/HomeController.php';
require BASE_PATH . '/app/Controllers/PostController.php';
require BASE_PATH . '/app/Controllers/LinksControllers.php';


$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post', [PostController::class, 'show']);
$router->get('/links', [LinksControllers::class, 'index']);
$router->get('/links/create', [LinksControllers::class, 'create']);
$router->post('/links/store', [LinksControllers::class, 'store']);