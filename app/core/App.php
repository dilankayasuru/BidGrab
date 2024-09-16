<?php
require_once "FileHandler.php";
class App
{
    protected $controller = 'ProductController';
    protected $method = 'index';
    protected array $params = [];

    public function __construct()
    {
        $urlParts = $this->parseUrl();

        require_once '../app/routes.php';

        if (isset($urlParts[0])) {
            $route = $urlParts[0];
        }

        if (isset($urlParts[1])) {
            $route = $route . '/' . $urlParts[1];
        }

        if (isset($routes[$route])) {
            $this->controller = $routes[$route]['controller'];
            $this->method = $routes[$route]['method'];
        } else {
            $this->controller = "PageNotFound";
            $this->method = "index";
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $parts = explode('?', $uri);

        if (isset($parts[1])) {
            parse_str($parts[1], $args);
            $this->params = $args;
        } else {
            $this->params = [];
        }

        $url = explode('/', filter_var(rtrim((substr($parts[0], 1)), FILTER_SANITIZE_URL)));

        return array_slice($url, 2);
    }
}