<?php


$servername = "DESKTOP-PTH1V72\SQLEXPRESS";  
$username = "Vlad";  
$password = "Vlad";  
$dbname = "web_side";  


$connectionInfo = array( 
    "UID" => $username,  
    "PWD" => $password, 
    "CharacterSet" => "UTF-8", 
    "Database" => $dbname  
);  


$conn = sqlsrv_connect($servername, $connectionInfo); 

if ($conn) {
    
} else {

    echo "Не підключено до бази даних... \n";
  
    die(print_r(sqlsrv_errors(), true));  
}
?>
