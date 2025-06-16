<?php
require __DIR__ . '/../app/bootstrap.php';

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

$router = new Router(new Request(), new Response());

$router->get('/', [AuthController::class, 'loginForm']);
$router->post('/', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/home', [HomeController::class, 'index']);
$router->get('/dashboard', [DashboardController::class, 'index']);

echo $router->resolve();