<?php
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "Signup successful. Please login.";
    } else {
        $message = "Error: Email may already exist.";
    }
}

include "includes/header.php";
?>

<h2>Signup</h2>

<?php if($message): ?>
<div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Create Account</button>
</form>

<p><a href="login.php">Already have an account? Login</a></p>

<?php include "includes/footer.php"; ?>
