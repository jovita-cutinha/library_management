<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if(isset($_POST['submit'])) {
    // Get the transaction ID and return date from the form
    $transaction_id = $_POST['transaction_id'];
    $return_date = $_POST['return_date'];
   // $email = $_POST['email'];

    // Update the transaction record in the database
    $sql = "UPDATE transactions SET return_date='$return_date',status='returned' WHERE transaction_id='$transaction_id'";
    if ($conn->query($sql) === TRUE) {
        // If the transaction record is updated successfully, update the book status to "available"
        $sql = "UPDATE books SET status='available' WHERE book_id=(SELECT book_id FROM transactions WHERE transaction_id='$transaction_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Book returned successfully.";
        } else {
            echo "Error updating book status: " . $conn->error;
        }
    } else {
        echo "Error updating transaction record: " . $conn->error;
    }
}

// Retrieve email from session variable
$email = $_SESSION['email'];

// Retrieve transactions where book has been returned and email matches the logged-in user's email
$sql = "SELECT transactions.transaction_id, books.title, transactions.issue_date, transactions.due_date, transactions.return_date 
        FROM transactions 
        INNER JOIN books ON transactions.book_id=books.book_id 
        WHERE transactions.status='returned' AND transactions.email='$email'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Returned Books</title>
    <link rel="stylesheet" href="book_reservation.css">
</head>
<body>

    <h2>Return a Book</h2>

    <form method="post" action="book_return.php">
    <label for="transaction_id"> Transaction ID:</label>
    <input type="text" name="transaction_id"><br>
    <label for="return_date"> Return Date:</label>
    <input type="date" name="return_date"><br>
    <input type="submit" name="submit" value="Return Book">
</form>
</body>
</html>
