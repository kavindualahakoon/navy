
<!-- reset_password.php -->
<?php

session_start();
include 'connection.php';

$token = $_GET['token'] ?? '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_token_expires=NULL WHERE reset_token=? AND reset_token_expires > NOW()");
    $stmt->bind_param("ss", $newPassword, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "Password successfully updated. <a href='login.php'>Login here</a>.";
    } else {
        $message = "Invalid or expired token.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="p-5 rounded bg-white shadow" style="width: 400px;">
    <h4 class="mb-4">Reset Your Password</h4>
    <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
    <?php if (empty($message)): ?>
        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="password" name="password" class="form-control mb-3" placeholder="New Password" required>
            <button type="submit" class="btn btn-success w-100">Update Password</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
