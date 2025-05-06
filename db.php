

<?php
$host = "localhost";
$dbname = "user_auth";
$username = "root"; // default in AMPPS
$password = "mysql"; // default in AMPPS

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
