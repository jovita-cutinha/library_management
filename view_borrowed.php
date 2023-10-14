<html>
  <head>
    <link rel="stylesheet" href="book_list.css">
    <h1>My Borrowed books</h1>
  </head>
</html>
<?php
include ('conn.php');
// Connect to database

// Get email ID from session
$email = $_SESSION['email'];

// Retrieve user ID from the database using email ID
$sql = "SELECT user_id FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_id = $row['user_id'];

  // Retrieve issued books information from transactions table using user ID
  $sql = "SELECT books.title, transactions.issue_date, transactions.due_date 
          FROM transactions
          INNER JOIN books ON transactions.book_id = books.book_id
          WHERE transactions.user_id = '$user_id' AND transactions.return_date IS NULL";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Display issued books information in a table
    echo "<table><tr><th>Book Title</th><th>Issue Date</th><th>Due Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row['title'] . "</td><td>" . $row['issue_date'] . "</td><td>" . $row['due_date'] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No books have been issued by this user.";
  }
} else {
  echo "User not found.";
}

$conn->close();
?>