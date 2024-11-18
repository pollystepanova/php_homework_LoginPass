<?php
// Создание пользователей. Пользователей в storage.php должно быть не меньше 100
$users = [];
for ($i = 1; $i <= 100; $i++) {
    $users[] = [
        'username' => "user$i",
        'password' => password_hash("password$i", PASSWORD_DEFAULT), 
        'email' => "user$i@example.com",
    ];
}