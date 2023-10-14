<?php
// Include the database connection file
include_once 'conn.php';

// Check if the user is logged in as an admin
// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve the user ID from the URL parameter
$id = $_GET['email'];

// Delete the user from the database
$query = "DELETE FROM users WHERE email='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Redirect to the user list page
    header("Location: user_list.php");
    exit();
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}
?>
