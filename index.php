<!DOCTYPE html>
<html>
<head >

<link rel="icon" href="navylogo.png" type="png">

  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
  background: url('gif/blue.gif') no-repeat center center fixed;
  background-size: cover;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
    }
    .login-container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    h2 {
      margin-bottom: 25px;
      color: #333;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    input[type="submit"] {
      width: 100%;
      background: #5c67f2;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #4a54e1;
    }
    .error {
      color: red;
      margin-bottom: 15px;
    }
    .register-link {
      margin-top: 15px;
      display: block;
      color: #555;
    }
    .register-link a {
      color: #5c67f2;
      text-decoration: none;
    }
    .register-link a:hover {
      text-decoration: underline;
    }

    .gif-container {
      margin-bottom: 20px;
    }
    .gif-container img {
      width: 420px; /* Adjust as needed */
      height: auto;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>NAVY SYSTEM LOGIN</h2>
    <div class="dashboard">
  <div class="gif-container">
    <img src="gif\navy1.jpg" alt="Welcome GIF">
  </div>

  
</div>
<?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
  <div class="error">Invalid username or password. Please try again.</div>
<?php endif; ?>

    <form action="login_process.php" method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
    <div class="register-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>

</body>
</html>


