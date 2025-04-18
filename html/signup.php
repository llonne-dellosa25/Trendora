<?php
// Access control headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle OPTIONS request (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Connect to DB
$conn = new mysqli("localhost", "root", "", "trendora");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Debugging: log incoming data to a file (remove in production)
file_put_contents("debug_log.txt", print_r($data, true), FILE_APPEND);

// Validate required fields
if (isset($data->email) && isset($data->fullName)) {
    $email = $conn->real_escape_string($data->email);
    $fullname = $conn->real_escape_string($data->fullName);

    // Check if the user already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows === 0) {
        // Use password from user (manual signup) or fallback for Google signup
        $password = isset($data->password)
            ? password_hash($data->password, PASSWORD_DEFAULT)
            : password_hash("google_signup", PASSWORD_DEFAULT);

        // Insert new user
        $query = "INSERT INTO users (email, password, fullname) VALUES ('$email', '$password', '$fullname')";
        if ($conn->query($query)) {
            echo "User registered successfully.";
        } else {
            echo "Error inserting user: " . $conn->error;
        }
    } else {
        echo "User already exists.";
    }
} else {
    echo "Invalid data received.";
}

$conn->close();
?>
