<?php 

require_once('Baza_data_1.php');

// Отримуємо дані 
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$passwd = $_POST['repeatpass'];
$user_role = $_POST['user_role'];

// Перевірка на пусті поля
if (empty($last_name) || empty($first_name) || empty($email) || empty($pass) || empty($passwd) || empty($user_role)) {
    echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
            Не заповнено все !!! <br>
            Спробуйте знову <br>
          </div>';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../html/register.html";
            }, 2000);
          </script>';
} else {
    // Перевірка на співпадіння паролів
    if ($pass != $passwd) {
        echo '<div style="text-align: center; font-size: 24px; font-weight: bold; color: red;">
                Паролі не співпадають !!! <br>
                Спробуйте знову <br>
              </div>';
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../html/register.html";
                }, 2000);
              </script>';
    } else {
        // Перевіряє чи є вже такий користувач
        $sql = "SELECT COUNT(*) as count FROM Users WHERE email = '$email'";  // Перевірка по email
        $stmt = sqlsrv_query($conn, $sql);

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
                        window.location.href = "../html/register.html";
                    }, 2000);
                  </script>';
        } else {
            // Додаємо нового користувача
         $tsql = "INSERT INTO Users ([last_name], [first_name], email, pass, user_role) 
         VALUES (N'$last_name', N'$first_name', '$email', '$pass', N'$user_role')";
            $stmt = sqlsrv_query($conn, $tsql);

            if ($stmt) {
                echo '<script>
                        alert("Ласкаво просимо, ' . $last_name . '!");
                      </script>';
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "../html/page_user_reader.html";
                        }, 0000);
                      </script>';
            } else {
                echo "Реєстрація неможлива....\n";  
                die(print_r(sqlsrv_errors(), true));  
            }
        }    
    }
}

?>
