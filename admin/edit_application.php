<?php
session_start();
require_once '../config.php';

// Получаем ID заявки
$app_id = (int)($_GET['id'] ?? 0);
if ($app_id <= 0) {
    header('Location: applications.php');
    exit;
}

// Получаем данные заявки
$stmt = $conn->prepare("SELECT a.*, c.full_name AS client_name, c.phone AS client_phone, c.email AS client_email
                        FROM applications a
                        LEFT JOIN clients c ON a.client_id = c.client_id
                        WHERE a.app_id = ? LIMIT 1");
$stmt->bind_param("i", $app_id);
$stmt->execute();
$result = $stmt->get_result();
$app = $result->fetch_assoc();
$stmt->close();

if (!$app) {
    header('Location: applications.php');
    exit;
}

// Получаем список статусов
$statuses = $conn->query("SELECT status_id, status_name FROM application_statuses ORDER BY sort_order");

// Получаем список менеджеров
$managers = $conn->query("SELECT emp_id, full_name FROM employees WHERE is_active = 1 ORDER BY full_name");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование заявки - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 0 20px; }
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; max-width: 100%; }
        .breadcrumbs .container { max-width: 800px; }
        .breadcrumbs span { color: #999; }
        .form-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .form-box h1 { margin-bottom: 20px; }
        .form-box label { display: block; font-weight: bold; margin-bottom: 5px; margin-top: 15px; }
        .form-box input, .form-box select, .form-box textarea {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; font-family: inherit;
        }
        .form-box textarea { resize: vertical; min-height: 100px; }
        .form-box .btn { background: #E67E22; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .form-box .btn:hover { background: #D35400; }
        .form-box .btn-back { background: #95a5a6; margin-left: 10px; text-decoration: none; display: inline-block; }
        .form-box .btn-back:hover { background: #7f8c8d; }
        .info-block { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; }
        .info-block p { margin-bottom: 5px; }
        .info-block b { color: #2C3E50; }
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
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <a href="applications.php">Заявки</a> / <span>Редактирование</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="form-box">
            <h1>✏️ Редактирование заявки №<?php echo $app['app_id']; ?></h1>

            <div class="info-block">
                <p><b>Клиент:</b> <?php echo htmlspecialchars($app['client_name']); ?></p>
                <p><b>Телефон:</b> <?php echo htmlspecialchars($app['client_phone']); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($app['client_email']); ?></p>
                <p><b>Дата создания:</b> <?php echo date('d.m.Y H:i', strtotime($app['date_created'])); ?></p>
            </div>

            <form action="update_application.php" method="POST">
                <input type="hidden" name="app_id" value="<?php echo $app['app_id']; ?>">

                <label>Статус заявки</label>
                <select name="status_id">
                    <?php while ($s = $statuses->fetch_assoc()): ?>
                        <option value="<?php echo $s['status_id']; ?>"
                            <?php echo ($s['status_id'] == $app['status_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($s['status_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Ответственный менеджер</label>
                <select name="manager_id">
                    <option value="">— не назначен —</option>
                    <?php while ($m = $managers->fetch_assoc()): ?>
                        <option value="<?php echo $m['emp_id']; ?>"
                            <?php echo ($m['emp_id'] == $app['manager_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($m['full_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Бюджет (руб.)</label>
                <input type="number" name="budget" value="<?php echo $app['budget']; ?>" step="0.01">

                <label>Описание</label>
                <textarea name="description"><?php echo htmlspecialchars($app['description']); ?></textarea>

                <button type="submit" class="btn">💾 Сохранить изменения</button>
                <a href="applications.php" class="btn btn-back">← Назад к списку</a>
            </form>
        </div>
    </div>
</section>

</body>
</html>