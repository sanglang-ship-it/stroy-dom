<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: applications.php');
    exit;
}

$app_id     = (int)($_POST['app_id'] ?? 0);
$status_id  = (int)($_POST['status_id'] ?? 0);
$manager_id = !empty($_POST['manager_id']) ? (int)$_POST['manager_id'] : null;
$budget     = !empty($_POST['budget']) ? (float)$_POST['budget'] : null;
$description = trim($_POST['description'] ?? '');

if ($app_id <= 0 || $status_id <= 0) {
    header('Location: applications.php');
    exit;
}

$sql = "UPDATE applications 
        SET status_id = ?, 
            manager_id = ?, 
            budget = ?, 
            description = ?, 
            date_updated = NOW() 
        WHERE app_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iidsi", $status_id, $manager_id, $budget, $description, $app_id);

if ($stmt->execute()) {
    header('Location: applications.php?updated=1');
} else {
    header('Location: applications.php?error=1');
}

$stmt->close();
exit;
?>