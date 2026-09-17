<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacts.php');
    exit;
}

$name      = trim($_POST['name'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$email     = trim($_POST['email'] ?? '');
$message   = trim($_POST['message'] ?? '');
$client_id = !empty($_POST['client_id']) ? (int)$_POST['client_id'] : null;

if (empty($name) || empty($phone)) {
    header('Location: contacts.php?error=empty');
    exit;
}

// Если клиент авторизован — используем его client_id
// Если нет — ищем по email
if ($client_id === null && !empty($email)) {
    $stmt = $conn->prepare("SELECT client_id FROM clients WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $client_id = $row['client_id'];
    }
    $stmt->close();
}

// Если всё ещё нет — создаём нового клиента БЕЗ пароля
if ($client_id === null) {
    $stmt = $conn->prepare("INSERT INTO clients (full_name, phone, email, password, registration_date, source, role) VALUES (?, ?, ?, '', NOW(), 'Заявка', 'client')");
    $stmt->bind_param("sss", $name, $phone, $email);
    $stmt->execute();
    $client_id = $stmt->insert_id;
    $stmt->close();
}

// Получаем ID статуса «Новая»
$status_id = 1;
$stmt = $conn->prepare("SELECT status_id FROM application_statuses WHERE status_name = 'Новая' LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $status_id = $row['status_id'];
}
$stmt->close();

// Получаем ID менеджера
$manager_id = null;
$stmt = $conn->prepare("SELECT emp_id FROM employees WHERE is_active = 1 LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $manager_id = $row['emp_id'];
}
$stmt->close();

// Сохраняем заявку
$stmt = $conn->prepare("INSERT INTO applications (client_id, manager_id, status_id, date_created, description) VALUES (?, ?, ?, NOW(), ?)");
$stmt->bind_param("iiis", $client_id, $manager_id, $status_id, $message);

if ($stmt->execute()) {
    header('Location: contacts.php?success=1');
} else {
    header('Location: contacts.php?error=db');
}

$stmt->close();
$conn->close();
?>