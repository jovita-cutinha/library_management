<?php
// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// check if form was submitted
if (isset($_POST["submit"])) {
  // retrieve form data
  $book_id = $_POST["book_id"];
  $reason = $_POST["reason"];

  // check if book exists
  $sql = "SELECT * FROM books WHERE book_id='$book_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // update book status to "disposed"
    $sql = "UPDATE books SET status='disposed' WHERE book_id='$book_id'";

    if (mysqli_query($conn, $sql)) {
      // remove book from inventory
      $sql = "DELETE FROM books WHERE book_id='$book_id'";
      echo 'Book Disposed';

    //   if (mysqli_query($conn, $sql)) {
        // create disposal record
       // $sql = "INSERT INTO disposal (book_id, reason) VALUES ($book_id, '$reason')";

    //     if (mysqli_query($conn, $sql)) {
    //       echo "Book disposal successful.";
    //     } else {
    //       echo "Error creating disposal record: " . mysqli_error($conn);
    //     }
    //   } else {
    //     echo "Error removing book from inventory: " . mysqli_error($conn);
    //   }
    } else 
    {
    echo "Book not found.";
  }
}
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Disposal</title>
    <link rel="stylesheet" href="book_reservation.css">
</head>
<body>
    <h1>Book Disposal</h1>
<form method="post" action="book_disposal.php">
  <label for="book_id">Book ID:</label>
  <input type="text" id="book_id" name="book_id" required>
  <br>
  <label for="reason">Reason for disposal:</label>
  <input type="text" id="reason" name="reason" required>
  <br>
  <input type="submit" name="submit" value="Dispose Book">
</form>
</body>
</html>