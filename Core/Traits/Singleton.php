<?php

namespace Core\Traits;

trait Singleton
{
    protected static $instance;

    public static function getInstance()
    {
        $class = method_exists(self::class, 'single') ? self::single() : self::class;

        if (is_null(self::$instance)) {
            self::$instance = new $class;
        }
        return self::$instance;
    }
}
