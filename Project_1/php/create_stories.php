<?php
header('Content-Type: text/html; charset=UTF-8');
require_once('Baza_data_1.php');


if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<script>
        alert("Історія додана!");
        setTimeout(function() {
            window.location.href = "../html/page_user_writer.html";
        }, 1000);
    </script>';
}


$query = "SELECT content, author, dateCreated, genre, title, image_ FROM Stories ORDER BY dateCreated DESC";
$stmt = sqlsrv_query($conn, $query);
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));

}
