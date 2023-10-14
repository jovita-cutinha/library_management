<?php
include('conn.php');

// Retrieve email from session variable
$email = $_SESSION['email'];

// Retrieve returned books for the logged-in user
$sql = "SELECT transactions.transaction_id, books.title, transactions.issue_date, transactions.due_date, transactions.return_date 
        FROM transactions 
        INNER JOIN books ON transactions.book_id = books.book_id 
        WHERE transactions.status = 'returned' AND transactions.email = '$email'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Returned Books</title>
    <link rel="stylesheet" href="book_list.css">
</head>
<body>
    <h1>My Returned Books</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>Book Title</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row["transaction_id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["issue_date"]; ?></td>
                    <td><?php echo $row["due_date"]; ?></td>
                    <td><?php echo $row["return_date"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No returned books.</p>
    <?php endif; ?>

</body>
</html>