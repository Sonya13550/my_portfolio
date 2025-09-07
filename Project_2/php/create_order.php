<?php
require_once('Baza.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $email = $_POST['email'];     
    $phone = $_POST['phone'];          
    $delivery = $_POST['delivery'];   
    $payment = $_POST['payment'];      
    $buyer = $_POST['buyer'];         
    $receiver = $_POST['receiver'];    

   
    $sql = "INSERT INTO [order] (email, phone, delivery, payment, buyer, receiver) 
            VALUES (?, ?, ?, ?, ?, ?)";


    $params = array($email, $phone, $delivery, $payment, $buyer, $receiver);

    $stmt = sqlsrv_query($conn, $sql, $params);


    if ($stmt === false) {
  
        die(print_r(sqlsrv_errors(), true));
    } else {
  
        echo '<script>
        alert("Замовлення успішно створене!");
        window.location.href = "../html/page_customer_.html";
      </script>';
    }


    sqlsrv_free_stmt($stmt); 
    sqlsrv_close($conn);     
}
?>
