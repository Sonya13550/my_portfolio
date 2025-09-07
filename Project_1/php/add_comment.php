<?php
require_once('Baza_data_1.php'); 


date_default_timezone_set('Europe/Kiev');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $author = isset($_POST['author']) ? trim($_POST['author']) : null;
    $comment_text = isset($_POST['comment']) ? trim($_POST['comment']) : null;
    $story_author = isset($_POST['story_author']) ? trim($_POST['story_author']) : null;

    $created_at = date("Y-m-d H:i:s");


    if (!empty($author) && !empty($comment_text) && !empty($story_author)) {

        $query = "INSERT INTO comments (author, comment_text, story_author, created_at) VALUES (?, ?, ?, ?)";

        $params = array($author, $comment_text, $story_author, $created_at);

       
        $stmt = sqlsrv_query($conn, $query, $params);

       
        if ($stmt) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit(); 
        } else {
           
            echo "Помилка при додавання коментаря: " . print_r(sqlsrv_errors(), true);
        }
    } else {
    
        echo "Заповніть всі поля!";
    }
}
?>
