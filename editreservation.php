<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Reservation</title>
  </head>
  <body>
    <?php
      // Connect to the database
      require_once('dbconfig.php');

      // Check if the form has been submitted
      if (isset($_POST['submit'])) {
        // Get the form data
        $reservation_id = $_POST['reservation_id'];
        $customer_id = $_POST['customer_id'];
        $employee_id = $_POST['employee_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $party_size = $_POST['party_size'];

        // Update the reservation details in the database
        $query = "UPDATE Reservations SET customer_id='$customer_id', employee_id='$employee_id', date='$date', time='$time', party_size='$party_size' WHERE reservation_id='$reservation_id'";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
          echo "<p>Reservation details updated successfully.</p>";
        } else {
          echo "<p>There was an error updating the reservation details.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      } else {
        // Get the reservation ID from the URL
        $reservation_id = $_GET['reservation_id'];

        // Query the database to get the reservation details
        $query = "SELECT * FROM Reservations WHERE reservation_id='$reservation_id'";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Get the reservation details from the query result
          $row = mysqli_fetch_assoc($result);
          $customer_id = $row['customer_id'];
          $employee_id = $row['employee_id'];
          $date = $row['date'];
          $time = $row['time'];
          $party_size = $row['party_size'];

          // Display the reservation details in a form
          echo "<h1>Edit Reservation</h1>";
          echo "<form method='post' action='editreservation.php'>";
          echo "<input type='hidden' name='reservation_id' value='$reservation_id'>";
          echo "<label for='customer_id'>Customer ID:</label>";
          echo "<input type='number' name='customer_id' id='customer_id' value='$customer_id'>";
          echo "<br>";
          echo "<label for='employee_id'>Employee ID:</label>";
          echo "<input type='number' name='employee_id' id='employee_id' value='$employee_id'>";
          echo "<br>";
          echo "<label for='date'>Date:</label>";
          echo "<input type='date' name='date' id='date' value='$date'>";
          echo "<br>";
          echo "<label for='time'>Time:</label>";
          echo "<input type='time' name='time' id='time' value='$time'>";
          echo "<br>";
          echo "<label for='party_size'>Party Size:</label>";
          echo "<input type='number' name='party_size' id='party_size' value='$party_size'>";
          echo "<br>";
          echo "<input type='submit' name='submit' value='Update'>";
          echo "</form>";
        } else {
          echo "<p>There was an error retrieving the reservation details.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      }
    ?>
  </body>
</html>
