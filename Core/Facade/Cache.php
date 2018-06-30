<?php

namespace Core\Facade;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache
{
    public static function get(string $label, $default = null)
    {
        $cache = new FilesystemAdapter();

        $item = $cache->getItem($label);
        if (!$item->isHit()) {
            if (is_callable($default)) {
                $default = $default();
            }
            $item->set($default);
            $cache->save($item);
        }
        return $item->get();
    }

    public static function set(string $label, $value)
    {
        $cache = new FilesystemAdapter();
        $item = $cache->getItem($label);
        $item->set($value);
        $cache->save($item);
        return $item->get();
    }

    public static function clear()
    {
        $cache = new FilesystemAdapter();
        $cache->clear();
    }
}
