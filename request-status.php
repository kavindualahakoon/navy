<?php
session_start(); // Start the session
include 'connection.php'; // or 'db.php' depending on your setup

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page or show error
    header("Location: login.php"); // Change this to your actual login page
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Request Status</title>
  <link rel="icon" href="navylogo.png" type="png">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <h2>Your Request Status</h2>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Status</th>
      <th>Admin Remark</th>
    </tr>

    <?php
    $sql = "SELECT * FROM user_requests ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>{$row['status']}</td>
                    <td>" . htmlspecialchars($row['admin_remark']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No requests found.</td></tr>";
    }
    ?>
  </table>
  

  <a class="logout" href="logout.php">LOGOUT</a>
  
</body>
</html>
