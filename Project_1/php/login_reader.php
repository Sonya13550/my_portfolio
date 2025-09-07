<?php

// Підключаємо файл для з'єднання з базою даних
require_once('Baza_data_1.php');

// Отримуємо дані з форми методом POST
$email = $_POST['email'];
$pass = $_POST['pass'];

// Перевірка, чи всі поля заповнені
if (empty($email) || empty($pass)) {
    echo("Не все заповнено !!! <br>");
} else {
    // SQL-запит на перевірку наявності користувача з таким email та паролем
    $sql = "SELECT * FROM Users WHERE ((email = '$email') AND (pass = '$pass'))";

    // Виконання запиту
    $stmt = sqlsrv_query($conn, $sql);

    // Перевірка, чи був запит успішно виконаний
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Вивід помилки у разі невдачі
    }

    // Перевірка, чи знайдено хоча б один рядок (користувача)
    if (sqlsrv_has_rows($stmt)) {
        // Якщо знайдено користувача, вітаємо його
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<script>
                    alert("Ласкаво просимо, ' . $row['email'] . '!");
                  </script>';

            // Перенаправлення користувача на сторінку читача
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "../html/page_user_reader.html";
                    }, 0000); // миттєво
                  </script>';
        }
    } else {
        // Якщо користувача не знайдено або пароль неправильний
        echo("Немає такого користувача або пароль невірний !!! <br>");
        echo "Введіть логін і пароль знову <br>";

        // Перенаправлення назад на сторінку входу через 1 секунду
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../html/register_reader.html";
                }, 1000);
              </script>';
    }
}
?>
