<?php

namespace ofernandoavila\Community\Core;

class Router {
    private Array $routes = [];

    private function AddRoute($method, $path, $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'function' => $callback
        ];
    }

    public function GetRoutes() {
        return $this->routes;
    }

    public function get($path, $callback) {
        $this->AddRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->AddRoute('POST', $path, $callback);
    }

    public function put($path, $callback) {
        $this->AddRoute('PUT', $path, $callback);
    }

    public function delete($path, $callback) {
        $this->AddRoute('DELETE', $path, $callback);
    }
}