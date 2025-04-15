<?php
class HomeController {
    public function index() {
        require_once '../app/views/home.php';
    }

    public function login() {
        require_once '../app/views/login.php';
    }

    public function signup() {
        require_once '../app/views/signup.php';
    }

    public function checkout() {
        require_once '../app/views/checkout.php';
    }
}
