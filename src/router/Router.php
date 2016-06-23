<?php
namespace hive2\router;

use hive2\router\RouterStorage;
use hive2\router\Request;

/**
 *  Keep routs and handle current rout
 */
class Router
{
    private $routes = [];

    /**
     * Keep rout via GET http method
     *
     * @param     string $path
     * @param     string $controllerName
     * @return    void
     */
    public function get($path, $controllerName)
    {
        $this->routes['GET'][$path] = $controllerName;
    }

    /**
     * Keep rout via POST http method
     *
     * @param     string $path
     * @param     string $controllerName
     * @return    void
     */
    public function post($path, $controllerName)
    {
        $this->routes['POST'][$path] = $controllerName;
    }

    /**
     * Handles current rout
     *
     * @param
     * @return    void
     * @author
     * @copyright
     */
    public function current($request)
    {
            $controllerName = $this->routes[$request->method][$request->controller];
            $controller = ControllersStorage::get($controllerName);
            $response = $controller->{$request->controllerMethod}($request->controllerArg);
            return $response;
    }
}
