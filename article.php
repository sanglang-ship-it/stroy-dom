<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: blog.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ? AND is_published = 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();

if (!$article) {
    header('Location: 404.html');
    exit;
}

// Увеличиваем счётчик просмотров
$conn->query("UPDATE articles SET views = views + 1 WHERE article_id = $id");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - СтройДом</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', Arial, sans-serif; color: #333; background: #F8F9FA; line-height: 1.8; }
        a { text-decoration: none; color: #2C3E50; }
        a:hover { color: #E67E22; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        header { background: #2C3E50; padding: 15px 0; border-bottom: 3px solid #E67E22; }
        header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .logo { font-size: 28px; font-weight: 700; color: #fff; }
        .logo span { color: #E67E22; }
        nav a { color: #fff; margin: 0 15px; font-weight: 500; }
        nav a:hover { color: #E67E22; }
        .header-contacts { color: #fff; font-size: 14px; }
        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; font-size: 14px; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }
        .article-detail { padding: 60px 0; max-width: 800px; margin: 0 auto; }
        .article-detail h1 { font-size: 36px; color: #2C3E50; margin-bottom: 10px; }
        .article-detail .meta { color: #999; font-size: 14px; margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .article-detail .content { font-size: 18px; color: #444; }
        .article-detail .content p { margin-bottom: 20px; }
        .article-detail .back-link { display: inline-block; margin-top: 40px; background: #E67E22; color: #fff; padding: 12px 25px; border-radius: 5px; }
        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-bottom: 30px; }
        .footer-grid h4 { color: #E67E22; margin-bottom: 15px; }
        .footer-grid p, .footer-grid a { color: #ccc; font-size: 14px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; text-align: center; font-size: 14px; color: #888; }
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="logo">Строй<span>Дом</span></div>
        <nav>
            <a href="index.php">Главная</a>
            <a href="about.php">О компании</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="blog.php">Блог</a>
            <a href="contacts.php">Контакты</a>
            <a href="sitemap.php">Карта сайта</a>
            <a href="login.php" style="background: #E67E22; padding: 6px 15px; border-radius: 5px; color: #fff;">👤 Войти</a>
        </nav>
        <div class="header-contacts">📞 +7 (999) 123-45-67</div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">
        <a href="index.php">Главная</a> / <a href="blog.php">Блог</a> / <span><?php echo htmlspecialchars(mb_substr($article['title'], 0, 40)); ?>...</span>
    </div>
</div>

<section class="article-detail">
    <div class="container">
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <div class="meta">
            📅 <?php echo date('d.m.Y', strtotime($article['date_created'])); ?> 
            | 👁️ <?php echo $article['views']; ?> просмотров
        </div>
        <div class="content">
            <?php echo nl2br(htmlspecialchars($article['content'])); ?>
        </div>
        <a href="blog.php" class="back-link">← Вернуться ко всем статьям</a>
    </div>
</section>

<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>СтройДом</h4>
                <p>Строительство частных домов под ключ с 2015 года.</p>
            </div>
            <div>
                <h4>Быстрые ссылки</h4>
                <p><a href="services.php">Услуги</a></p>
                <p><a href="portfolio.php">Портфолио</a></p>
                <p><a href="blog.php">Блог</a></p>
                <p><a href="contacts.php">Контакты</a></p>
            </div>
            <div>
                <h4>Контакты</h4>
                <p>📞 +7 (999) 123-45-67</p>
                <p>✉️ info@stroy-dom.ru</p>
                <p>📍 г. Москва, ул. Строительная, д. 15</p>
            </div>
            <div>
                <h4>Разработчик</h4>
                <p>Дарк Александра Юлия Александровна</p>
                <p>© 2026 СтройДом</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 СтройДом. Все права защищены.</p>
        </div>
    </div>
</footer>

</body>
</html>