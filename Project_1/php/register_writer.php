<?php 
require_once('Baza_data_1.php');

// Отримуємо дані з форми
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$repeatpass = $_POST['repeatpass'];

// Перевірка на порожні поля
if (empty($last_name) || empty($first_name) || empty($email) || empty($pass) || empty($repeatpass)) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Не заповнено все !!! <br> Спробуйте знову <br>
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/register_writer.html";
            }, 2000);
          </script>';
    exit;
}

// Перевірка на збіг паролів
if ($pass !== $repeatpass) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Паролі не співпадають !!! <br> Спробуйте знову <br>
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/register_writer.html";
            }, 2000);
          </script>';
    exit;
}

// Перевірка на наявність користувача
$sql = "SELECT COUNT(*) as count FROM Users WHERE first_name = ?";
$stmt = sqlsrv_query($conn, $sql, array($first_name));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); 
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$count = $row['count'];

if ($count > 0) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Такий користувач вже існує !!! <br>
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/register_writer.html";
            }, 2000);
          </script>';
    exit;
}

// Хешуємо пароль
$hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

// Вставляємо користувача
$tsql = "INSERT INTO Users ([last_name], [first_name], email, [pass]) VALUES (?, ?, ?, ?)";
$params = array($last_name, $first_name, $email, $hashed_pass);

$stmt = sqlsrv_query($conn, $tsql, $params);

if ($stmt) {
    echo '<script>
            alert("Ласкаво просимо, ' . htmlspecialchars($last_name) . '!");
          </script>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/page_user_writer.html";
            }, 0);
          </script>';
} else {
    echo "Реєстрація неможлива....\n";  
    die(print_r(sqlsrv_errors(), true));  
}
?>
