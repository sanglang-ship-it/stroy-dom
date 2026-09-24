<?php
session_start();
require_once '../config.php';

// Проверка роли
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'manager')) {
    header('Location: ../login.php');
    exit;
}

// Получаем ID заявки
$app_id = (int)($_GET['id'] ?? 0);
if ($app_id <= 0) {
    header('Location: applications.php');
    exit;
}

// Получаем данные заявки
$stmt = $conn->prepare("SELECT a.*, c.full_name AS client_name, c.phone AS client_phone, c.email AS client_email
                        FROM applications a
                        LEFT JOIN clients c ON a.client_id = c.client_id
                        WHERE a.app_id = ? LIMIT 1");
$stmt->bind_param("i", $app_id);
$stmt->execute();
$result = $stmt->get_result();
$app = $result->fetch_assoc();
$stmt->close();

if (!$app) {
    header('Location: applications.php');
    exit;
}

// Получаем список статусов
$statuses = $conn->query("SELECT status_id, status_name FROM application_statuses ORDER BY sort_order");

// Получаем список менеджеров из таблицы clients
$managers = $conn->query("SELECT client_id AS emp_id, full_name FROM clients 
                          WHERE role = 'manager' 
                          ORDER BY full_name");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование заявки - Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 0 20px; }
        .admin-header { background: #2C3E50; padding: 15px 0; border-bottom: 4px solid #E67E22; }
        .admin-header .container { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; }
        .admin-header .logo { font-size: 24px; font-weight: bold; color: #fff; }
        .admin-header .logo span { color: #E67E22; }
        .admin-header nav a { color: #fff; margin: 0 15px; text-decoration: none; font-size: 14px; }
        .breadcrumbs { background: #fff; padding: 12px 0; margin-bottom: 30px; border-bottom: 1px solid #ddd; font-size: 14px; max-width: 100%; }
        .breadcrumbs .container { max-width: 800px; }
        .breadcrumbs span { color: #999; }
        .form-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .form-box h1 { margin-bottom: 20px; }
        .form-box label { display: block; font-weight: bold; margin-bottom: 5px; margin-top: 15px; }
        .form-box input, .form-box select, .form-box textarea {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; font-family: inherit;
        }
        .form-box textarea { resize: vertical; min-height: 100px; }
        .form-box .btn { background: #E67E22; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .form-box .btn:hover { background: #D35400; }
        .form-box .btn-back { background: #95a5a6; margin-left: 10px; text-decoration: none; display: inline-block; }
        .form-box .btn-back:hover { background: #7f8c8d; }
        .info-block { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-size: 14px; }
        .info-block p { margin-bottom: 5px; }
        .info-block b { color: #2C3E50; }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="container">
        <div class="logo">Строй<span>Дом</span> | Админ-панель</div>
        <nav>
            <a href="index.php">Дашборд</a>
            <a href="applications.php">Заявки</a>
            <a href="clients.php">Клиенты</a>
            <a href="services.php">Услуги</a>
            <a href="portfolio.php">Портфолио</a>
            <a href="../index.php">На сайт</a>
        </nav>
    </div>
</header>

<div class="breadcrumbs">
    <div class="container">Админ-панель / <a href="applications.php">Заявки</a> / <span>Редактирование</span></div>
</div>

<section style="padding: 20px 0 40px;">
    <div class="container">
        <div class="form-box">
            <?php if (isset($_GET['service_added'])): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    ✅ Услуга успешно привязана к заявке
                </div>
            <?php endif; ?>
            <h1>✏️ Редактирование заявки №<?php echo $app['app_id']; ?></h1>

            <div class="info-block">
                <p><b>Клиент:</b> <?php echo htmlspecialchars($app['client_name']); ?></p>
                <p><b>Телефон:</b> <?php echo htmlspecialchars($app['client_phone']); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($app['client_email']); ?></p>
                <p><b>Дата создания:</b> <?php echo date('d.m.Y H:i', strtotime($app['date_created'])); ?></p>
            </div>

            <?php
            // Получаем услуги по заявке
            $stmt = $conn->prepare("SELECT s.title, aps.quantity, aps.unit_price, aps.total_price 
                                    FROM app_services aps 
                                    LEFT JOIN services s ON aps.service_id = s.service_id 
                                    WHERE aps.app_id = ?");
            $stmt->bind_param("i", $app_id);
            $stmt->execute();
            $services_result = $stmt->get_result();
            $stmt->close();
            ?>

            <?php if ($services_result && $services_result->num_rows > 0): ?>
                <h3 style="margin-top: 20px; color: #2C3E50;">Услуги по заявке</h3>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px;">
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Услуга</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Кол-во</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Цена</th>
                        <th style="padding: 10px; border-bottom: 2px solid #ddd;">Сумма</th>
                    </tr>
                    <?php 
                    $total = 0;
                    while ($srv = $services_result->fetch_assoc()): 
                        $total += $srv['total_price'];
                    ?>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($srv['title']); ?></td>
                            <td style="padding: 10px; text-align: center; border-bottom: 1px solid #eee;"><?php echo $srv['quantity']; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo number_format($srv['unit_price'], 0, ',', ' '); ?> руб.</td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><b><?php echo number_format($srv['total_price'], 0, ',', ' '); ?> руб.</b></td>
                        </tr>
                    <?php endwhile; ?>
                    <tr style="background: #f8f9fa;">
                        <td colspan="3" style="padding: 10px; text-align: right;"><b>Итого:</b></td>
                        <td style="padding: 10px;"><b><?php echo number_format($total, 0, ',', ' '); ?> руб.</b></td>
                    </tr>
                </table>
            <?php else: ?>
                <p style="color: #888; margin-top: 15px;">Услуги по этой заявке не привязаны</p>
            <?php endif; ?>

            <!-- ===== ФОРМА ПРИВЯЗКИ УСЛУГИ ===== -->
            <h3 style="margin-top: 30px; color: #2C3E50;">➕ Добавить услугу к заявке</h3>

            <?php
            $all_services = $conn->query("SELECT service_id, title, cost, unit FROM services WHERE is_active = 1 ORDER BY sort_order");
            ?>

            <form action="add_app_service.php" method="POST" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">

                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Услуга</label>
                <select name="service_id" id="service_select" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 15px;"
                        onchange="updatePrice()">
                    <option value="">— выберите услугу —</option>
                    <?php while ($s = $all_services->fetch_assoc()): ?>
                        <option value="<?php echo $s['service_id']; ?>" 
                                data-price="<?php echo $s['cost']; ?>"
                                data-unit="<?php echo htmlspecialchars($s['unit']); ?>">
                            <?php echo htmlspecialchars($s['title']); ?> — <?php echo number_format($s['cost'], 0, ',', ' '); ?> руб./<?php echo htmlspecialchars($s['unit']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Количество</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 15px;">

                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Цена за единицу (руб.)</label>
                <input type="number" name="unit_price" id="unit_price" step="0.01" required
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 15px;">

                <div style="background: #fff; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <b>Итоговая сумма:</b> <span id="total_price_view" style="color: #E67E22; font-size: 18px;">0 руб.</span>
                </div>

                <button type="submit" style="background: #27ae60; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;">
                    ✅ Привязать услугу
                </button>
            </form>

            <script>
            function updatePrice() {
                var select = document.getElementById('service_select');
                var option = select.options[select.selectedIndex];
                var price = parseFloat(option.getAttribute('data-price')) || 0;
                document.getElementById('unit_price').value = price;
                updateTotal();
            }

            function updateTotal() {
                var qty = parseFloat(document.getElementById('quantity').value) || 0;
                var price = parseFloat(document.getElementById('unit_price').value) || 0;
                var total = qty * price;
                document.getElementById('total_price_view').textContent = total.toLocaleString('ru-RU') + ' руб.';
            }

            document.getElementById('quantity').addEventListener('input', updateTotal);
            document.getElementById('unit_price').addEventListener('input', updateTotal);
            </script>

            <form action="update_application.php" method="POST">
                <input type="hidden" name="app_id" value="<?php echo $app['app_id']; ?>">

                <label>Статус заявки</label>
                <select name="status_id">
                    <?php while ($s = $statuses->fetch_assoc()): ?>
                        <option value="<?php echo $s['status_id']; ?>"
                            <?php echo ($s['status_id'] == $app['status_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($s['status_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Ответственный менеджер</label>
                <select name="manager_id">
                    <option value="">— не назначен —</option>
                    <?php while ($m = $managers->fetch_assoc()): ?>
                        <option value="<?php echo $m['emp_id']; ?>"
                            <?php echo ($m['emp_id'] == $app['manager_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($m['full_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Бюджет (руб.)</label>
                <input type="number" name="budget" value="<?php echo $app['budget']; ?>" step="0.01">

                <label>Описание</label>
                <textarea name="description"><?php echo htmlspecialchars($app['description']); ?></textarea>

                <button type="submit" class="btn">💾 Сохранить изменения</button>
                <a href="applications.php" class="btn btn-back">← Назад к списку</a>
            </form>
        </div>
    </div>
</section>

</body>
</html>