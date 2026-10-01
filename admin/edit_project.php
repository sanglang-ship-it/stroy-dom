<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: portfolio.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image_path = trim($_POST['image_path'] ?? '');
    $material_type = trim($_POST['material_type'] ?? '');
    $area = (float)($_POST['area'] ?? 0);
    $year_built = (int)($_POST['year_built'] ?? 0);
    $address = trim($_POST['address'] ?? '');
    $client_id = !empty($_POST['client_id']) ? (int)$_POST['client_id'] : null;

    if (!empty($title)) {
        $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, image_path=?, material_type=?, area=?, year_built=?, address=?, client_id=? WHERE project_id=?");
        $stmt->bind_param("ssssdisii", $title, $description, $image_path, $material_type, $area, $year_built, $address, $client_id, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: portfolio.php?updated=1');
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM projects WHERE project_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$project) {
    header('Location: portfolio.php');
    exit;
}

$clients = $conn->query("SELECT client_id, full_name FROM clients WHERE role = 'client' ORDER BY full_name");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать проект</title>
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
    <h1>✏️ Редактировать проект</h1>
    <form method="POST">
        <label>Название проекта</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>

        <label>Описание</label>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($project['description']); ?></textarea>

        <label>Путь к изображению</label>
        <input type="text" name="image_path" value="<?php echo htmlspecialchars($project['image_path'] ?? ''); ?>">

        <label>Тип материала</label>
        <input type="text" name="material_type" value="<?php echo htmlspecialchars($project['material_type'] ?? ''); ?>">

        <label>Площадь (м²)</label>
        <input type="number" name="area" step="0.01" value="<?php echo $project['area']; ?>">

        <label>Год постройки</label>
        <input type="number" name="year_built" min="2000" max="2030" value="<?php echo $project['year_built']; ?>">

        <label>Адрес</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($project['address'] ?? ''); ?>">

        <label>Клиент</label>
        <select name="client_id">
            <option value="">— не указан —</option>
            <?php while ($c = $clients->fetch_assoc()): ?>
                <option value="<?php echo $c['client_id']; ?>" <?php echo ($c['client_id'] == $project['client_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($c['full_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn">Сохранить</button>
        <a href="portfolio.php" class="back">← Назад к списку</a>
    </form>
</div>
</body>
</html>