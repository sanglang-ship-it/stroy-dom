<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = $_POST['role'] ?? 'client';

    if (!empty($name) && !empty($email) && !empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO clients (full_name, email, phone, password, role, registration_date, source) VALUES (?, ?, ?, ?, ?, NOW(), 'Админ')");
        $stmt->bind_param("sssss", $name, $email, $phone, $hash, $role);
        if ($stmt->execute()) {
            $stmt->close();
            header('Location: users.php?added=1');
            exit;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить пользователя</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 20px; }
        .box { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; }
        label { display: block; font-weight: bold; margin: 15px 0 5px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; }
        .btn { background: #E67E22; color: #fff; padding: 14px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; width: 100%; }
        .back { display: block; text-align: center; margin-top: 15px; color: #2C3E50; }
    </style>
</head>
<body>
<div class="box">
    <h1>➕ Добавить пользователя</h1>
    <form method="POST">
        <label>ФИО</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Телефон</label>
        <input type="tel" name="phone">

        <label>Пароль</label>
        <input type="password" name="password" required>

        <label>Роль</label>
        <select name="role">
            <option value="client">Клиент</option>
            <option value="manager">Менеджер</option>
            <option value="admin">Администратор</option>
        </select>

        <button type="submit" class="btn">Сохранить</button>
        <a href="users.php" class="back">← Назад к списку</a>
    </form>
</div>
</body>
</html>