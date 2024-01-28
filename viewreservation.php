<html>
  <head>
    <meta charset="UTF-8">
    <title>View Reservations</title>
    <style>
      /* Style for the table */
      table {
        border-collapse: collapse;
        margin-top: 50px;
      }
css
Copy code
  /* Style for table rows */
  tr {
    border-bottom: 1px solid #ddd;
  }

  /* Style for table headers */
  th {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: left;
  }

  /* Style for table data cells */
  td {
    padding: 10px 20px;
  }
</style>
  </head>
  <body>
    <h1>View Reservations</h1>
    <table>
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>Customer ID</th>
          <th>Employee ID</th>
          <th>Date</th>
          <th>Time</th>
          <th>Party Size</th>
		  <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connect to the database
          require_once('dbconfig.php');
      // Query the database
	  // Check if the delete button has been clicked
      if (isset($_GET['delete'])) {
        $reservation_id = $_GET['delete'];
        $result = mysqli_query($conn, "DELETE FROM Reservations WHERE reservation_id='$reservation_id'");
        if ($result) {
          echo "<p>Record deleted successfully!</p>";
        } else {
          echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
        }
      }
      $result = mysqli_query($conn, "SELECT * FROM Reservations");

      // Loop through the results and display them in the table
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['reservation_id'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>" . $row['employee_id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['party_size'] . "</td>";
		echo "<td><a href='editreservation.php?reservation_id=" . $row['reservation_id'] . "'>Edit</a> | <a href='viewreservation.php?delete=" . $row['reservation_id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></td>";
        echo "</tr>";
      }

      // Close the database connection
      mysqli_close($conn);
    ?>
  </tbody>
</table>
</body>
</html>