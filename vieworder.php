<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>View Orders</title>
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
    <h1>View Orders</h1>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer ID</th>
          <th>Employee ID</th>
          <th>Date</th>
          <th>Total Price</th>
          <th>Payment Method</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connect to the database
          require_once('dbconfig.php');

      // Check if the delete button has been clicked
      if (isset($_GET['delete'])) {
        $order_id = $_GET['delete'];
        $result = mysqli_query($conn, "DELETE FROM Orders WHERE order_id='$order_id'");
        if ($result) {
          echo "<p>Record deleted successfully!</p>";
        } else {
          echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
        }
      }
      
      // Query the database
      $result = mysqli_query($conn, "SELECT * FROM Orders");

      // Loop through the results and display them in the table
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>" . $row['employee_id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['total_price'] . "</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='editorder.php?order_id=" . $row['order_id'] . "'>Edit</a> | <a href='vieworder.php?delete=" . $row['order_id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></td>";
        echo "</tr>";
      }

      // Close the database connection
      mysqli_close($conn);
    ?>
  </tbody>
</table>
 </body>
</html>