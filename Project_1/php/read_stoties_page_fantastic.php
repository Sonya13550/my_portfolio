<?php
// Підключення до бази даних
require_once('Baza_data_1.php');

// SQL-запит для отримання всіх опублікованих історій жанру "fantastic", відсортованих за датою публікації (від новіших до старіших)
$query = "SELECT title, author, content, image_, genre, datecreated FROM stories 
          WHERE published = 1 AND genre = 'fantastic' ORDER BY datecreated DESC";

// Виконання запиту
$stmt = sqlsrv_query($conn, $query);

// Перевірка на помилки при виконанні запиту
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true)); // Вивід помилок, якщо запит не вдався
}
?>
