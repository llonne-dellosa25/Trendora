<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Only POST requests are allowed.']);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "trendora");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

// Get POST data (manual or Google Sign-In)
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    $isGoogleLogin = ($password === "google_signup");
    $isPasswordValid = password_verify($password, $user['password']);

    if ($isGoogleLogin || $isPasswordValid) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = ($user['email'] === 'admin@gmail.com') ? 'admin' : 'user';

        // Set redirect based on role
        $redirect = ($_SESSION['role'] === 'admin') ? 'dashboard.html' : 'women_clothing.html';

        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful.',
            'redirect_url' => $redirect
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
    }
} else {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
}

$stmt->close();
$conn->close();
?>
