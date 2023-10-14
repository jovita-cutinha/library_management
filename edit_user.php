<?php
session_start();
require_once 'conn.php';


// Retrieve user ID from the query string
$id = $_GET['user_id'];

// Retrieve user information from the database
$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    // Display a form to update the user's details
    $row = mysqli_fetch_assoc($result);
    echo "<form method='post' action='update_user.php'>";
    echo "<input type='hidden' name='id' value='" . $row['user_id'] . "'>";
    echo "<label>Name:</label> <input type='text' name='name' value='" . $row['name'] . "'><br>";
    echo "<label>Email:</label> <input type='email' name='email' value='" . $row['email'] . "'><br>";
    echo "<label>Type:</label> <select name='type'><option value='student' " . ($row['type'] == 'student' ? 'selected' : '') . ">Student</option><option value='teacher' " . ($row['type'] == 'teacher' ? 'selected' : '') . ">Teacher</option></select><br>";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
} else {
    echo "User not found";
}
?>