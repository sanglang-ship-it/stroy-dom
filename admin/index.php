<?php
session_start();

// Проверка роли
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

require_once '../config.php';

$is_admin = ($_SESSION['role'] === 'admin');
$is_manager = ($_SESSION['role'] === 'manager');
$manager_id = $_SESSION['client_id'];

// Статистика (для админа — всё, для менеджера — только его заявки)
if ($is_manager) {
    $total_applications = $conn->query("SELECT COUNT(*) AS c FROM applications WHERE manager_id = $manager_id")->fetch_assoc()['c'];
    $in_work = $conn->query("SELECT COUNT(*) AS c FROM applications a 
                             LEFT JOIN application_statuses s ON a.status_id = s.status_id 
                             WHERE a.manager_id = $manager_id AND (s.is_final = 0 OR s.is_final IS NULL)")->fetch_assoc()['c'];
    $done = $conn->query("SELECT COUNT(*) AS c FROM applications a 
                          LEFT JOIN application_statuses s ON a.status_id = s.status_id 
                          WHERE a.manager_id = $manager_id AND s.is_final = 1")->fetch_assoc()['c'];
} else {
    $total_applications = $conn->query("SELECT COUNT(*) AS c FROM applications")->fetch_assoc()['c'];
    $in_work = $conn->query("SELECT COUNT(*) AS c FROM applications a 
                             LEFT JOIN application_statuses s ON a.status_id = s.status_id 
                             WHERE s.is_final = 0 OR s.is_final IS NULL")->fetch_assoc()['c'];
    $done = $conn->query("SELECT COUNT(*) AS c FROM applications a 
                          LEFT JOIN application_statuses s ON a.status_id = s.status_id 
                          WHERE s.is_final = 1")->fetch_assoc()['c'];
}

$total_clients  = $conn->query("SELECT COUNT(*) AS c FROM clients WHERE role = 'client'")->fetch_assoc()['c'];
$total_services = $conn->query("SELECT COUNT(*) AS c FROM services WHERE is_active = 1")->fetch_assoc()['c'];
$total_projects = $conn->query("SELECT COUNT(*) AS c FROM projects")->fetch_assoc()['c'];

// Конверсия
$conversion = $total_applications > 0 
    ? round(($done / $total_applications) * 100, 1) 
    : 0;

// Средний бюджет
$avg_budget = $conn->query("SELECT AVG(budget) AS avg_b FROM applications WHERE budget IS NOT NULL")
                   ->fetch_assoc()['avg_b'];
$avg_budget = $avg_budget ? round($avg_budget, 0) : 0;

// Среднее время
$avg_time = $conn->query("SELECT AVG(TIMESTAMPDIFF(HOUR, date_created, date_updated)) AS avg_t 
                          FROM applications WHERE date_updated IS NOT NULL")->fetch_assoc()['avg_t'];
$avg_time = $avg_time ? round($avg_time, 1) : 0;

// Эффективность менеджеров (только для админа)
$managers_stats = null;
$positions = null;

if ($is_admin) {
    $managers_stats = $conn->query("
        SELECT 
            e.emp_id,
            e.full_name AS manager_name,
            COUNT(a.app_id) AS total_apps,
            SUM(CASE WHEN s.status_name = 'Договор заключен' THEN 1 ELSE 0 END) AS successful_apps,
            ROUND(
                SUM(CASE WHEN s.status_name = 'Договор заключен' THEN 1 ELSE 0 END) * 100.0 
                / NULLIF(COUNT(a.app_id), 0), 
                1
            ) AS effectiveness
        FROM employees e
        LEFT JOIN applications a ON e.emp_id = a.manager_id
        LEFT JOIN application_statuses s ON a.status_id = s.status_id
        GROUP BY e.emp_id, e.full_name
        HAVING COUNT(a.app_id) > 0
        ORDER BY effectiveness DESC
    ");

    $positions = $conn->query("SELECT p.pos_name, COUNT(e.emp_id) AS count 
                               FROM positions p 
                               LEFT JOIN employees e ON p.pos_id = e.pos_id 
                               GROUP BY p.pos_id
                               ORDER BY p.pos_id");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель - СтройДом</title>
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
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; }
        .stat-card .number { font-size: 32px; font-weight: bold; color: #2C3E50; }
        .stat-card .label { color: #888; font-size: 14px; margin-top: 5px; }
        .admin-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; }
        .admin-card { background: #fff; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .admin-card .icon { font-size: 40px; display: block; margin-bottom: 10px; }
        .admin-card h3 { margin-bottom: 5px; color: #2C3E50; }
        .admin-card p { color: #888; font-size: 14px; margin-bottom: 15px; }
        .admin-card .btn { display: inline-block; background: #E67E22; color: #fff; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-size: 14px; }
        .admin-card .btn:hover { background: #D35400; }
        table { width: 100%; background: #fff; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table th { padding: 12px; text-align: left; background: #f8f9fa; }
        table td { padding: 12px; border-bottom: 1px solid #eee; }
        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php" class="active">Дашборд</a>
            <a href="applications.php">Заявки</a>
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
    <div class="container">Админ-панель / <span>Дашборд</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">📊 Статистика</h1>

        <div class="stats">
            <div class="stat-card">
                <div class="number"><?php echo $total_applications; ?></div>
                <div class="label">Всего заявок</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $in_work; ?></div>
                <div class="label">В работе</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $done; ?></div>
                <div class="label">Завершено</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_clients; ?></div>
                <div class="label">Клиентов</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_services; ?></div>
                <div class="label">Услуг</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_projects; ?></div>
                <div class="label">Проектов</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $conversion; ?>%</div>
                <div class="label">Конверсия заявок</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo number_format($avg_budget, 0, ',', ' '); ?> ₽</div>
                <div class="label">Средний бюджет</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $avg_time; ?> ч</div>
                <div class="label">Среднее время</div>
            </div>
        </div>

        <?php if ($is_admin && $managers_stats && $managers_stats->num_rows > 0): ?>
            <h2 style="margin: 30px 0 15px;">Эффективность менеджеров</h2>
            <table style="margin-bottom: 30px;">
                <tr style="background: #f8f9fa;">
                    <th>Менеджер</th>
                    <th>Всего заявок</th>
                    <th>Успешных</th>
                    <th>Эффективность</th>
                </tr>
                <?php while ($m = $managers_stats->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($m['manager_name']); ?></td>
                        <td><?php echo $m['total_apps']; ?></td>
                        <td><?php echo $m['successful_apps']; ?></td>
                        <td>
                            <b style="color: <?php echo $m['effectiveness'] >= 50 ? '#27ae60' : '#e67e22'; ?>;">
                                <?php echo $m['effectiveness']; ?>%
                            </b>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>

        <?php if ($is_admin && $positions): ?>
            <h2 style="margin: 30px 0 15px;">Сотрудники по должностям</h2>
            <table>
                <tr style="background: #f8f9fa;">
                    <th>Должность</th>
                    <th>Количество</th>
                </tr>
                <?php while ($pos = $positions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pos['pos_name']); ?></td>
                        <td><?php echo $pos['count']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>

        <h2 style="margin: 30px 0 20px;">Быстрое управление</h2>
        <div class="admin-grid">
            <div class="admin-card">
                <span class="icon">📋</span>
                <h3>Заявки</h3>
                <p>Просмотр и обработка</p>
                <a href="applications.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">👤</span>
                <h3>Клиенты</h3>
                <p>Управление клиентами</p>
                <a href="clients.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">🔧</span>
                <h3>Услуги</h3>
                <p>Каталог услуг</p>
                <a href="services.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">🖼️</span>
                <h3>Портфолио</h3>
                <p>Управление проектами</p>
                <a href="portfolio.php" class="btn">Перейти</a>
            </div>
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