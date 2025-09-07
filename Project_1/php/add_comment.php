<?php
require_once('Baza_data_1.php'); // Підключення файлу з налаштуваннями підключення до бази даних

// Встановлюємо часовий пояс для України
date_default_timezone_set('Europe/Kiev');

// Перевіряємо, чи була надіслана форма методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо значення з форми і очищуємо від зайвих пробілів
    $author = isset($_POST['author']) ? trim($_POST['author']) : null;
    $comment_text = isset($_POST['comment']) ? trim($_POST['comment']) : null;
    $story_author = isset($_POST['story_author']) ? trim($_POST['story_author']) : null;

    // Отримуємо поточну дату і час у форматі "Y-m-d H:i:s"
    $created_at = date("Y-m-d H:i:s");

    // Перевіряємо, чи заповнені всі необхідні поля
    if (!empty($author) && !empty($comment_text) && !empty($story_author)) {
        // SQL-запит для додавання нового коментаря
        $query = "INSERT INTO comments (author, comment_text, story_author, created_at) VALUES (?, ?, ?, ?)";

        // Параметри для запиту
        $params = array($author, $comment_text, $story_author, $created_at);

        // Виконання запиту
        $stmt = sqlsrv_query($conn, $query, $params);

        // Якщо запит виконано успішно, перенаправляємо користувача на попередню сторінку
        if ($stmt) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit(); // Завершуємо скрипт після перенаправлення
        } else {
            // Якщо сталася помилка, виводимо її
            echo "Помилка при додавання коментаря: " . print_r(sqlsrv_errors(), true);
        }
    } else {
        // Якщо хоча б одне поле не заповнене
        echo "Заповніть всі поля!";
    }
}
?>
