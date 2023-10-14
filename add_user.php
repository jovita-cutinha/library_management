<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve user information submitted in the form
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Validate user information
// if (empty($name) || empty($email) || empty($password) || empty($role)){
//     die("Please enter all required fields");
// }

// Hash the password
//$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the database
$query = "INSERT INTO users (name, email, password,role) VALUES ('$name', '$email', '$password','$role')";
$result = mysqli_query($conn, $query);

if ($result) {
    // User was successfully added to the database
   // echo "User added successfully";
} else {
    // An error occurred while adding the user
    echo "Error adding user: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="update_user.css">
</head>
<body>
    <h1>Add User</h1>

    <form method="post" action="add_user.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="student" <?php if ($role == 'student') { echo 'selected'; } ?>>student</option>
            <option value="teacher" <?php if ($role == 'teacher') { echo 'selected'; } ?>>teacher</option>
        </select><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>
