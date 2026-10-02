<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);

// Нельзя удалить самого себя
if ($id > 0 && $id != $_SESSION['client_id']) {
    $stmt = $conn->prepare("DELETE FROM clients WHERE client_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: users.php?deleted=1');
exit;
?>