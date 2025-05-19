<?php
session_start();
include 'connection.php'; // Ensure correct path to your database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rank = $_POST['rank'];
    $role = isset($_POST['role']) ? $_POST['role'] : 'user';

    // Handle profile photo upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_photo']['tmp_name'];
        $fileName = $_FILES['profile_photo']['name'];
        $fileSize = $_FILES['profile_photo']['size'];
        $fileType = $_FILES['profile_photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file types
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('profile_', true) . '.' . $fileExtension;
            $uploadFileDir = 'uploads/profile_photos/';
            $dest_path = $uploadFileDir . $newFileName;

            // Create directory if it doesn't exist
            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profile_photo_path = $dest_path;
            } else {
                echo "<script>alert('Error: Could not move uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Error: Invalid file type. Only JPG, PNG, and GIF are allowed.');</script>";
        }
    } else {
        // No photo uploaded, use default photo or leave empty
        $profile_photo_path = 'uploads/profile_photos/default.png'; // or NULL
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, phonenumber, password, role, `rank`, profile_photo) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("sssssss", $username, $email, $phonenumber, $password, $role, $rank, $profile_photo_path);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: Could not register user.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: register.php");
    exit();
}
?>
