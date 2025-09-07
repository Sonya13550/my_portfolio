<?php

// Підключення до бази даних
require_once('Baza_data_1.php');

// Отримання даних з форми методом POST
$email = $_POST['email'];
$pass = $_POST['pass'];

// Перевірка, чи всі поля заповнені
if (empty($email) || empty($pass)) {
    echo("Не все заповнено !!! <br>");
} else {
    // Параметризований SQL-запит — захист від SQL-інʼєкцій
    $sql = "SELECT * FROM Users WHERE email = ? AND pass = ?";
    $params = array($email, $pass); // Параметри для запиту

    // Виконання запиту
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Перевірка на помилки виконання
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Вивід помилки
    }

    // Якщо знайдено користувача з таким логіном і паролем
    if (sqlsrv_has_rows($stmt)) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Вивід повідомлення про вдалий вхід
            echo '<script>
                    alert("Ласкаво просимо, ' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '!");
                  </script>';

            // Перенаправлення на сторінку користувача-письменника
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "../html/page_user_writer.html";
                    }, 0);
                  </script>';
        }
    } else {
        // Якщо користувача не знайдено
        echo("Немає такого користувача або пароль невірний !!! <br>");
        echo "Введіть логін і пароль знову <br>";

        // Перенаправлення на сторінку входу через 1 секунду
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../html/login_writer.html";
                }, 1000);
              </script>';
    }
}
?>
