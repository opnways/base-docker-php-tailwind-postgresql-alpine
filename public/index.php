<?php
require __DIR__ . '/../app/bootstrap.php';

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Controllers\HomeController;

$router = new Router(new Request(), new Response());

$router->get('/', [HomeController::class, 'index']);

echo $router->resolve();