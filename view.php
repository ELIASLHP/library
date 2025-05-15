<?php
require 'config.php';

if (!isset($_GET['id'])) {
    echo "No book ID provided.";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Book not found.";
    exit;
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Details</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f0f0; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
        h1 { color: #333; }
        .info { margin-bottom: 15px; }
        img { max-width: 200px; height: auto; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($book['book_title']); ?></h1>
        <?php if (!empty($book['book_cover'])): ?>
            <img src="uploads/<?php echo $book['book_cover']; ?>" alt="Book Cover">
        <?php endif; ?>
        <div class="info"><strong>Author:</strong> <?php echo htmlspecialchars($book['author_name']); ?></div>
        <div class="info"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></div>
        <div class="info"><strong>Publication Year:</strong> <?php echo $book['publication_year']; ?></div>
        <div class="info"><strong>Quantity:</strong> <?php echo $book['quantity']; ?></div>

        <a href="list.php">← Back to Book List</a>
    </div>
</body>
</html>
