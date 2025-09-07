<?php

require_once('Baza.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'] ?? "";
    $genres = $_POST['genres'] ?? []; 
    $description = $_POST['description_'] ?? "";
    $materials = $_POST['materials'] ?? "";


    if (empty($title) || empty($genres) || empty($description) || empty($materials) || empty($_FILES['photo_path']['name'])) {
        echo '<script>
            alert("Помилка: не всі поля заповнені.");
            setTimeout(function() {
                window.location.href = "../html/To_create_a_job.html";
            }, 2000);
        </script>';
        exit; 
    }

  
    $temp_upload_dir = __DIR__ . "/../jpg/"; 
    $final_upload_dir = __DIR__ . "/../create_a_job/"; 

 
    if (!file_exists($temp_upload_dir)) {
        mkdir($temp_upload_dir, 0777, true);
    }
    if (!file_exists($final_upload_dir)) {
        mkdir($final_upload_dir, 0777, true);
    }


    $imageFileType = strtolower(pathinfo($_FILES["photo_path"]["name"], PATHINFO_EXTENSION));


    if (getimagesize($_FILES["photo_path"]["tmp_name"]) === false) {
        echo "Помилка: Файл не є зображенням.";
        exit;
    }


    if ($_FILES["photo_path"]["size"] > 123000) {
        echo '<script>
            alert("Помилка: Файл занадто великий.");
            setTimeout(function() {
                window.location.href = "../html/To_create_a_job.html";
            }, 2000);
        </script>';
        exit;
    }


    $allowedFormats = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Помилка: Дозволені лише JPG, JPEG та PNG файли.";
        exit;
    }

 
    $unique_name = time() . "_" . uniqid() . "." . $imageFileType;
    $temp_file = $temp_upload_dir . $unique_name; 
    $final_file = $final_upload_dir . $unique_name; 

   
    if (!move_uploaded_file($_FILES["photo_path"]["tmp_name"], $temp_file)) {
        echo "Помилка: Не вдалося завантажити файл у тимчасову папку.";
        exit;
    }


    if (!rename($temp_file, $final_file)) {
        echo "Помилка: Не вдалося перемістити файл у кінцеву папку.";
        exit;
    }

  
    $photo_path = "create_a_job/" . $unique_name;


    $sql = "INSERT INTO create_a_job (title, genres, description_, materials, photo_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = sqlsrv_query($conn, $sql, array($title, implode(", ", $genres), $description, $materials, $photo_path));

 
    if ($stmt) {
        echo '<script>
            alert("Новий запис створено успішно.");
            setTimeout(function() {
                window.location.href = "../html/page_author_.html";
            }, 2000);
        </script>';
    } else {
        echo "Помилка при записі в базу: " . print_r(sqlsrv_errors(), true);
    }
} else {
   
    echo "Помилка: неправильний метод запиту.";
}
?>
