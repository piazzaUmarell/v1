<?php

namespace Core\Components;

use ArrayIterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{
    protected $collection;

    public function __construct($collection = null)
    {
        $this->collection = [];
        $this->add($collection);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->collection);
    }

    public function add($collection)
    {
        if (!is_iterable($collection)) {
            $collection = $collection ? [$collection] : [];
        }

        foreach ($collection as $value) {
            $this->collection[] = $value;
        }
    }

    public function toArray()
    {
        return $this->collection;
    }
}
