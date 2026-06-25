<?php
$host = 'localhost';
$dbname = 'university_db';
$username = 'root'; // غيره حسب إعدادات السيرفر لديك
$password = '';     // غيره حسب إعدادات السيرفر لديك

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // تفعيل وضع الأخطاء البرمجية للمساعدة في التطوير
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>