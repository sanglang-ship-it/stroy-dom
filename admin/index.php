<?php
// Это просто заглушка для демонстрации. Позже мы подключим реальную базу данных.
$total_applications = 5;
$total_clients = 8;
$total_services = 6;
$total_portfolio = 4;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - СтройДом</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* Шапка админки */
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .admin-header nav a:hover { color: #E67E22; }
        .admin-header nav a.active { color: #E67E22; border-bottom: 2px solid #E67E22; padding-bottom: 5px; }

        /* Хлебные крошки */
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }

        /* Карточки статистики */
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; }
        .stat-card .number { font-size: 32px; font-weight: bold; color: #2C3E50; }
        .stat-card .label { color: #888; font-size: 14px; }

        /* Сетка меню админки */
        .admin-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .admin-card { background: #fff; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .admin-card .icon { font-size: 40px; display: block; margin-bottom: 10px; }
        .admin-card h3 { margin-bottom: 5px; }
        .admin-card .btn { display: inline-block; margin-top: 15px; background: #E67E22; color: #fff; padding: 8px 20px; border-radius: 5px; text-decoration: none; }
        .admin-card .btn:hover { background: #D35400; }

        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php" class="active">Дашборд</a>
            <a href="applications.php">Заявки</a>
            <a href="clients.php">Клиенты</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Дашборд</span></div>
</div>

<section style="padding: 20px 0;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">📊 Статистика</h1>
        
        <div class="stats">
            <div class="stat-card">
                <div class="number"><?php echo $total_applications; ?></div>
                <div class="label">Всего заявок</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_clients; ?></div>
                <div class="label">Клиентов</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_services; ?></div>
                <div class="label">Услуг</div>
            </div>
            <div class="stat-card">
                <div class="number"><?php echo $total_portfolio; ?></div>
                <div class="label">Проектов</div>
            </div>
        </div>

        <h2 style="margin: 40px 0 20px;">Быстрое управление</h2>
        <div class="admin-grid">
            <div class="admin-card">
                <span class="icon">📋</span>
                <h3>Заявки</h3>
                <p>Просмотр и обработка</p>
                <a href="applications.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">👤</span>
                <h3>Клиенты</h3>
                <p>Управление клиентами</p>
                <a href="clients.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">🔧</span>
                <h3>Услуги</h3>
                <p>Редактирование услуг</p>
                <a href="services.php" class="btn">Перейти</a>
            </div>
            <div class="admin-card">
                <span class="icon">🖼️</span>
                <h3>Портфолио</h3>
                <p>Управление проектами</p>
                <a href="portfolio.php" class="btn">Перейти</a>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>© 2026 СтройДом. Разработчик: Дарк Александра Юлия Александровна</p>
    </div>
</footer>

</body>
</html>