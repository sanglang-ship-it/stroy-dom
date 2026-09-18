<?php
// Подключаем базу данных
require_once 'config.php';

// Запрос к БД: получаем все активные услуги
$sql = "SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги - СтройДом</title>
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
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }

        .services-section { padding: 60px 0; }
        .services-section h1 { font-size: 36px; color: #2C3E50; margin-bottom: 20px; text-align: center; }
        .service-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 30px; }
        .service-card { background: #fff; border-radius: 10px; padding: 30px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .service-card:hover { transform: translateY(-5px); }
        .service-card .icon { font-size: 48px; display: block; margin-bottom: 15px; }
        .service-card h3 { font-size: 22px; color: #2C3E50; margin-bottom: 10px; }
        .service-card p { color: #666; margin-bottom: 20px; }
        .service-card .btn { display: inline-block; background: #E67E22; color: #fff; padding: 10px 25px; border-radius: 5px; font-weight: 600; transition: background 0.3s; }
        .service-card .btn:hover { background: #D35400; }

        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-bottom: 30px; }
        .footer-grid h4 { color: #E67E22; margin-bottom: 15px; }
        .footer-grid p, .footer-grid a { color: #ccc; font-size: 14px; }
        .footer-grid a:hover { color: #E67E22; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; text-align: center; font-size: 14px; color: #888; }

        body.dark-theme { background: #000 !important; color: #fff !important; font-size: 20px !important; }
        body.dark-theme header { background: #000 !important; border-bottom: 2px solid #fff !important; }
        body.dark-theme .logo { color: #fff !important; }
        body.dark-theme .logo span { color: #FFFF00 !important; }
        body.dark-theme nav a { color: #fff !important; text-decoration: underline !important; }
        body.dark-theme nav a:hover { color: #FFFF00 !important; }
        body.dark-theme .breadcrumbs { background: #111 !important; border-bottom-color: #444 !important; }
        body.dark-theme .breadcrumbs a { color: #FFFF00 !important; }
        body.dark-theme .breadcrumbs span { color: #aaa !important; }
        body.dark-theme .services-section h1 { color: #fff !important; }
        body.dark-theme .service-card { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .service-card h3 { color: #fff !important; }
        body.dark-theme .service-card p { color: #ccc !important; }
        body.dark-theme .service-card .btn { background: #FFFF00 !important; color: #000 !important; font-size: 20px !important; padding: 12px 30px !important; }
        body.dark-theme footer { background: #111 !important; border-top: 2px solid #444 !important; }
        body.dark-theme .footer-grid h4 { color: #FFFF00 !important; }
        body.dark-theme .footer-grid p, body.dark-theme .footer-grid a { color: #ccc !important; }
        body.dark-theme .footer-grid a:hover { color: #FFFF00 !important; }
        body.dark-theme .theme-toggle { background: #FFFF00 !important; color: #000 !important; font-size: 18px !important; padding: 10px 20px !important; }

        @media (max-width: 768px) {
            header .container { flex-direction: column; text-align: center; }
            nav a { display: inline-block; margin: 5px 10px; }
        }
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
        </nav>
        <button class="theme-toggle" onclick="toggleTheme()">👁️ Версия для слабовидящих</button>
        <div class="header-contacts">📞 +7 (999) 123-45-67</div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">
        <a href="index.php">Главная</a> / <span>Услуги</span>
    </div>
</div>

<section class="services-section">
    <div class="container">
        <h1>Наши услуги</h1>
        <div class="service-cards">
            <?php
            // Проверяем, есть ли услуги в базе
            if ($result->num_rows > 0) {
                // Выводим каждую услугу как карточку
                while ($row = $result->fetch_assoc()) {
                    // Получаем данные из базы
                    $icon = ''; // заглушка для иконки
                    $title = htmlspecialchars($row['title']);
                    $description = htmlspecialchars($row['description']);
                    $cost = number_format($row['cost'], 0, ' ', ' ') . ' руб.';
                    $service_id = $row['service_id'];

                    echo '
                    <div class="service-card">
                        <span class="icon">🔨</span>
                        <h3>' . $title . '</h3>
                        <p>' . $description . '</p>
                        <p><strong>Цена: ' . $cost . '</strong></p>
                        <a href="service-detail.php?id=' . $service_id . '" class="btn">Подробнее</a>
                    </div>
                    ';
                }
            } else {
                echo '<p style="text-align:center; font-size:18px; color:#888;">Услуги временно не загружены. Пожалуйста, зайдите позже.</p>';
            }
            ?>
        </div>
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

<script>
function toggleTheme() {
    const body = document.body;
    const btn = document.querySelector('.theme-toggle');
    if (body.classList.contains('dark-theme')) {
        body.classList.remove('dark-theme');
        localStorage.setItem('theme', 'light');
        btn.textContent = '👁️ Версия для слабовидящих';
    } else {
        body.classList.add('dark-theme');
        localStorage.setItem('theme', 'dark');
        btn.textContent = '☀️ Стандартная версия';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        document.querySelector('.theme-toggle').textContent = '☀️ Стандартная версия';
    }
});
</script>

</body>
</html>