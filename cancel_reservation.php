
<?php
// Check if reservation ID was submitted
if(isset($_POST['reservation_id'])) {
  // Get the reservation ID from the form submission
  $reservation_id = $_POST['reservation_id'];

  // Check if reservation ID is numeric
  if(!is_numeric($reservation_id)) {
    echo "Invalid reservation ID";
    exit;
  }

  // Connect to the database
  $conn = mysqli_connect('localhost', 'root', '', 'library');

  // Check if connection was successful
  if(!$conn) {
    echo "Unable to connect to database";
    exit;
  }

  // Check if the reservation ID exists in the database
  $reservation_query = "SELECT * FROM reservations WHERE reservation_id = $reservation_id";
  $reservation_result = mysqli_query($conn, $reservation_query);

  if(mysqli_num_rows($reservation_result) == 0) {
    echo "Reservation not found";
  } else {
    // Delete the reservation record from the database
    $delete_query = "DELETE FROM reservations WHERE reservation_id = $reservation_id";
    mysqli_query($conn, $delete_query);

    echo "Reservation cancelled successfully";
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cancel Reservation</title>
    <link rel="stylesheet" href="book_reservation.css">
</head>
<body>
    <h1>Cancel Reservation</h1>
<form method="post" action="cancel_reservation.php">
  <label for="reservation_id">Reservation ID:</label>
  <input type="text" name="reservation_id" required><br>
  <input type="submit" value="Cancel Reservation">
</form>
</body>
</html>