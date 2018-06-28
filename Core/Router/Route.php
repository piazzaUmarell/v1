<?php

namespace Core\Router;

class Route
{
    protected $name;
    protected $definition;
    protected $action;

    public function __construct(string $definition, string $action, string $method, string $name = null)
    {
        $this->name = $name;
        $this->definition = self::prepareDefinition($definition);
        $this->action = $action;
        $this->method = $method;
    }

    protected static function prepareDefinition(string $definition)
    {
        $trimmed = trim($definition, '/');
        return !empty($trimmed) ? ('/' . preg_quote($trimmed, '/') . '/') : '';
    }

    public function name(string $name)
    {
        $this->name = $name;
    }

    public function matches(string $uri)
    {
        return (empty($this->definition) && $uri == $this->definition) || (!empty($this->definition) && preg_match(
            $this->definition,
            $uri
        ));
    }

    public function getAction()
    {
        return $this->action;
    }

    public function dispatch()
    {
        list($controller, $action) = explode('@', $this->action);
        $controller = "Controller\\$controller";
    }
}
