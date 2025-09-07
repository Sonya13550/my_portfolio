<?php

require_once('Baza.php'); 


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$sql = "SELECT title, genres, materials, description_, photo_path FROM create_a_job WHERE id = ?";
$stmt = sqlsrv_query($conn, $sql, [$id]);


if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформлення замовлення</title>
</head>
<body>

<link rel="stylesheet" href="../css/To_create_to_order.css">
      

<center><h2>Оформлення замовлення</h2></center>


<form action="create_order.php" method="post">
  
    <center><label for="email">Пошта:</label><br>
    <input type="email" id="email" name="email" ><br><br></center>

  
    <center><label for="phone">Телефон:</label><br>
    <input type="text" id="phone" name="phone"><br><br></center>

   
    <center><label for="delivery">Доставка:</label><br>
    <input type="text" id="delivery" name="delivery" ><br><br></center>

  
    <center><label for="payment">Оплата:</label><br>
    <select name="payment" id="payment">
        <option value="на місці">На місці</option>
        <option value="онлайн">Онлайн</option>
    </select><br><br></center>

  
    <center><label for="buyer">Покупець:</label><br>
    <input type="text" id="buyer" name="buyer" ><br><br></center>


    <center><label for="receiver">Отримувач:</label><br>
    <input type="text" id="receiver" name="receiver" ><br><br></center>

    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
       
        <input type="hidden" name="title" value="<?= htmlspecialchars($row['title']) ?>">
        <input type="hidden" name="photo_path" value="<?= htmlspecialchars($row['photo_path']) ?>">


        <center><h3>Назва: <?= htmlspecialchars($row['title']) ?></h3></center>
        <center><p><strong>Жанр:</strong> <?= htmlspecialchars($row['genres']) ?></p></center>
        <center><p><strong>Матеріали:</strong> <?= htmlspecialchars($row['materials']) ?></p></center>
        <center><p><strong>Опис:</strong> <?= htmlspecialchars($row['description_']) ?></p></center>

     
        <?php if (!empty($row['photo_path'])) : ?>
            <center><img src="../<?= htmlspecialchars($row['photo_path']) ?>" alt="Картина"></center>
        <?php endif; ?>

      
        <center><button type="submit">Підтвердити замовлення</button></center>
    <?php endwhile; ?>

</form>

<?php 

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

</body>
</html>
