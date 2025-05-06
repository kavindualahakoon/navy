<?php
session_start();


// Check if user is logged in
if (!isset($_SESSION['username']) ) {
    // Not logged in or missing rank, redirect to login page
    header("Location: login.php");
    exit();
}
?>








<!DOCTYPE html>

<html>
<head>
<link rel="icon" href="navylogo.png" type="png">
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>

<div class="dashboard">
  <div class="gif-container">
    <img src="gif/navy1.jpg" alt="Welcome GIF">
  </div>
  
  <h2>Welcome,<?php echo htmlspecialchars($_SESSION['rank']); ?> <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  
  <p>
    THIS IS YOUR DSHBOARD.</p>
  
</div>
<div class="position-relative ">



<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
  <a class="request" href="admin-review.php">REQUEST STATUS</a>
<?php endif; ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
  <a class="usercreate" href="register.php">USER CREATE</a>
<?php endif; ?>
<a class="request1" href="request.php">REQUEST</a>
<a class="logout" href="logout.php">LOGOUT</a>

</div>



</body>
</html>
