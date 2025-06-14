<?php
namespace App\Core;

use App\Core\Request;
use App\Core\Response;

class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback): void {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? null;

        if (!$callback) {
            $this->response->setStatusCode(404);
            return "404 Not Found";
        }

        if (is_string($callback)) {
            return $this->response->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            $action = $callback[1];
            return call_user_func([$controller, $action]);
        }

        if ($callback instanceof \Closure) {
            return call_user_func($callback);
        }

        return "Method not allowed";
    }
}