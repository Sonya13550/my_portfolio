<?php
require_once('Baza.php');

$sql = "SELECT id, email, phone, delivery, payment, buyer, receiver, status_ FROM [order]";

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Повідомлення</title>
    <link rel="stylesheet" href="../css/notifications.css">
</head>
<body>

    <h2>Повідомлення</h2>

    <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
        <div class="order-box">
            <h4>Email:</h4> <?= htmlspecialchars($row['email'] !== null ? $row['email'] : '') ?><br>
            <h4>Телефон:</h4> <?= htmlspecialchars($row['phone'] !== null ? $row['phone'] : '') ?><br>
            <h4>Доставка:</h4> <?= htmlspecialchars($row['delivery'] !== null ? $row['delivery'] : '') ?><br>
            <h4>Оплата:</h4> <?= htmlspecialchars($row['payment'] !== null ? $row['payment'] : '') ?><br>
            <h4>Покупець:</h4> <?= htmlspecialchars($row['buyer'] !== null ? $row['buyer'] : '') ?><br>
            <h4>Отримувач:</h4> <?= htmlspecialchars($row['receiver'] !== null ? $row['receiver'] : '') ?><br>
            <h4>Статус:</h4> <?= htmlspecialchars($row['status_'] !== null ? $row['status_'] : '') ?><br>
        </div>
    <?php endwhile; ?>

    <?php sqlsrv_free_stmt($stmt); sqlsrv_close($conn); ?>
</body>
</html>