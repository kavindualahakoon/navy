<?php
require 'db.php';
session_start();

// Get and sanitize form inputs
$username     = $_POST['username'] ?? '';
$email        = $_POST['email'] ?? '';
$phonenumber  = $_POST['phonenumber'] ?? '';
$password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rank         = $_POST['rank'] ?? '';
$role         = $_POST['role'] ?? 'user'; // Default to 'user' if not set

// Prevent non-admins from submitting 'admin' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $role = 'user';
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO users (username, email, phonenumber, password, role, `rank`) VALUES (?, ?, ?, ?, ?, ?)");

try {
    $stmt->execute([$username, $email, $phonenumber, $password, $role, $rank]);
    echo "Registration successful. <a href='index.php'>Login here</a>";
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        echo "Username or email already exists. <a href='register.php'>Try again</a>";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
