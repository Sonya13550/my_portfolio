<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  
    $role = $_POST['user_role'] ?? '';    
    $action = $_POST['action'] ?? '';

 
    if ($role && $action) {
        
      
        if ($role === 'reader') {
          
            if ($action === 'register') {
                header('Location: ../html/register_reader.html');
                exit();
            } 
          
            elseif ($action === 'login') {
                header('Location: ../html/login_reader.html');
                exit();
            }
        } 
    
        elseif ($role === 'writer') {
           
            if ($action === 'register') {
                header('Location: ../html/register_writer.html');
                exit();
            } 
        
            elseif ($action === 'login') {
                header('Location: ../html/login_writer.html');
                exit();
            }
        } 
      
        elseif ($role === 'admin') {
          
            if ($action === 'register') {
                header('Location: ../html/admin_register.html');
                exit();
            } 
         
            elseif ($action === 'login') {
                header('Location: ../html/admin_login.html');
                exit();
            }
        }
    }

  
    header('Location: index.html');
    exit();
}
?>

