<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СтройДом - Строительство частных домов под ключ</title>
    <meta name="description" content="Строительство частных домов под ключ. Проектирование, строительство, отделка. Гарантия качества. Более 200 реализованных объектов.">
    <style>
        /* ===== ОБЩИЕ СТИЛИ ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', Arial, sans-serif; color: #333; background: #F8F9FA; line-height: 1.6; }
        a { text-decoration: none; color: #2C3E50; }
        a:hover { color: #E67E22; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* ===== КНОПКИ ===== */
        .btn { display: inline-block; padding: 12px 30px; border-radius: 5px; font-weight: 600; transition: all 0.3s; cursor: pointer; border: none; }
        .btn-primary { background: #E67E22; color: #fff; }
        .btn-primary:hover { background: #D35400; color: #fff; }
        .btn-secondary { background: #2C3E50; color: #fff; }
        .btn-secondary:hover { background: #1a252f; color: #fff; }

        /* ===== ШАПКА ===== */
        header { background: #2C3E50; padding: 15px 0; border-bottom: 3px solid #E67E22; }
        header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .logo { font-size: 28px; font-weight: 700; color: #fff; }
        .logo span { color: #E67E22; }
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        /* ===== БАННЕР ===== */
        .banner { background: linear-gradient(135deg, #2C3E50 0%, #1a252f 100%); color: #fff; text-align: center; padding: 80px 20px; }
        .banner h1 { font-size: 48px; margin-bottom: 20px; }
        .banner p { font-size: 22px; margin-bottom: 30px; opacity: 0.9; }
        .banner .btn { margin: 0 10px; }

        /* ===== РАЗДЕЛЫ ===== */
        section { padding: 50px 0; }
        section:nth-child(even) { background: #fff; }
        h2 { text-align: center; font-size: 36px; margin-bottom: 40px; color: #2C3E50; }

        /* ===== ПРЕИМУЩЕСТВА ===== */
        .advantages-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
        .advantage-item { text-align: center; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .advantage-item .icon { font-size: 48px; display: block; margin-bottom: 15px; }
        .advantage-item h3 { font-size: 20px; color: #2C3E50; }
        .advantage-item p { color: #666; font-size: 15px; }

        /* ===== УСЛУГИ ===== */
        .service-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .service-card { background: #fff; border-radius: 10px; padding: 25px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .service-card:hover { transform: translateY(-5px); }
        .service-card .icon { font-size: 40px; display: block; margin-bottom: 15px; }
        .service-card h3 { font-size: 22px; color: #2C3E50; }
        .service-card p { color: #666; margin: 10px 0 20px; }

        /* ===== ГАЛЕРЕЯ ===== */
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .gallery img { width: 100%; height: 250px; object-fit: cover; border-radius: 10px; transition: transform 0.3s; cursor: pointer; }
        .gallery img:hover { transform: scale(1.02); }

        /* ===== БЛОГ ===== */
        .blog-item { background: #fff; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .blog-item h3 { margin-bottom: 5px; }
        .blog-item h3 a { color: #2C3E50; }
        .blog-item h3 a:hover { color: #E67E22; }
        .blog-item .date { color: #999; font-size: 14px; }
        .blog-item p { color: #555; margin-top: 10px; }

        /* ===== КОНТАКТЫ ===== */
        .contacts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; }
        .contact-item { display: flex; gap: 15px; margin-bottom: 20px; align-items: flex-start; }
        .contact-item .icon { font-size: 24px; min-width: 40px; }
        .contact-item h4 { color: #2C3E50; }
        .contact-item p { color: #555; }
        .contact-form { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .contact-form input, .contact-form textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 15px; font-family: inherit; }
        .contact-form input:focus, .contact-form textarea:focus { border-color: #E67E22; outline: none; }
        .contact-form .btn { width: 100%; }

        /* ===== ФУТЕР ===== */
        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; margin-bottom: 30px; }
        .footer-grid h4 { color: #E67E22; margin-bottom: 15px; }
        .footer-grid p, .footer-grid a { color: #ccc; font-size: 14px; }
        .footer-grid a:hover { color: #E67E22; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; text-align: center; font-size: 14px; color: #888; }

        /* ===== СТРАНИЦА 404 ===== */
        .error-404 { text-align: center; padding: 100px 20px; }
        .error-404 h1 { font-size: 100px; color: #E67E22; }
        .error-404 h2 { font-size: 32px; color: #2C3E50; margin: 20px 0; }
        .error-404 p { font-size: 18px; color: #666; margin-bottom: 30px; }
        .error-404 .btn { margin: 0 10px; }

        /* ===== КАРТА САЙТА ===== */
        .sitemap-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
        .sitemap-col h3 { color: #2C3E50; border-bottom: 2px solid #E67E22; padding-bottom: 10px; margin-bottom: 15px; }
        .sitemap-col ul { list-style: none; }
        .sitemap-col ul li { padding: 5px 0; }
        .sitemap-col ul li a { color: #555; }
        .sitemap-col ul li a:hover { color: #E67E22; }

        /* ===== ТЕМНАЯ ТЕМА (ДЛЯ СЛАБОВИДЯЩИХ) ===== */
        body.dark-theme { background: #000 !important; color: #fff !important; font-size: 20px !important; }
        body.dark-theme header { background: #000 !important; border-bottom: 2px solid #fff !important; }
        body.dark-theme .logo { color: #fff !important; }
        body.dark-theme .logo span { color: #FFFF00 !important; }
        body.dark-theme nav a { color: #fff !important; text-decoration: underline !important; }
        body.dark-theme nav a:hover { color: #FFFF00 !important; }
        body.dark-theme .banner { background: #111 !important; }
        body.dark-theme .banner h1 { color: #fff !important; }
        body.dark-theme .banner p { color: #fff !important; }
        body.dark-theme .btn-primary { background: #FFFF00 !important; color: #000 !important; font-size: 20px !important; padding: 15px 35px !important; }
        body.dark-theme .btn-primary:hover { background: #FFDD00 !important; }
        body.dark-theme .btn-secondary { background: #fff !important; color: #000 !important; font-size: 20px !important; padding: 15px 35px !important; }
        body.dark-theme section:nth-child(even) { background: #111 !important; }
        body.dark-theme h2 { color: #fff !important; }
        body.dark-theme .advantage-item { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .advantage-item h3 { color: #fff !important; }
        body.dark-theme .advantage-item p { color: #ccc !important; }
        body.dark-theme .service-card { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .service-card h3 { color: #fff !important; }
        body.dark-theme .service-card p { color: #ccc !important; }
        body.dark-theme .blog-item { background: #222 !important; border: 1px solid #444 !important; }
        body.dark-theme .blog-item h3 a { color: #fff !important; }
        body.dark-theme .blog-item h3 a:hover { color: #FFFF00 !important; }
        body.dark-theme .blog-item p { color: #ccc !important; }
        body.dark-theme .blog-item .date { color: #aaa !important; }
        body.dark-theme .contact-form { background: #222 !important; border: 2px solid #fff !important; }
        body.dark-theme .contact-form input, body.dark-theme .contact-form textarea { background: #111 !important; color: #fff !important; border: 2px solid #fff !important; font-size: 18px !important; }
        body.dark-theme .contact-form input:focus, body.dark-theme .contact-form textarea:focus { border-color: #FFFF00 !important; }
        body.dark-theme .contact-item h4 { color: #fff !important; }
        body.dark-theme .contact-item p { color: #ccc !important; }
        body.dark-theme footer { background: #111 !important; border-top: 2px solid #444 !important; }
        body.dark-theme .footer-grid h4 { color: #FFFF00 !important; }
        body.dark-theme .footer-grid p, body.dark-theme .footer-grid a { color: #ccc !important; }
        body.dark-theme .footer-grid a:hover { color: #FFFF00 !important; }
        body.dark-theme .sitemap-col h3 { color: #fff !important; border-bottom-color: #FFFF00 !important; }
        body.dark-theme .sitemap-col ul li a { color: #ccc !important; text-decoration: underline !important; font-size: 18px !important; }
        body.dark-theme .sitemap-col ul li a:hover { color: #FFFF00 !important; }
        body.dark-theme .error-404 h1 { color: #FFFF00 !important; }
        body.dark-theme .error-404 h2 { color: #fff !important; }
        body.dark-theme .error-404 p { color: #ccc !important; }
        body.dark-theme .theme-toggle { background: #FFFF00 !important; color: #000 !important; font-size: 18px !important; padding: 10px 20px !important; }

        /* ===== АДАПТИВ ===== */
        @media (max-width: 768px) {
            header .container { flex-direction: column; text-align: center; }
            nav a { display: inline-block; margin: 5px 10px; }
            .banner h1 { font-size: 32px; }
            .banner p { font-size: 18px; }
            .contacts-grid { grid-template-columns: 1fr; }
            .banner .btn { display: block; margin: 10px auto; max-width: 250px; }
        }
        @media (max-width: 480px) {
            .banner h1 { font-size: 24px; }
            .advantages-grid { grid-template-columns: 1fr; }
            .service-cards { grid-template-columns: 1fr; }
            .gallery { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ===== ШАПКА ===== -->
<header>
    <div class="container">
        <div class="logo">Строй<span>Дом</span></div>
        <nav>
            <a href="#home">Главная</a>
            <a href="#services">Услуги</a>
            <a href="#portfolio">Портфолио</a>
            <a href="#blog">Блог</a>
            <a href="#contacts">Контакты</a>
            <a href="#sitemap">Карта сайта</a>
        </nav>
        <button class="theme-toggle" onclick="toggleTheme()">👁️ Версия для слабовидящих</button>
        <div class="header-contacts">📞 +7 (999) 123-45-67</div>
    </div>
</header>

<!-- ===== ГЛАВНАЯ ===== -->
<section id="home" class="banner">
    <div class="container">
        <h1>Построим дом вашей мечты</h1>
        <p>Проектирование, строительство и отделка под ключ</p>
        <a href="#contacts" class="btn btn-primary">Оставить заявку</a>
        <a href="#portfolio" class="btn btn-secondary">Наши работы</a>
    </div>
</section>

<!-- ===== ПРЕИМУЩЕСТВА ===== -->
<section>
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

<!-- ===== УСЛУГИ ===== -->
<section id="services">
    <div class="container">
        <h2>Наши услуги</h2>
        <div class="service-cards">
            <div class="service-card">
                <span class="icon">📐</span>
                <h3>Проектирование</h3>
                <p>Индивидуальные архитектурные и конструктивные решения</p>
                <a href="#contacts" class="btn btn-primary">Заказать</a>
            </div>
            <div class="service-card">
                <span class="icon">🏠</span>
                <h3>Строительство</h3>
                <p>Кирпичные, газобетонные, деревянные и каркасные дома</p>
                <a href="#contacts" class="btn btn-primary">Заказать</a>
            </div>
            <div class="service-card">
                <span class="icon">🛠️</span>
                <h3>Отделочные работы</h3>
                <p>Внутренняя и наружная отделка любой сложности</p>
                <a href="#contacts" class="btn btn-primary">Заказать</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== ПОРТФОЛИО ===== -->
<section id="portfolio">
    <div class="container">
        <h2>Наши работы</h2>
        <div class="gallery">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop" alt="Кирпичный дом">
            <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=400&h=300&fit=crop" alt="Деревянный дом">
            <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=400&h=300&fit=crop" alt="Современный дом">
            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&h=300&fit=crop" alt="Дом с бассейном">
        </div>
    </div>
</section>

<!-- ===== БЛОГ ===== -->
<section id="blog">
    <div class="container">
        <h2>Полезные статьи</h2>
        <div class="blog-item">
            <h3><a href="#blog">Как выбрать материал для строительства дома?</a></h3>
            <p class="date">15 декабря 2025</p>
            <p>Сравнение кирпича, газобетона, дерева и каркасных технологий. Разбираем плюсы и минусы каждого материала...</p>
        </div>
        <div class="blog-item">
            <h3><a href="#blog">Этапы строительства дома под ключ</a></h3>
            <p class="date">10 декабря 2025</p>
            <p>От проекта до сдачи объекта — все этапы строительства в одной статье. Что должен знать заказчик на каждом этапе...</p>
        </div>
        <div class="blog-item">
            <h3><a href="#blog">Как сэкономить на строительстве без потери качества?</a></h3>
            <p class="date">5 декабря 2025</p>
            <p>Практические советы по оптимизации бюджета: выбор сезона, типовые проекты, отечественные материалы и контроль работ...</p>
        </div>
    </div>
</section>

<!-- ===== КОНТАКТЫ ===== -->
<section id="contacts">
    <div class="container">
        <h2>Контакты</h2>
        <div class="contacts-grid">
            <div>
                <div class="contact-item">
                    <span class="icon">📍</span>
                    <div>
                        <h4>Адрес</h4>
                        <p>г. Москва, ул. Строительная, д. 15, офис 305</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="icon">📞</span>
                    <div>
                        <h4>Телефон</h4>
                        <p>+7 (999) 123-45-67</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="icon">✉️</span>
                    <div>
                        <h4>Email</h4>
                        <p>info@stroy-dom.ru</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="icon">🕐</span>
                    <div>
                        <h4>Режим работы</h4>
                        <p>Пн-Пт: 9:00 - 20:00<br>Сб: 10:00 - 18:00<br>Вс: по записи</p>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <h3 style="text-align:center; margin-bottom:20px;">Оставьте заявку</h3>
                <p style="text-align:center; margin-bottom:20px; color:#666;">Мы свяжемся с вами в ближайшее время</p>
                <form action="#" method="POST">
                    <input type="text" name="name" placeholder="Ваше имя" required>
                    <input type="tel" name="phone" placeholder="Телефон" required>
                    <input type="email" name="email" placeholder="Email">
                    <textarea name="message" placeholder="Сообщение" rows="4"></textarea>
                    <button type="submit" class="btn btn-primary">Отправить заявку</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ===== КАРТА САЙТА ===== -->
<section id="sitemap">
    <div class="container">
        <h2>Карта сайта</h2>
        <div class="sitemap-grid">
            <div class="sitemap-col">
                <h3>Главная</h3>
                <ul><li><a href="#home">Главная страница</a></li></ul>
            </div>
            <div class="sitemap-col">
                <h3>Услуги</h3>
                <ul>
                    <li><a href="#services">Все услуги</a></li>
                    <li><a href="#services">Проектирование</a></li>
                    <li><a href="#services">Строительство</a></li>
                    <li><a href="#services">Отделка</a></li>
                </ul>
            </div>
            <div class="sitemap-col">
                <h3>Портфолио</h3>
                <ul>
                    <li><a href="#portfolio">Все проекты</a></li>
                    <li><a href="#portfolio">Кирпичные дома</a></li>
                    <li><a href="#portfolio">Деревянные дома</a></li>
                    <li><a href="#portfolio">Современные дома</a></li>
                </ul>
            </div>
            <div class="sitemap-col">
                <h3>Блог</h3>
                <ul>
                    <li><a href="#blog">Все статьи</a></li>
                    <li><a href="#blog">Выбор материала</a></li>
                    <li><a href="#blog">Этапы строительства</a></li>
                    <li><a href="#blog">Как сэкономить</a></li>
                </ul>
            </div>
            <div class="sitemap-col">
                <h3>Контакты</h3>
                <ul>
                    <li><a href="#contacts">Контакты</a></li>
                    <li><a href="#contacts">Форма заявки</a></li>
                </ul>
            </div>
            <div class="sitemap-col">
                <h3>Страница 404</h3>
                <ul><li><a href="404.html">Страница не найдена</a></li></ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== СТРАНИЦА 404 (скрытая, но доступна по ссылке) ===== -->
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
                <p><a href="#services">Услуги</a></p>
                <p><a href="#portfolio">Портфолио</a></p>
                <p><a href="#blog">Блог</a></p>
                <p><a href="#contacts">Контакты</a></p>
            </div>
            <div>
                <h4>Контакты</h4>
                <p>📞 +7 (999) 123-45-67</p>
                <p>✉️ info@stroy-dom.ru</p>
                <p>📍 г. Москва, ул. Строительная, д. 15</p>
            </div>
            <div>
                <h4>Режим работы</h4>
                <p>Пн-Пт: 9:00 - 20:00</p>
                <p>Сб: 10:00 - 18:00</p>
                <p>Вс: по записи</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 СтройДом. Все права защищены.</p>
        </div>
    </div>
</footer>

<!-- ===== СКРИПТ ПЕРЕКЛЮЧЕНИЯ ТЕМЫ ===== -->
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

// Восстановление темы при загрузке
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