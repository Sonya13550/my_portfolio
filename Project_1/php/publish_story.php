<?php
// Підключення до бази даних
require_once('Baza_data_1.php');

// Перевірка, що форма була надіслана методом POST і всі потрібні поля заповнені
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['title'], $_POST['author'], $_POST['content'], $_POST['genre'])) {
    
    // Отримання та обрізання пробілів з вхідних даних
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $content = trim($_POST['content']);
    $genre = trim($_POST['genre']);
    
    // Підготовлений SQL-запит для оновлення історії:
    // Встановлюємо ознаку, що історія опублікована (published = 1)
    // та дату публікації (published_at = GETDATE())
    $query = "UPDATE Stories SET published = 1, published_at = GETDATE() 
              WHERE title = ? AND author = ? AND content = ? AND genre = ?";
    
    // Параметри, які підставляються у запит
    $params = array($title, $author, $content, $genre);
    
    // Підготовка SQL-запиту
    $stmt = sqlsrv_prepare($conn, $query, $params);

    // Виконання запиту
    if (sqlsrv_execute($stmt)) {
        // Якщо успішно — виводимо повідомлення та перенаправляємо на сторінку користувача
        echo '<script>
            alert("Історія опублікована!");
        </script>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../html/page_user_writer.html";
            }, 0000);
        </script>';
        exit();
    } else {
        // У разі помилки — виводимо інформацію про помилку
        echo "Помилка при публікації: " . print_r(sqlsrv_errors(), true);
    }
}
?>
