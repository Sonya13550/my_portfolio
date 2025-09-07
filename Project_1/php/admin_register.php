<?php

require_once('Baza_data_1.php');


$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$passwd = $_POST['repeatpass']; 


if (empty($last_name) || empty($first_name) || empty($email) || empty($pass) || empty($passwd)) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Не заповнено все !!! <br> Спробуйте знову <br>
          </div>';
   
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
    exit(); 
}


if ($pass !== $passwd) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Паролі не співпадають! <br> Введіть ще раз.
          </div>';
  
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
    exit();
}

$sql = "SELECT COUNT(*) as count FROM administrator WHERE first_name = ?";
$params = array($first_name);
$stmt = sqlsrv_query($conn, $sql, $params);


if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$count = $row['count'];


if ($count > 0) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Такий користувач вже існує! <br> Введіть дані знову.
          </div>';

    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/admin_register.html";
            }, 2000);
          </script>';
} else {
 
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);


    $tsql = "INSERT INTO administrator (last_name, first_name, email, pass) VALUES (?, ?, ?, ?)";
    $params = array($last_name, $first_name, $email, $hashed_pass);
    $stmt = sqlsrv_query($conn, $tsql, $params);

   
    if ($stmt) {
        echo '<script>
                alert("Вітаємо, ' . $first_name . '!");
                window.location.href = "../php/admin.page.php";
              </script>';
    } else {
     
        echo "Реєстрація неможлива....\n";
        die(print_r(sqlsrv_errors(), true));
    }
}
?>

