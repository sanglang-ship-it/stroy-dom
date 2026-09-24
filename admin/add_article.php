<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    $author_id = 1; // можно взять из сессии

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO articles (title, content, date_created, author_id, is_published, views) VALUES (?, ?, NOW(), ?, ?, 0)");
        $stmt->bind_param("ssii", $title, $content, $author_id, $is_published);
        $stmt->execute();
        $stmt->close();
        header('Location: articles.php?saved=1');
        exit;
    } else {
        $error = 'Заполните все обязательные поля';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить статью - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { max-width: 1200px; display: flex; justify-content: space-between; align-items: center; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 12px; text-decoration: none; font-size: 14px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }
        .form-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .form-box h1 { margin-bottom: 20px; }
        .form-box label { display: block; font-weight: bold; margin-bottom: 5px; margin-top: 15px; }
        .form-box input[type="text"], .form-box textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; font-family: inherit; }
        .form-box textarea { min-height: 250px; resize: vertical; }
        .form-box .checkbox-row { margin-top: 15px; }
        .form-box .btn { background: #E67E22; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .form-box .btn:hover { background: #D35400; }
        .form-box .btn-back { background: #95a5a6; text-decoration: none; display: inline-block; margin-left: 10px; }
        .msg-error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php">Дашборд</a>
            <a href="applications.php">Заявки</a>
            <a href="articles.php">Статьи</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <a href="articles.php">Статьи</a> / <span>Добавить</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="form-box">
            <h1>➕ Добавить статью</h1>

            <?php if (!empty($error)): ?>
                <div class="msg-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <label>Заголовок *</label>
                <input type="text" name="title" required>

                <label>Содержание *</label>
                <textarea name="content" required></textarea>

                <div class="checkbox-row">
                    <label>
                        <input type="checkbox" name="is_published" value="1"> Опубликовать сразу
                    </label>
                </div>

                <button type="submit" class="btn">💾 Сохранить статью</button>
                <a href="articles.php" class="btn btn-back">← Назад</a>
            </form>
        </div>
    </div>
</section>

</body>
</html>