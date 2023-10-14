<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve books from the database
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <link rel="stylesheet" href="book_list.css">
</head>
<body>
    <h1>Book List</h1>

    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['book_id'] ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td>
                        <a href="update_book.php?id=<?= $book['book_id'] ?>">Update</a>
                        <a href="delete_book.php?id=<?= $book['book_id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <a href="add_book.php?id=<?= $book['book_id'] ?>">Add Book</a>
</body>
</html>
