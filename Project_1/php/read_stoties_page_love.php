<?php
require_once('Baza_data_1.php'); // Підключення до бази даних

// SQL-запит для отримання опублікованих історій жанру "kohannya" (любов)
$query = "SELECT title, author, content, image_, genre, datecreated FROM stories 
          WHERE published = 1 AND genre = 'kohannya' ORDER BY datecreated DESC";

$stmt = sqlsrv_query($conn, $query);

// Перевірка на помилки виконання запиту
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true)); // Якщо є помилки, виводимо їх
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Історії про любов</title>
    <style>
        body {
            background-color: Olive; /* Колір фону */
            font-family: Arial, sans-serif; /* Шрифт для всього тексту */
            padding: 20px;
        }
        h1 {
            color: rgb(0, 0, 0); /* Колір заголовка */
        }
        h2 {
            color: black;
            text-align: right; /* Вирівнювання тексту вправо */
        }
        h3 {
            color: black;
            text-align: left; /* Вирівнювання тексту вліво */
        }
        .date, .genre {
            text-align: right; /* Вирівнювання дати та жанру вправо */
        }
        .date h2, .genre h3 {
            margin: 0; /* Відсутність відступів */
        }
        label{
            width: 20px;
        }
        img {
            display: block;
            margin: 20px auto; /* Центрування зображення */
            max-width: 100%; /* Максимальна ширина 100% */
            height: auto; /* Автоматичне визначення висоти */
            border: 1px solid #ccc; /* Рамка навколо зображення */
        }
        .comment {
            padding: 10px;
            margin-top: 15px;
        }
        button {
            padding: 15px 30px;  /* Увеличення відступів */
            font-size: 15px;      /* Збільшення шрифта */
            background-color: #4CAF50; /* Зелений фон кнопки */
            color: white;         /* Білий текст на кнопці */
            border: none;         /* Без рамки */
            border-radius: 5px;   /* Закруглені кути кнопки */
            cursor: pointer;      /* Курсор у вигляді руки */
            transition: background-color 0.3s ease; /* Плавна зміна фону */
        }
        .comment small {
            color: black;
        }
    </style>
</head>
<body>

<?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
    <!-- Виведення автора історії -->
    <h2>Автор: <?= htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8') ?></h2>

    <!-- Виведення дати публікації історії з перевіркою на наявність -->
    <p><strong>Дата:</strong> 
        <?php
        if (!empty($row['DateCreated'])) {
            // Перевірка, чи є дата об'єктом DateTime
            if ($row['DateCreated'] instanceof DateTime) {
                echo $row['DateCreated']->format('Y-m-d H:i:s');
            } else {
                // Преобразування рядка в DateTime
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $row['DateCreated']);
                if ($date) {
                    echo $date->format('Y-m-d H:i:s');
                } else {
                    echo "Помилка формату дати";
                }
            }
        } else {
            echo "Дата не вказана"; // Якщо дата не вказана
        }
        ?>
    </p>

    <!-- Виведення жанру історії -->
    <p><strong>Жанр:</strong> <?= htmlspecialchars($row['Genre'], ENT_QUOTES, 'UTF-8') ?></p>

    <!-- Виведення вмісту історії з переведенням рядків -->
    <p><?= nl2br(htmlspecialchars($row['Content'], ENT_QUOTES, 'UTF-8')) ?></p>

    <!-- Форма для додавання коментарів -->
    <form action="add_comment.php" method="POST">
        <input type="hidden" name="story_author" value="<?= htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8') ?>">
        <label for="author">Ім'я:</label>
        <br>
        <input type="text" name="author" required>
        <br>
        <label for="comment">Коментарій:</label>
        <br>
        <textarea name="comment" required></textarea>
        <br><br>
        <button type="submit">Опублікувати</button>
    </form>

    <!-- Виведення коментарів до історії -->
    <h3>Коментарі:</h3>
    <?php
    // Збереження автора історії для запиту коментарів
    $story_author = $row['Author'];
    $comment_query = "SELECT author, comment_text, created_at FROM comments WHERE story_author = ? ORDER BY created_at DESC";
    $comment_stmt = sqlsrv_query($conn, $comment_query, array($story_author));

    if ($comment_stmt) {
        // Виведення кожного коментаря
        while ($comment = sqlsrv_fetch_array($comment_stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<div style='border-top: 1px solid gray; padding: 5px;'>";
            echo "<strong>" . htmlspecialchars($comment['author'], ENT_QUOTES, 'UTF-8') . "</strong> ";

            // Виведення дати коментаря з перевіркою
            if (!empty($comment['created_at'])) {
                if ($comment['created_at'] instanceof DateTime) {
                    echo "<small>" . $comment['created_at']->format('Y-m-d H:i:s') . "</small>";
                } else {
                    $comment_date = DateTime::createFromFormat('Y-m-d H:i:s', $comment['created_at']);
                    if ($comment_date) {
                        echo "<small>" . $comment_date->format('Y-m-d H:i:s') . "</small>";
                    } else {
                        echo "<small>Помилка формату дати</small>";
                    }
                }
            } else {
                echo "<small>Дата не вказана</small>";
            }

            // Виведення тексту коментаря
            echo "<br>" . nl2br(htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8')) . "<br>";
            echo "</div>";
        }
    }
    ?>
<?php endwhile; ?>

</body>
</html>
