<?php
  // Connect to the database
  require_once('dbconfig.php');

  // Retrieve the order data from the form submission
  $order_id = $_POST['order_id'];
  $customer_id = $_POST['customer_id'];
  $employee_id = $_POST['employee_id'];
  $date = $_POST['date'];
  $total_price = $_POST['total_price'];
  $payment_method = $_POST['payment_method'];
  $status = $_POST['status'];

  // Insert the order data into the database
  $sql = "INSERT INTO Orders (order_id, customer_id, employee_id, date, total_price, payment_method, status) VALUES ('$order_id', '$customer_id', '$employee_id', '$date', '$total_price', '$payment_method', '$status')";

  if (mysqli_query($conn, $sql)) {
    echo "New Order added successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
?>
