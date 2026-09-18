<?php
session_start();
require_once '../config.php';

$sql = "SELECT s.*, c.cat_name 
        FROM services s
        LEFT JOIN service_categories c ON s.cat_id = c.cat_id
        ORDER BY s.sort_order, s.service_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Услуги - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .admin-header nav a:hover { color: #E67E22; }
        .admin-header nav a.active { color: #E67E22; border-bottom: 2px solid #E67E22; padding-bottom: 5px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }
        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        table tr:hover { background: #fafafa; }
        .status-active { background: #2ecc71; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-inactive { background: #e74c3c; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php">Дашборд</a>
            <a href="applications.php">Заявки</a>
            <a href="clients.php">Клиенты</a>
            <a href="services.php" class="active">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Услуги</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">🔧 Управление услугами</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Стоимость</th>
                        <th>Ед. изм.</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['service_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['cat_name'] ?? '—'); ?></td>
                                <td><?php echo number_format($row['cost'], 0, ',', ' '); ?> руб.</td>
                                <td><?php echo htmlspecialchars($row['unit'] ?? '—'); ?></td>
                                <td>
                                    <?php if ($row['is_active']): ?>
                                        <span class="status-active">Активна</span>
                                    <?php else: ?>
                                        <span class="status-inactive">Неактивна</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #888;">
                                Услуг пока нет
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