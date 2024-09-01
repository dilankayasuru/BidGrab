<?php

class App
{
    private $route;
    private $controller;
    private $method;
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $routes = require_once "../app/routes.php";

        if (isset($url[0])) {
            $this->route = $url[0];
        }

        if (isset($url[1])) {
            $this->route = "$url[0]/$url[1]";
        }

        if (isset($routes[$this->route])) {
            $this->controller = $routes[$this->route]['controller'];
            $this->method = $routes[$this->route]['method'];
        }
        else {
            $this->controller = 'PageNotFound';
            $this->method = 'index';
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            // Trim and sanitize url
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [''];
    }

}