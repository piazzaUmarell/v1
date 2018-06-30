<?php

namespace Core;

use ReflectionClass;
use Core\Components\Collection;
use Core\Controller\Exceptions\InvalidActionException;

abstract class Controller
{
    protected $view;

    protected function __construct()
    {
        $this->view = TemplateEngine::getInstance();
    }

    public static function act(string $action, Collection $parameters)
    {
        $class = static::class;
        if (!method_exists($class, $action)) {
            throw new InvalidActionException("$action isn't a valid action for {$class}");
        }
        $controller = new static;
        $controller->preDispatch();
        $result = call_user_func_array(
            [$controller, $action],
            $parameters->toArray()
        );
        $controller->render($action, $result);
        $controller->postDispatch();
    }

    public function preDispatch()
    {
    }

    public function postDispatch()
    {
        $this->view->clearData();
    }

    public function renderDefault($action)
    {
        $this->view->render();
    }

    public function render($action, $result)
    {
        if (!$result) {
            return $this->view->render(
                $this->getTemplate($action)
            );
        }
        echo $result;
        return;
    }

    protected function getTemplate($action)
    {
        $reflected = new ReflectionClass(static::class);
        $folderName = strtolower(str_replace('Controller', '', $reflected->getShortName()));
        return "templates/$folderName/$action.html.twig";
    }
}
