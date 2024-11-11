<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help!!!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #FFD700; /* Золотистый цвет при наведении */
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Главная</a>
    <a href="register.php">Регистрация</a>
    <a href="login.php">Вход</a>
    <a href="create_requests.php">Подача заявки</a>
    <a href="admin.php">Админ панель</a>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['username'] === 'help'): ?>
        <!-- Дополнительные ссылки для пользователя с именем 'help' -->
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Выйти</a>
    <?php endif; ?>
</nav>

<h1>Добро пожаловать в Сервис для автоматизации процессов техподдержки «Help!!!» </h1>
<p>Выберите действие из меню выше.</p>

</body>
</html>
