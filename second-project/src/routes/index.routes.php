<?php

use App\Classes\HomeController;
use App\Classes\AuthController;
use App\Router;

$router = new Router();

// registers a route for /
// uses HomeController and executes index() method
$router->get('/', HomeController::class, 'index');
$router->get('/auth', AuthController::class, 'index');
$router->post('/login', AuthController::class, 'login');
$router->post('/signup', AuthController::class, 'signup');



$router->dispatch();


?>