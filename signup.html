<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - Trendora</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="signup.css" />

  <!-- Google Sign-In Library -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <script>
    // Decode Google JWT
    function parseJwt(token) {
      const base64Url = token.split('.')[1];
      const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      return JSON.parse(atob(base64));
    }

    // Google Sign-In handler
    function handleCredentialResponse(response) {
      const data = parseJwt(response.credential);
      const email = data.email;
      const fullName = data.name;

      // Send to backend
      fetch("signup.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: email, fullName: fullName, password: "google_signup" }), // Password set for Google Sign-In
      })
      .then(res => res.text())
      .then(result => {
        alert(result);
        if (result.includes("User registered") || result.includes("already exists")) {
          window.location.href = "login.html";
        }
      })
      .catch(err => console.error("Error:", err));
    }

    // Manual signup handler
    function setupManualSignup() {
      const form = document.querySelector("form");
      form.addEventListener("submit", function (e) {
        e.preventDefault();
        const fullName = document.getElementById("fullname").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        // Check if fields are empty
        if (!fullName || !email || !password) {
          alert("Please fill all fields.");
          return;
        }

        // Send to backend
        fetch("signup.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ fullName, email, password }),
        })
        .then(res => res.text())
        .then(result => {
          alert(result);
          if (result.includes("User registered") || result.includes("already exists")) {
            window.location.href = "login.html";
          }
        })
        .catch(err => console.error("Error:", err));
      });
    }

    // Initialize Google Sign-In (wait for the script to load)
    function initializeGoogleSignIn() {
      if (window.google && google.accounts && google.accounts.id) {
        google.accounts.id.initialize({
          client_id: "488729672496-iq9dleno2kl63gfp0aa5o36rtkfht840.apps.googleusercontent.com",
          callback: handleCredentialResponse
        });
        google.accounts.id.renderButton(
          document.getElementById("google-signin-button"),
          { theme: "outline", size: "large", text: "sign_up_with" }
        );
      } else {
        // Retry if the script hasn't loaded yet
        setTimeout(initializeGoogleSignIn, 300);
      }
    }

    // Wait for DOM and run setup
    window.addEventListener("DOMContentLoaded", () => {
      setupManualSignup();
      initializeGoogleSignIn();
    });

    // Toggle password visibility
    function togglePassword(icon) {
      const input = document.getElementById("password");
      if (input.type === "password") {
        input.type = "text";
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
      }
    }
  </script>
</head>
<body>
  <div class="page-header">
    <div class="brand-name">TRENDORA</div>
  </div>
  <div class="container">
    <div class="right-section">
      <div class="signup-title">Sign Up</div>
      <form>
        <div class="form-group">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group password-wrapper">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Enter your password" required>
          <i class="fa-solid fa-eye" onclick="togglePassword(this);"></i>
        </div>
        <button class="submit-btn" type="submit">Submit</button>

        <!-- Google Sign-In Button -->
        <div id="google-signin-button" style="margin-top: 1rem;"></div>
      </form>
    </div>
    <div class="left-section">
      <img src="images/Shopaholics - Online Shopping.png" alt="Fashion illustration" style="width: 75%; height: auto;" />
    </div>
  </div>
</body>
</html>
