



<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate token and expiry
        $token = bin2hex(random_bytes(32));  // Create a unique token
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));  // Set expiration to 1 hour

        // Store token and expiration time in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        // Send email with PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'checkcode08@gmail.com'; // Your Gmail
            $mail->Password = 'wlri zlvb rjks ybpo';    // App password (not Gmail password)
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Navy System');
            $mail->addAddress($email);  // Send to user's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $reset_link = "http://localhost/navy/reset_password.php?token=$token";
            $mail->Body = "Click <a href='$reset_link'>here</a> to reset your password. This link expires in 1 hour.";

            $mail->send();
            echo "Password reset email has been sent!";
        } catch (Exception $e) {
            echo "Message could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Navy System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="p-5 rounded bg-white shadow" style="width: 400px;">
        <h4 class="mb-4">Reset Your Password</h4>
        <form method="POST">
            <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
