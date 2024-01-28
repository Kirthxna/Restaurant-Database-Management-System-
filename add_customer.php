<?php
require_once('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$customer_id = $_POST['customer_id'];
	$name = $_POST['name'];
	$phone_number = $_POST['phone_number'];
	$email_address = $_POST['email_address'];
	$address = $_POST['address'];

	$sql = "INSERT INTO Customers (customer_id, name, phone_number, email_address, address) VALUES ('$customer_id', '$name', '$phone_number', '$email_address', '$address')";
	if (mysqli_query($conn, $sql)) {
		echo "New customer added successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>
