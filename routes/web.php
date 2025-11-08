<?php

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\PostController;
use App\Controllers\LinksControllers;
use Framework\Middleware\Authenticated;
use App\Controllers\AuthController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post', [PostController::class, 'show']);
//necesitas autenticación
$router->get('/links', [LinksControllers::class, 'index']);
$router->get('/links/create', [LinksControllers::class, 'create'], Authenticated::class);
$router->post('/links/store', [LinksControllers::class, 'store'], Authenticated::class);
$router->get('/links/edit', [LinksControllers::class, 'edit'], Authenticated::class);// mandar a llamar el formulario de edicion
$router->put('/links/update', [LinksControllers::class, 'update'], Authenticated::class);// actualizar el link
$router->delete('/links/delete', [LinksControllers::class, 'delete'], Authenticated::class);

$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);
$router->post('/logout', [AuthController::class, 'logout'], Authenticated::class);