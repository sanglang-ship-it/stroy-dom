<?php
session_start();
require_once '../config.php';

// Проверка роли
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

$is_manager = ($_SESSION['role'] === 'manager');
$manager_id = $_SESSION['client_id'];

if ($is_manager) {
    $sql = "SELECT a.*, 
                   c.full_name AS client_name, 
                   c.phone AS client_phone,
                   c.email AS client_email,
                   s.status_name, 
                   s.color_code
            FROM applications a
            LEFT JOIN clients c ON a.client_id = c.client_id
            LEFT JOIN application_statuses s ON a.status_id = s.status_id
            WHERE a.manager_id = ?
            ORDER BY a.date_created DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $manager_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT a.*, 
                   c.full_name AS client_name, 
                   c.phone AS client_phone,
                   c.email AS client_email,
                   s.status_name, 
                   s.color_code
            FROM applications a
            LEFT JOIN clients c ON a.client_id = c.client_id
            LEFT JOIN application_statuses s ON a.status_id = s.status_id
            ORDER BY a.date_created DESC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 12px; text-decoration: none; font-size: 14px; }
        .admin-header nav a:hover { color: #E67E22; }
        .admin-header nav a.active { color: #E67E22; border-bottom: 2px solid #E67E22; padding-bottom: 5px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }
        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        table tr:hover { background: #fafafa; }
        .status-badge { color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .btn-edit { background: #E67E22; color: #fff; padding: 4px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .btn-edit:hover { background: #D35400; }
        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php">Дашборд</a>
            <a href="applications.php" class="active">Заявки</a>
            <a href="clients.php">Клиенты</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="articles.php">Статьи</a>
            <a href="../index.php">На сайт</a>
            <a href="../logout.php" style="background: #e74c3c; padding: 6px 15px; border-radius: 5px; color: #fff;">🚪 Выйти</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Заявки</span></div>
</div>

<section style="padding: 20px 0;">
    <div class="container">
        <?php if (isset($_GET['updated'])): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                ✅ Заявка успешно обновлена
            </div>
        <?php endif; ?>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="margin: 0;">📋 Управление заявками</h1>
            <a href="export_applications.php" 
               style="background: #27ae60; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                📥 Экспорт в Excel
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Клиент</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['app_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['client_name'] ?? 'Не указан'); ?></td>
                                <td><?php echo htmlspecialchars($row['client_phone'] ?? '—'); ?></td>
                                <td><?php echo htmlspecialchars($row['client_email'] ?? '—'); ?></td>
                                <td><?php echo htmlspecialchars(mb_substr($row['description'] ?? '', 0, 50)); ?></td>
                                <td>
                                    <span class="status-badge" style="background: <?php echo $row['color_code'] ?? '#3498db'; ?>;">
                                        <?php echo htmlspecialchars($row['status_name'] ?? 'Новая'); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d.m.Y', strtotime($row['date_created'])); ?></td>
                                <td><a href="edit_application.php?id=<?php echo $row['app_id']; ?>" class="btn-edit">✏️</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: #888;">
                                Заявок пока нет
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>© 2026 СтройДом. Разработчик: Дарк Александра Юлия Александровна</p>
    </div>
</footer>

</body>
</html>