<?php

namespace Core;

use Core\Router\Route;
use Core\Router\RouteCollection;
use Core\Router\Exceptions\InvalidRouteException;

class Router
{
    protected $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection;
    }

    public function define(string $definition, string $action, string $method)
    {
        $route = new Route($definition, $action, $method);
        $this->routes->add($route);
        return $route;
    }

    public function dispatch(Request $request)
    {
        $route = $this->routes->match($request);
        if (is_null($route)) {
            throw new InvalidRouteException("/{$request->getUri()} is not a valid Uri");
        }
        Dispatcher::dispatch($route);
    }
}
