<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "❌ No book ID provided.";
    exit();
}

$book_id = $_GET['id'];

$sql = "SELECT * FROM books WHERE id = $book_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "❌ Book not found.";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 400px;
        }
        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
        }
        img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Edit Book</h1>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="book_id" value="<?= $row['id'] ?>">

        <label>Title:</label>
        <input type="text" name="book_title" value="<?= htmlspecialchars($row['book_title']) ?>" required>

        <label>Author:</label>
        <input type="text" name="author_name" value="<?= htmlspecialchars($row['author_name']) ?>" required>

        <label>Genre:</label>
        <select name="genre" required>
            <option value="Fiction" <?= $row['genre'] == 'Fiction' ? 'selected' : '' ?>>Fiction</option>
            <option value="Science" <?= $row['genre'] == 'Science' ? 'selected' : '' ?>>Science</option>
            <option value="History" <?= $row['genre'] == 'History' ? 'selected' : '' ?>>History</option>
        </select>

        <label>Year:</label>
        <input type="number" name="publication_year" value="<?= $row['publication_year'] ?>" min="1900" max="2099" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?= $row['quantity'] ?>" min="1" required>

        <label>Current Cover:</label><br>
        <img src="<?= $row['book_cover'] ?>" alt="Current Book Cover">

        <label>Change Cover (optional):</label>
        <input type="file" name="book_cover">

        <button type="submit">Update Book</button>
    </form>

    <a href="list.php">← Back to Book List</a>
</body>
</html>
