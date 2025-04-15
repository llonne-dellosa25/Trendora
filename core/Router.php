<?php
class Router {
    protected $url;

    public function __construct($url) {
        $this->url = explode('/', trim($url, '/'));
    }

    public function dispatch() {
        $controllerName = ucfirst($this->url[0]) . 'Controller';
        $method = $this->url[1] ?? 'index';
        $params = array_slice($this->url, 2);

        $controllerFile = "../app/controllers/$controllerName.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                echo "⚠️ Method '$method' not found.";
            }
        } else {
            echo "⚠️ Controller '$controllerName' not found.";
        }
    }
}
