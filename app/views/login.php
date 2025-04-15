<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Trendora</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/login.css" />
  <script src="https://cdn.jsdelivr.net/npm/jwt-decode@3.1.2/build/jwt-decode.min.js"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="https://connect.facebook.net/en_US/sdk.js" async defer></script>
  <script src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js" async defer></script>
  <script>
    function togglePassword(icon) {
      const passwordInput = document.getElementById("password");
      const isPassword = passwordInput.type === "password";
      passwordInput.type = isPassword ? "text" : "password";
      icon.classList.toggle("fa-eye");
      icon.classList.toggle("fa-eye-slash");
    }

    // Function to handle Google login
    function handleCredentialResponse(response) {
      const token = response.credential;
      const decoded = jwt_decode(token);
      const email = decoded.email;
      const fullName = decoded.name;

      // Try to login the user using Google email
      fetch('Home/processLogin', {  <!-- Updated route -->
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent('google_signup')}`
      })
      .then(res => res.text())
      .then(data => {
        console.log(data);
        if (data.includes('Login successful')) {
          window.location.href = "dashboard.html";  // Redirect to dashboard
        } else if (data.includes('Email not found')) {
          // If email is not found, sign up first
          fetch('Home/processSignup', {  <!-- Updated route -->
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, fullName })
          })
          .then(res => res.text())
          .then(msg => {
            console.log(msg);
            alert('Signed up with Google, please log in again.');
          });
        } else {
          alert('Something went wrong: ' + data);
        }
      });
    }

    // Manual login function to handle the login form submission
    function handleManualLogin(event) {
      event.preventDefault();  // Prevent the default form submission

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      // Send the form data to HomeController's processLogin method
      fetch('Home/processLogin', {  <!-- Updated route -->
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
      })
      .then(res => res.text())
      .then(data => {
        console.log(data);
        if (data.includes('Login successful')) {
          window.location.href = "dashboard.html";  // Redirect to dashboard
        } else {
          alert('Login failed: ' + data);
        }
      });
    }

    window.onload = function() {
      google.accounts.id.initialize({
        client_id: "488729672496-iq9dleno2kl63gfp0aa5o36rtkfht840.apps.googleusercontent.com", // Your Google Client ID
        callback: handleCredentialResponse
      });
      google.accounts.id.renderButton(
        document.querySelector(".g_id_signin"),
        { theme: "outline", size: "large", text: "signin_with" }
      );
      google.accounts.id.prompt();  // Show the One Tap prompt
    };
</script>

</head>
<body>
  <div class="container">
    <div class="left-panel">
      <h1>TRENDORA</h1>
      <img src="<?php echo BASE_URL; ?>products/login.png"  alt="Fashion Illustration" class="illustration" />
    </div>
    <div class="right-panel">
      <h2>Login</h2>
      <!-- Manual Login Form -->
      <form id="login-form" method="POST" onsubmit="handleManualLogin(event)">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="form-group password">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
            <i class="fa-solid fa-eye toggle-visibility" onclick="togglePassword(this);"></i>
          </div>
        </div>
        <div class="forgot">
          <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" class="btn-login">Log In</button>
      </form>

      <div class="or-divider">or continue with</div>

      <div class="social-icons">
        <!-- Google Sign-In Button -->
        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="sign_in_with" data-size="large" data-logo_alignment="left"></div>

        <!-- Facebook Sign-In Button -->
        <a href="#" id="facebook-signin">
          <img src="<?php echo BASE_URL; ?>products/facebook (1).jpg" alt="Facebook" class="social-icon" />
        </a>

        <!-- Apple Sign-In Button -->
        <a href="#" id="apple-signin">
        <img src="<?php echo BASE_URL; ?>products/apple.jpg" alt="Apple" class="social-icon" />
        </a>
      </div>

      <div class="signup">
        Don’t have an account? <a href="signup.html">Sign Up Here</a>
      </div>
    </div>
  </div>
</body>
</html>
