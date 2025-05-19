<!-- promote_user.php -->

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Connect to DB
$conn = new mysqli("localhost", "root", "mysql", "user_auth");

// Check if current user is admin
$current_user = $_SESSION['username'];
$stmt = $conn->prepare("SELECT role FROM users WHERE username = ?");
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

// Promote the target user
$target_user = $_POST['target_user'];
$stmt = $conn->prepare("UPDATE users SET role = 'admin' WHERE username = ?");
$stmt->bind_param("s", $target_user);

if ($stmt->execute()) {
    echo "User '$target_user' has been promoted to admin.";
} else {
echo "Failed to promote user.";
}
?>
