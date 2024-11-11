<?php
session_start();
include 'db.php'; // Подключение к базе данных

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Перенаправление на страницу авторизации
    exit();
}

$user_id = $_SESSION['user_id']; // Получаем ID пользователя из сессии

// Получаем заявки пользователя
$stmt = $pdo->prepare("SELECT * FROM requests WHERE user_id = ?");
$stmt->execute([$user_id]);
$requests = $stmt->fetchAll(); // Получаем все заявки пользователя
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мои заявки</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #2A00FF; /* Зеленый цвет */
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #50E3C2; /* Золотистый цвет при наведении */
        }
        h2 {
            color: #333;
        }
        ul {
            list-style-type: none; /* Убираем маркеры списка */
            padding: 0;
        }
        li {
            background-color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        strong {
            color: #2A00FF; /* Цвет для выделенного текста */
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Главная</a>
    <a href="create_requests.php">Создать новую заявку</a>
    <a href="my_requests.php">Мои заявки</a>
    <a href="logout.php">Выйти</a>
</nav>

<h2>Мои заявки</h2>
<ul>
    <?php if (count($requests) > 0): ?>
        <?php foreach ($requests as $request): ?>
            <li>
                <strong>Категория:</strong> <?= htmlspecialchars($request['category']) ?>, 
                <strong>Статус:</strong> <?= htmlspecialchars($request['status']) ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>У вас нет заявок.</li>
    <?php endif; ?>
</ul>

</body>
</html>
