<?php
// ==============================================
// ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (InfinityFree) С ПРАВИЛЬНОЙ КОДИРОВКОЙ
// ==============================================

// Данные для подключения
$host = 'sql104.infinityfree.com';
$user = 'if0_42830626';
$password = 'OJ0GF0QzsWv';
$dbname = 'if0_42830626_stroy_dom_db';

// Создаем подключение
$conn = new mysqli($host, $user, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// ====== ГЛАВНОЕ: УСТАНАВЛИВАЕМ КОДИРОВКУ ПРИНУДИТЕЛЬНО ======
$conn->set_charset("utf8mb4");

// Дополнительный способ для старых версий MySQL (на всякий случай)
$conn->query("SET NAMES 'utf8mb4'");
$conn->query("SET CHARACTER SET 'utf8mb4'");
$conn->query("SET SESSION collation_connection = 'utf8mb4_unicode_ci'");

// Теперь переменная $conn доступна во всех файлах
?>