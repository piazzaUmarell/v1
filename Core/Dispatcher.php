<?php

namespace Core;

use Core\Router\Route;

class Dispatcher
{
    private function __construct()
    {
    }

    public static function dispatch(Route $route)
    {
        list($controller, $action) = explode('@', $route->getAction());
        $controller = "Controller\\$controller";
        $controller::act($action, $route->getParams());
    }
}
