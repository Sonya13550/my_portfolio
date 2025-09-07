<?php
// Параметри підключення до бази даних
$servername = "DESKTOP-PTH1V72\SQLEXPRESS";
$username = "Sonya_2025";
$password = "Sonya_2025";
$dbname = "Sales";

// Масив з інформацією для підключення
$connectionInfo = array( 
    "UID"=>$username, 
    "PWD"=>$password, 
    "CharacterSet"=>"UTF-8",
    "Database"=>$dbname
);  

// Підключення до SQL Server
$conn = sqlsrv_connect($servername, $connectionInfo); 

// Перевірка підключення
if ( $conn )  
{  
    // Підключення успішне
}   
else   
{
    echo "Не підключено... .\n";  
    die( print_r( sqlsrv_errors(), true));  
}  
?>
