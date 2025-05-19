
<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['sysadmin', 'admin', 'admin1', 'admin2', 'admin3', 'admin4'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$adminLevel = $_SESSION['role'];

// Determine which requests to show
switch ($adminLevel) {
    case 'admin1':
        $whereStatus = "r.status = 'pending'";
        break;
    case 'admin2':
        $whereStatus = "r.status = 'admin1_approved'";
        break;
    case 'admin3':
        $whereStatus = "r.status = 'admin2_approved'";
        break;
        case 'admin4':
            $whereStatus = "r.status = 'admin3_approved'";
            break;
    default:
        echo "Unauthorized admin level.";
        exit();
}

// Fetch requests with requester info
$query = "
    SELECT r.*, u.username AS requester_name, u.profile_photo AS requester_photo
    FROM user_requests r
    JOIN users u ON r.user_id = u.id
    WHERE $whereStatus
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('gif/blue.gif') no-repeat center center fixed;
            background-size: cover;
        }
        .custom-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            margin-top: 60px;
        }
        textarea {
            resize: none;
            min-height: 60px;
        }
        .position-absolute {
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
        .position-absolute a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <script>
        function validateForm(form) {
            const remark = form.querySelector("textarea").value.trim();
            if (remark === "") {
                alert("Please enter a remark.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="container custom-container">
    <h2 class="text-center mb-4"><?= htmlspecialchars($username); ?> Review Panel</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Profile Photo</th>
                    <th>Requester Name</th>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Remark</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>
                        <img src="<?= htmlspecialchars(!empty($row['requester_photo']) ? $row['requester_photo'] : 'uploads/profile_photos/default.png'); ?>" 
                             alt="Profile Photo" width="40" height="40" class="rounded-circle border">
                    </td>
                    <td><?= htmlspecialchars($row['requester_name']); ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars($row['details']); ?></td>
                    <td>
                        <form method="POST" onsubmit="return validateForm(this);">
                            <textarea name="remark" class="form-control mb-2" required></textarea>
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    </td>
                    <td>
                            <button type="submit" name="approve" class="btn btn-success btn-sm mb-1">Approve</button>
                            <button type="submit" name="reject" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="request-status.php" class="btn btn-secondary px-4">Request Status</a>
        <a href="welcome.php" class="btn btn-warning px-4">Back to Dashboard</a>
        <a href="logout.php" class="btn btn-danger px-4">Logout</a>
    </div>
</div>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $remark = trim($_POST['remark']);

    if ($remark === '') {
        echo "<script>alert('Remark is required');</script>";
    } else {
        switch ($adminLevel) {
            case 'admin1':
                $remarkField = 'admin1_remark';
                $nextStatus = 'admin1_approved';
                break;
            case 'admin2':
                $remarkField = 'admin2_remark';
                $nextStatus = 'admin2_approved';
                break;
            case 'admin3':
                $remarkField = 'admin3_remark';
                $nextStatus = 'admin3_approved';
                break;
            case 'admin4':
                $remarkField = 'admin4_remark';
                $nextStatus = 'approved';
                break;
        }

        $statusUpdate = isset($_POST['approve']) ? $nextStatus : 'rejected';

        $sql = "UPDATE user_requests SET $remarkField = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $remark, $statusUpdate, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "<script>alert('Action completed successfully'); window.location.href = 'admin-review.php';</script>";
    }
}
?>

</body>
</html>
