<?php
require_once 'config.php';
$reviews = $conn->query("SELECT r.*, c.full_name AS client_name 
                         FROM reviews r 
                         LEFT JOIN clients c ON r.client_id = c.client_id 
                         WHERE r.is_published = 1 
                         ORDER BY r.date_created DESC 
                         LIMIT 5");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СтройДом - Строительство частных домов под ключ</title>
    <meta name="description" content="Строительство частных домов под ключ. Проектирование, строительство, отделка. Гарантия качества. Более 200 реализованных объектов.">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', Arial, sans-serif; color: #333; background: #F8F9FA; line-height: 1.6; }
        a { text-decoration: none; color: #2C3E50; }
        a:hover { color: #E67E22; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .btn { display: inline-block; padding: 12px 30px; border-radius: 5px; font-weight: 600; transition: all 0.3s; cursor: pointer; border: none; }
        .btn-primary { background: #E67E22; color: #fff; }
        .btn-primary:hover { background: #D35400; color: #fff; }
        .btn-secondary { background: #2C3E50; color: #fff; }
        .btn-secondary:hover { background: #1a252f; color: #fff; }

        header { background: #2C3E50; padding: 15px 0; border-bottom: 3px solid #E67E22; }
        header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .logo { font-size: 28px; font-weight: 700; color: #fff; }
        .logo span { color: #E67E22; }
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        .banner { background: linear-gradient(135deg, #2C3E50 0%, #1a252f 100%); color: #fff; text-align: center; padding: 80px 20px; }
        .banner h1 { font-size: 48px; margin-bottom: 20px; }
        .banner p { font-size: 22px; margin-bottom: 30px; opacity: 0.9; }
        .banner .btn { margin: 0 10px; }

        .advantages { padding: 50px 0; }
        .advantages h2 { text-align: center; font-size: 36px; margin-bottom: 40px; color: #2C3E50; }
        .advantages-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
        .advantage-item { text-align: center; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .advantage-item .icon { font-size: 48px; display: block; margin-bottom: 15px; }
        .advantage-item h3 { font-size: 20px; color: #2C3E50; }
        .advantage-item p { color: #666; font-size: 15px; }

        .section-links { padding: 40px 0; }
        .section-links h2 { text-align: center; font-size: 36px; color: #2C3E50; margin-bottom: 40px; }
        .section-links-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 30px; }
        .section-link-card { background: #fff; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .section-link-card:hover { transform: translateY(-5px); }
        .section-link-card .icon { font-size: 40px; display: block; margin-bottom: 15px; }
        .section-link-card h3 { color: #2C3E50; margin-bottom: 10px; }
        .section-link-card p { color: #666; margin-bottom: 15px; }
        .section-link-card .btn { font-size: 14px; padding: 8px 20px; }

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
        body.dark-theme .banner { background: #111 !important; }
        body.dark-theme .banner h1 { color: #fff !important; }
        body.dark-theme .banner p { color: #fff !important; }
        body.dark-theme .btn-primary { background: #FFFF00 !important; color: #000 !important; }
        body.dark-theme .btn-secondary { background: #fff !important; color: #000 !important; }
        body.dark-theme .advantages h2 { color: #fff !important; }
        body.dark-theme .advantage-item { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .advantage-item h3 { color: #fff !important; }
        body.dark-theme .advantage-item p { color: #ccc !important; }
        body.dark-theme .section-links h2 { color: #fff !important; }
        body.dark-theme .section-link-card { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .section-link-card h3 { color: #fff !important; }
        body.dark-theme .section-link-card p { color: #ccc !important; }
        body.dark-theme footer { background: #111 !important; border-top: 2px solid #444 !important; }
        body.dark-theme .footer-grid h4 { color: #FFFF00 !important; }
        body.dark-theme .footer-grid p, body.dark-theme .footer-grid a { color: #ccc !important; }
        body.dark-theme .theme-toggle { background: #FFFF00 !important; color: #000 !important; }

        @media (max-width: 768px) {
            header .container { flex-direction: column; text-align: center; }
            nav a { display: inline-block; margin: 5px 10px; }
            .banner h1 { font-size: 32px; }
            .banner p { font-size: 18px; }
            .banner .btn { display: block; margin: 10px auto; max-width: 250px; }
        }
        @media (max-width: 480px) {
            .banner h1 { font-size: 24px; }
            .advantages-grid { grid-template-columns: 1fr; }
            .section-links-grid { grid-template-columns: 1fr; }
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
            <form action="search.php" method="GET" style="display:inline-block;">
    <input type="text" name="q" placeholder="Поиск..." 
           style="padding: 5px 10px; border-radius: 5px; border: none; font-size: 14px; width: 150px;">
</form>
            <a href="login.php" style="background: #E67E22; padding: 6px 15px; border-radius: 5px; color: #fff;">👤 Войти</a>
        </nav>
        <button class="theme-toggle" onclick="toggleTheme()">👁️ Версия для слабовидящих</button>
        <div class="header-contacts">📞 +7 (999) 123-45-67</div>
    </div>
</header>

<!-- ===== БАННЕР ===== -->
<section class="banner">
    <div class="container">
        <h1>Построим дом вашей мечты</h1>
        <p>Проектирование, строительство и отделка под ключ</p>
        <a href="contacts.php" class="btn btn-primary">Оставить заявку</a>
        <a href="portfolio.php" class="btn btn-secondary">Наши работы</a>
    </div>
</section>

<!-- ===== ПРЕИМУЩЕСТВА ===== -->
<section class="advantages">
    <div class="container">
        <h2>Почему выбирают нас?</h2>
        <div class="advantages-grid">
            <div class="advantage-item">
                <span class="icon">🏗️</span>
                <h3>Более 10 лет опыта</h3>
                <p>Работаем с 2015 года, построили более 200 домов</p>
            </div>
            <div class="advantage-item">
                <span class="icon">📋</span>
                <h3>Прозрачная смета</h3>
                <p>Фиксированная цена без скрытых платежей</p>
            </div>
            <div class="advantage-item">
                <span class="icon">🔒</span>
                <h3>Гарантия качества</h3>
                <p>Гарантия на все виды работ до 5 лет</p>
            </div>
            <div class="advantage-item">
                <span class="icon">📸</span>
                <h3>Отчет по этапам</h3>
                <p>Еженедельный фотоотчет о ходе строительства</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== ССЫЛКИ НА РАЗДЕЛЫ ===== -->
<section class="section-links">
    <div class="container">
        <h2>Что мы предлагаем</h2>
        <div class="section-links-grid">
            <div class="section-link-card">
                <span class="icon">🔧</span>
                <h3>Услуги</h3>
                <p>Посмотрите все наши услуги</p>
                <a href="services.php" class="btn btn-primary">Перейти</a>
            </div>
            <div class="section-link-card">
                <span class="icon">🖼️</span>
                <h3>Портфолио</h3>
                <p>Наши реализованные проекты</p>
                <a href="portfolio.php" class="btn btn-primary">Перейти</a>
            </div>
            <div class="section-link-card">
                <span class="icon">📝</span>
                <h3>Блог</h3>
                <p>Полезные статьи о строительстве</p>
                <a href="blog.php" class="btn btn-primary">Перейти</a>
            </div>
            <div class="section-link-card">
                <span class="icon">📞</span>
                <h3>Контакты</h3>
                <p>Свяжитесь с нами</p>
                <a href="contacts.php" class="btn btn-primary">Перейти</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== КАЛЬКУЛЯТОР СТОИМОСТИ ===== -->
<section id="calculator" style="padding: 50px 0; background: #fff;">
    <div class="container">
        <h2 style="text-align: center; font-size: 36px; margin-bottom: 40px; color: #2C3E50;">
            Рассчитать стоимость строительства
        </h2>
        <div style="max-width: 600px; margin: 0 auto; background: #F8F9FA; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Площадь дома (м²)</label>
            <input type="number" id="area" placeholder="Например, 150" min="1"
                   style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 15px;">

            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Тип материала</label>
            <select id="material"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 15px;">
                <option value="kirpich">Кирпич</option>
                <option value="gazobeton">Газобетон</option>
                <option value="brus">Брус</option>
                <option value="karkas">Каркас</option>
            </select>

            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Этажность</label>
            <select id="floors"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 15px;">
                <option value="1">1 этаж</option>
                <option value="2">2 этажа</option>
                <option value="3">3 этажа</option>
            </select>

            <button onclick="calculateCost()"
                    style="width: 100%; background: #E67E22; color: #fff; padding: 14px; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer;">
                Рассчитать стоимость
            </button>

            <div id="result" style="margin-top: 20px;"></div>
        </div>
    </div>
</section>

<!-- ===== ОТЗЫВЫ КЛИЕНТОВ ===== -->
<section class="reviews" style="padding: 60px 0; background: #F8F9FA;">
    <div class="container">
        <h2 style="text-align: center; font-size: 36px; margin-bottom: 40px; color: #2C3E50;">
            Отзывы клиентов
        </h2>

        <?php if ($reviews && $reviews->num_rows > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto;">
                <?php while ($rev = $reviews->fetch_assoc()): ?>
                    <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <p style="color: #E67E22; font-size: 20px; margin-bottom: 10px;">
                            <?php echo str_repeat('★', (int)$rev['rating']); ?>
                        </p>
                        <p style="color: #555; margin-bottom: 15px; font-style: italic;">
                            «<?php echo htmlspecialchars($rev['comment']); ?>»
                        </p>
                        <p style="color: #2C3E50; font-weight: 600;">
                            — <?php echo htmlspecialchars($rev['client_name'] ?? 'Клиент'); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #888;">Отзывов пока нет</p>
        <?php endif; ?>

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
<script src="calculator.js"></script>
</body>
</html>