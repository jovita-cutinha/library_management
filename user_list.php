
<html>
    <head>
        <title>User List</title>
        <link rel="stylesheet" href="user_list.css">
    </head>
</html>

<?php
// Include the database connection file
include_once 'conn.php';

// Check if the user is logged in as an admin
// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve all users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Display the users in a table
echo "<h1>User List</h1>";
echo "<table border='1'>";
echo "<tr><th>Email</th><th>Name</th><th>Password</th><th>Role</th><th>Actions</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['role'] . "</td>";
    echo "<td><a href='update_user.php?email=" . $row['email'] . "'>Edit</a> | <a href='delete_user.php?email=" . $row['email'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
    echo "</tr>";
}
echo "<tr><td colspan='4'><a href='add_user.php'>Add User</a></td></tr>";
echo "</table>";
?>
