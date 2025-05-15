<?php
require 'config.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM library WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "✅ Book deleted successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "❌ Delete failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "❌ No book ID provided.";
}
$conn->close();
?>