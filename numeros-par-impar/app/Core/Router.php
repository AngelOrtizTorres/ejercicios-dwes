<?php

namespace App\Core;

class Router {
    private $routes = array();

    public function add($route) {
        $this->routes[] = $route;
    }

    public function match(string $request) {
        $matches = array();
        foreach ($this->routes as $route) {
            if (preg_match($route['path'], $request, $matches)) {
                array_shift($matches); // eliminamos coincidencia completa
                $route['params'] = $matches; // guardamos los parámetros capturados
                return $route;
            }
        }
        return false;
    }
}