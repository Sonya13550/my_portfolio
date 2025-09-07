<?php

require_once('Baza.php');


$sql = "SELECT id, title, genres, materials, description_, photo_path FROM create_a_job";
$stmt = sqlsrv_query($conn, $sql);


if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


$selectedId = isset($_GET['selected']) ? (int)$_GET['selected'] : null;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Картини</title>

    <link rel="stylesheet" href="../css/revision.css">
</head>
<body>
<center><h2>Картини</h2></center>

<?php

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
    <div class="card">

        <h2>Назва: <?= htmlspecialchars($row['title']) ?></h2>
        
 
        <h2><p><strong>Жанр:</strong> <?= htmlspecialchars($row['genres']) ?></p></h2>
        

        <h2><p><strong>Матеріали:</strong> <?= htmlspecialchars($row['materials']) ?></p></h2>
        

        <h2><p><strong>Опис:</strong> <?= htmlspecialchars($row['description_']) ?></p></h2>

        <?php if (!empty($row['photo_path'])) : ?>

            <img src="../<?= htmlspecialchars($row['photo_path']) ?>" alt="Картина">
        <?php endif; ?>


        <?php if ($selectedId === $row['id']) : ?>
            <p style="color: green; font-weight: bold;">✅ Ви обрали цю картину для оформлення!</p>
        <?php endif; ?>


        <button class="order-button" onclick="window.location.href='../php/To_create_to_order.php?id=<?= $row['id'] ?>'">
            Оформити замовлення
        </button>
    </div>
<?php endwhile; ?>

<?php

sqlsrv_free_stmt($stmt); 
sqlsrv_close($conn);
?>
</body>
</html>
