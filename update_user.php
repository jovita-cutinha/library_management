<?php
require_once 'conn.php';

// if (!isset($_SESSION['email'])) {
//     header("Location: login.php");
//     exit();
// }

if (isset($_POST['email'])) {
    // Retrieve user information submitted in the form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Check if the user exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User exists, update their data
        $query = "UPDATE users SET name = '$name', password = '$password', role = '$role' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // User data was successfully updated
            // echo "User data updated successfully";
        } else {
            // An error occurred while updating the user data
            echo "Error updating user data: " . mysqli_error($conn);
        }
    } else {
        // User doesn't exist
        echo "User with email $email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="update_user.css">
</head>
<body>
    <h1>Update User</h1>

    <form method="post" action="update_user.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="student">student</option>
            <option value="teacher">teacher</option>
        </select>

        <input type="submit" value="Update User">
    </form>
</body>
</html>
