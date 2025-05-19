<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['user', 'sysadmin', 'admin1', 'admin2', 'admin3', 'admin4'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Show only the logged-in user's requests if role is 'user'
if ($role === 'user') {
    $userId = $_SESSION['user_id']; // Ensure this is set at login
    $query = "
        SELECT r.*, u.username AS requester_name, u.profile_photo AS requester_photo
        FROM user_requests r
        JOIN users u ON r.user_id = u.id
        WHERE r.user_id = $userId
        ORDER BY r.id DESC
    ";
} else {
    // Admins see all requests
    $query = "
        SELECT r.*, u.username AS requester_name, u.profile_photo AS requester_photo
        FROM user_requests r
        JOIN users u ON r.user_id = u.id
        ORDER BY r.id DESC
    ";
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Request Status</title>
    <link rel="icon" href="navylogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Your Request Status</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Profile Photo</th>
                    <th>Requester</th>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>HOD/CO Remark</th>
                    <th>DG/Director Remark</th>
                    <th>DDNIT(S) Remark</th>
                    <th>DNIT Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars(!empty($row['requester_photo']) ? $row['requester_photo'] : 'uploads/profile_photos/default.png'); ?>"
                                     alt="Profile Photo" width="40" height="40" class="rounded-circle border">
                            </td>
                            <td><?= htmlspecialchars($row['requester_name']) ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td><?= htmlspecialchars($row['admin1_remark'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['admin2_remark'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['admin3_remark'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['admin4_remark'] ?? '') ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="9" class="text-center">No requests found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['sysadmin','admin', 'admin1', 'admin2', 'admin3', 'admin4'])): ?>
        <a href="admin-review.php" class="btn btn-success btn-lg px-4">Admin Review</a>
        <?php endif; ?>
        <a href="welcome.php" class="btn btn-warning btn-lg px-4">Dashboard</a>
        <a href="logout.php" class="btn btn-danger btn-lg px-4">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>