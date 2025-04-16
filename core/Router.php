<?php
class Router {
    protected $controllerName = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct($url) {
        $this->parseUrl($url);
    }

    protected function parseUrl($url) {
        // Remove the '/public' part from the URL
        $path = parse_url($url, PHP_URL_PATH);
        $path = str_replace('/public', '', $path);  // Clean out '/public' part if it's present

        // Split the URL path into segments
        $parts = explode('/', trim($path, '/'));

        // Default controller is HomeController
        if (!empty($parts[0])) {
            $this->controllerName = ucfirst($parts[0]) . 'Controller';
        }

        // Default method is index, but check if a valid method is present
        if (!empty($parts[1])) {
            $this->method = $parts[1];
        }

        // Any additional parameters
        if (count($parts) > 2) {
            $this->params = array_slice($parts, 2);
        }
    }

    public function dispatch() {
        // Construct the file path for the controller
        $controllerFile = "../app/controllers/{$this->controllerName}.php";

        // Check if the controller file exists
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($this->controllerName)) {
                $controller = new $this->controllerName();

                // Check if the method exists in the controller
                if (method_exists($controller, $this->method)) {
                    // Call the method and pass the parameters
                    call_user_func_array([$controller, $this->method], $this->params);
                } else {
                    echo "⚠️ Method '{$this->method}' not found in {$this->controllerName}.";
                }
            } else {
                echo "⚠️ Class '{$this->controllerName}' not found.";
            }
        } else {
            echo "⚠️ Controller file '{$this->controllerName}.php' not found.";
        }
    }
}
