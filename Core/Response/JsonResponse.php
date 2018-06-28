<?php

namespace Core\Response;

use Core\Components\Response;

class JsonResponse extends Response
{
    public function __toString()
    {
        header('Content-Type: application/json');
        return json_encode($this->content);
    }
}
