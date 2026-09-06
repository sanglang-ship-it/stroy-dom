<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля - Личный кабинет</title>
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

        .settings-box { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .settings-box h2 { margin-bottom: 20px; color: #2C3E50; }
        .settings-box label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; }
        .settings-box input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 15px; }
        .settings-box input:focus { border-color: #E67E22; outline: none; }
        .settings-box .btn { width: 100%; background: #E67E22; color: #fff; padding: 14px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; }
        .settings-box .btn:hover { background: #D35400; }
        .settings-box .btn-outline { background: transparent; border: 2px solid #2C3E50; color: #2C3E50; margin-top: 10px; }
        .settings-box .btn-outline:hover { background: #2C3E50; color: #fff; }

        footer { background: #2C3E50; color: #fff; text-align: center; padding: 20px 0; margin-top: 40px; font-size: 14px; }

        @media (max-width: 768px) {
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
        <div class="user">👤 Алексей Иванов</div>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Личный кабинет / <span>Редактирование профиля</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="settings-box">
            <h2>✏️ Редактирование профиля</h2>
            <form action="#" method="POST">
                <label for="name">ФИО</label>
                <input type="text" id="name" name="name" value="Алексей Иванов" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="alexey@mail.ru" required>

                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" value="+7 (903) 123-45-67">

                <label for="address">Адрес</label>
                <input type="text" id="address" name="address" value="Москва, ул. Ленина, д. 10">

                <button type="submit" class="btn">💾 Сохранить изменения</button>
                <a href="index.php" class="btn btn-outline" style="display:block; text-align:center; text-decoration:none; padding:14px; border-radius:5px; margin-top:10px;">⬅ Назад в профиль</a>
            </form>
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