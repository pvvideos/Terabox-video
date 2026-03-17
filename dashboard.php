<?php
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

$result = $conn->query("SELECT * FROM links WHERE user_id = $user_id ORDER BY id DESC");

include "includes/header.php";
?>

<h2>Dashboard</h2>
<p>Welcome, <?php echo htmlspecialchars($user_name); ?></p>

<form method="POST" action="create_link.php">
    <input type="text" name="title" placeholder="Link title">
    <input type="url" name="original_url" placeholder="Enter destination URL" required>
    <button type="submit">Create Short Link</button>
</form>

<h3>Your Links</h3>

<?php while($row = $result->fetch_assoc()): ?>
    <div class="message">
        <strong><?php echo htmlspecialchars($row["title"]); ?></strong><br>
        Short: <a href="/<?php echo $row["short_code"]; ?>" target="_blank">
            https://provider-hub.com/<?php echo $row["short_code"]; ?>
        </a><br>
        Views: <?php echo $row["total_views"]; ?><br>
        Earnings: $<?php echo $row["earnings"]; ?>
    </div>
<?php endwhile; ?>

<p><a href="logout.php">Logout</a></p>

<?php include "includes/footer.php"; ?>
