<?php
require 'config.php';
$sql = "SELECT id, book_title, author_name, genre, publication_year, quantity, book_cover FROM library";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        h1 { color: #333; }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th {
            background-color: #0077cc;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        img {
            max-width: 80px;
            max-height: 100px;
            border-radius: 5px;
        }
        a {
            text-decoration: none;
            color: #0077cc;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions a {
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
            color: #0077cc;
            border: 1px solid #0077cc;
        }
        .actions a:hover {
            background-color: #0077cc;
            color: white;
        }
        .top-link {
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>📚 Book List</h1>
    <a href="index.html" class="top-link">➕ Add New Book</a><br><br>
    <table>
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        if ($row["book_cover"]) {
            $imgData = base64_encode($row["book_cover"]);
            echo "<td><img src='data:image/jpeg;base64,{$imgData}' alt='Book Cover'></td>";
        } else {
            echo "<td>No Cover</td>";
        }
        echo "<td>" . htmlspecialchars($row["book_title"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["author_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["genre"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["publication_year"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
        echo "<td class='actions'>
        <a href='update.php?id=" . $row["id"] . "'>Edit</a> |
        <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Delete</a>
      </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No books found.</td></tr>";
}
$conn->close();
?>
    </table>
</body>
</html>
