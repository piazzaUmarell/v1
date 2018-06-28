<?php

namespace Core\Router;

use Core\Request;
use Core\Components\Collection;

class RouteCollection extends Collection
{
    public function match(Request $request)
    {
        foreach ($this as $route) {
            if (!$route instanceof Route) {
                continue;
            }

            if ($route->matches($request->getUri())) {
                return $route;
            }
        }

        return null;
    }
}
