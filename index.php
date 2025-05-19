<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NAVY SYSTEM LOGIN</title>
  <link rel="icon" href="navylogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('gif/blue.gif') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      text-align: center;
      max-width: 420px;
      width: 100%;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #333;
      font-weight: bold;
    }

    .gif-container img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #5c67f2;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #4a54e1;
    }

    .error {
      color: red;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .register-link, .forgot-password-link {
      margin-top: 10px;
      font-size: 15px;
      color: #555;
    }

    .register-link a, .forgot-password-link a {
      color: #5c67f2;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link a:hover, .forgot-password-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>NAVY SYSTEM LOGIN</h2>

    <div class="gif-container">
      <img src="gif/navy1.jpg" alt="Welcome Image">
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
      <div class="error">Invalid username or password. Please try again.</div>
    <?php endif; ?>

    <form action="login_process.php" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>

    <div class="forgot-password-link mt-2">
      <a href="forgot_password.php">Forgot your password?</a>
    </div>

    <div class="register-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>

</body>
</html>
