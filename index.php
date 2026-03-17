
<?php
include "db.php";
include "includes/header.php";
?>

<h2>Welcome to Provider Hub</h2>
<p>Short links and earn from traffic.</p>

<?php if(isset($_SESSION['user_id'])): ?>
    <p><a href="dashboard.php">Go to Dashboard</a></p>
    <p><a href="logout.php">Logout</a></p>
<?php else: ?>
    <p><a href="signup.php">Signup</a> | <a href="login.php">Login</a></p>
<?php endif; ?>

<?php include "includes/footer.php"; ?>
