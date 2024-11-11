<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO requests (user_id, category, description, status) VALUES (?, ?, ?, 'new')");
    if ($stmt->execute([$user_id, $category, $description])) {
        echo "<p>Заявка успешно создана!</p>";
    } else {
        echo "<p>Ошибка при создании заявки.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание заявки</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #F80000; /* Зеленый цвет */
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
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        select, textarea, button {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #FF0000; /* Зеленый цвет кнопки */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #BA2A2A; /* Темнее зеленый при наведении */
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
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Выйти</a>
    <?php endif; ?>
</nav>

<h2>Создание новой заявки</h2>
<form method="post">
    <select name="category" required>
        <option value="">Выберите категорию</option>
        <option value="Техническая проблема">Техническая проблема</option>
        <option value="Запрос информации">Запрос информации</option>
        <!-- Добавьте другие категории по мере необходимости -->
    </select>
    <textarea name="description" placeholder="Описание проблемы" required></textarea>
    <button type="submit">Создать заявку</button>
</form>

</body>
</html>
