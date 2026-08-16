<?php

define('TITLE', 'Xem tất cả các Trích dẫn');
include_once __DIR__ . '/../partials/header.php';

echo '<h2>Tất cả các Trích dẫn</h2>';

require_once __DIR__ . '/../partials/check_admin.php';
require_once __DIR__ . '/../partials/db_connect.php';

try {
    $sql = "SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC";
    $stmt = $pdo->query($sql);
    $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($quotes) {
        echo '<ul>';
        foreach ($quotes as $row) {
            $quote = htmlspecialchars($row['quote']);
            $source = htmlspecialchars($row['source']);
            $id = $row['id'];
            $favorite = $row['favorite'] ? '<strong> [Yêu thích]</strong>' : '';

            echo "<li>
                <blockquote>{$quote}</blockquote>
                - {$source} {$favorite}<br>
                <a href=\"edit_quote.php?id={$id}\">Sửa</a> | 
                <a href=\"delete_quote.php?id={$id}\" onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
            </li><br>";
        }
        echo '</ul>';
    } else {
        echo '<p>Không có trích dẫn nào trong cơ sở dữ liệu.</p>';
    }

} catch (PDOException $e) {
    echo '<p class="error">Không thể lấy dữ liệu: ' . htmlspecialchars($e->getMessage()) . '</p>';
}

include_once __DIR__ . '/../partials/footer.php';
