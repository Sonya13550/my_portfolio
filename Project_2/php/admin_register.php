<?php 


require_once('Baza.php');


$first_name = $_POST['first_name'];
$email = $_POST['email'];
$user_password = $_POST['user_password'];
$repeatpass = $_POST['repeatpass'];


if (empty($first_name) || empty($email) || empty($user_password) || empty($repeatpass)) {

    echo '<script>
    alert("Не заповнено все !!!");
    alert("Спробуйте знову");
    </script>';
    exit(); 
}


if ($user_password !== $repeatpass) {
    
    echo '<script>
    alert("Паролі не співпадають !!!");
    alert("Спробуйте знову");
    window.location.href = "../html/register_author.html";
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
    echo '<script>
            alert("Такий користувач вже існує! \nВведіть логін і пароль знову.");
            window.location.href = "register_author.html";
          </script>';
    exit(); 
}


$tsql = "INSERT INTO regestation ([first_name], email, user_password, repeatpass) 
         VALUES (?, ?, ?, ?)";
$stmt = sqlsrv_query($conn, $tsql, [$first_name, $email, $user_password, $repeatpass ]);


if ($stmt) {

    echo '<script>
            alert("Ласкаво просимо! Адміністратор: ' . $first_name . '!");
          </script>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../php/admin_page.php";
            }, 0000); // Без затримки для миттєвого перенаправлення
          </script>';
} else {
    echo "Реєстрація неможлива....\n";  
    die(print_r(sqlsrv_errors(), true));  
}

?>
