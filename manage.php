<?php session_start(); ?>
<?php require_once('connection.php'); ?>

<?php 
    
    
	$booking_list = '';

	// getting the list of bookings

    $query = "SELECT * FROM bookings WHERE contactNumber IS NOT NULL ORDER BY id";

	$bookings = mysqli_query($connection, $query);

	
		global $connection;

		if (!$bookings) {
			die("Database query failed: " . mysqli_error($connection));
		}


	while ($book = mysqli_fetch_assoc($bookings)) {
		$booking_list .= "<tr class='vg'>";
		$booking_list .= "<td>{$book['busRoute']}</td>";
		$booking_list .= "<td>{$book['bookDate']}</td>";
		$booking_list .= "<td>{$book['seatNumber']}</td>";
        $booking_list .= "<td>{$book['nameCustomer']}</td>";
        $booking_list .= "<td>{$book['nic']}</td>";
        $booking_list .= "<td>{$book['contactNumber']}</td>";
        $booking_list .= "<td><button type='submit' name='submit' onclick=\"window.location.href='deleteUser.php?user_id={$book['id']}'\" class='butCancelBook'>Cancel Booking</button></td>";
        $booking_list .= "</tr>";
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="styleTab.css">
</head>
<body>

    <div><h1>Manage Bookings</h1><button type="submit" name="submit" onclick="window.location.href='booking.php';" class="butTab">Book New</button></div>

    <main>

		<table class="masterlist">
			<tr>
				<th>Bus Route</th>
				<th>Date</th>
				<th>Seat Number</th>
				<th>Name</th>
                <th>NIC</th>
                <th>Contact Number</th>
			</tr>

			<?php echo $booking_list; ?>

		</table>
		
	</main>
    

</body>
</html>