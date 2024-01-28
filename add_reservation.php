<?php
require_once('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$reservation_id = $_POST['reservation_id'];
	$customer_id = $_POST['customer_id'];
	$employee_id = $_POST['employee_id'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$party_size = $_POST['party_size'];

	$sql = "INSERT INTO Reservations (reservation_id, customer_id, employee_id, date, time, party_size) VALUES ('$reservation_id', '$customer_id', '$employee_id', '$date', '$time', '$party_size')";
	if (mysqli_query($conn, $sql)) {
		echo "New reservation added successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>