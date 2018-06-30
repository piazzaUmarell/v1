<?php

namespace Core\Router;

use Core\Components\Collection;

class Route
{
    protected $name;
    protected $definition;
    protected $action;
    protected $parameters;
    protected $parametersOrder;

    public function __construct(string $definition, string $action, string $method, string $name = null)
    {
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
        $this->prepareDefinition($definition);
        $this->parameters = new Collection();
        $this->parametersOrder = [];
    }

    protected function prepareDefinition(string $definition)
    {
        $trimmed = trim($definition, '/');
        $placeholders = [];
        if (preg_match('/{(.*)}/', $trimmed, $placeholders)) {
            $trimmed = preg_replace('/({.*})/', '%REPLACE_ME%', $trimmed);
            $this->prepareParameters($placeholders);
        }
        $trimmed = preg_quote($trimmed, '/');
        if (preg_match('/(\%REPLACE_ME\%)/', $trimmed)) {
            $trimmed = preg_replace('/(\%REPLACE_ME\%)/', '(.*)', $trimmed);
        }
        $this->definition = !empty($trimmed) ? ('/^' . $trimmed . '$/') : '';
    }

    protected function prepareParameters(array $params)
    {
        $this->parameters = new Collection();
        $index = 0;
        foreach (array_slice($params, 1) as $param) {
            $this->parametersOrder[$index++] = $param;
        }
    }

    public function name(string $name)
    {
        $this->name = $name;
    }

    public function matches(string $uri)
    {
        $params = [];
        $matches = (empty($this->definition) && $uri == $this->definition) || (!empty($this->definition) && preg_match(
            $this->definition,
            $uri,
            $params
        ));

        $params = array_slice($params, 1);

        if ($matches) {
            foreach ($params as $param) {
                $this->parameters->add(
                    $param,
                    $this->getNextParameter()
                );
            }
        }

        return $matches;
    }

    protected function getNextParameter()
    {
        return array_shift($this->parametersOrder);
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->parameters;
    }

    public function dispatch()
    {
        list($controller, $action) = explode('@', $this->action);
        $controller = "Controller\\$controller";
    }
}
