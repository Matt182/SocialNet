<?php
namespace hive2\router;

use function hive2\auth\isAuthorized;
/**
 *  Handle request
 */
class Request
{
    public $method;
    public $post;
    public $getParams;
    public $uri;
    public $controllerArg;
    public $controllerMethod;
    public $controller;

    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $parameters = parse_url($this->uri);
        if (!empty($parameters['query'])) {
            parse_str($parameters['query'], $query);
            $this->getParams = $query;
        }
        $this->uri = ltrim(rtrim($parameters['path'], '/'), '/');
        $this->post = $_POST;
        $temparr = explode('/', $this->uri);

        if(isAuthorized()) {
            if (empty($temparr[0]) || $temparr[0] == 'login') {
                $this->controller = 'profile';
            } else {
                $this->controller = $temparr[0];
            }
        } else {
            if (empty($temparr[0]) || $temparr[0] == 'profile') {
                $this->controller = 'login';
            } else {
                $this->controller = $temparr[0];
            }
        }

        if(empty($temparr[1])) {
            $this->controllerMethod = 'index';
            $this->controllerArg = empty($temparr[2]) ? '' : $temparr[2];
        } elseif(is_numeric($temparr[1])) {
            $this->controllerMethod = 'index';
            $this->controllerArg = $temparr[1];
        } else {
            $this->controllerMethod = $temparr[1];
            $this->controllerArg = empty($temparr[2]) ? '' : $temparr[2];
        }
    }
}
