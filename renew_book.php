<!DOCTYPE html>
<html>
<head>
    <title>Renew Book</title>
    <link rel="stylesheet" href="book_reservation.css">
</head>
<body>
    <h1>Renew Book</h1>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $transaction_id = $_POST['transaction_id'];
        $new_due_date = $_POST['new_due_date'];

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

        // Update transaction record with new due date
        $sql = "UPDATE transactions SET due_date='$new_due_date' WHERE transaction_id='$transaction_id'";

        if (mysqli_query($conn, $sql)) {
          echo "Book renewal successful!";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label for="transaction_id">Transaction ID:</label>
        <input type="text" name="transaction_id" id="transaction_id">
        <br>
        <label for="new_due_date">New Due Date:</label>
        <input type="date" name="new_due_date" id="new_due_date">
        <br>
        <input type="submit" value="Renew Book">
    </form>
</body>
</html>
