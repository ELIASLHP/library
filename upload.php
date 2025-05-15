<?php
require 'config.php';
$book_title = $_POST['book_title'];
$author_name = $_POST['author_name'];
$genre = $_POST['genre'];
$publication_year = $_POST['publication_year'];
$quantity = $_POST['quantity'];
$book_cover = null;
if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] === 0) {
    $book_cover = file_get_contents($_FILES['book_cover']['tmp_name']);
}
$stmt = $conn->prepare("INSERT INTO library (book_title, author_name, book_cover, genre, publication_year, quantity) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssbsi", $book_title, $author_name, $book_cover, $genre, $publication_year, $quantity);
$stmt->send_long_data(2, $book_cover);
if ($stmt->execute()) {
    echo "✅ Book added successfully! <a href='index.html'>Back</a>";
} else {
    echo "❌ Failed to add book: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>