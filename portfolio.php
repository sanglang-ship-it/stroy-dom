<?php
require_once 'config.php';

$sql = "SELECT p.*, 
        GROUP_CONCAT(s.title SEPARATOR ', ') AS services_list
        FROM projects p
        LEFT JOIN service_projects sp ON p.project_id = sp.project_id
        LEFT JOIN services s ON sp.service_id = s.service_id
        GROUP BY p.project_id
        ORDER BY p.year_built DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфолио - СтройДом</title>
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
        .portfolio-section { padding: 60px 0; }
        .portfolio-section h1 { font-size: 36px; color: #2C3E50; margin-bottom: 40px; text-align: center; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .gallery-item { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; display: block; background: #eee; }
        .gallery-item .info { padding: 20px; }
        .gallery-item .info h3 { color: #2C3E50; margin-bottom: 8px; }
        .gallery-item .info p { color: #666; font-size: 14px; margin-bottom: 5px; }
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
        <a href="index.php">Главная</a> / <span>Портфолио</span>
    </div>
</div>

<section class="portfolio-section">
    <div class="container">
        <h1>Наши работы</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="gallery">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($row['image_path'] ?? ''); ?>" 
                             alt="<?php echo htmlspecialchars($row['title']); ?>"
                             onerror="this.style.display='none'">
                        <div class="info">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description'] ?? ''); ?></p>
                            <p><b>Материал:</b> <?php echo htmlspecialchars($row['material_type'] ?? '—'); ?></p>
                            <p><b>Площадь:</b> <?php echo $row['area'] ? $row['area'] . ' м²' : '—'; ?></p>
                            <p><b>Год постройки:</b> <?php echo htmlspecialchars($row['year_built'] ?? '—'); ?></p>
                            <p><b>Услуги:</b> <?php echo htmlspecialchars($row['services_list'] ?? '—'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #888;">Проектов пока нет</p>
        <?php endif; ?>

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