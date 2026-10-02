<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = $_POST['role'] ?? 'client';

    if (!empty($name) && !empty($email)) {
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE clients SET full_name=?, email=?, phone=?, role=?, password=? WHERE client_id=?");
            $stmt->bind_param("sssssi", $name, $email, $phone, $role, $hash, $id);
        } else {
            $stmt = $conn->prepare("UPDATE clients SET full_name=?, email=?, phone=?, role=? WHERE client_id=?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $role, $id);
        }
        $stmt->execute();
        $stmt->close();
        header('Location: users.php?updated=1');
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM clients WHERE client_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    header('Location: users.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать пользователя</title>
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
    <h1>✏️ Редактировать пользователя</h1>
    <form method="POST">
        <label>ФИО</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Телефон</label>
        <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">

        <label>Пароль (оставьте пустым, если не меняете)</label>
        <input type="password" name="password" placeholder="Новый пароль">

        <label>Роль</label>
        <select name="role">
            <option value="client" <?php echo ($user['role'] === 'client') ? 'selected' : ''; ?>>Клиент</option>
            <option value="manager" <?php echo ($user['role'] === 'manager') ? 'selected' : ''; ?>>Менеджер</option>
            <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Администратор</option>
        </select>

        <button type="submit" class="btn">Сохранить</button>
        <a href="users.php" class="back">← Назад к списку</a>
    </form>
</div>
</body>
</html>