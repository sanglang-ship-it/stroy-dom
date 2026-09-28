<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: portfolio.php');
    exit;
}

$stmt = $conn->prepare("SELECT p.*, 
                        GROUP_CONCAT(s.title SEPARATOR ', ') AS services_list
                        FROM projects p
                        LEFT JOIN service_projects sp ON p.project_id = sp.project_id
                        LEFT JOIN services s ON sp.service_id = s.service_id
                        WHERE p.project_id = ?
                        GROUP BY p.project_id");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$stmt->close();

if (!$project) {
    header('Location: 404.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($project['title']); ?> - СтройДом</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #F8F9FA; color: #333; line-height: 1.6; }
        a { text-decoration: none; color: #2C3E50; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        header { background: #2C3E50; padding: 15px 0; border-bottom: 3px solid #E67E22; }
        header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .logo { font-size: 28px; font-weight: 700; color: #fff; }
        .logo span { color: #E67E22; }
        nav a { color: #fff; margin: 0 15px; font-weight: 500; }
        .breadcrumbs { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; font-size: 14px; }
        .breadcrumbs a { color: #E67E22; }
        .breadcrumbs span { color: #999; }
        .project-detail { padding: 60px 0; max-width: 900px; margin: 0 auto; }
        .project-detail h1 { font-size: 36px; color: #2C3E50; margin-bottom: 20px; }
        .project-detail .description { font-size: 18px; color: #555; margin-bottom: 30px; }
        .info-block { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .info-item { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #eee; }
        .info-item:last-child { border-bottom: none; }
        .info-item .label { color: #888; }
        .info-item .value { font-weight: 500; }
        .btn { display: inline-block; background: #E67E22; color: #fff; padding: 14px 40px; border-radius: 5px; font-weight: 600; }
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
            <a href="login.php" style="background: #E67E22; padding: 6px 15px; border-radius: 5px; color: #fff;">👤 Войти</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">
        <a href="index.php">Главная</a> / <a href="portfolio.php">Портфолио</a> / <span><?php echo htmlspecialchars($project['title']); ?></span>
    </div>
</div>

<section class="project-detail">
    <div class="container">
        <h1><?php echo htmlspecialchars($project['title']); ?></h1>
        <p class="description"><?php echo htmlspecialchars($project['description']); ?></p>

        <div class="info-block">
            <div class="info-item">
                <span class="label">Материал</span>
                <span class="value"><?php echo htmlspecialchars($project['material_type'] ?? '—'); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Площадь</span>
                <span class="value"><?php echo $project['area'] ? $project['area'] . ' м²' : '—'; ?></span>
            </div>
            <div class="info-item">
                <span class="label">Год постройки</span>
                <span class="value"><?php echo htmlspecialchars($project['year_built'] ?? '—'); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Адрес</span>
                <span class="value"><?php echo htmlspecialchars($project['address'] ?? '—'); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Услуги</span>
                <span class="value"><?php echo htmlspecialchars($project['services_list'] ?? '—'); ?></span>
            </div>
        </div>

        <a href="contacts.php" class="btn">Хочу такой дом</a>
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