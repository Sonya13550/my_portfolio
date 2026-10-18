<?php
$host = "localhost";
$user = "cha2690dc0_sofia_2026";
$password = "2eTuD2Gf2N";
$dbname = "cha2690dc0_site";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB error: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>