<?php

$host = 'localhost';
$db = 'Alpha';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host; dbname=$db;charset=$charset";

try{
$pdo = new PDO($dsn, $user, $pass);
} catch(PDOException $error){
    echo "Erro ao tentar conectar com o banco de dados <p>" . $error;
}
echo "Conexão funcionando";
?>
