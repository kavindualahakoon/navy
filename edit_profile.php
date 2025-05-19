<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['user_id'])) { 
    die("Access denied. Please log in first.");
}

$userId = $_SESSION['user_id']; // 
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $rank = $_POST['rank'];
    $profile_photo_path = null; // Initialize in case no file is uploaded

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
                $profile_photo_path = $dest_path; // Set the path to be updated in the database
            } else {
                echo "<script>alert('Error: Could not move uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Error: Invalid file type. Only JPG, PNG, and GIF are allowed.');</script>";
        }
    }

    // Update user profile information, including the profile photo if uploaded
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phonenumber = ?, `rank` = ?, profile_photo = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $username, $email, $phonenumber, $rank, $profile_photo_path, $userId);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }

    $stmt->close();
}

// Fetch the current user’s details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="navylogo.png" type="image/png">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Your Profile</h2>

    <div class="card p-4 shadow-sm">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phonenumber" value="<?= htmlspecialchars($user['phonenumber']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rank</label>
                <select name="rank" class="form-select" required>
                    <?php
                    $ranks = ["Midshipman", "Sub Lieutenant", "Lieutenant", "Lieutenant Commander", "Commander", "Captain", "Commodore", "Rear Admiral", "Vice Admiral", "Admiral", "Admiral Of the Fleet"];
                    foreach ($ranks as $r) {
                        $selected = ($r == $user['rank']) ? 'selected' : '';
                        echo "<option value='$r' $selected>$r</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Profile photo upload -->
            <div class="mb-3">
                <label class="form-label">Profile Photo</label>
                <input type="file" name="profile_photo" class="form-control">
                <small class="form-text text-muted">You can upload a new profile photo. (Optional)</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="welcome.php" class="btn btn-secondary btn-lg px-4">Dashboard</a>
        <a href="logout.php" class="btn btn-danger btn-lg px-4">Logout</a>
    </div>
</div>

</body>
</html>
