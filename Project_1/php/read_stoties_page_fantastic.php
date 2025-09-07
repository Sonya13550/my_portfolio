<?php

require_once('Baza_data_1.php');

$query = "SELECT title, author, content, image_, genre, datecreated FROM stories 
          WHERE published = 1 AND genre = 'fantastic' ORDER BY datecreated DESC";


$stmt = sqlsrv_query($conn, $query);


if (!$stmt) {
    die(print_r(sqlsrv_errors(), true)); 
}
?>

