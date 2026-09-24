<?php
session_start();
require_once '../config.php';

// Проверка роли
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

$is_admin = ($_SESSION['role'] === 'admin');

// Удаление статьи — только админ
if (isset($_GET['delete']) && $is_admin) {
    $del_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM articles WHERE article_id = $del_id");
    header('Location: articles.php?deleted=1');
    exit;
}

$result = $conn->query("SELECT article_id, title, date_created, is_published, views 
                        FROM articles 
                        ORDER BY date_created DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статьи - Админ-панель</title>
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
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-add { background: #27ae60; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        .status-pub { background: #2ecc71; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-draft { background: #f39c12; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .btn-edit { background: #E67E22; color: #fff; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 5px; }
        .btn-del { background: #e74c3c; color: #fff; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .msg { padding: 15px; border-radius: 5px; margin-bottom: 20px; background: #d4edda; color: #155724; }
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
            <a href="articles.php" class="active">Статьи</a>
            <a href="../index.php">На сайт</a>
            <a href="../logout.php" style="background: #e74c3c; padding: 6px 15px; border-radius: 5px; color: #fff;">🚪 Выйти</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Статьи</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <?php if (isset($_GET['deleted'])): ?>
            <div class="msg">✅ Статья удалена</div>
        <?php endif; ?>
        <?php if (isset($_GET['saved'])): ?>
            <div class="msg">✅ Статья сохранена</div>
        <?php endif; ?>

        <div class="top-bar">
            <h1 style="margin: 0;">📄 Управление статьями</h1>
            <?php if ($is_admin): ?>
                <a href="add_article.php" class="btn-add">+ Добавить статью</a>
            <?php endif; ?>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th>Просмотры</th>
                        <?php if ($is_admin): ?><th>Действия</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['article_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo date('d.m.Y', strtotime($row['date_created'])); ?></td>
                                <td>
                                    <?php if ($row['is_published']): ?>
                                        <span class="status-pub">Опубликовано</span>
                                    <?php else: ?>
                                        <span class="status-draft">Черновик</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['views']; ?></td>
                                <?php if ($is_admin): ?>
                                    <td>
                                        <a href="edit_article.php?id=<?php echo $row['article_id']; ?>" class="btn-edit">✏️</a>
                                        <a href="articles.php?delete=<?php echo $row['article_id']; ?>" class="btn-del" onclick="return confirm('Удалить статью?')">🗑️</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 30px; color: #888;">Статей пока нет</td></tr>
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