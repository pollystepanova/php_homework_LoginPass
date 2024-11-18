<?php
include 'storage.php'; // Подключение массива пользователей
session_start();

$error = ''; // Переменная для хранения ошибок

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Валидация
    if (!$username || !$password) {
        $error = 'Заполните все поля.';
    } else {
        // Поиск пользователя
        $user = array_filter($users, fn($u) => $u['username'] === $username);
        if ($user) {
            $user = reset($user); // Берём первого найденного пользователя
            if (password_verify($password, $user['password'])) {
                // Авторизация успешна
                $_SESSION['user'] = $user;
                header('Location: about.php'); // Переход на страницу пользователя
                exit;
            } else {
                $error = 'Неверный пароль.';
            }
        } else {
            $error = 'Пользователь не найден.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
    <h1>Авторизация</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Логин:</label>
        <input type="text" name="username" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Войти</button>
    </form>
</body>
</html>

