<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location:login.php");
//     exit();
// }

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve book information submitted in the form
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
     $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
    // $description = isset($_POST['description']) ? $_POST['description'] : '';
    //$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $status = isset($_POST['status'])? $_POST['status']:'';


    // Validate book information
    if (empty($title) || empty($author)) {
        die("Please fill out all fields");
    }

    // Insert book into the database
    $query = "INSERT INTO books (title, author,isbn,status) VALUES ('$title', '$author',$isbn  ,'$status')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Book was successfully added to the database
        echo "Book added successfully";
    } else {
        // An error occurred while adding the book
        echo "Error adding book: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="add_book.css">
</head>
<body>
    <h1>Add Book</h1>

    <form method="post" action="add_book.php">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">

        <label for="author">Author:</label>
        <input type="text" name="author" id="author">

         <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn">

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="available" <?php if (isset($status)&&($status == 'available')) { echo 'selected'; } ?>>available</option>
              </select>

        <input type="submit" value="Add Book">
    </form>
</body>
</html>
