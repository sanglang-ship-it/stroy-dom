<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

$is_admin = ($_SESSION['role'] === 'admin');

// Удаление отзыва — только админ
if (isset($_GET['delete']) && $is_admin) {
    $del_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM reviews WHERE review_id = $del_id");
    header('Location: reviews.php?deleted=1');
    exit;
}

// Публикация/снятие с публикации — только админ
if (isset($_GET['toggle']) && $is_admin) {
    $tog_id = (int)$_GET['toggle'];
    $conn->query("UPDATE reviews SET is_published = 1 - is_published, is_moderated = 1 WHERE review_id = $tog_id");
    header('Location: reviews.php?toggled=1');
    exit;
}

$result = $conn->query("SELECT r.*, c.full_name AS client_name 
                        FROM reviews r 
                        LEFT JOIN clients c ON r.client_id = c.client_id 
                        ORDER BY r.date_created DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отзывы - Админ-панель</title>
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
        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; max-width: 400px; word-wrap: break-word; }
        .stars { color: #E67E22; }
        .status-pub { background: #2ecc71; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-draft { background: #f39c12; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .btn-toggle { background: #f39c12; color: #fff; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 5px; }
        .btn-del { background: #e74c3c; color: #fff; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .msg { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
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
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="articles.php">Статьи</a>
            <a href="reviews.php" class="active">Отзывы</a>
            <a href="../index.php">На сайт</a>
            <a href="../logout.php" style="background: #e74c3c; padding: 6px 15px; border-radius: 5px; color: #fff;">🚪 Выйти</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Отзывы</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <?php if (isset($_GET['deleted'])): ?>
            <div class="msg">✅ Отзыв удалён</div>
        <?php endif; ?>
        <?php if (isset($_GET['toggled'])): ?>
            <div class="msg">✅ Статус отзыва изменён</div>
        <?php endif; ?>

        <h1 style="margin-bottom: 20px;">⭐ Управление отзывами</h1>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Клиент</th>
                        <th>Оценка</th>
                        <th>Отзыв</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <?php if ($is_admin): ?><th>Действия</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['review_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['client_name'] ?? 'Клиент'); ?></td>
                                <td class="stars"><?php echo str_repeat('★', (int)$row['rating']); ?></td>
                               <td><?php echo htmlspecialchars($row['comment']); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($row['date_created'])); ?></td>
                                <td>
                                    <?php if ($row['is_published']): ?>
                                        <span class="status-pub">Опубликован</span>
                                    <?php else: ?>
                                        <span class="status-draft">Скрыт</span>
                                    <?php endif; ?>
                                </td>
                                <?php if ($is_admin): ?>
                                    <td>
                                        <a href="reviews.php?toggle=<?php echo $row['review_id']; ?>" class="btn-toggle">👁️</a>
                                        <a href="reviews.php?delete=<?php echo $row['review_id']; ?>" class="btn-del" onclick="return confirm('Удалить отзыв?')">🗑️</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align: center; padding: 30px; color: #888;">Отзывов пока нет</td></tr>
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