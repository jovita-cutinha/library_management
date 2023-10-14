<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve book information submitted in the form
$id = isset($_POST['book_id']) ? $_POST['book_id'] : '';

// Validate book information
// if (empty($id)) {
//     die("Please enter book ID");
// }

// Delete book from the database
$query = "DELETE FROM books WHERE book_id='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Book was successfully deleted from the database
   // echo "Book deleted successfully";
} else {
    // An error occurred while deleting the book
    echo "Error deleting book: " . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Book</title>
    <link rel="stylesheet" href="delete_book.css">
</head>
<body>
    <h1>Delete Book</h1>

    <form method="post" action="delete_book.php">
        <label for="book_id">Book ID:</label>
        <input type="text" name="book_id" id="book_id">

        <input type="submit" value="Delete Book" onclick="alert('Are You Sure want to delete?')" value="Okay">
    </form>
</body>
</html>
