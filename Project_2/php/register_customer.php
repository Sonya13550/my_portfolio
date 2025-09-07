<?php 


require_once('Baza.php');


$first_name = $_POST['first_name'];
$email = $_POST['email'];
$user_password = $_POST['user_password'];
$repeatpass = $_POST['repeatpass'];


if (empty($first_name) || empty($email) || empty($user_password) || empty($repeatpass)) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Не заповнено все !!! <br>
            Спробуйте знову <br>
          </div>';

    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/regestation.html";
            }, 2000);
          </script>';
    exit();  
}


if ($user_password !== $repeatpass) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Паролі не співпадають !!! <br>
            Спробуйте знову <br>
          </div>';
    
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/regestation.html";
            }, 2000);
          </script>';
    exit(); 
}

$sql = "SELECT COUNT(*) as count FROM regestation WHERE first_name = ?";
$stmt = sqlsrv_query($conn, $sql, [$first_name]);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); 
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$count = $row['count'];


if ($count > 0) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Такий користувач вже існує !!! <br>
            Введіть логін і пароль знову <br>
          </div>';
   
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/regestation.html";
            }, 2000);
          </script>';
    exit();  
}


$tsql = "INSERT INTO regestation ([first_name], email, user_password, repeatpass) 
         VALUES (?, ?, ?, ?)";
$stmt = sqlsrv_query($conn, $tsql, [$first_name, $email, $user_password, $repeatpass]);


if ($stmt) {

    echo '<script>
            alert("Ласкаво просимо! Покупець: ' . $first_name . '!");
          </script>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/page_customer_.html";
            }, 0000);
          </script>';
} else {

    echo "Реєстрація неможлива....\n";  
    die(print_r(sqlsrv_errors(), true));  
}

?>
