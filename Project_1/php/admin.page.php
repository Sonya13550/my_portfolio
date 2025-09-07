<?php
require_once('Baza_data_1.php');


$query = "SELECT last_name, first_name, email FROM Users ORDER BY last_name ASC";
$stmt = sqlsrv_query($conn, $query);

if (!$stmt) {
    die("Ошибка запроса: " . print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Користувачі</title>
    <link rel="stylesheet" href="../css/table.css">
</head>
<body>
 
        <button class="exit-btn" onclick="exitAccount()">Вийти</button>

      
        <script>
            function exitAccount() {
                alert('Ви вийшли з облікового запису');  
                window.location.href = 'Home_stories.html';  
            }
        </script>
    <table>
        <caption>Користувачі</caption>
        <thead>
            <tr>
                <th>Прізвище</th>
                <th>Ім'я</th>
                <th>Електронна пошта</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php
    //Закриття бази
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
</body>
</html>

