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

    public function add($collection, $label = null)
    {
        if (!is_iterable($collection)) {
            $collection = $label ? [$label => $collection] : ($collection ? [$collection] : []);
        }

        foreach ($collection as $key => $value) {
            if ($key) {
                $this->collection[$key] = $value;
            } else {
                $this->collection[] = $value;
            }
        }
    }

    public function toArray()
    {
        return $this->collection;
    }
}
