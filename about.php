<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О компании - СтройДом</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', Arial, sans-serif; color: #333; background: #F8F9FA; line-height: 1.6; }
        a { text-decoration: none; color: #2C3E50; }
        a:hover { color: #E67E22; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* ===== ШАПКА (скопирована из index.php) ===== */
        header { background: #2C3E50; padding: 15px 0; border-bottom: 3px solid #E67E22; }
        header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .logo { font-size: 28px; font-weight: 700; color: #fff; }
        .logo span { color: #E67E22; }
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        /* ===== ХЛЕБНЫЕ КРОШКИ ===== */
        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }

        /* ===== ОСНОВНОЙ КОНТЕНТ ===== */
        .about-section { padding: 60px 0; }
        .about-section h1 { font-size: 36px; color: #2C3E50; margin-bottom: 20px; }
        .about-section p { font-size: 18px; color: #555; margin-bottom: 20px; }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 40px; }
        .about-grid .item { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .about-grid .item h3 { color: #2C3E50; margin-bottom: 10px; }
        .about-grid .item p { font-size: 16px; color: #666; }

        /* ===== ФУТЕР ===== */
        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-bottom: 30px; }
        .footer-grid h4 { color: #E67E22; margin-bottom: 15px; }
        .footer-grid p, .footer-grid a { color: #ccc; font-size: 14px; }
        .footer-grid a:hover { color: #E67E22; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; text-align: center; font-size: 14px; color: #888; }

        /* ===== ТЕМНАЯ ТЕМА ===== */
        body.dark-theme { background: #000 !important; color: #fff !important; font-size: 20px !important; }
        body.dark-theme header { background: #000 !important; border-bottom: 2px solid #fff !important; }
        body.dark-theme .logo { color: #fff !important; }
        body.dark-theme .logo span { color: #FFFF00 !important; }
        body.dark-theme nav a { color: #fff !important; text-decoration: underline !important; }
        body.dark-theme nav a:hover { color: #FFFF00 !important; }
        body.dark-theme .breadcrumbs { background: #111 !important; border-bottom-color: #444 !important; }
        body.dark-theme .breadcrumbs a { color: #FFFF00 !important; }
        body.dark-theme .breadcrumbs span { color: #aaa !important; }
        body.dark-theme .about-section h1 { color: #fff !important; }
        body.dark-theme .about-section p { color: #ccc !important; }
        body.dark-theme .about-grid .item { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .about-grid .item h3 { color: #fff !important; }
        body.dark-theme .about-grid .item p { color: #ccc !important; }
        body.dark-theme footer { background: #111 !important; border-top: 2px solid #444 !important; }
        body.dark-theme .footer-grid h4 { color: #FFFF00 !important; }
        body.dark-theme .footer-grid p, body.dark-theme .footer-grid a { color: #ccc !important; }
        body.dark-theme .footer-grid a:hover { color: #FFFF00 !important; }
        body.dark-theme .theme-toggle { background: #FFFF00 !important; color: #000 !important; font-size: 18px !important; padding: 10px 20px !important; }

        @media (max-width: 768px) {
            header .container { flex-direction: column; text-align: center; }
            nav a { display: inline-block; margin: 5px 10px; }
            .about-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ===== ШАПКА ===== -->
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

<!-- ===== ХЛЕБНЫЕ КРОШКИ ===== -->
<div class="breadcrumbs">
    <div class="container">
        <a href="index.php">Главная</a> / <span>О компании</span>
    </div>
</div>

<!-- ===== О КОМПАНИИ ===== -->
<section class="about-section">
    <div class="container">
        <h1>О компании</h1>
        <p>СтройДом — это команда профессионалов, которая строит дома вашей мечты с 2015 года. За это время мы построили более 200 частных домов по всей Московской области.</p>
        <p>Мы работаем по принципу «прозрачность на каждом этапе»: от проекта до сдачи объекта вы всегда знаете, что происходит на стройплощадке, и какой бюджет вас ждет.</p>

        <div class="about-grid">
            <div class="item">
                <h3>🏗️ Наша миссия</h3>
                <p>Строить качественные, уютные и энергоэффективные дома, которые будут радовать семьи долгие годы.</p>
            </div>
            <div class="item">
                <h3>📋 Наши ценности</h3>
                <p>Честность, ответственность, качество. Мы всегда выполняем обещанное и используем только проверенные материалы.</p>
            </div>
            <div class="item">
                <h3>👷 Команда</h3>
                <p>В нашей команде — архитекторы, инженеры, прорабы и строители с многолетним опытом работы в частном домостроении.</p>
            </div>
            <div class="item">
                <h3>🔒 Гарантия</h3>
                <p>Мы даём гарантию на все виды работ до 5 лет и всегда остаёмся на связи после сдачи дома.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== ФУТЕР ===== -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>СтройДом</h4>
                <p>Строительство частных домов под ключ с 2015 года. Более 200 реализованных проектов.</p>
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

<!-- ===== СКРИПТ ===== -->
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