<?php

require_once('Baza_data_1.php');

$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];

if (empty($email) || empty($pass)) {
    echo("Не все заповнено !!! <br>");
} else {
    $sql = "SELECT * FROM administrator WHERE ((last_name = '$last_name') AND (email = '$email') AND ($pass = '$pass'))";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt)) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo '<script>
                    alert("Ласкаво просимо, ' . $row['email'] . '!");
                  </script>';
            echo '<script>
            setTimeout(function() {
            window.location.href = "../php/admin.page.php";
                  }, 0000);
                </script>';

        }
    } else {
        echo("Немає такого користувача або пароль невірний !!! <br>");
        echo "Введіть логін і пароль знову <br>";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "admin_login.html";
                }, 1000);
              </script>';
    }
}
?>

