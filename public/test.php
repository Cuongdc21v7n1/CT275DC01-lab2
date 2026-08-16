<?php
// Hiển thị lỗi nếu có
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thông tin kết nối CSDL
$host = 'localhost';
$db   = 'ct275_lab2';
$user = 'postgres';
$pass = 'admin'; // đổi theo mật khẩu thật
$port = '5432';

try {
    // Kết nối bằng PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Thực hiện truy vấn đơn giản
    $sql = "SELECT quote FROM quotes LIMIT 1";
    $stmt = $pdo->query($sql);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo " Quote: " . htmlspecialchars($row['quote']);
    } else {
        echo " Không có dữ liệu trong bảng quotes.";
    }

} catch (PDOException $e) {
    echo " Lỗi kết nối CSDL: " . $e->getMessage();
}
