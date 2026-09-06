<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог - СтройДом</title>
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

        .blog-section { padding: 60px 0; }
        .blog-section h1 { font-size: 36px; color: #2C3E50; margin-bottom: 40px; text-align: center; }
        .blog-item { background: #fff; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .blog-item h3 { font-size: 22px; margin-bottom: 5px; }
        .blog-item h3 a { color: #2C3E50; }
        .blog-item h3 a:hover { color: #E67E22; }
        .blog-item .date { color: #999; font-size: 14px; }
        .blog-item p { color: #555; margin-top: 10px; }
        .blog-item .btn { display: inline-block; margin-top: 10px; background: #E67E22; color: #fff; padding: 8px 20px; border-radius: 5px; font-weight: 600; transition: background 0.3s; }
        .blog-item .btn:hover { background: #D35400; }

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
        body.dark-theme .blog-section h1 { color: #fff !important; }
        body.dark-theme .blog-item { background: #222 !important; border: 1px solid #444 !important; }
        body.dark-theme .blog-item h3 a { color: #fff !important; }
        body.dark-theme .blog-item h3 a:hover { color: #FFFF00 !important; }
        body.dark-theme .blog-item p { color: #ccc !important; }
        body.dark-theme .blog-item .date { color: #aaa !important; }
        body.dark-theme .blog-item .btn { background: #FFFF00 !important; color: #000 !important; font-size: 20px !important; padding: 12px 25px !important; }
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
        <a href="index.php">Главная</a> / <span>Блог</span>
    </div>
</div>

<section class="blog-section">
    <div class="container">
        <h1>Полезные статьи</h1>

        <div class="blog-item">
            <h3><a href="article.php?id=1">Как выбрать материал для строительства дома?</a></h3>
            <p class="date">15 декабря 2025</p>
            <p>Сравнение кирпича, газобетона, дерева и каркасных технологий. Разбираем плюсы и минусы каждого материала...</p>
            <a href="article.php?id=1" class="btn">Читать далее</a>
        </div>

        <div class="blog-item">
            <h3><a href="article.php?id=2">Этапы строительства дома под ключ</a></h3>
            <p class="date">10 декабря 2025</p>
            <p>От проекта до сдачи объекта — все этапы строительства в одной статье. Что должен знать заказчик на каждом этапе...</p>
            <a href="article.php?id=2" class="btn">Читать далее</a>
        </div>

        <div class="blog-item">
            <h3><a href="article.php?id=3">Как сэкономить на строительстве без потери качества?</a></h3>
            <p class="date">5 декабря 2025</p>
            <p>Практические советы по оптимизации бюджета: выбор сезона, типовые проекты, отечественные материалы и контроль работ...</p>
            <a href="article.php?id=3" class="btn">Читать далее</a>
        </div>

        <div class="blog-item">
            <h3><a href="article.php?id=4">Выбор участка под строительство: на что обратить внимание?</a></h3>
            <p class="date">28 ноября 2025</p>
            <p>Как правильно выбрать земельный участок для строительства дома. Основные критерии: геология, коммуникации, инфраструктура...</p>
            <a href="article.php?id=4" class="btn">Читать далее</a>
        </div>

        <div class="blog-item">
            <h3><a href="article.php?id=5">Утепление дома: какие материалы лучше?</a></h3>
            <p class="date">20 ноября 2025</p>
            <p>Сравнение популярных утеплителей: минеральная вата, пенополистирол, эковата. Какой выбрать для своего дома?</p>
            <a href="article.php?id=5" class="btn">Читать далее</a>
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