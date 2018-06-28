<?php

namespace Core;

use Core\Facade\Router;

class Core
{
    protected function __construct()
    {
    }

    public static function init()
    {
        Router::init();
        Router::dispatch(
            Request::init()
        );
    }
}
