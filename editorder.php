<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
  </head>
  <body>
    <?php
      // Connect to the database
      require_once('dbconfig.php');

      // Check if the form has been submitted
      if (isset($_POST['submit'])) {
        // Get the form data
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        $total_price = $_POST['total_price'];

        // Update the order status and amount in the database
        $query = "UPDATE Orders SET status='$status', total_price ='$total_price' WHERE order_id='$order_id'";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
          echo "<p>Order status and amount updated successfully.</p>";
        } else {
          echo "<p>There was an error updating the order status and amount.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      } else {
        // Get the order ID from the URL
        $order_id = $_GET['order_id'];

        // Query the database to get the order details
        $query = "SELECT * FROM Orders WHERE order_id='$order_id'";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Get the order details from the query result
          $row = mysqli_fetch_assoc($result);
          $status = $row['status'];
          $total_price = $row['total_price'];

          // Display the order details in a form
          echo "<h1>Edit Order</h1>";
          echo "<form method='post' action='editorder.php'>";
          echo "<input type='hidden' name='order_id' value='$order_id'>";
          echo "<label for='status'>Status:</label>";
          echo "<input type='text' name='status' id='status' value='$status'>";
          echo "<br>";
          echo "<label for='total_price'>Total_Price:</label>";
          echo "<input type='number' name='total_price' id='total_price' value='$total_price'>";
          echo "<br>";
          echo "<input type='submit' name='submit' value='Update'>";
          echo "</form>";
        } else {
          echo "<p>There was an error retrieving the order details.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      }
    ?>
  </body>
</html>
