<?php
require_once __DIR__ . '/../partials/db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('Thiếu ID.');
}

// Lấy trích dẫn hiện tại
$stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
$stmt->execute([$id]);
$quote = $stmt->fetch();

if (!$quote) {
    exit('Không tìm thấy trích dẫn.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_quote = $_POST['quote'] ?? '';
    $new_source = $_POST['source'] ?? '';
    $favorite = isset($_POST['favorite']) ? true : false;

    $update = $pdo->prepare("UPDATE quotes SET quote = ?, source = ?, favorite = ? WHERE id = ?");
    $update->execute([$new_quote, $new_source, $favorite, $id]);
    echo "Đã cập nhật thành công. <a href='view_quotes.php'>Quay lại</a>";
    exit;
}
?>

<form method="post">
    <label>Trích dẫn:<br>
        <textarea name="quote" rows="4" cols="40"><?= htmlspecialchars($quote['quote']) ?></textarea>
    </label><br>
    <label>Nguồn: <input type="text" name="source" value="<?= htmlspecialchars($quote['source']) ?>"></label><br>
    <label><input type="checkbox" name="favorite" <?= $quote['favorite'] ? 'checked' : '' ?>> Yêu thích</label><br>
    <button type="submit">Lưu</button>
</form>
