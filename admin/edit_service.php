<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: services.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $cost = (float)($_POST['cost'] ?? 0);
    $unit = trim($_POST['unit'] ?? '');
    $cat_id = (int)($_POST['cat_id'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (!empty($title) && $cost > 0) {
        $stmt = $conn->prepare("UPDATE services SET title=?, description=?, cost=?, unit=?, cat_id=?, is_active=? WHERE service_id=?");
        $stmt->bind_param("ssdsiii", $title, $description, $cost, $unit, $cat_id, $is_active, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: services.php?updated=1');
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM services WHERE service_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$service = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$service) {
    header('Location: services.php');
    exit;
}

$cats = $conn->query("SELECT cat_id, cat_name FROM service_categories ORDER BY cat_name");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать услугу</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 20px; }
        .box { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; }
        label { display: block; font-weight: bold; margin: 15px 0 5px; }
        input, textarea, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; }
        .btn { background: #E67E22; color: #fff; padding: 14px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; width: 100%; }
        .back { display: block; text-align: center; margin-top: 15px; color: #2C3E50; }
    </style>
</head>
<body>
<div class="box">
    <h1>✏️ Редактировать услугу</h1>
    <form method="POST">
        <label>Название</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>

        <label>Описание</label>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($service['description']); ?></textarea>

        <label>Стоимость (руб.)</label>
        <input type="number" name="cost" step="0.01" value="<?php echo $service['cost']; ?>" required>

        <label>Единица измерения</label>
        <input type="text" name="unit" value="<?php echo htmlspecialchars($service['unit']); ?>">

        <label>Категория</label>
        <select name="cat_id">
            <?php while ($c = $cats->fetch_assoc()): ?>
                <option value="<?php echo $c['cat_id']; ?>" <?php echo ($c['cat_id'] == $service['cat_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($c['cat_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label><input type="checkbox" name="is_active" <?php echo $service['is_active'] ? 'checked' : ''; ?>> Активна</label>

        <button type="submit" class="btn">Сохранить</button>
        <a href="services.php" class="back">← Назад к списку</a>
    </form>
</div>
</body>
</html>