

<?php
$conn = new mysqli("localhost", "root", "mysql", "user_auth");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
