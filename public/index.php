<?php
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/bootstrap.php';

use Framework\Router;


$route = new Router();
$route->run();

// db()->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
//     'name' => 'Test User',
//     'email' => 'i@test.com',
//     'password' => password_hash('password', PASSWORD_DEFAULT)
// ]);