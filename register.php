<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>

  <!-- ✅ Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="main.css">
</head>
<body>

  <div class="login-container">
    <h2>NAVY SYSTEM REGISTER</h2>

    <div class="gif-container">
      <img src="gif/navy1.jpg" alt="Welcome GIF">
    </div>

    <form action="register_process.php" method="post">
      <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
      <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
      <input type="tel" name="phonenumber" placeholder="Phone Number" class="form-control mb-2" required>
      <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>

      <!-- Role Selection -->
      <div class="role-selection mb-3 d-flex gap-3">
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <label class="role-btn">
          <input type="radio" name="role" value="user" required > User
        </label>

        
          <label class="role-btn">
            <input type="radio" name="role" value="admin" required> Admin
          </label>
        <?php endif; ?>
      </div>

      <!-- Rank Dropdown -->
      <?php
      $rank_abbreviations = [
        "Mid", "A/S/Lt", "S/Lt", "Lt", "Lt Cdr",
        "Cdr", "Capt", "Cdre", "R Adm", "V Adm", "Adm"
      ];
      ?>
      <div class="mb-3 text-start">
        <label for="rank" class="form-label">Select Rank</label>
        <select class="form-select" name="rank" id="rank" required>
          <option value="">-- Select Rank --</option>
          <?php foreach ($rank_abbreviations as $abbr): ?>
            <option value="<?php echo $abbr; ?>"><?php echo $abbr; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <input type="submit" value="Register" class="btn btn-primary w-100">
    </form>

    <p class="mt-3">Already have an account? <a href="index.php">Login here</a></p>
  </div>

  <!-- Optional: Style for role buttons -->
  <style>
    .role-selection .role-btn {
      padding: 10px 20px;
      border: 2px solid #007bff;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      color: #007bff;
      background-color: white;
      transition: all 0.3s ease;
    }

    .role-selection .role-btn:hover {
      background-color: #007bff;
      color: white;
    }

    .role-selection .role-btn input[type="radio"] {
      display: none;
    }

    .role-selection .role-btn:has(input[type="radio"]:checked) {
      background-color: #007bff;
      color: white;
    }

    .login-container {
      max-width: 400px;
      margin: auto;
      padding: 20px;
      text-align: center;
    }

    .gif-container img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 15px;
    }
  </style>

</body>
</html>
