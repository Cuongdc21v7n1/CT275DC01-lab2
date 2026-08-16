<?php
require_once __DIR__ . '/../partials/db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('Thiếu ID.');
}

// Kiểm tra trích dẫn tồn tại
$stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
$stmt->execute([$id]);
$quote = $stmt->fetch();

if (!$quote) {
    exit('Không tìm thấy trích dẫn.');
}

// Thực hiện xóa
$del = $pdo->prepare("DELETE FROM quotes WHERE id = ?");
$del->execute([$id]);

echo "✅ Đã xóa trích dẫn. <a href='view_quotes.php'>Quay lại danh sách</a>";
