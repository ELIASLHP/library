<?php
require 'config.php';

// 接收表单字段
$book_title = $_POST['book_title'] ?? '';
$author_name = $_POST['author_name'] ?? '';
$genre = $_POST['genre'] ?? '';
$publication_year = $_POST['publication_year'] ?? null;
$quantity = $_POST['quantity'] ?? null;

// 处理封面上传（BLOB）
$book_cover = null;
if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] === 0) {
    $book_cover = file_get_contents($_FILES['book_cover']['tmp_name']);
}

// 准备 SQL 语句
$stmt = $conn->prepare("INSERT INTO library (book_title, author_name, book_cover, genre, publication_year, quantity) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssbsi", $book_title, $author_name, $book_cover, $genre, $publication_year, $quantity);
$stmt->send_long_data(2, $book_cover); // book_cover 是第 3 个参数

// 执行并反馈
if ($stmt->execute()) {
    echo "✅ Book added successfully! <br><a href='index.html'>Back</a> | <a href='list.php'>View List</a>";
} else {
    echo "❌ Failed to add book: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
