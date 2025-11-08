<?php
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/bootstrap.php';

use Framework\Router;


$route = new Router();
$route->run();