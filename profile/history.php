<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История - Личный кабинет</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .profile-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .profile-header .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .profile-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .profile-header .logo span { color: #E67E22; }
        .profile-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .profile-header nav a:hover { color: #E67E22; }
        .profile-header nav a.active { color: #E67E22; border-bottom: 2px solid #E67E22; padding-bottom: 5px; }
        .profile-header .user { color: #fff; font-size: 14px; }

        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; }
        .breadcrumbs span { color: #999; }

        .table-wrapper { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background: #f8f9fa; padding: 14px 16px; text-align: left; font-weight: bold; border-bottom: 2px solid #ddd; }
        table td { padding: 12px 16px; border-bottom: 1px solid #eee; }
        table tr:hover { background: #fafafa; }

        .status-done { background: #27ae60; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }
        .status-cancel { background: #e74c3c; color: #fff; padding: 3px 10px; border-radius: 4px; font-size: 12px; }

        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }

        @media (max-width: 768px) {
            .profile-header .container { flex-direction: column; text-align: center; }
            .profile-header nav a { display: inline-block; margin: 5px 10px; }
            table { font-size: 13px; }
            table th, table td { padding: 8px 10px; }
        }
    </style>
</head>
<body>

<header class="profile-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Личный кабинет</div>
        <nav>
            <a href="index.php">Профиль</a>
            <a href="applications.php">Мои заявки</a>
            <a href="history.php" class="active">История</a>
            <a href="settings.php">Настройки</a>
            <a href="../index.php">На сайт</a>
        </nav>
        <div class="user">👤 Алексей Иванов</div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Личный кабинет / <span>История</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <h1 style="margin-bottom: 20px;">📜 История обращений</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Услуга</th>
                        <th>Статус</th>
                        <th>Дата завершения</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>003</td>
                        <td>Отделочные работы</td>
                        <td><span class="status-done">Завершено</span></td>
                        <td>20.12.2025</td>
                        <td>420 000 руб.</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Строительство из кирпича</td>
                        <td><span class="status-cancel">Отказ</span></td>
                        <td>18.12.2025</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>Проектирование домов</td>
                        <td><span class="status-done">Завершено</span></td>
                        <td>15.11.2025</td>
                        <td>25 000 руб.</td>
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