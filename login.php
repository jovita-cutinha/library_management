<?php
require_once 'conn.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the users table to find a user with the given email and password
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_role'] = $row['role'];
        $_SESSION['email'] = $email;
        if($_SESSION['user_role'] == "admin") {
            header("Location: dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        // Login failed
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <img src="sjec-logo.png" alt="sjec-logo" >
    <h1>ST JOSEPH ENGINEERING COLLEGE</h1>
    <h2>Vamanjoor, Mangaluru</h2>
    <h3>An Autonomous Institution</h3>
    <h4>Department of Computer Application</h4>

</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo '<p style="color:red">'.$error.'</p>'; } ?>
    <form method="post" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
