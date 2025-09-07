<?php

require_once('Baza.php');


$updated = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {


    foreach ($_POST['status'] as $id => $newStatus) {

        $updateSql = "UPDATE [order] SET status_ = ? WHERE id = ?";
        $params = [$newStatus, $id];
        $updateStmt = sqlsrv_query($conn, $updateSql, $params);

        if ($updateStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    $updated = true;
}


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
    <title>Список замовлень</title>

    <link rel="stylesheet" href="../css/admin_page.css">
</head>
<body>

<?php if ($updated): ?>
    <script>
        alert("Статус оновлений!");
    </script>
<?php endif; ?>

<button onclick="window.location.href='../html/page.page.html'">Вихід</button>

<h2>Список замовлень</h2>

<form method="post">
    <table>
        <tr>
            <th>Email</th>
            <th>Телефон</th>
            <th>Доставка</th>
            <th>Оплата</th>
            <th>Покупець</th>
            <th>Отримувач</th>
            <th>Статус</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['delivery']) ?></td>
                <td><?= htmlspecialchars($row['payment']) ?></td>
                <td><?= htmlspecialchars($row['buyer']) ?></td>
                <td><?= htmlspecialchars($row['receiver']) ?></td>
                <td>
                    <select name="status[<?= $row['id'] ?>]">
                        <option value="1" <?= $row['status_'] == 1 ? 'selected' : '' ?>>Підтверджено</option>
                        <option value="2" <?= $row['status_'] == 2 ? 'selected' : '' ?>>Відхилено</option>
                    </select>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <button type="submit">Оновити статуси</button>
</form>

<?php

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
</body>
</html>
