<?php
// CORS headers (adjust domain in production)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Connect to database
$conn = new mysqli("sql313.infinityfree.com", "if0_38912952", "llonnewhennn", "if0_38912952_wp997");
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}

// Read JSON input
$input = file_get_contents("php://input");
$data = json_decode($input);

// Optional debug log (disable in production)
// file_put_contents("debug_log.txt", print_r($data, true), FILE_APPEND);

// Validate input
if (!isset($data->email) || !isset($data->fullName)) {
    http_response_code(400);
    echo "Missing required fields.";
    exit;
}

$email = $conn->real_escape_string($data->email);
$fullname = $conn->real_escape_string($data->fullName);

// Optional password (for manual signup)
$password = isset($data->password) ? $data->password : null;

// Check if user already exists
$checkUser = $conn->prepare("SELECT id FROM users WHERE email = ?");
$checkUser->bind_param("s", $email);
$checkUser->execute();
$checkUser->store_result();

if ($checkUser->num_rows > 0) {
    http_response_code(409);
    echo "User already exists.";
} else {
    $hashedPassword = $password
        ? password_hash($password, PASSWORD_DEFAULT)
        : password_hash("google_signup", PASSWORD_DEFAULT); // fallback

    $insert = $conn->prepare("INSERT INTO users (email, password, fullname) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $email, $hashedPassword, $fullname);

    if ($insert->execute()) {
        http_response_code(201);
        echo "User registered successfully.";
    } else {
        http_response_code(500);
        echo "Error inserting user: " . $insert->error;
    }

    $insert->close();
}

$checkUser->close();
$conn->close();
?>
