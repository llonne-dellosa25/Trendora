<?php
class HomeController {

    public function index() {
        require_once '../app/views/home.php';
    }

    public function login() {
        require_once '../app/views/login.php';
    }

    public function processLogin() {
        // Start session for login tracking
        session_start();

        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "trendora");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize inputs
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Fetch user
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Check if password matches for manual sign-ups, or check if it's the default password for Google users
            if ($password === "google_signup" || password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header("Location: /Trendora/public/dashboard"); // Redirect to a dashboard or another page
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "Email not found.";
        }

        // Close connection
        $conn->close();
    }
}
