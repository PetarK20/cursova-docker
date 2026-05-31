<?php

$host = "db"; 
$dbname = "cursova";
$user = "root";
$password = "123456"; 

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Грешка: " . $e->getMessage());
}