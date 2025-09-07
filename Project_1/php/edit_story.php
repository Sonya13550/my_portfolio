<?php

// Підключаємо файл із з'єднанням до бази даних
require_once('Baza_data_1.php');

// Додаємо стилі CSS безпосередньо в HTML через echo
echo "<style>
body { background-color: rgb(10, 169, 69); }
.center {
    text-align: center;
    margin-top: 20px;
}
.custom-select img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 20px;
}
input, textarea {
    background-color: darkcyan;
    border: darkcyan;
}
button {
    background-color: darkgoldenrod;
    border: darkgoldenrod;
}
</style>";

// Ініціалізація змінних
$genre = "";
$author = "";
$content = "";
$title = "";  // Змінна для зберігання заголовка

// Перевіряємо, чи передано параметр 'genre' через GET-запит
if (isset($_GET['genre'])) {
    $genre = trim($_GET['genre']); // Жанр може бути пустим, це нормально

    // Підготовка запиту до бази з урахуванням, що жанр може бути пустим
    if ($genre === '') {
        // Запит для пустого жанру (Genre NULL або порожній рядок)
        $query = "SELECT Title, Author, Content FROM Stories WHERE Genre IS NULL OR Genre = ''";
        $stmt = sqlsrv_query($conn, $query);
    } else {
        $query = "SELECT Title, Author, Content FROM Stories WHERE Genre = ?";
        $stmt = sqlsrv_query($conn, $query, array($genre));
    }

    // Перевірка на помилку запиту
    if ($stmt === false) {
        die("<center><h2>Помилка запиту: </h2>" . print_r(sqlsrv_errors(), true) . "</center>");
    }

    // Отримуємо перший рядок результату
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        // Записуємо значення в змінні
        $title = $row['Title'];
        $author = $row['Author'];  
        $content = $row['Content']; 
    } else {
        // Якщо історія не знайдена
        die("<center><h2>Жанр не обраний! Будь ласка оберіть жанр</h2></center>");
    }

} else {
    // Якщо жанр не передано, показуємо список доступних жанрів

    $query = "SELECT DISTINCT Genre FROM Stories";
    $stmt = sqlsrv_query($conn, $query);

    // Перевірка на помилку запиту
    if ($stmt === false) {
        die("<center><h2>Помилка запиту жанрів:</h2>" . print_r(sqlsrv_errors(), true) . "</center>");
    }

    // Форма для вибору жанру
    echo "<div class='center'><h2>Оберіть жанр для редагування</h2>";
    echo "<form method='get'>";
    echo "<select name='genre'>";
    
    // Додаємо порожній жанр у список
    echo "<option value=''>Без жанру</option>";

    // Додаємо кожен жанр у випадаючий список
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $genreOption = htmlspecialchars($row['Genre'], ENT_QUOTES, 'UTF-8');
        echo "<option value='$genreOption'>$genreOption</option>";
    }

    echo "</select><br><br>";
    echo "<button type='submit'>Редагувати</button>";
    echo "</form></div>";
    exit; // Завершуємо виконання скрипту після виведення форми
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагування історії</title>
</head>
<body>
    <!-- Форма редагування історії -->
    <form action="../php/save_story.php" method="POST" enctype="multipart/form-data">
        <div class="form-container">
            <div class="center">
                <h2>Редагування історії</h2>
            </div>
            <div class="center">
                <!-- Приховане поле для передачі жанру -->
                <input type="hidden" name="genre" value="<?= htmlspecialchars($genre, ENT_QUOTES, 'UTF-8') ?>">
                
                <!-- Поле для заголовка -->
                <h2><label for="title">Змінити заголовок:</label></h2>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"><br>
            </div>
            <div class="center">
                <!-- Поле для автора -->
                <label>Автор:</label><br>
                <input type="text" name="author" value="<?= htmlspecialchars($author, ENT_QUOTES, 'UTF-8') ?>"><br><br>
                
                <!-- Поле для тексту історії -->
                <label>Текст історії:</label><br>
                <textarea name="content" rows="10" cols="50"><?= htmlspecialchars($content, ENT_QUOTES, 'UTF-8') ?></textarea><br><br>
                
                <!-- Кнопка збереження -->
                <button class="button" type="submit">Зберегти зміни</button><br><br>
            </div>
        </div>
    </form>

    <!-- Скрипт (можна видалити або допрацювати) -->
    <script>
        function updateSelection(imgSrc, text) {
            document.getElementById("selected-img").src = imgSrc;
        }
    </script>
</body>
</html>
