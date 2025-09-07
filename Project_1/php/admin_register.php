<?php
// Підключення файлу з налаштуваннями підключення до бази даних
require_once('Baza_data_1.php');

// Отримуємо дані з форми
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$passwd = $_POST['repeatpass']; // Використовуємо правильну змінну для повторного пароля

// Перевіряємо, чи всі поля заповнені
if (empty($last_name) || empty($first_name) || empty($email) || empty($pass) || empty($passwd)) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Не заповнено все !!! <br> Спробуйте знову <br>
          </div>';
    // Через 2 секунди перенаправляємо назад на сторінку реєстрації
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
    exit(); // Завершаємо виконання коду, якщо є помилка
}

// Перевіряємо, чи паролі співпадають
if ($pass !== $passwd) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Паролі не співпадають! <br> Введіть ще раз.
          </div>';
    // Перенаправляємо назад на сторінку реєстрації через 2 секунди
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
    exit(); // Завершаємо виконання коду при помилці
}

// Перевіряємо, чи вже існує адміністратор з таким ім'ям
$sql = "SELECT COUNT(*) as count FROM administrator WHERE first_name = ?";
$params = array($first_name);
$stmt = sqlsrv_query($conn, $sql, $params);

// Якщо є помилка при виконанні запиту, виводимо її
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Отримуємо кількість записів, де ім'я співпадає
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$count = $row['count'];

// Якщо такий користувач вже існує
if ($count > 0) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Такий користувач вже існує! <br> Введіть дані знову.
          </div>';
    // Перенаправляємо назад на сторінку реєстрації через 2 секунди
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
} else {
    // Якщо користувача не існує, хешуємо пароль для зберігання
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Додаємо нового адміністратора до бази даних
    $tsql = "INSERT INTO administrator (last_name, first_name, email, pass) VALUES (?, ?, ?, ?)";
    $params = array($last_name, $first_name, $email, $hashed_pass);
    $stmt = sqlsrv_query($conn, $tsql, $params);

    // Якщо вставка успішна, показуємо повідомлення і перенаправляємо на сторінку адміністратора
    if ($stmt) {
        echo '<script>
                alert("Вітаємо, ' . $first_name . '!");
                window.location.href = "../php/admin.page.php";
              </script>';
    } else {
        // Якщо виникла помилка при додаванні, виводимо її
        echo "Реєстрація неможлива....\n";
        die(print_r(sqlsrv_errors(), true));
    }
}
?>
