<?php
include "db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Wrong password.";
        }
    } else {
        $message = "User not found.";
    }
}

include "includes/header.php";
?>

<h2>Login</h2>

<?php if($message): ?>
<div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<form method="POST">
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<p><a href="signup.php">Create new account</a></p>

<?php include "includes/footer.php"; ?>
