<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуга - СтройДом</title>
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

        .service-detail { padding: 60px 0; }
        .service-detail h1 { font-size: 36px; color: #2C3E50; margin-bottom: 20px; }
        .service-detail .icon-big { font-size: 72px; display: block; margin-bottom: 20px; }
        .service-detail p { font-size: 18px; color: #555; margin-bottom: 20px; }
        .service-detail ul { margin: 20px 0; padding-left: 20px; }
        .service-detail ul li { margin-bottom: 10px; color: #555; }
        .service-detail .price { font-size: 28px; color: #E67E22; font-weight: 700; margin: 30px 0; }
        .service-detail .btn { display: inline-block; background: #E67E22; color: #fff; padding: 14px 40px; border-radius: 5px; font-weight: 600; transition: background 0.3s; border: none; font-size: 16px; cursor: pointer; }
        .service-detail .btn:hover { background: #D35400; }

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
        body.dark-theme .service-detail h1 { color: #fff !important; }
        body.dark-theme .service-detail p { color: #ccc !important; }
        body.dark-theme .service-detail ul li { color: #ccc !important; }
        body.dark-theme .service-detail .price { color: #FFFF00 !important; }
        body.dark-theme .service-detail .btn { background: #FFFF00 !important; color: #000 !important; font-size: 20px !important; padding: 16px 45px !important; }
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
        <a href="index.php">Главная</a> / <a href="services.php">Услуги</a> / <span id="service-name">Услуга</span>
    </div>
</div>

<section class="service-detail">
    <div class="container">
        <?php
        // Получаем ID услуги из URL
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

        // Данные услуг
        $services = [
            1 => [
                'icon' => '📐',
                'title' => 'Проектирование домов',
                'description' => 'Мы разрабатываем индивидуальные архитектурные проекты с учётом всех ваших пожеланий и особенностей участка. Наши архитекторы создают функциональные, эстетичные и энергоэффективные решения.',
                'details' => [
                    'Архитектурное проектирование',
                    'Конструктивные решения',
                    'Инженерные системы (отопление, вентиляция, электрика)',
                    '3D-визуализация будущего дома',
                    'Согласование проекта в госорганах'
                ],
                'price' => 'от 25 000 руб.'
            ],
            2 => [
                'icon' => '🏠',
                'title' => 'Строительство из кирпича',
                'description' => 'Кирпичные дома — это классика, проверенная временем. Мы строим дома из качественного керамического кирпича с использованием современных технологий кладки.',
                'details' => [
                    'Кладка стен из керамического кирпича',
                    'Утепление и гидроизоляция',
                    'Монтаж перекрытий и кровли',
                    'Внутренняя и наружная отделка',
                    'Гарантия на работы — до 5 лет'
                ],
                'price' => 'от 8 500 руб./м²'
            ],
            3 => [
                'icon' => '🧱',
                'title' => 'Строительство из газобетона',
                'description' => 'Газобетон — современный материал, который сочетает теплоэффективность, экологичность и доступную цену. Дома из газобетона тёплые зимой и прохладные летом.',
                'details' => [
                    'Кладка стен из газобетонных блоков',
                    'Армирование и утепление',
                    'Монтаж перекрытий и кровли',
                    'Отделка фасада и внутренняя отделка',
                    'Энергоэффективность класса А'
                ],
                'price' => 'от 5 500 руб./м²'
            ],
            4 => [
                'icon' => '🌲',
                'title' => 'Деревянные дома',
                'description' => 'Дома из бруса и бревна — это экологичность, уют и натуральная красота. Мы строим дома из профилированного бруса камерной сушки и оцилиндрованного бревна.',
                'details' => [
                    'Строительство из бруса (профилированный, клееный)',
                    'Строительство из бревна (рубленое, оцилиндрованное)',
                    'Усадка и конопатка',
                    'Отделка деревом и защита от влаги',
                    'Экологичные материалы'
                ],
                'price' => 'от 7 500 руб./м²'
            ],
            5 => [
                'icon' => '🔨',
                'title' => 'Каркасное строительство',
                'description' => 'Каркасные дома — это быстро, экономично и надёжно. Канадская технология позволяет построить дом за 2-3 месяца без усадки.',
                'details' => [
                    'Каркас из сухого строганного бруса',
                    'Утепление минеральной ватой (200-250 мм)',
                    'Пароизоляция и ветрозащита',
                    'Отделка фасада и внутренняя отделка',
                    'Отсутствие усадки — можно сразу заезжать'
                ],
                'price' => 'от 4 500 руб./м²'
            ],
            6 => [
                'icon' => '🛠️',
                'title' => 'Отделочные работы',
                'description' => 'Мы выполняем внутреннюю и наружную отделку любой сложности. От черновой отделки до дизайнерского ремонта под ключ.',
                'details' => [
                    'Черновая отделка (стяжка, штукатурка)',
                    'Чистовая отделка (обои, плитка, ламинат)',
                    'Наружная отделка (штукатурка, вентилируемый фасад)',
                    'Сантехника и электрика',
                    'Дизайн-проект интерьера'
                ],
                'price' => 'от 3 500 руб./м²'
            ]
        ];

        // Получаем данные выбранной услуги
        $service = $services[$id] ?? $services[1];
        ?>

        <span class="icon-big"><?php echo $service['icon']; ?></span>
        <h1><?php echo $service['title']; ?></h1>
        <p><?php echo $service['description']; ?></p>

        <h3>Что входит в услугу:</h3>
        <ul>
            <?php foreach ($service['details'] as $item): ?>
                <li><?php echo $item; ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="price">💰 <?php echo $service['price']; ?></div>
        <a href="contacts.php" class="btn">Заказать услугу</a>
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

    // Обновляем хлебные крошки с названием услуги
    const nameElem = document.getElementById('service-name');
    if (nameElem) {
        const title = document.querySelector('.service-detail h1');
        if (title) {
            nameElem.textContent = title.textContent;
        }
    }
});
</script>

</body>
</html>