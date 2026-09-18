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
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }

        .portfolio-section { padding: 60px 0; }
        .portfolio-section h1 { font-size: 36px; color: #2C3E50; margin-bottom: 20px; text-align: center; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 30px; }
        .gallery-item { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .gallery-item:hover { transform: translateY(-5px); }
        .gallery-item img { width: 100%; height: 250px; object-fit: cover; display: block; }
        .gallery-item .info { padding: 20px; }
        .gallery-item .info h3 { color: #2C3E50; margin-bottom: 5px; }
        .gallery-item .info p { color: #666; font-size: 14px; }

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
        body.dark-theme .portfolio-section h1 { color: #fff !important; }
        body.dark-theme .gallery-item { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .gallery-item .info h3 { color: #fff !important; }
        body.dark-theme .gallery-item .info p { color: #ccc !important; }
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
        <a href="index.php">Главная</a> / <span>Портфолио</span>
    </div>
</div>

<section class="portfolio-section">
    <div class="container">
        <h1>Наши работы</h1>
        <div class="gallery">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&h=400&fit=crop" alt="Кирпичный дом">
                <div class="info">
                    <h3>Кирпичный дом в Крылатском</h3>
                    <p>Площадь: 220 м² | 2024 г.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=600&h=400&fit=crop" alt="Деревянный дом">
                <div class="info">
                    <h3>Дом из бруса в Одинцово</h3>
                    <p>Площадь: 110 м² | 2023 г.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=600&h=400&fit=crop" alt="Современный дом">
                <div class="info">
                    <h3>Газобетонный дом в Мытищах</h3>
                    <p>Площадь: 150 м² | 2023 г.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600&h=400&fit=crop" alt="Дом с бассейном">
                <div class="info">
                    <h3>Особняк в Рублево</h3>
                    <p>Площадь: 280 м² | 2024 г.</p>
                </div>
            </div>
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