<?php
namespace hive2\router;

use hive2\router\RouterStorage;
use hive2\router\Request;

/**
 *
 */
class Router
{
    private $routes = [];

    public function get($path, $controllerName)
    {
        $this->routes['GET'][$path] = $controllerName;
    }

    public function post($path, $controllerName)
    {
        $this->routes['POST'][$path] = $controllerName;
    }

    public function current($request)
    {
            $controllerName = $this->routes[$request->method][$request->controller];
            $controller = ControllersStorage::get($controllerName);
            $response = $controller->{$request->controllerMethod}($request->controllerArg);
            return $response;
    }
}
