
<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }
// Retrieve list of users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
// Display a table with the list of users
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Type</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['user_id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['role'] . "</td>";
echo "<td><a href='edit_user.php?id=" . $row['user_id'] . "'>Edit</a> | <a href='delete_user.php?id=" . $row['user_id'] . "'>Delete</a></td>";
echo "</tr>";
}
echo "<tr><td colspan='4'><a href='add_user.php'>Add User</a></td></tr>";
echo "</table>";
} else {
echo "No users found";
}
?>
