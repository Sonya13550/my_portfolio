<?php
require_once('Baza_data_1.php'); 


echo "<style>
body { background-color: rgba(8, 94, 23, 0.73);}
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
    $genre = $_POST['genre'] ?? ''; 
    $author = $_POST['author'] ?? ''; 
    $content = $_POST['content'] ?? ''; 
    

    if (!empty($_FILES['selected-image']['name'])) {
       
        $image_ = $_FILES['selected-image']['name']; 
        move_uploaded_file($_FILES['selected-image']['tmp_name'], "../images/" . $image_); 
    } else {

        $query = "SELECT image_ FROM Stories WHERE Genre = ?"; 
        $stmt = sqlsrv_query($conn, $query, array($genre)); 

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); 
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $image_ = $row['image_'];
    }

    
    if (empty($genre) || empty($author) || empty($content)) {
        die("<h2 style='text-align:center; color: red;'>Помилка: усі поля повинні бути заповнені!</h2>");
        
    }

  
    $query = "UPDATE Stories SET Author = ?, Content = ?, DateCreated = GETDATE(), image_ = ? WHERE Genre = ?";
    $params = array($author, $content, $image_, $genre); 

    $stmt = sqlsrv_query($conn, $query, $params); 

    if ($stmt) {
    
        echo "<h2 style='text-align:center; color: yellow;'>Історія успішно оновлена!</h2>";
        echo "<script>setTimeout(() => window.location.href = '../html/page_user_writer.html', 2000);</script>"; 
        exit; 
    } else {
        
        die(print_r(sqlsrv_errors(), true));
    }
}
?>


