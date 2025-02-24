<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Router;

$router = new Router();

// registers a route for /
// uses HomeController and executes index() method
$router->get('/', HomeController::class, 'index');
$router->get('/login', LoginController::class, 'index');



$router->dispatch();


?>