<?php
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

function generateCode($length = 6) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

$user_id = $_SESSION["user_id"];
$title = trim($_POST["title"]);
$original_url = trim($_POST["original_url"]);

$short_code = generateCode();

$check = $conn->query("SELECT id FROM links WHERE short_code = '$short_code'");
while ($check->num_rows > 0) {
    $short_code = generateCode();
    $check = $conn->query("SELECT id FROM links WHERE short_code = '$short_code'");
}

$stmt = $conn->prepare("INSERT INTO links (user_id, original_url, short_code, title) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $original_url, $short_code, $title);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>
