<?php
$host = 'sql104.infinityfree.com';
$user = 'if0_42830626';
$password = 'OJ0GF0QzsWv';
$dbname = 'if0_42830626_stroy_dom_db';

echo "Пытаюсь подключиться к БД...<br>";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    echo "<span style='color:red;font-weight:bold;'>Ошибка подключения: </span>" . $conn->connect_error;
} else {
    echo "<span style='color:green;font-weight:bold;'>✅ Подключение к базе данных УСПЕШНО!</span>";
    $conn->close();
}
?>