<?php
include ('conn.php');
// Connect to database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "library";
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// Get form data
$email = $_POST['email'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];
$issue_date=$_POST['issue_date'];
$due_date = $_POST['due_date'];
//echo $user_id;
$_SESSION['email']=$email;
// Check if book is available

$sql = "SELECT * FROM books WHERE book_id = '$book_id' AND status = 'available'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Book is available, create transaction record and update book status
  $sql = "INSERT INTO transactions (user_id,email, book_id,issue_date, due_date) VALUES ('$user_id','$email','$book_id','$issue_date', '$due_date')";
  if ($conn->query($sql) === TRUE) {
    $sql = "UPDATE books SET status = 'checked out' WHERE book_id = '$book_id'";
    if ($conn->query($sql) === TRUE) {
      echo "Book successfully borrowed!";
    } else {
      echo "Error updating book status: ";
    }
  } else {
    echo "Error creating transaction record: ";
  }
} else {
  // Book is not available
  echo "Book is currently checked out.";
}

$conn->close();
?>
