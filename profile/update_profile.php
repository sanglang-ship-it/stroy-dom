<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['client_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: edit.php');
    exit;
}

$client_id = (int)$_SESSION['client_id'];
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');

if (empty($name) || empty($email)) {
    header('Location: edit.php?error=empty');
    exit;
}

$stmt = $conn->prepare("UPDATE clients SET full_name = ?, email = ?, phone = ?, address = ? WHERE client_id = ?");
$stmt->bind_param("ssssi", $name, $email, $phone, $address, $client_id);

if ($stmt->execute()) {
    $_SESSION['client_name'] = $name;
    header('Location: edit.php?success=1');
} else {
    header('Location: edit.php?error=db');
}
$stmt->close();
exit;
?>