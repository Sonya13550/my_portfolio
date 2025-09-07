<?php
require_once('Baza_data_1.php');


$content = trim($_POST['content']);
$author = trim($_POST['author']);
$genre = isset($_POST['genre']) ? trim($_POST['genre']) : ''; 
$title = trim($_POST['title']);
$image_ = isset($_POST['image_']) ? trim($_POST['image_']) : ''; 

$dateCreated = date('Y-m-d H:i:s');


if (empty($content) || empty($author) || empty($genre) || empty($title) || empty($image_)) {
    echo '<div style="text-align: center; color: red; font-weight: bold;">Не всі поля заповнені!</div>';
    exit;
}

$checkQuery = "SELECT COUNT(*) AS count FROM Stories WHERE content = ?";
$checkStmt = sqlsrv_query($conn, $checkQuery, array($content));

if ($checkStmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);
$count = $row['count'];

if ($count > 0) {
    echo '<div style="text-align: center; color: red; font-weight: bold;">Така історія вже існує!</div>';
    exit;
}


$insertQuery = "INSERT INTO Stories (content, author, dateCreated, genre, title, image_) VALUES (?, ?, ?, ?, ?, ?)";
$params = array($content, $author, $dateCreated, $genre, $title, $image_);

$insertStmt = sqlsrv_query($conn, $insertQuery, $params);

if ($insertStmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


header('Location: create_stories.php?success=true');
exit;

