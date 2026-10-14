<?php
include "baza.php";

// ===== ДОБАВЛЕНИЕ =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $author = $_POST['author'] ?? '';
    $text = $_POST['comment_text'] ?? '';

    if (!empty($author) && !empty($text)) {

        $stmt = $conn->prepare("INSERT INTO commet (author, comment_text, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $author, $text);
        $stmt->execute();
        $stmt->close();
    }

    echo "ok"; // 👈 важно для JS
    exit;
}

// ===== ВЫВОД =====
$sql = "SELECT author, comment_text, created_at FROM commet ORDER BY created_at DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "
    <div class='comment'>
        <b>" . htmlspecialchars($row['author']) . "</b><br>
        " . nl2br(htmlspecialchars($row['comment_text'])) . "<br>
        <small>" . $row['created_at'] . "</small>
    </div>
    ";
}
?>