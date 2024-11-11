<?php
$host = 'localhost'; // адрес сервера
$db = 'helpp'; // имя базы данных
$user = 'root'; // имя пользователя
$pass = 'root'; // пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Не удалось подключиться к базе данных: " . $e->getMessage());
}
?>