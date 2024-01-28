<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
  </head>
  <body>
    <?php
      // Connect to the database
      require_once('dbconfig.php');

      // Check if the form has been submitted
      if (isset($_POST['submit'])) {
        // Get the form data
        $customer_id = $_POST['customer_id'];
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $email_address = $_POST['email_address'];
        $address = $_POST['address'];

        // Update the customer details in the database
        $query = "UPDATE Customers SET name='$name', phone_number='$phone_number', email_address='$email_address', address='$address' WHERE customer_id='$customer_id'";
        $result = mysqli_query($conn, $query);

        // Check if the update was successful
        if ($result) {
          echo "<p>Customer details updated successfully.</p>";
        } else {
          echo "<p>There was an error updating the customer details.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      } else {
        // Get the customer ID from the URL
        $customer_id = $_GET['customer_id'];

        // Query the database to get the customer details
        $query = "SELECT * FROM Customers WHERE customer_id='$customer_id'";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Get the customer details from the query result
          $row = mysqli_fetch_assoc($result);
          $name = $row['name'];
          $phone_number = $row['phone_number'];
          $email_address = $row['email_address'];
          $address = $row['address'];

          // Display the customer details in a form
          echo "<h1>Edit Customer</h1>";
          echo "<form method='post' action='editcustomer.php'>";
          echo "<input type='hidden' name='customer_id' value='$customer_id'>";
          echo "<label for='name'>Name:</label>";
          echo "<input type='text' name='name' id='name' value='$name'>";
          echo "<br>";
          echo "<label for='phone_number'>Phone Number:</label>";
          echo "<input type='text' name='phone_number' id='phone_number' value='$phone_number'>";
          echo "<br>";
          echo "<label for='email_address'>Email Address:</label>";
          echo "<input type='email' name='email_address' id='email_address' value='$email_address'>";
          echo "<br>";
          echo "<label for='address'>Address:</label>";
          echo "<input type='text' name='address' id='address' value='$address'>";
          echo "<br>";
          echo "<input type='submit' name='submit' value='Update'>";
          echo "</form>";
        } else {
          echo "<p>There was an error retrieving the customer details.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
      }
    ?>
  </body>
</html>
