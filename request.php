<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Submit Request</title>
  <link rel="icon" href="navylogo.png" type="image/png">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('gif/blue.gif') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .request-container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }
    h2 {
      margin-bottom: 25px;
      color: #333;
    }
    input[type="text"], textarea {
      width: 100%;
      padding: 12px 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    textarea {
      height: 100px;
      resize: none;
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
    .success {
      margin-top: 15px;
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  

  <div class="request-container">
    <h2>Submit Your Request</h2>
    <form method="POST" action="">
      <input type="text" name="title" placeholder="Request Title" required><br>
      <textarea name="details" placeholder="Enter request details..." required></textarea><br>
      <input type="submit" name="submit_request" value="Send Request">
    </form>

    <?php
    if (isset($_POST['submit_request'])) {
        $title = $_POST['title'];
        $details = $_POST['details'];

        $sql = "INSERT INTO user_requests (title, details, status) VALUES (?, ?, 'pending')";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $title, $details);
        mysqli_stmt_execute($stmt);

        echo "<div class='success'>Request submitted successfully!</div>";
    }
    ?>
  </div>

  </div>
<a class="logout" href="logout.php">LOGOUT</a>




</body>
</html>
