<?php
session_start();
include 'db.php';

// Проверка на администраторский доступ
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Проверка логина администратора
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['login'] == 'help' && $_POST['password'] == 'helpme') {
        $_SESSION['admin'] = true;
    } else {
        echo '<form method="POST">
                <input type="text" name="login" placeholder="Логин" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти как администратор</button>
              </form>';
        exit();
    }
}

// Получаем все заявки
$stmt = $pdo->query("SELECT requests.*, users.full_name, users.department FROM requests JOIN users ON requests.user_id = users.id");
$requests = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE requests SET status = ? WHERE id = ?");
    $stmt->execute([$status, $request_id]);
    header("Location: admin.php"); // Перезагрузка страницы
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
    <h2>Панель администратора</h2>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        table {
            background-color: #FF00F0;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn-update {
            background-color: #28a745;
            color: white;
        }
        .btn-update:hover {
            background-color: #218838;
        }
    </style>
    <table>
        <tr>
            <th>ФИО пользователя</th>
            <th>Отдел</th>
            <th>Категория</th>
            <th>Описание</th>
            <th>Статус</th>
            <th>Изменить статус</th>
        </tr>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= htmlspecialchars($request['full_name']) ?></td>
                <td><?= htmlspecialchars($request['department']) ?></td>
                <td><?= htmlspecialchars($request['category']) ?></td>
                <td><?= htmlspecialchars($request['description']) ?></td>
                <td><?= htmlspecialchars($request['status']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                        <select name="status">
                            <option value="new" <?= $request['status'] == 'new' ? 'selected' : '' ?>>Новая</option>
                            <option value="in_progress" <?= $request['status'] == 'in_progress' ? 'selected' : '' ?>>В работе</option>
                            <option value="completed" <?= $request['status'] == 'completed' ? 'selected' : '' ?>>Завершена</option>
                        </select>
                        <button type="submit">Обновить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>