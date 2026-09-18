<?php
session_start();
require_once '../config.php';

$sql = "SELECT client_id, full_name, phone, email, registration_date, subscription, role 
        FROM clients 
        ORDER BY registration_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Клиенты - Админ-панель</title>
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
        .role-badge { padding: 3px 10px; border-radius: 4px; font-size: 12px; color: #fff; }
        .role-admin { background: #e74c3c; }
        .role-manager { background: #f39c12; }
        .role-client { background: #3498db; }
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
            <a href="clients.php" class="active">Клиенты</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Клиенты</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">👤 Управление клиентами</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['client_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone'] ?? '—'); ?></td>
                                <td><?php echo htmlspecialchars($row['email'] ?? '—'); ?></td>
                                <td>
                                    <?php 
                                    $role = $row['role'] ?? 'client';
                                    $role_names = ['admin' => 'Администратор', 'manager' => 'Менеджер', 'client' => 'Клиент'];
                                    ?>
                                    <span class="role-badge role-<?php echo $role; ?>">
                                        <?php echo $role_names[$role] ?? 'Клиент'; ?>
                                    </span>
                                </td>
                                <td><?php echo $row['registration_date'] ? date('d.m.Y', strtotime($row['registration_date'])) : '—'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #888;">
                                Клиентов пока нет
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