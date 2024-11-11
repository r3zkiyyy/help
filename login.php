<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: requests.php");
        exit();
    } else {
        $error = "Неверный email или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #28a745; /* Зеленый цвет */
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
        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #004CFF; /* Зеленый цвет кнопки */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838; /* Темнее зеленый при наведении */
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

<h2>Авторизация</h2>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit">Войти</button>
</form>

</body>
</html>

