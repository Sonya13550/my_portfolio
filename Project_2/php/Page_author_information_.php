<?php
require_once('Baza.php'); 


$sql = "SELECT title, photo_path FROM create_a_job"; 


$stmt = sqlsrv_query($conn, $sql);


if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); 
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про автора</title>
    <link rel="stylesheet" href="../css/Page_author_information_.css"> 
</head>
<body>

<img src="../jpg/free-icon-man-236831.png" alt="Аватар користувача" class="avatar"> 

<br><br>
<center><h1>Інформація про автора</h1></center>


<h2>
    Я дуже творча людина, люблю писати картини. Творчість — для мене все.<br>
    З самого дитинства я почав малювати. Ходив у художню школу і хотів стати дизайнером,<br>
    але так сталося, що я захотів працювати для себе.
</h2>


<h2>Електронна пошта: <a href="mailto:vladyslav.hlyebov@kitu.nau.edu.ua">vladyslav.hlyebov@kitu.nau.edu.ua</a></h2>

<hr> 

<center><h2>Мої роботи</h2></center>
<div class="gallery">
    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?> 
        <?php if (!empty($row['photo_path'])) : ?> 
           
            <img src="../<?= htmlspecialchars($row['photo_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
        <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php 

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

</body>
</html>
