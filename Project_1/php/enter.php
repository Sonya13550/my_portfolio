<?php 

// Перевіряємо, чи був запит методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Отримуємо роль користувача та дію з форми, якщо вони задані
    $role = $_POST['user_role'] ?? '';    
    $action = $_POST['action'] ?? '';

    // Перевіряємо, чи задані роль та дія
    if ($role && $action) {
        
        // Якщо роль - "reader" (читач)
        if ($role === 'reader') {
            // Якщо дія - реєстрація, перенаправляємо на сторінку реєстрації для читача
            if ($action === 'register') {
                header('Location: ../html/register_reader.html');
                exit();
            } 
            // Якщо дія - вхід, перенаправляємо на сторінку входу для читача
            elseif ($action === 'login') {
                header('Location: ../html/login_reader.html');
                exit();
            }
        } 
        // Якщо роль - "writer" (письменник)
        elseif ($role === 'writer') {
            // Якщо дія - реєстрація, перенаправляємо на сторінку реєстрації для письменника
            if ($action === 'register') {
                header('Location: ../html/register_writer.html');
                exit();
            } 
            // Якщо дія - вхід, перенаправляємо на сторінку входу для письменника
            elseif ($action === 'login') {
                header('Location: ../html/login_writer.html');
                exit();
            }
        } 
        // Якщо роль - "admin" (адміністратор)
        elseif ($role === 'admin') {
            // Якщо дія - реєстрація, перенаправляємо на сторінку реєстрації для адміністратора
            if ($action === 'register') {
                header('Location: ../html/admin_register.html');
                exit();
            } 
            // Якщо дія - вхід, перенаправляємо на сторінку входу для адміністратора
            elseif ($action === 'login') {
                header('Location: ../html/admin_login.html');
                exit();
            }
        }
    }

    // Якщо роль або дія не задані чи сталася помилка, перенаправляємо на головну сторінку
    header('Location: index.html');
    exit();
}
?>
