<?php

namespace Core\Components;

abstract class Response
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    abstract public function __toString();
}
