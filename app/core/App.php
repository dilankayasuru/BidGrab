<?php
require_once "FileHandler.php";

class App
{
    // Default controller and method
    protected $controller = 'ProductController';
    protected $method = 'index';
    protected array $params = [];

    public function __construct()
    {
        // Run the script based on the OS
        $this->runScript();

        // Parse the URL to get the controller and method
        $urlParts = $this->parseUrl();

        // Include the routes configuration
        require_once '../app/routes.php';

        // Determine the route from the URL parts
        if (isset($urlParts[0])) {
            $route = $urlParts[0];
        }

        if (isset($urlParts[1])) {
            $route = $route . '/' . $urlParts[1];
        }

        // Check if the route exists in the routes configuration
        if (isset($routes[$route])) {
            $this->controller = $routes[$route]['controller'];
            $this->method = $routes[$route]['method'];
        } else {
            // Default to PageNotFound controller if route is not found
            $this->controller = "PageNotFound";
            $this->method = "index";
        }

        // Include the controller file
        require_once '../app/controllers/' . $this->controller . '.php';

        // Instantiate the controller
        $this->controller = new $this->controller;

        // Call the method with the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        // Get the request URI
        $uri = $_SERVER['REQUEST_URI'];

        // Split the URI by the query string
        $parts = explode('?', $uri);

        // Parse the query string into parameters
        if (isset($parts[1])) {
            parse_str($parts[1], $args);
            $this->params = $args;
        } else {
            $this->params = [];
        }

        // Split the URI path into parts and sanitize
        $url = explode('/', filter_var(rtrim((substr($parts[0], 1)), FILTER_SANITIZE_URL)));

        // Return the URL parts, skipping the first two segments
        return array_slice($url, 2);
    }

    private function runScript()
    {
        // Get the operating system
        $os = PHP_OS;

        // Define the script and log file paths
        $scriptFile = SCRIPT_FILE;
        $logFile = LOG_FILE;

        // Run the script based on the OS
        if (stripos($os, 'WIN') === 0) {
            // Windows OS
            $command = "start /B $scriptFile > $logFile 2>&1";
            exec($command);
        } else {
            // Linux
            exec("php $scriptFile > /dev/null 2>&1 &");
        }
    }
}