<?php
include 'connection.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Fetch user profile photo from database
$username = $_SESSION['username'];
$sql = "SELECT profile_photo FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$profile_photo = !empty($user['profile_photo']) ? $user['profile_photo'] : 'uploads/profile_photos/default.png';

// Initialize notification count
$notificationCount = 0;

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];

    switch ($role) {
        case 'admin1':
            $status = 'pending';
            break;
        case 'admin2':
            $status = 'admin1_approved';
            break;
        case 'admin3':
            $status = 'admin2_approved';
            break;
            case 'admin4':
              $status = 'admin3_approved';
              break;
        default:
            $status = null;
    }

    if ($status) {
        $notif_sql = "SELECT COUNT(*) AS count FROM user_requests WHERE status = ?";
        $notif_stmt = $conn->prepare($notif_sql);
        $notif_stmt->bind_param("s", $status);
        $notif_stmt->execute();
        $notif_result = $notif_stmt->get_result();
        $notif_data = $notif_result->fetch_assoc();
        $notificationCount = $notif_data['count'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="icon" href="navylogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: url('gif/blue.gif') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .dashboard-container {
      background: #ffffffcc;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      padding: 40px;
      text-align: center;
      max-width: 600px;
      width: 100%;
    }
    .dashboard-container img.profile {
      max-width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 3px solid #5c67f2;
    }
    .dashboard-container h2 {
      margin-bottom: 10px;
    }
    .dashboard-container p {
      margin-bottom: 30px;
      font-size: 18px;
      color: #444;
    }
    .btn-group-custom {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
    }
    .btn-group-custom a {
      min-width: 120px;
    }
    .position-relative .badge {
      font-size: 0.75rem;
    }
  </style>
</head>
<body>
<div class="logo-container">

</div>

<div class="dashboard-container">
  <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="Profile Photo" class="profile">
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['rank'] . ' ' . $_SESSION['username']); ?>!</h2>
  <p>This is your dashboard.</p>

  <div class="btn-group-custom">
    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'admin1', 'admin2', 'admin3','admin4'])): ?>
      <a href="admin-review.php" class="btn btn-primary position-relative">
        Admin Review
        <?php if ($notificationCount > 0): ?>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= $notificationCount ?>
            <span class="visually-hidden">pending requests</span>
          </span>
        <?php endif; ?>
      </a>
    <?php endif; ?>

    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['sysadmin','admin', 'admin1', 'admin2', 'admin3', 'admin4'])): ?>
      <a href="register.php" class="btn btn-success">User Create</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'sysadmin'): ?>
      <a href="super_dashboard.php" class="btn btn-dark">Super User</a>
    <?php endif; ?>

    <a href="edit_profile.php" class="btn btn-warning">Profile Edit</a>
    <a href="request.php" class="btn btn-info">Request</a>
    
      <a href="request-status.php" class="btn btn-success">Request status</a>
   
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
</div>

</body>
</html>
