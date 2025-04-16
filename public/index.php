<?php
// Load core files
require_once '../core/Router.php';
require_once '../core/Controller.php';
require_once '../config/config.php';

// Get URL from the browser (e.g., /home/index)
$url = $_GET['url'] ?? 'home/index';
echo $_GET['url']; // Add this to check the value

// Initialize and run the router
$router = new Router($url);
$router->dispatch();
