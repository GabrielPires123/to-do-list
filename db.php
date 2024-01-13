<?php

$host = "127.0.0.1"; 
$dbname = "teste"; 
$username = "root"; 
$password = ""; 

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   
catch (PDOException $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
}

?>

