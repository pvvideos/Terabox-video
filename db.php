<?php
$host = "localhost";
$dbname = "providerhub";
$username = "provideruser";
$password = "ProviderHub@123";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

session_start();
?>
