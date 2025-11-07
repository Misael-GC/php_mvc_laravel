<?php
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/framework/Database.php';
require BASE_PATH . '/framework/Validator.php';
require BASE_PATH . '/framework/Router.php';

$db = Database::getInstance();

$route = new Router();
$route->run();