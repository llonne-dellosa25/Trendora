<?php
// app/controllers/DashboardController.php

class DashboardController {
    public function index() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Display the dashboard content
            require_once '../app/views/dashboard.php'; // Your dashboard view file
        } else {
            // If the user is not logged in, redirect to login
            header("Location: /Trendora/public/login");
            exit();
        }
    }
}
