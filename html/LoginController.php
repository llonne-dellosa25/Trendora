<?php
class LoginController
{
  public function login()
  {
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }
  
      // Ensure JSON response
      header('Content-Type: application/json');
  
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
          http_response_code(405);
          echo json_encode([
              'status' => 'error',
              'message' => 'Only POST requests are allowed.'
          ]);
          return;
      }
  
      $conn = new mysqli("localhost", "root", "", "trendora");
      if ($conn->connect_error) {
          http_response_code(500);
          echo json_encode([
              'status' => 'error',
              'message' => 'Database connection failed.'
          ]);
          return;
      }
  
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';
  
      if (empty($email) || empty($password)) {
          http_response_code(400);
          echo json_encode([
              'status' => 'error',
              'message' => 'Email and password are required.'
          ]);
          return;
      }
  
      $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
  
      if ($result->num_rows === 1) {
          $user = $result->fetch_assoc();
  
          if ($password === "google_signup" || password_verify($password, $user['password'])) {
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['email'] = $user['email'];
  
              echo json_encode([
                  'status' => 'success',
                  'message' => 'Login successful.',
                  'redirect_url' => '/Trendora/public/dashboard.php'
              ]);
              return;
          } else {
              http_response_code(401);
              echo json_encode([
                  'status' => 'error',
                  'message' => 'Incorrect password.'
              ]);
              return;
          }
      } else {
          http_response_code(404);
          echo json_encode([
              'status' => 'error',
              'message' => 'Email not found.'
          ]);
          return;
      }
  
      $stmt->close();
      $conn->close();
  }  
}
