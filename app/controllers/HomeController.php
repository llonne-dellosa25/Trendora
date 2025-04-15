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

    public function processLogin() {
        require_once '../app/models/User.php';
        
        // Get and sanitize input
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $user = new User();
        $userData = $user->getUserByEmail($email);  // Added getUserByEmail method in User model

        if ($userData) {
            if ($password === "google_signup" || password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['email'] = $userData['email'];
                echo "Login successful!";
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Email not found.";
        }
    }

    public function processSignup() {
        require_once '../app/models/User.php';
        
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        $fullName = $data['fullName'];

        $user = new User();
        
        // If user doesn't exist, register them
        if (!$user->userExists($email)) {
            $success = $user->registerUser($fullName, $email, "google_signup");
            if ($success) {
                echo "User signed up via Google.";
            } else {
                echo "Something went wrong with the signup.";
            }
        } else {
            echo "User already exists.";
        }
    }
}
