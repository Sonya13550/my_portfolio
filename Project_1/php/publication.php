<?php

// Підключення до бази даних
require_once('Baza_data_1.php');

// CSS-стилі для сторінки
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
$title = "";  // Змінна для заголовку

// Перевірка, чи переданий жанр через GET-запит
if (isset($_GET['genre'])) {
    $genre = trim($_GET['genre']);

    // Якщо жанр порожній
    if (empty($genre)) {
        die("<center><h2>Будь ласка, оберіть жанр.</h2></center>");
    }

    // Запит до бази даних для отримання історії за жанром
    $query = "SELECT Title, Author, Content FROM Stories WHERE Genre = ?";
    $stmt = sqlsrv_query($conn, $query, array($genre));

    // Обробка помилки запиту
    if ($stmt === false) {
        die("<center><h2>Помилка запиту: </h2>" . print_r(sqlsrv_errors(), true) . "</center>");
    }

    // Отримання одного рядка з результату
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
    if ($row) {
        // Заповнення змінних даними з БД
        $title = $row['Title'];
        $author = $row['Author'];
        $content = $row['Content'];
    } else {
        die("<center><h2>Історію не знайдено.</h2></center>");
    }

} else {
    // Якщо жанр не вибрано, показати список доступних жанрів
    $query = "SELECT DISTINCT Genre FROM Stories";
    $stmt = sqlsrv_query($conn, $query);

    // Обробка помилки запиту жанрів
    if ($stmt === false) {
        die("<center><h2>Помилка запиту жанрів:</h2>" . print_r(sqlsrv_errors(), true) . "</center>");
    }

    // Виведення HTML-форми для вибору жанру
    echo "<div class='center'><h2>Оберіть жанр </h2>";
    echo "<form method='get'>";
    echo "<select name='genre'>";
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $genreOption = htmlspecialchars($row['Genre'], ENT_QUOTES, 'UTF-8');
        echo "<option value='$genreOption'>$genreOption</option>";
    }
    echo "</select><br><br>";
    echo "<button type='submit'>Обрати жанр</button>";
    echo "</form></div>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Публікація історій</title>
</head>
<body>
    <center><h1>Публікація історій</h1></center>

    <!-- Форма публікації -->
    <form method="POST" action="publish_story.php">
        
        <div class="center">
            <!-- Приховане поле з жанром -->
            <input type="hidden" name="genre" value="<?= htmlspecialchars($genre, ENT_QUOTES, 'UTF-8') ?>">
            <h2><label for="title">Заголовок:</label></h2>
            <!-- Поле заголовка -->
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"><br>
        </div>

        <div class="center">
            <!-- Поле автора -->
            <label>Автор:</label><br>
            <input type="text" name="author" value="<?= htmlspecialchars($author, ENT_QUOTES, 'UTF-8') ?>"><br><br>
            
            <!-- Текстова область для змісту -->
            <label>Текст історії:</label><br>
            <textarea name="content" rows="10" cols="50"><?= htmlspecialchars($content, ENT_QUOTES, 'UTF-8') ?></textarea><br><br>
            
            <!-- Кнопка надсилання -->
            <button class="button" type="submit">Опублікувати</button><br><br>
        </div>
    </form>
</body>
</html>
