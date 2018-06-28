<?php

namespace Core;

class Request
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    protected $uri;

    public function __construct()
    {
        $this->uri = trim($_SERVER['REQUEST_URI'], '/');
    }

    public static function init()
    {
        return new self;
    }

    public function getUri()
    {
        return $this->uri;
    }
}
