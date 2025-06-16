<?php
require __DIR__ . '/../app/bootstrap.php';

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

$router = new Router(new Request(), new Response());

$router->get('/', [AuthController::class, 'registerForm']);
$router->post('/', [AuthController::class, 'register']);

echo $router->resolve();