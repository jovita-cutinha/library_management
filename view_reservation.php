<?php
session_start();

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit;
// }

// Retrieve user ID from session variable
$user_id = $_SESSION['user_id'];

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo $_SESSION['user_id'];
echo "$user_id";
// Retrieve user's reservations
$sql = "SELECT books.title, reservations.reserved_date FROM books, reservations where books.book_id=reservations.book_id AND  reservations.user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} else {
    // Display list of reserved books
    echo "<h1>My Reserved Books</h1>";
    echo "<table>";
    echo "<tr><th>Title</th><th>Reservation Date</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['title'] . "</td><td>" . $row['reserved_date'] . "</td></tr>";
    }
    echo "</table>";
}

mysqli_close($conn);
?>
