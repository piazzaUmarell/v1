<?php

namespace Core\Facade;

use Core\Request;
use Core\Traits\Singleton;
use Core\Router as SingleRouter;

class Router
{
    use Singleton;

    protected static function single()
    {
        return SingleRouter::class;
    }

    public static function init()
    {
        require 'routes.php';
    }

    public static function get(string $definition, string $action)
    {
        return self::getInstance()->define($definition, $action, Request::GET);
    }

    public static function dispatch(Request $request)
    {
        self::getInstance()->dispatch($request);
    }

    public static function debug()
    {
        var_dump(self::getInstance());
    }
}
