<?php

namespace ofernandoavila\challenges\core;

class Routes {
    public array $routes = [];

    public function __construct()
    {
        
    }

    public function AddRoute(string $path, mixed $callback) {
        $route['path'] = $path;
        $route['function'] = $callback;
        
        array_push($this->routes, $route);
    }

    public function GetRoutes() {
        return $this->routes;
    }
}