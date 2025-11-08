<?php

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\PostController;
use App\Controllers\LinksControllers;


$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post', [PostController::class, 'show']);
$router->get('/links', [LinksControllers::class, 'index']);
$router->get('/links/create', [LinksControllers::class, 'create']);
$router->post('/links/store', [LinksControllers::class, 'store']);
$router->get('/links/edit', [LinksControllers::class, 'edit']);// mandar a llamar el formulario de edicion
$router->put('/links/update', [LinksControllers::class, 'update']);// actualizar el link
$router->delete('/links/delete', [LinksControllers::class, 'delete']);