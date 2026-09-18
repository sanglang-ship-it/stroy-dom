<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статья - СтройДом</title>
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
        nav a { color: #fff; margin: 0 15px; font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: #E67E22; }
        .theme-toggle { background: #E67E22; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .theme-toggle:hover { background: #D35400; }
        .header-contacts { color: #fff; font-size: 14px; }

        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }

        .article-detail { padding: 60px 0; max-width: 800px; margin: 0 auto; }
        .article-detail h1 { font-size: 36px; color: #2C3E50; margin-bottom: 10px; }
        .article-detail .meta { color: #999; font-size: 14px; margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .article-detail .content { font-size: 18px; color: #444; }
        .article-detail .content p { margin-bottom: 20px; }
        .article-detail .back-link { display: inline-block; margin-top: 40px; background: #E67E22; color: #fff; padding: 12px 25px; border-radius: 5px; transition: background 0.3s; }
        .article-detail .back-link:hover { background: #D35400; color: #fff; }

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
        body.dark-theme .article-detail h1 { color: #fff !important; }
        body.dark-theme .article-detail .content { color: #ccc !important; }
        body.dark-theme .article-detail .meta { color: #aaa !important; border-bottom-color: #444 !important; }
        body.dark-theme .article-detail .back-link { background: #FFFF00 !important; color: #000 !important; font-size: 20px !important; padding: 14px 30px !important; }
        body.dark-theme footer { background: #111 !important; border-top: 2px solid #444 !important; }
        body.dark-theme .footer-grid h4 { color: #FFFF00 !important; }
        body.dark-theme .footer-grid p, body.dark-theme .footer-grid a { color: #ccc !important; }
        body.dark-theme .footer-grid a:hover { color: #FFFF00 !important; }
        body.dark-theme .theme-toggle { background: #FFFF00 !important; color: #000 !important; font-size: 18px !important; padding: 10px 20px !important; }

        @media (max-width: 768px) {
            header .container { flex-direction: column; text-align: center; }
            nav a { display: inline-block; margin: 5px 10px; }
            .article-detail h1 { font-size: 28px; }
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
        <a href="index.php">Главная</a> / <a href="blog.php">Блог</a> / <span id="article-title">Статья</span>
    </div>
</div>

<section class="article-detail">
    <div class="container">
        <?php
        // Получаем ID статьи из URL
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

        // Данные статей
        $articles = [
            1 => [
                'title' => 'Как выбрать материал для строительства дома?',
                'date' => '15 декабря 2025',
                'content' => '
                    <p>Выбор материала для строительства дома — одно из самых важных решений, которое влияет на стоимость, сроки и комфорт проживания.</p>
                    <p><strong>Кирпич</strong> — классический вариант. Кирпичные дома долговечны, огнестойки и имеют отличную звукоизоляцию. Однако кирпич требует времени на усадку и имеет высокую стоимость.</p>
                    <p><strong>Газобетон</strong> — современный материал, который обеспечивает хорошую теплоизоляцию. Дома из газобетона строятся быстрее и стоят дешевле кирпичных. При этом они требуют качественной наружной отделки.</p>
                    <p><strong>Дерево (брус, бревно)</strong> — экологичный выбор. Деревянные дома имеют уникальный микроклимат, но требуют регулярного ухода и защиты от влаги.</p>
                    <p><strong>Каркасные дома</strong> — самый быстрый и экономичный вариант. Технология позволяет построить дом за 2-3 месяца. При правильном утеплении такие дома ничем не уступают по теплоэффективности.</p>
                    <p>Рекомендуем проконсультироваться со специалистом, чтобы подобрать оптимальный материал под ваш бюджет и требования.</p>
                '
            ],
            2 => [
                'title' => 'Этапы строительства дома под ключ',
                'date' => '10 декабря 2025',
                'content' => '
                    <p>Строительство дома под ключ включает несколько ключевых этапов:</p>
                    <p><strong>1. Проектирование.</strong> Разработка архитектурного и конструктивного проекта, согласование с заказчиком, получение разрешений.</p>
                    <p><strong>2. Закладка фундамента.</strong> Один из самых ответственных этапов. Выбор типа фундамента зависит от грунта и этажности дома.</p>
                    <p><strong>3. Возведение стен.</strong> Кладка стен из выбранного материала. На этом этапе формируется коробка дома.</p>
                    <p><strong>4. Кровля.</strong> Установка стропильной системы и кровельного покрытия.</p>
                    <p><strong>5. Инженерные системы.</strong> Отопление, электрика, водопровод, вентиляция.</p>
                    <p><strong>6. Отделка.</strong> Внутренняя и наружная отделка, установка дверей и окон.</p>
                    <p><strong>7. Сдача объекта.</strong> Подписание акта приёма-передачи и гарантийное обслуживание.</p>
                '
            ],
            3 => [
                'title' => 'Как сэкономить на строительстве без потери качества?',
                'date' => '5 декабря 2025',
                'content' => '
                    <p>Строительство дома — это серьёзные затраты. Но есть способы сократить бюджет без потери качества:</p>
                    <p><strong>1. Выбор правильного времени года.</strong> Зимой на стройматериалы часто действуют скидки до 20-30%.</p>
                    <p><strong>2. Типовой проект.</strong> Индивидуальный проект стоит дороже типового. Если вам подходит типовое решение, это может сэкономить сотни тысяч рублей.</p>
                    <p><strong>3. Сравнение материалов.</strong> Не всегда дороже — значит лучше. Например, газобетон может быть выгоднее кирпича при сопоставимых характеристиках.</p>
                    <p><strong>4. Контроль работ.</strong> Личный контроль или привлечение технического надзора поможет избежать перерасхода материалов и брака.</p>
                    <p><strong>5. Комплексный подход.</strong> Заказ строительства под ключ у одной компании часто выгоднее, чем поиск отдельных подрядчиков.</p>
                '
            ],
            4 => [
                'title' => 'Выбор участка под строительство: на что обратить внимание?',
                'date' => '28 ноября 2025',
                'content' => '
                    <p>Выбор земельного участка — первый и очень важный шаг в строительстве дома. Вот на что стоит обратить внимание:</p>
                    <p><strong>1. Геология.</strong> Тип грунта и уровень грунтовых вод влияют на выбор фундамента.</p>
                    <p><strong>2. Коммуникации.</strong> Наличие газа, электричества, воды и канализации на участке или рядом с ним. Подведение коммуникаций может быть дорогим.</p>
                    <p><strong>3. Инфраструктура.</strong> Близость к дорогам, школам, магазинам и больницам.</p>
                    <p><strong>4. Рельеф.</strong> Ровный участок проще и дешевле строить. Перепад высот увеличит затраты на фундамент.</p>
                    <p><strong>5. Назначение участка.</strong> Убедитесь, что участок предназначен для индивидуального жилищного строительства (ИЖС).</p>
                '
            ],
            5 => [
                'title' => 'Утепление дома: какие материалы лучше?',
                'date' => '20 ноября 2025',
                'content' => '
                    <p>Правильное утепление дома — это комфорт и экономия на отоплении. Сравним популярные утеплители:</p>
                    <p><strong>Минеральная вата.</strong> Экологичный, негорючий материал с хорошими звукоизоляционными свойствами. Требует защиты от влаги.</p>
                    <p><strong>Пенополистирол (пенопласт).</strong> Лёгкий, влагостойкий и недорогой, но горючий и может привлекать грызунов.</p>
                    <p><strong>Эковата.</strong> Натуральный материал на основе целлюлозы. Обеспечивает хорошую теплоизоляцию и создаёт бесшовное покрытие.</p>
                    <p><strong>Пеноплекс (экструдированный пенополистирол).</strong> Прочный, влагостойкий, с низкой теплопроводностью. Идеален для фундамента и цоколя.</p>
                    <p>Оптимальный выбор зависит от утепляемой зоны (стены, крыша, пол) и бюджета. Мы поможем подобрать лучшее решение.</p>
                '
            ]
        ];

        // Получаем данные выбранной статьи
        $article = $articles[$id] ?? $articles[1];
        ?>

        <h1><?php echo $article['title']; ?></h1>
        <div class="meta">📅 <?php echo $article['date']; ?></div>
        <div class="content">
            <?php echo $article['content']; ?>
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

    // Обновляем хлебные крошки с названием статьи
    const titleElem = document.getElementById('article-title');
    if (titleElem) {
        const title = document.querySelector('.article-detail h1');
        if (title) {
            titleElem.textContent = title.textContent;
        }
    }
});
</script>

</body>
</html>