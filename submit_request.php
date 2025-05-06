<?php
session_start();
include 'connection.php';

// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Logged-in user's ID
?>

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
      align-items: flex-start;
      padding-top: 40px;
      min-height: 100vh;
      margin: 0;
    }
    .request-container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 600px;
      text-align: center;
    }
    h2, h3 {
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
    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
    .logout {
      position: fixed;
      top: 15px;
      right: 20px;
      background: #ff4d4d;
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .logout:hover {
      background: #e60000;
    }
  </style>
</head>
<body>

  <a class="logout" href="logout.php">LOGOUT</a>

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

        // Sanity check
        if (empty($user_id)) {
            echo "<div class='error'>User ID missing. Please log in again.</div>";
        } else {
            $sql = "INSERT INTO user_requests (user_id, title, details, status) VALUES (?, ?, ?, 'pending')";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $details);
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='success'>Request submitted successfully!</div>";
            } else {
                echo "<div class='error'>Failed to submit request. Please try again.</div>";
            }
        }
    }
    ?>

    <h3>Your Submitted Requests</h3>
    <?php
    $sql = "SELECT title, details, status FROM user_requests WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo "<table>";
    echo "<tr><th>Title</th><th>Details</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['details']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
  </div>

</body>
</html>
