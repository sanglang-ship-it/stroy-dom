<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    header('Location: login.php?error=empty');
    exit;
}

$stmt = $conn->prepare("SELECT client_id, full_name, password, role FROM clients WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: login.php?error=notfound');
    exit;
}

$password_ok = false;
if (password_verify($password, $user['password'])) {
    $password_ok = true;
} elseif ($password === $user['password']) {
    $password_ok = true;
}

if (!$password_ok) {
    header('Location: login.php?error=wrongpass');
    exit;
}

$_SESSION['client_id']   = $user['client_id'];
$_SESSION['client_name'] = $user['full_name'];
$_SESSION['role']        = $user['role'] ?? 'client';

if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'manager') {
    header('Location: admin/index.php');
} else {
    header('Location: profile/index.php');
}
exit;
?>