<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="icon" href="navylogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url('gif/blue.gif') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }

    .register-container {
      background-color: #ffffffdd;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      max-width: 450px;
      width: 100%;
      text-align: center;
    }

    .register-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .gif-container img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    input[type="file"],
    select {
      margin-bottom: 15px;
      padding: 10px;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .btn-primary {
      background-color: #5c67f2;
      border: none;
      padding: 10px;
      font-size: 16px;
    }

    .btn-primary:hover {
      background-color: #4a54e1;
    }

    .form-label {
      font-weight: 600;
    }

    .login-link {
      margin-top: 15px;
      display: block;
      color: #333;
    }

    .login-link a {
      color: #5c67f2;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="register-container">
  <h2>NAVY SYSTEM REGISTER</h2>

  <div class="gif-container">
    <img src="gif/navy1.jpg" alt="Welcome GIF">
  </div>

  <form action="register_process.php" method="post" enctype="multipart/form-data">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="tel" name="phonenumber" placeholder="Phone Number" required>
    <input type="password" name="password" placeholder="Password" required>

    <!-- Profile Photo Upload -->
    <div class="text-start mb-3">
      <label for="profile_photo" class="form-label">Upload Profile Photo</label>
      <input type="file" name="profile_photo" id="profile_photo" accept="image/*" >
    </div>

<!-- Role Dropdown (only visible and editable for sysadmin, admin1, admin2, admin3, admin4) -->
<?php
if (isset($_SESSION['role'])) {
    $current_role = $_SESSION['role'];
    $role_options = [];

    switch ($current_role) {
        case 'sysadmin':
            $role_options = ['sysadmin', 'admin1', 'admin2', 'admin3', 'admin4', 'user'];
            break;
        case 'admin1':
            $role_options = ['admin2', 'admin3', 'admin4'];
            break;
        case 'admin2':
            $role_options = ['admin3', 'admin4'];
            break;
        case 'admin3':
            $role_options = ['user'];
            break;
    }

    if (!empty($role_options)): ?>
        <div class="text-start mb-3">
            <label for="role" class="form-label">Select Role</label>
            <select name="role" id="role" required>
                <option value="">-- Select Role --</option>
                <?php foreach ($role_options as $role): ?>
                    <option value="<?= $role ?>"><?= ucfirst($role) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
<?php
    endif;
}
?>


    <!-- Rank Dropdown -->
    <?php
      $rank_abbreviations = ["Midshipman", "Sub Lieutenant", "Lieutenant", "Lieutenant Commander", "Commander", "Captain", "Commodore", "Rear Admiral", "Vice Admiral", "Admiral", "Admiral Of the Fleet"];
    ?>
    <div class="text-start mb-3">
      <label for="rank" class="form-label">Select Rank</label>
      <select name="rank" id="rank" required>
        <option value="">-- Select Rank --</option>
        <?php foreach ($rank_abbreviations as $abbr): ?>
          <option value="<?= $abbr ?>"><?= $abbr ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <input type="submit" value="Register" class="btn btn-primary w-100">
  </form>

  <div class="login-link">
    Already have an account? <a href="index.php">Login here</a>
  </div>
</div>

</body>
</html>
