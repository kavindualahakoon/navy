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
  <meta charset="UTF-8">
  <title>Admin Review</title>
  <link rel="icon" href="navylogo.png" type="image/png">
  <link rel="stylesheet" href="main.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('gif/blue.gif') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      
    }

    .container {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 95%;
      max-width: 1000px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ccc;
      vertical-align: top;
    }

    th {
      background-color: #5c67f2;
      color: white;
    }

    textarea {
      width: 100%;
      height: 60px;
      resize: none;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 8px;
      font-size: 14px;
    }

    input[type="submit"] {
      padding: 10px 16px;
      border: none;
      border-radius: 5px;
      background-color: #5c67f2;
      color: white;
      cursor: pointer;
      font-size: 14px;
      margin-right: 5px;
    }

    input[type="submit"]:hover {
      background-color: #4a54e1;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .action-buttons {
      display: flex;
      gap: 10px;
    }
  </style>
  <script>
    function validateForm(form) {
      const remark = form.querySelector("textarea").value.trim();
      if (remark === "") {
        alert("Please enter a remark.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>

  <div class="container">
    <h2>Pending Discussion Requests</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Details</th>
        <th>Remark</th>
        <th>Action</th>
      </tr>

      <?php
      $query = "SELECT * FROM user_requests WHERE status = 'pending'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['details']) ?></td>
        <td>
          <form method="POST" onsubmit="return validateForm(this);">
            <textarea name="remark" required></textarea>
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
        </td>
        <td class="action-buttons">
            <input type="submit" name="approve" value="Approve">
            <input type="submit" name="reject" value="Reject">
          </form>
        </td>
      </tr>
      <?php } ?>
    </table>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $remark = trim($_POST['remark']);

        if ($remark === '') {
            echo "<script>alert('Remark is required');</script>";
        } else {
            if (isset($_POST['approve'])) {
                $update = "UPDATE user_requests SET status = 'approved', admin_remark = ? WHERE id = ?";
            } elseif (isset($_POST['reject'])) {
                $update = "UPDATE user_requests SET status = 'rejected', admin_remark = ? WHERE id = ?";
            }

            $stmt = mysqli_prepare($conn, $update);
            mysqli_stmt_bind_param($stmt, "si", $remark, $id);
            mysqli_stmt_execute($stmt);

            echo "<script>alert('Action taken successfully'); window.location.href = 'admin-review.php';</script>";
        }
    }
    ?>
  </div>
  
<a class="logout" href="logout.php">LOGOUT</a>
<a class="request" href="request-status.php">REQUEST STATUS</a>




</body>
</html>
