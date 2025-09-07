<?php
// Підключення до бази даних
require_once('Baza_data_1.php');

// SQL-запит: отримати всі опубліковані історії жанру "Android", відсортовані за датою створення (від новіших до старіших)
$query = "SELECT title, author, content, image_, genre, datecreated FROM stories 
          WHERE published = 1 AND genre = 'Android' ORDER BY datecreated DESC";

// Виконання SQL-запиту
$stmt = sqlsrv_query($conn, $query);

// Якщо сталася помилка — показати її
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Історії про андроїдів</title>
    <style>
        /* Стилізація сторінки */
        body {
            background-color: Olive;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1, h2, h3 {
            color: black;
        }
        .date, .genre {
            text-align: right;
        }
        img {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
        }
        button {
            padding: 15px 30px;
            font-size: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .comment {
            padding: 10px;
            margin-top: 15px;
        }
        .comment small {
            color: black;
        }
    </style>
</head>
<body>
