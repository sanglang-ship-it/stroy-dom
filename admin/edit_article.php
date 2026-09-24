<?php
session_start();
require_once '../config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: articles.php');
    exit;
}

// Сохранение изменений
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $is_published = isset($_POST['is_published']) ? 1 : 0;

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, date_updated = NOW(), is_published = ? WHERE article_id = ?");
        $stmt->bind_param("ssii", $title, $content, $is_published, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: articles.php?saved=1');
        exit;
    }
}

// Загрузка статьи
$stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$article) {
    header('Location: articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать статью - Админ-панель</title>
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
    <div class="container">Админ-панель / <a href="articles.php">Статьи</a> / <span>Редактирование</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="form-box">
            <h1>✏️ Редактирование статьи №<?php echo $article['article_id']; ?></h1>

            <form action="" method="POST">
                <label>Заголовок *</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>

               <label>Содержание *</label>
                <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>

                <div class="checkbox-row">
                    <label>
                        <input type="checkbox" name="is_published" value="1" <?php echo $article['is_published'] ? 'checked' : ''; ?>> Опубликовать
                    </label>
                </div>

                <button type="submit" class="btn">💾 Сохранить</button>
                <a href="articles.php" class="btn btn-back">← Назад</a>
            </form>
        </div>
    </div>
</section>

</body>
</html>