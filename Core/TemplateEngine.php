<?php

namespace Core;

use Twig\Environment;
use Core\Traits\Singleton;
use Twig\Loader\FilesystemLoader;

class TemplateEngine
{
    use Singleton;

    protected $data;

    protected function __construct()
    {
        $this->engine = new Environment(
            new FilesystemLoader(__DIR__ . '/../Views/')
        );
        $this->data = [];
    }

    public function render($templateFile, $data = [])
    {
        $data = !empty($this->data) ? $this->data : $data;
        echo $this->engine->render($templateFile, $data);
    }

    public function clearData()
    {
        $this->data = [];
    }
}
