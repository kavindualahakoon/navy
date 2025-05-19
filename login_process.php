<?php
session_start();
require 'db.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    
    if (empty($username) || empty($password)) {
        header("Location: index.php?error=empty_fields");
        exit();
    }

    try {
       
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       
        if ($user && password_verify($password, $user['password'])) {
           
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? '';
            $_SESSION['rank'] = $user['rank'] ?? '';

            
            header("Location: welcome.php");
            exit();
        } else {
         
            header("Location: index.php?error=invalid_credentials");
            exit();
        }
    } catch (PDOException $e) {
  
        header("Location: index.php?error=server_error");
        exit();
    }
} else {
   
    header("Location: index.php");
    exit();
}
?>
