<?php
require_once 'config.php';

$query = trim($_GET['q'] ?? '');
$results = [];

if (!empty($query)) {
    $search = '%' . $query . '%';

    // Поиск по статьям
    $stmt = $conn->prepare("SELECT article_id AS id, title, 'article' AS type, 
                                   LEFT(content, 200) AS excerpt 
                            FROM articles 
                            WHERE is_published = 1 AND (title LIKE ? OR content LIKE ?)");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $results[] = $row;
    $stmt->close();

    // Поиск по услугам
    $stmt = $conn->prepare("SELECT service_id AS id, title, 'service' AS type, 
                                   description AS excerpt 
                            FROM services 
                            WHERE is_active = 1 AND (title LIKE ? OR description LIKE ?)");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $results[] = $row;
    $stmt->close();

    // Поиск по проектам
    $stmt = $conn->prepare("SELECT project_id AS id, title, 'project' AS type, 
                                   description AS excerpt 
                            FROM projects 
                            WHERE title LIKE ? OR description LIKE ?");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) $results[] = $row;
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск - СтройДом</title>
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
        .search-section { padding: 60px 0; }
        .search-form { max-width: 600px; margin: 0 auto 40px; display: flex; gap: 10px; }
        .search-form input { flex: 1; padding: 14px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        .search-form button { background: #E67E22; color: #fff; padding: 14px 30px; border: none; border-radius: 5px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .search-form button:hover { background: #D35400; }
        .result-item { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .result-item h3 { margin-bottom: 8px; }
        .result-item h3 a { color: #2C3E50; }
        .result-item h3 a:hover { color: #E67E22; }
        .result-item .type { display: inline-block; background: #E67E22; color: #fff; padding: 2px 8px; border-radius: 3px; font-size: 12px; margin-bottom: 8px; }
        .result-item p { color: #666; font-size: 15px; }
        .no-results { text-align: center; color: #888; padding: 40px; }
        footer { background: #2C3E50; color: #fff; padding: 40px 0 20px; }
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
        <a href="index.php">Главная</a> / <span>Поиск</span>
    </div>
</div>

<section class="search-section">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 30px; color: #2C3E50;">🔍 Поиск по сайту</h1>

        <form class="search-form" action="search.php" method="GET">
            <input type="text" name="q" placeholder="Введите запрос..." value="<?php echo htmlspecialchars($query); ?>" required>
            <button type="submit">Найти</button>
        </form>

        <?php if (!empty($query)): ?>
            <?php if (!empty($results)): ?>
                <p style="margin-bottom: 20px; color: #666;">Найдено результатов: <b><?php echo count($results); ?></b></p>
                <?php foreach ($results as $r): ?>
                    <div class="result-item">
                        <span class="type">
                            <?php 
                            echo $r['type'] === 'article' ? 'Статья' 
                                : ($r['type'] === 'service' ? 'Услуга' : 'Проект'); 
                            ?>
                        </span>
                        <h3>
                            <?php 
                            $link = $r['type'] === 'article' ? 'article.php?id=' . $r['id'] 
                                  : ($r['type'] === 'service' ? 'service-detail.php?id=' . $r['id'] 
                                  : 'portfolio.php');
                            ?>
                            <a href="<?php echo $link; ?>"><?php echo htmlspecialchars($r['title']); ?></a>
                        </h3>
                        <p><?php echo htmlspecialchars(mb_substr(strip_tags($r['excerpt']), 0, 200)); ?>...</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">По запросу «<?php echo htmlspecialchars($query); ?>» ничего не найдено</p>
            <?php endif; ?>
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