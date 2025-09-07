<?php
require_once('Baza_data_1.php'); // Підключаємо файл з налаштуваннями підключення до бази даних

// Стилізуємо сторінку
echo "<style>
body { background-color: rgba(8, 94, 23, 0.73);}
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Перевіряємо, чи був надісланий POST-запит
    // Отримуємо дані з форми
    $genre = $_POST['genre'] ?? ''; // Якщо genre не задано, то присвоюємо порожній рядок
    $author = $_POST['author'] ?? ''; // Якщо author не задано, то присвоюємо порожній рядок
    $content = $_POST['content'] ?? ''; // Якщо content не задано, то присвоюємо порожній рядок
    
    // Перевіряємо, чи було завантажено нове зображення
    if (!empty($_FILES['selected-image']['name'])) {
        // Якщо зображення було завантажено, то зберігаємо його
        $image_ = $_FILES['selected-image']['name']; // Отримуємо назву файлу зображення
        move_uploaded_file($_FILES['selected-image']['tmp_name'], "../images/" . $image_); // Переміщаємо завантажений файл до папки images
    } else {
        // Якщо зображення не було завантажено, беремо існуюче зображення з бази даних
        $query = "SELECT image_ FROM Stories WHERE Genre = ?"; // Запит для отримання зображення по жанру
        $stmt = sqlsrv_query($conn, $query, array($genre)); // Виконуємо запит

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Якщо сталася помилка, виводимо її
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); // Отримуємо результат запиту
        $image_ = $row['image_']; // Встановлюємо старе зображення
    }

    // Перевірка на порожні поля
    if (empty($genre) || empty($author) || empty($content)) {
        die("<h2 style='text-align:center; color: red;'>Помилка: усі поля повинні бути заповнені!</h2>");
        // Якщо одне з полів порожнє, виводимо помилку
    }

    // Запит для оновлення історії в базі даних
    $query = "UPDATE Stories SET Author = ?, Content = ?, DateCreated = GETDATE(), image_ = ? WHERE Genre = ?";
    $params = array($author, $content, $image_, $genre); // Массив параметрів для запиту

    $stmt = sqlsrv_query($conn, $query, $params); // Виконуємо запит на оновлення

    if ($stmt) {
        // Якщо запит успішний, виводимо повідомлення про успіх і через 2 секунди перенаправляємо на іншу сторінку
        echo "<h2 style='text-align:center; color: yellow;'>Історія успішно оновлена!</h2>";
        echo "<script>setTimeout(() => window.location.href = '../html/page_user_writer.html', 2000);</script>"; 
        exit; // Завершуємо виконання коду після перенаправлення
    } else {
        // Якщо сталася помилка при виконанні запиту, виводимо її
        die(print_r(sqlsrv_errors(), true));
    }
}
?>
