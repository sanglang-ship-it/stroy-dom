<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['client_id'])) {
    header('Location: ../login.php');
    exit;
}

$client_id = (int)$_SESSION['client_id'];
$client_name = $_SESSION['client_name'] ?? 'Клиент';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = (int)($_POST['rating'] ?? 5);
    $comment = trim($_POST['comment'] ?? '');

    if ($rating >= 1 && $rating <= 5 && !empty($comment)) {
        // is_published = 0 — отзыв отправляется на модерацию, а не сразу на сайт
        $stmt = $conn->prepare("INSERT INTO reviews (client_id, rating, comment, date_created, is_moderated, is_published) VALUES (?, ?, ?, NOW(), 0, 0)");
        $stmt->bind_param("iis", $client_id, $rating, $comment);
        $stmt->execute();
        $stmt->close();
        header('Location: add_review.php?review=sent');
        exit;
    } else {
        $error = 'Заполните все поля корректно';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оставить отзыв - Личный кабинет</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 0 20px; }
        .profile-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .profile-header .container { max-width: 1200px; display: flex; justify-content: space-between; align-items: center; }
        .profile-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .profile-header .logo span { color: #E67E22; }
        .profile-header nav a { color: #fff; margin: 0 12px; text-decoration: none; font-size: 14px; }
        .profile-header .user { color: #fff; font-size: 14px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs .container { max-width: 600px; }
        .breadcrumbs span { color: #999; }
        .form-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .form-box h1 { margin-bottom: 20px; }
        .form-box label { display: block; font-weight: bold; margin-bottom: 5px; margin-top: 15px; }
        .form-box select, .form-box textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; font-family: inherit; }
        .form-box textarea { min-height: 120px; resize: vertical; }
        .form-box .btn { background: #E67E22; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .form-box .btn:hover { background: #D35400; }
        .form-box .btn-back { background: #95a5a6; text-decoration: none; display: inline-block; margin-left: 10px; }
        .msg-error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .msg-success { background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

<header class="profile-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Личный кабинет</div>
        <nav>
            <a href="index.php">Профиль</a>
            <a href="applications.php">Мои заявки</a>
            <a href="history.php">История</a>
            <a href="add_review.php">Оставить отзыв</a>
            <a href="settings.php">Настройки</a>
            <a href="../index.php">На сайт</a>
            <a href="../logout.php" style="background: #e74c3c; padding: 6px 15px; border-radius: 5px; color: #fff;">🚪 Выйти</a>
        </nav>
        <div class="user">👤 <?php echo htmlspecialchars($client_name ?? 'Клиент'); ?></div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Личный кабинет / <span>Оставить отзыв</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="form-box">
            <h1>⭐ Оставить отзыв</h1>

            <?php if (isset($_GET['review']) && $_GET['review'] === 'sent'): ?>
                <div class="msg-success">
                    ✅ Спасибо! Ваш отзыв отправлен на модерацию. После проверки администратором он появится на главной странице
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="msg-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <label>Оценка</label>
                <select name="rating" required>
                    <option value="5">★★★★★ — Отлично</option>
                    <option value="4">★★★★ — Хорошо</option>
                    <option value="3">★★★ — Нормально</option>
                    <option value="2">★★ — Плохо</option>
                    <option value="1">★ — Очень плохо</option>
                </select>

                <label>Ваш отзыв</label>
                <textarea name="comment" placeholder="Поделитесь впечатлениями о работе компании..." required></textarea>

                <button type="submit" class="btn">📤 Отправить отзыв</button>
                <a href="index.php" class="btn btn-back">← Назад в профиль</a>
            </form>
        </div>
    </div>
</section>

</body>
</html>