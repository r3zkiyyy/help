<?php
session_start(); // Запускаем сессию

// Удаляем все переменные сессии
$_SESSION = [];

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на страницу входа
header("Location: login.php");
exit();
?>
