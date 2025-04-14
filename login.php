<?php
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
  
  if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    echo "Login successful!";
    // header("Location: dashboard.php"); // Uncomment if you have a dashboard
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "Email not found.";
}
header("Access-Control-Allow-Origin: *");  // Allows any domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle OPTIONS request (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$conn->close();
?>
