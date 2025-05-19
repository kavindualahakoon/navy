<?php
session_start();
include 'connection.php'; // Use MySQLi ($conn = new mysqli(...))

// Restrict access to sysadmin only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'sysadmin') {
    die("Access denied. This page is for sysadmins only.");
}

$username = $_SESSION['username'];
$sql = "SELECT profile_photo FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$profile_photo = !empty($user['profile_photo']) ? $user['profile_photo'] : 'uploads/profile_photos/default.png'; // Fallback image

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $rank = $_POST['rank'];
    $role = $_POST['role'];
    

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phonenumber = ?, `rank` = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $username, $email, $phonenumber, $rank, $role, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update user');</script>";
    }

    $stmt->close();
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];

    // Optional: Prevent sysadmin from deleting themselves
    if (isset($_SESSION['user_id']) && $id == $_SESSION['user_id']) {
        echo "<script>alert('You cannot delete yourself.');</script>";
    } else {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('User deleted successfully');</script>";
        } else {
            echo "<script>alert('Failed to delete user');</script>";
        }

        $stmt->close();
    }
}

// Fetch all users
$result = $conn->query("SELECT * FROM users ORDER BY id ASC");
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Super Admin - Manage Users</title>
    <link rel="icon" href="navylogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">SUPER ADMIN - Manage Users</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Profile Photo</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Rank</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']); ?>">
                        <!-- Display Profile Photo -->
                        <td>
                            <?php
                            // Determine the profile photo or default one
                           
                            $profile_photo = !empty($user['profile_photo']) ? $user['profile_photo'] : 'uploads/profile_photos/default.png'; // Fallback image
                            ?>
                            <img src="<?= htmlspecialchars($profile_photo); ?>" alt="Profile Photo" width="40" height="40" class="rounded-circle border">
                        </td>
                        <td><input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-control" required></td>
                        <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control" required></td>
                        <td><input type="text" name="phonenumber" value="<?= htmlspecialchars($user['phonenumber']); ?>" class="form-control" required></td>
                        <td>
                            <select name="rank" class="form-select" required>
                                <?php
                                $ranks = ["Midshipman", "Sub Lieutenant", "Lieutenant", "Lieutenant Commander", "Commander", "Captain", "Commodore", "Rear Admiral", "Vice Admiral", "Admiral", "Admiral Of the Fleet"];
                                foreach ($ranks as $rankOption) {
                                    $selected = ($rankOption === $user['rank']) ? 'selected' : '';
                                    echo "<option value='$rankOption' $selected>$rankOption</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="role" class="form-select" required>
                                <?php
                                $roles = ["user", "sysadmin", "admin1", "admin2", "admin3", "admin4"];
                                foreach ($roles as $roleOption) {
                                    $selected = ($roleOption === $user['role']) ? 'selected' : '';
                                    echo "<option value='$roleOption' $selected>$roleOption</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td class="d-flex gap-1">
                            <button type="submit" name="update_user" class="btn btn-primary btn-sm">Update</button>
                    </form>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']); ?>">
                        <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between mt-4">
            <a href="welcome.php" class="btn btn-secondary btn-lg px-4">Dashboard</a>
            <a href="logout.php" class="btn btn-danger btn-lg px-4">Logout</a>
        </div>

    </div>
</div>

</body>
</html>
