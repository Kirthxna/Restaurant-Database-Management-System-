<html>
  <head>
    <meta charset="UTF-8">
    <title>View Customers</title>
    <style>
      /* Style for the table */
      table {
        border-collapse: collapse;
        margin-top: 50px;
      }

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
    <h1>View Customers</h1>
    <table>
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Email Address</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Connect to the database
          require_once('dbconfig.php');
  
          // Check if the delete button has been clicked
          if (isset($_GET['delete'])) {
            $customer_id = $_GET['delete'];
            $result = mysqli_query($conn, "DELETE FROM Customers WHERE customer_id='$customer_id'");
            if ($result) {
              echo "<p>Record deleted successfully!</p>";
            } else {
              echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
            }
          }
          
          // Query the database
          $result = mysqli_query($conn, "SELECT * FROM Customers");

          // Loop through the results and display them in the table
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td>" . $row['email_address'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td><a href='editcustomer.php?customer_id=" . $row['customer_id'] . "'>Edit</a> | <a href='viewcustomer.php?delete=" . $row['customer_id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></td>";
            echo "</tr>";
          }

          // Close the database connection
          mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </body>
</html>