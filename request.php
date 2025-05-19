<?php
session_start();
include 'connection.php';

// Make sure the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $details = trim($_POST['details']);

    if ($title === '' || $details === '') {
        $message = "Title and details are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO user_requests (user_id, title, details, status) VALUES (?, ?, ?, 'pending')");
        $stmt->bind_param("iss", $user_id, $title, $details);

        if ($stmt->execute()) {
            $message = "Request submitted successfully.";
        } else {
            $message = "Error submitting request: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Request</title>
    <link rel="icon" href="navylogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('gif/blue.gif') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .request-container {
            background-color: #ffffffdd;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #003366;
            font-weight: bold;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            text-align: left;
            display: block;
        }

        .btn-primary {
            background-color: #5c67f2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4a54e1;
        }

        .btn-secondary {
            margin-top: 15px;
        }

        .alert {
            margin-top: 15px;
        }

        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .logo-container img {
            height: 60px;
        }
    </style>
</head>
<body>

<!-- Logo -->
<div class="logo-container">
    <img src="navylogo.png" alt="Navy Logo">
</div>

<!-- Main Container -->
<div class="request-container">
    <h2>Submit a New Request</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
    </form>

    <a href="welcome.php" class="btn btn-secondary w-100">Back to Dashboard</a>
</div>

</body>
</html>
