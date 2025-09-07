<?php
require_once('Baza_data_1.php'); 

$query = "SELECT title, author, content, image_, genre, datecreated FROM Stories 
          WHERE published = 1 AND genre = 'horror' ORDER BY datecreated DESC";

$stmt = sqlsrv_query($conn, $query);


if (!$stmt) {
    die(print_r(sqlsrv_errors(), true)); 
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Історії жахів</title>
    <link rel="stylesheet" href="../css/read_stoties_page_horror.css"> 
</head>
<body>
      <p class="back">
    <button onclick="window.location.href='../html/page_user_reader.html'">Назад</button>
  </p>
    <center><h1>Історії жахів</h1></center>

    <?php

    if (sqlsrv_has_rows($stmt)) {

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
           
            if ($row['image_']) {
                echo "<img src='" . htmlspecialchars($row['image_'], ENT_QUOTES, 'UTF-8') . "' alt='Зображення історії' style='width: 270px; height: 400px;'>";
            }
            
        
            $datecreated = $row['datecreated'] ? $row['datecreated']->format('Y-m-d H:i:s') : 'Невідома дата';

         
            echo "<h1><center>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</center></h1>";
            echo "<style> h3.author { text-align: right; } </style><h3 class='author'><strong>Автор:</strong> " . htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') . "</h3>";
            echo "<h2><p class='genre'><strong>Жанр:</strong> " . htmlspecialchars($row['genre'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p class='date'><strong>Дата публікації:</strong> " . $datecreated . "</p>";
            
          
            echo "<style> p { text-align: left; } </style><h3><p>" . nl2br(htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8')) . "</p></h3>";

       
echo '<form action="add_comment.php" method="POST">
    <input type="hidden" name="story_author" value="' . htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') . '">
    <label>Ім\'я:</label><br>
    <input type="text" name="author" placeholder="Ваше ім’я" required><br><br>

    <label for="comment">Коментарій:</label><br>
    <textarea name="comment" required></textarea><br><br>

    <button type="submit">Опублікувати</button>
</form>';



         
            echo "<h4>Коментарі:</h4>";
           
            $comment_query = "SELECT author, comment_text, created_at FROM comments ORDER BY created_at DESC"; // SQL-запит для коментарів
            $comment_stmt = sqlsrv_query($conn, $comment_query);

            if ($comment_stmt) {
            
                while ($comment = sqlsrv_fetch_array($comment_stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<div class='comment'>";
                    echo "<strong>" . htmlspecialchars($comment['author'], ENT_QUOTES, 'UTF-8') . "</strong> ";
                    
                
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

                    echo "<br>" . nl2br(htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8')) . "<br>";
                    echo "</div>";
                }
            }
        }
    } else {
      
        echo "<p>Історій не знайдено.</p>";
    }

    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn); 
    ?>

</body>
</html>

