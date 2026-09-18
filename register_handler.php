<?php
// ==============================================
// ОБРАБОТЧИК РЕГИСТРАЦИИ
// ==============================================
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm  = trim($_POST['confirm'] ?? '');

// Проверяем обязательные поля
if (empty($name) || empty($email) || empty($password)) {
    header('Location: register.php?error=empty');
    exit;
}

// Проверяем, что пароли совпадают
if ($password !== $confirm) {
    header('Location: register.php?error=passwords');
    exit;
}

// Ищем клиента по email
$stmt = $conn->prepare("SELECT client_id, password FROM clients WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$existing = $result->fetch_assoc();
$stmt->close();

// Случай 1: клиент уже с паролем — ошибка
if ($existing && !empty($existing['password'])) {
    header('Location: register.php?error=exists');
    exit;
}

// Случай 2: клиент без пароля (из заявки) — обновляем пароль
if ($existing && empty($existing['password'])) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE clients SET full_name = ?, phone = ?, password = ? WHERE client_id = ?");
    $stmt->bind_param("sssi", $name, $phone, $password_hash, $existing['client_id']);
    $stmt->execute();
    $stmt->close();

    $_SESSION['client_id']   = $existing['client_id'];
    $_SESSION['client_name'] = $name;
    $_SESSION['role']        = 'client';

    header('Location: profile/index.php');
    exit;
}

// Случай 3: клиента нет — создаём нового
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO clients (full_name, email, phone, password, registration_date, source, role) VALUES (?, ?, ?, ?, NOW(), 'Регистрация', 'client')");
$stmt->bind_param("ssss", $name, $email, $phone, $password_hash);

if ($stmt->execute()) {
    $client_id = $stmt->insert_id;
    $stmt->close();

    $_SESSION['client_id']   = $client_id;
    $_SESSION['client_name'] = $name;
    $_SESSION['role']        = 'client';

    header('Location: profile/index.php');
} else {
    header('Location: register.php?error=db');
}
exit;
?>