<?php

require_once('Baza_data_1.php');


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['title'], $_POST['author'], $_POST['content'], $_POST['genre'])) {
    
   
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $content = trim($_POST['content']);
    $genre = trim($_POST['genre']);
    
    $query = "UPDATE Stories SET published = 1, published_at = GETDATE() 
              WHERE title = ? AND author = ? AND content = ? AND genre = ?";
    
   
    $params = array($title, $author, $content, $genre);
    
  
    $stmt = sqlsrv_prepare($conn, $query, $params);

  
    if (sqlsrv_execute($stmt)) {
       
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
      
        echo "Помилка при публікації: " . print_r(sqlsrv_errors(), true);
    }
}
?>

