<?php


require_once('Baza_data_1.php');


$email = $_POST['email'];
$pass = $_POST['pass'];


if (empty($email) || empty($pass)) {
    echo("Не все заповнено !!! <br>");
} else {
  
    $sql = "SELECT * FROM Users WHERE email = ? AND pass = ?";
    $params = array($email, $pass); 


    $stmt = sqlsrv_query($conn, $sql, $params);

    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); 
    }

  
    if (sqlsrv_has_rows($stmt)) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
           
            echo '<script>
                    alert("Ласкаво просимо, ' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '!");
                  </script>';

          
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "../html/page_user_writer.html";
                    }, 0);
                  </script>';
        }
    } else {
   
        echo("Немає такого користувача або пароль невірний !!! <br>");
        echo "Введіть логін і пароль знову <br>";

   
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../html/login_writer.html";
                }, 1000);
              </script>';
    }
}
?>

