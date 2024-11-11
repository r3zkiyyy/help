<?php
session_start();
include 'db.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = $_POST['department'];

    $stmt = $pdo->prepare("INSERT INTO users (full_name, phone, email, password, department) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$full_name, $phone, $email, $password, $department])) {
        echo "<p>Регистрация успешна!</p>";
    } else {
        echo "<p>Ошибка регистрации. Возможно, этот email уже используется.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #D0021B;
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
        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #28FF00; /* Зеленый регистрации при наведении */
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

<h1>Регистрация нового пользователя</h1>

<form method="post">
    <input type="text" name="full_name" placeholder="ФИО" required>
    <input type="text" name="phone" placeholder="Телефон">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <select name="department" required>
        <option value="">Выберите отдел</option>
        <option value="IT">IT</option>
        <option value="HR">HR</option>
        <option value="Sales">Sales</option>
    </select>
    <button type="submit">Зарегистрироваться</button>
</form>

</body>
</html>
