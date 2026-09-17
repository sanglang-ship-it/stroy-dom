<?php
// ==============================================
// ЭКСПОРТ ЗАЯВОК В EXCEL (CSV)
// ==============================================
require_once '../config.php';

// Запрос: получаем все заявки с данными клиента и статуса
$sql = "SELECT 
            a.app_id,
            c.full_name AS client_name,
            c.phone AS client_phone,
            c.email AS client_email,
            a.description,
            s.status_name,
            a.budget,
            a.date_created
        FROM applications a
        LEFT JOIN clients c ON a.client_id = c.client_id
        LEFT JOIN application_statuses s ON a.status_id = s.status_id
        ORDER BY a.date_created DESC";

$result = $conn->query($sql);

// Устанавливаем заголовки для скачивания файла
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="applications_' . date('Y-m-d') . '.csv"');

// Открываем поток вывода
$output = fopen('php://output', 'w');

// BOM для корректного отображения кириллицы в Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Заголовки таблицы
fputcsv($output, [
    '№',
    'Клиент',
    'Телефон',
    'Email',
    'Описание',
    'Статус',
    'Бюджет',
    'Дата создания'
], ';');

// Данные
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['app_id'],
            $row['client_name'] ?? '',
            $row['client_phone'] ?? '',
            $row['client_email'] ?? '',
            $row['description'] ?? '',
            $row['status_name'] ?? 'Новая',
            $row['budget'] ?? '',
            $row['date_created'] ?? ''
        ], ';');
    }
}

fclose($output);
exit;
?>