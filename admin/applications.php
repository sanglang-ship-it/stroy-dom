<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .admin-header nav a:hover { color: #E67E22; }
        .admin-header nav a.active { color: #E67E22; border-bottom: 2px solid #E67E22; padding-bottom: 5px; }

        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }

        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        table tr:hover { background: #fafafa; }

        .status-new { background: #3498db; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-work { background: #f39c12; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-ready { background: #2ecc71; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-done { background: #27ae60; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-cancel { background: #e74c3c; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }

        .btn-edit { background: #E67E22; color: #fff; padding: 4px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; }
        .btn-edit:hover { background: #D35400; }

        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php">Дашборд</a>
            <a href="applications.php" class="active">Заявки</a>
            <a href="clients.php">Клиенты</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <span>Заявки</span></div>
</div>

<section style="padding: 20px 0;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">📋 Управление заявками</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Клиент</th>
                        <th>Телефон</th>
                        <th>Услуга</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Иванов Алексей</td>
                        <td>+7 (903) 123-45-67</td>
                        <td>Проектирование</td>
                        <td><span class="status-new">Новая</span></td>
                        <td>15.12.2025</td>
                        <td><a href="#" class="btn-edit">✏️</a></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Петрова Ольга</td>
                        <td>+7 (916) 987-65-43</td>
                        <td>Кирпичный дом</td>
                        <td><span class="status-work">В работе</span></td>
                        <td>14.12.2025</td>
                        <td><a href="#" class="btn-edit">✏️</a></td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Соколов Денис</td>
                        <td>+7 (925) 111-22-33</td>
                        <td>Газобетонный дом</td>
                        <td><span class="status-ready">Смета готова</span></td>
                        <td>12.12.2025</td>
                        <td><a href="#" class="btn-edit">✏️</a></td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Морозова Елена</td>
                        <td>+7 (926) 444-55-66</td>
                        <td>Деревянный дом</td>
                        <td><span class="status-done">Договор заключен</span></td>
                        <td>10.12.2025</td>
                        <td><a href="#" class="btn-edit">✏️</a></td>
                    </tr>
                    <tr>
                        <td>005</td>
                        <td>Кузнецов Павел</td>
                        <td>+7 (909) 777-88-99</td>
                        <td>Отделочные работы</td>
                        <td><span class="status-cancel">Отказ</span></td>
                        <td>08.12.2025</td>
                        <td><a href="#" class="btn-edit">✏️</a></td>
                    </tr>
                </tbody>
            </table>
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