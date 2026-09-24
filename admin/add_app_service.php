<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: applications.php');
    exit;
}

$app_id     = (int)($_POST['app_id'] ?? 0);
$service_id = (int)($_POST['service_id'] ?? 0);
$quantity   = (int)($_POST['quantity'] ?? 1);
$unit_price = (float)($_POST['unit_price'] ?? 0);
$total_price = $quantity * $unit_price;

if ($app_id <= 0 || $service_id <= 0) {
    header('Location: edit_application.php?id=' . $app_id);
    exit;
}

$stmt = $conn->prepare("INSERT INTO app_services (app_id, service_id, quantity, unit_price, total_price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiidd", $app_id, $service_id, $quantity, $unit_price, $total_price);
$stmt->execute();
$stmt->close();

header('Location: edit_application.php?id=' . $app_id . '&service_added=1');
exit;
?>