<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "trendora");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to database successfully.<br>";
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Debugging: Output the incoming data for verification (remove in production)
var_dump($data); // Check the incoming data

// Check if the email and fullName are set
if (isset($data->email) && isset($data->fullName)) {
    $email = $conn->real_escape_string($data->email);
    $fullname = $conn->real_escape_string($data->fullName);

    // Check if the user already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows === 0) {
        // Set a default password for the user (Google login doesn't provide one)
        $defaultPassword = password_hash("google_signup", PASSWORD_DEFAULT);

        // Prepare the query for better debugging
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$defaultPassword')";
        echo "Query: " . $query;  // Debugging: check the SQL query
        
        // Insert the new user into the database
        $insert = $conn->query($query);
        if ($insert) {
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

// Access control headers for CORS
header("Access-Control-Allow-Origin: *");  // Allows any domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle OPTIONS request (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$conn->close();
?>
