<?php

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    if (isset($_POST['user_id']) && isset($_POST['book_id'])) {
        $user_id = $_POST['user_id'];
        $book_id = $_POST['book_id'];
        $reserved_date = $_POST['reserved_date'];
        $_SESSION['user_id']=$user_id;
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

        // Check if book is available
        $sql = "SELECT status FROM books WHERE book_id='$book_id'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } else {
            $row = mysqli_fetch_assoc($result);
            $status = $row['status'];

            if ($status == 'available') {
                // Book is available, create transaction record
                $due_date = date('Y-m-d', strtotime('+1 week'));
                $sql = "INSERT INTO reservations (user_id, book_id, due_date) VALUES ('$user_id', '$book_id', '$due_date')";

                if (mysqli_query($conn, $sql)) {
                    // Update book status to checked out
                    $sql = "UPDATE books SET status='checked_out' WHERE book_id='$book_id'";

                    if (mysqli_query($conn, $sql)) {
                        echo "Book reservation successful!";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                // Book is not available, create reservation record
                $sql = "INSERT INTO reservations (user_id, book_id,reserved_date) VALUES ('$user_id', '$book_id','$reserved_date')";

                if (mysqli_query($conn, $sql)) {
                    echo "Book reservation successful!";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }

        mysqli_close($conn);
    } else {
        echo "Error: Please enter the details";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Reservation</title>
    <link rel="stylesheet" href="book_reservation.css">
</head>
<body>
    <h1>Book Reservation</h1>

    <form method="post" action="book_reservation.php">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id">
        <br>
        <label for="book_id">Book ID:</label>
        <input type="text" name="book_id" id="book_id">
        <br>
        <label for="reserved_date">Reservation  Date:</label>
        <input type="date" id="reserved_date" name="reserved_date"><br><br>
        <input type="submit" value="Reserve">
    </form>
</body>
</html>
