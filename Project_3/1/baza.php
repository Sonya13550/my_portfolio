<?php
$host = "";
$user = "";
$password = "";
$dbname = "";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB error: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
