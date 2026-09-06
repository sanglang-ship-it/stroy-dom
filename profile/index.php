<?php
// Заглушка для демонстрации (позже подключим базу данных)
$client_name = "Алексей Иванов";
$client_email = "alexey@mail.ru";
$client_phone = "+7 (903) 123-45-67";
$total_applications = 3;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - СтройДом</title>
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

        .profile-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 30px; }
        .profile-sidebar { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .profile-sidebar .avatar { font-size: 60px; text-align: center; display: block; margin-bottom: 10px; }
        .profile-sidebar h3 { text-align: center; margin-bottom: 5px; }
        .profile-sidebar p { text-align: center; color: #888; font-size: 14px; margin-bottom: 15px; }
        .profile-sidebar .btn { display: block; width: 100%; background: #E67E22; color: #fff; padding: 10px; text-align: center; border-radius: 5px; text-decoration: none; margin-top: 8px; }
        .profile-sidebar .btn:hover { background: #D35400; }
        .profile-sidebar .btn-outline { background: transparent; border: 2px solid #E67E22; color: #E67E22; }
        .profile-sidebar .btn-outline:hover { background: #E67E22; color: #fff; }

        .profile-content { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .profile-content h2 { margin-bottom: 20px; color: #2C3E50; }
        .info-item { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #eee; }
        .info-item .label { color: #888; }
        .info-item .value { font-weight: 500; }

        .stats-mini { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px; margin-top: 20px; }
        .stat-mini { background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; }
        .stat-mini .number { font-size: 24px; font-weight: bold; color: #2C3E50; }
        .stat-mini .label { font-size: 13px; color: #888; }

        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }

        @media (max-width: 768px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-header .container { flex-direction: column; text-align: center; }
            .profile-header nav a { display: inline-block; margin: 5px 10px; }
        }
    </style>
</head>
<body>

<header class="profile-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Личный кабинет</div>
        <nav>
            <a href="index.php" class="active">Профиль</a>
            <a href="applications.php">Мои заявки</a>
            <a href="history.php">История</a>
            <a href="settings.php">Настройки</a>
            <a href="../index.php">На сайт</a>
        </nav>
        <div class="user">👤 <?php echo $client_name; ?></div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Личный кабинет / <span>Профиль</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="profile-grid">
            <!-- Боковая панель -->
            <div class="profile-sidebar">
                <span class="avatar">👤</span>
                <h3><?php echo $client_name; ?></h3>
                <p><?php echo $client_email; ?></p>
                <a href="edit.php" class="btn">✏️ Редактировать профиль</a>
                <a href="settings.php" class="btn btn-outline">⚙️ Настройки</a>
                <a href="../index.php" style="display:block; margin-top:15px; text-align:center; color:#e74c3c; font-size:14px;">🚪 Выйти</a>
            </div>

            <!-- Основной контент -->
            <div class="profile-content">
                <h2>👋 Добро пожаловать!</h2>
                <p style="color: #666; margin-bottom: 20px;">В вашем личном кабинете вы можете отслеживать заявки, редактировать данные и управлять настройками.</p>

                <div class="info-item">
                    <span class="label">📛 ФИО</span>
                    <span class="value"><?php echo $client_name; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">📧 Email</span>
                    <span class="value"><?php echo $client_email; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">📞 Телефон</span>
                    <span class="value"><?php echo $client_phone; ?></span>
                </div>
                <div class="info-item" style="border-bottom: none;">
                    <span class="label">📅 Дата регистрации</span>
                    <span class="value">15 ноября 2025</span>
                </div>

                <div class="stats-mini">
                    <div class="stat-mini">
                        <div class="number"><?php echo $total_applications; ?></div>
                        <div class="label">Всего заявок</div>
                    </div>
                    <div class="stat-mini">
                        <div class="number">1</div>
                        <div class="label">В работе</div>
                    </div>
                    <div class="stat-mini">
                        <div class="number">1</div>
                        <div class="label">Завершено</div>
                    </div>
                </div>

                <a href="applications.php" style="display:inline-block; margin-top:20px; background:#E67E22; color:#fff; padding:10px 25px; border-radius:5px; text-decoration:none;">📋 Мои заявки →</a>
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