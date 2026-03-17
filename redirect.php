<?php
include "db.php";

$uri = trim($_SERVER["REQUEST_URI"], "/");

$ignore = ["index.php","login.php","signup.php","dashboard.php","create_link.php","logout.php","assets","includes","redirect.php"];
if ($uri == "" || in_array($uri, $ignore)) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT id, original_url FROM links WHERE short_code = ?");
$stmt->bind_param("s", $uri);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $link = $result->fetch_assoc();
    $link_id = $link["id"];
    $original_url = $link["original_url"];
    $ip = $_SERVER["REMOTE_ADDR"] ?? "";
    $agent = $_SERVER["HTTP_USER_AGENT"] ?? "";

    $stmt2 = $conn->prepare("INSERT INTO views (link_id, ip_address, user_agent, is_paid) VALUES (?, ?, ?, 0)");
    $stmt2->bind_param("iss", $link_id, $ip, $agent);
    $stmt2->execute();

    $conn->query("UPDATE links SET total_views = total_views + 1 WHERE id = $link_id");

    header("Location: " . $original_url);
    exit;
} else {
    echo "Link not found";
}
?>
