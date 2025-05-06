<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['rank'] = $user['rank'];
    header("Location: welcome.php");
    exit();
} else {
    // Invalid login, redirect back with error
    header("Location: index.php?error=1");
    exit();
}
?>
