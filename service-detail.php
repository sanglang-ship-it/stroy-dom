<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: services.php');
    exit;
}

$stmt = $conn->prepare("SELECT s.*, c.cat_name 
                        FROM services s 
                        LEFT JOIN service_categories c ON s.cat_id = c.cat_id 
                        WHERE s.service_id = ? AND s.is_active = 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();
$stmt->close();

if (!$service) {
    header('Location: 404.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($service['title']); ?> - СтройДом</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', Arial, sans-serif; color: #333; background: #F8F9FA; line-height: 1.6; }
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
        .service-detail { padding: 60px 0; max-width: 900px; margin: 0 auto; }
        .service-detail h1 { font-size: 36px; color: #2C3E50; margin-bottom: 10px; }
        .service-detail .category { color: #999; font-size: 14px; margin-bottom: 20px; }
        .service-detail .description { font-size: 18px; color: #555; margin-bottom: 30px; line-height: 1.8; }
        .service-detail .price-block { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .service-detail .price { font-size: 32px; color: #E67E22; font-weight: 700; }
        .service-detail .unit { color: #999; font-size: 14px; }
        .service-detail .btn { display: inline-block; background: #E67E22; color: #fff; padding: 14px 40px; border-radius: 5px; font-weight: 600; font-size: 16px; }
        .service-detail .btn:hover { background: #D35400; }
        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; margin-top: 40px; }
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
        <a href="index.php">Главная</a> / <a href="services.php">Услуги</a> / <span><?php echo htmlspecialchars($service['title']); ?></span>
    </div>
</div>

<section class="service-detail">
    <div class="container">
        <h1><?php echo htmlspecialchars($service['title']); ?></h1>
        <p class="category">Категория: <?php echo htmlspecialchars($service['cat_name'] ?? '—'); ?></p>

        <div class="price-block">
            <p class="price"><?php echo number_format($service['cost'], 0, ',', ' '); ?> руб.</p>
            <p class="unit">за 1 <?php echo htmlspecialchars($service['unit'] ?? 'ед.'); ?></p>
        </div>

        <div class="description">
            <?php echo nl2br(htmlspecialchars($service['description'] ?? '')); ?>
        </div>

        <a href="contacts.php" class="btn">Оставить заявку</a>
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