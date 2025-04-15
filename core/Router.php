<?php
class Router {
    protected $url;
    protected $controllerName = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct($url) {
        // Remove the /public from the URL
        $this->parseUrl(str_replace('/public', '', $url));
    }

    protected function parseUrl($url) {
        $this->url = explode('/', trim($url, '/'));

        // Default controller is HomeController
        if (!empty($this->url[0])) {
            $this->controllerName = ucfirst($this->url[0]) . 'Controller';
        }

        // Default method is 'index'
        if (!empty($this->url[1])) {
            $this->method = $this->url[1];
        }

        // Any additional parameters
        if (count($this->url) > 2) {
            $this->params = array_slice($this->url, 2);
        }
    }

    public function dispatch() {
        $controllerFile = "../app/controllers/{$this->controllerName}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($this->controllerName)) {
                $controller = new $this->controllerName();

                if (method_exists($controller, $this->method)) {
                    call_user_func_array([$controller, $this->method], $this->params);
                } else {
                    echo "⚠️ Method '{$this->method}' not found in {$this->controllerName}.";
                }
            } else {
                echo "⚠️ Class '{$this->controllerName}' not found inside file.";
            }
        } else {
            echo "⚠️ Controller file '{$this->controllerName}.php' not found in /app/controllers.";
        }
    }
}
