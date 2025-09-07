<?php
require_once('Baza_data_1.php'); 


$query = "SELECT title, author, content, image_, genre, datecreated FROM stories 
          WHERE published = 1 AND genre = 'kohannya' ORDER BY datecreated DESC";

$stmt = sqlsrv_query($conn, $query);


if (!$stmt) {
    die(print_r(sqlsrv_errors(), true)); 
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Історії про любов</title>
    <style>
        body {
            background-color: Olive; 
            font-family: Arial, sans-serif; 
            padding: 20px;
        }
        h1 {
            color: rgb(0, 0, 0); 
        }
        h2 {
            color: black;
            text-align: right; 
        }
        h3 {
            color: black;
            text-align: left; 
        }
        .date, .genre {
            text-align: right;
        }
        .date h2, .genre h3 {
            margin: 0; 
        }
        label{
            width: 20px;
        }
        img {
            display: block;
            margin: 20px auto; 
            max-width: 100%; 
            height: auto; 
            border: 1px solid #ccc; 
        }
        .comment {
            padding: 10px;
            margin-top: 15px;
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
        .comment small {
            color: black;
        }
    </style>
</head>
<body>

<?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>

    <h2>Автор: <?= htmlspecialchars($row['Author'], ENT_QUOTES, 'UTF-8') ?></h2>


    <p><strong>Дата:</strong> 
        <?php
        if (!empty($row['DateCreated'])) {
        
            if ($row['DateCreated'] instanceof DateTime) {
                echo $row['DateCreated']->format('Y-m-d H:i:s');
            } else {
             
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $row['DateCreated']);
                if ($date) {
                    echo $date->format('Y-m-d H:i:s');
                } else {
                    echo "Помилка формату дати";
                }
            }
        } else {
            echo "Дата не вказана"; 
        }
        ?>
    </p>


    <p><strong>Жанр:</strong> <?= htmlspecialchars($row['Genre'], ENT_QUOTES, 'UTF-8') ?></p>


    <p><?= nl2br(htmlspecialchars($row['Content'], ENT_QUOTES, 'UTF-8')) ?></p>

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


    <h3>Коментарі:</h3>
    <?php

    $story_author = $row['Author'];
    $comment_query = "SELECT author, comment_text, created_at FROM comments WHERE story_author = ? ORDER BY created_at DESC";
    $comment_stmt = sqlsrv_query($conn, $comment_query, array($story_author));

    if ($comment_stmt) {
 
        while ($comment = sqlsrv_fetch_array($comment_stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<div style='border-top: 1px solid gray; padding: 5px;'>";
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
    ?>
<?php endwhile; ?>

</body>
</html>

