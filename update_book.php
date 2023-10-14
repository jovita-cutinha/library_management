<?php
require_once 'conn.php';

// Check if the user is logged in as an admin
// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }
if (isset($_POST['isbn'])) {
    // Retrieve user information submitted in the form
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $isbn = $_POST['isbn'];
    // Check if the book exists
    $query = "SELECT * FROM books WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // book exists, update its data
        $query = "UPDATE books SET author = '$author', title = '$title' where isbn='$isbn'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // book data was successfully updated
            // echo "book data updated successfully";
        } else {
            // An error occurred while updating the book data
            echo "Error updating  data: " . mysqli_error($conn);
        }
    } else {
        // User doesn't exist
        echo "book with isbn $isbn not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book</title>
    <link rel="stylesheet" href="update_book.css">
</head>
<body>
    <h1>Update Book</h1>

    <form method="POST" action="update_book.php">
    <input type="hidden" name="book_id" value="<?php echo $book['book_id'] ?? ''; ?>">

<label for="isbn">ISBN:</label>
<input type="text" name="isbn" id="isbn" value="<?php echo $book['isbn'] ?? ''; ?>">

<label for="title">Title:</label>
<input type="text" name="title" id="title" value="<?php echo $book['title'] ?? ''; ?>">

<label for="author">Author:</label>
<input type="text" name="author" id="author" value="<?php echo $book['author'] ?? ''; ?>">


        <input type="submit" value="Update Book">
    </form>
</body>
</html>
