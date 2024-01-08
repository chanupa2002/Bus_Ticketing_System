<?php session_start(); ?>
<?php require_once('connection.php'); ?>

<?php 
	$errors = array();
	$busRoot = '';
    $date = '';
    $seatNumber = '';
    $name = '';
    $nic = '';
    $contactNo = '';
	

	if (isset($_POST['submit'])) {
		
		$busRoot = $_POST['catogory'];
        $date = $_POST['date'];
		$seatNumber = $_POST['seatNumber'];
        $name = $_POST['name'];
		$nic = $_POST['nic'];
        $contactNo = $_POST['phone'];
        

        // checking if seal already booked
        $busRoot = mysqli_real_escape_string($connection, $_POST['catogory']);
        //$date = mysqli_real_escape_string($connection, $_POST['date']);
        $seatNumber = mysqli_real_escape_string($connection, $_POST['seatNumber']);

		$query = "SELECT * FROM bookings WHERE seatNumber = '{$seatNumber}' AND bookDate = '{$date}' AND busRoute = '{$busRoot}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'seat number already exists';
                //echo "<p class='errEx'>'Seat already booked !'</p>";
                echo '<script>alert("Seat already booked !")</script>';
			}
		}

        if(empty($errors)){
			$busRoot = mysqli_real_escape_string($connection, $_POST['catogory']);
            $date = mysqli_real_escape_string($connection, $_POST['date']);
			$seatNumber = mysqli_real_escape_string($connection, $_POST['seatNumber']);
            $name = mysqli_real_escape_string($connection, $_POST['name']);
		    $nic = mysqli_real_escape_string($connection, $_POST['nic']);
		    $contactNo = mysqli_real_escape_string($connection, $_POST['phone']);

			$query = "INSERT INTO bookings ( ";
			$query .= "busRoute, bookDate, seatNumber, nameCustomer, nic, contactNumber";
			$query .= ") VALUES (";
			$query .= "'{$busRoot}', '{$date}', '{$seatNumber}', '{$name}', '{$nic}', '{$contactNo}'";
			$query .= ")";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: manage.php?user_added=true');
			} else {
				echo "Failed to add booking ! ";
			}
        
        }

	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div><h1>Reserve your Ticket</h1><button type="submit" name="submit" onclick="window.location.href='manage.php';" class="butTab">Manage Bookings</button></div>

    <div>
            <form method="post" action="" method="post" autocomplete="off" class="form">
                <div class = "form-row">
                    <p>Select Bus Route : 
                        <select name = "catogory" class="" required>
                        <option value = "catogory">Bus Route</option>
                        <option value = "01 : COLOMBO - KANDY">01 : COLOMBO - KANDY</option>
                        <option value = "06 : COLOMBO - GALLE">06 : COLOMBO - GALLE</option>
                        <option value = "100 : COLOMBO - PANADURA">100 : COLOMBO - PANADURA</option>
                        <option value = "138 : COLOMBO - KOTTAWA">138 : COLOMBO - KOTTAWA</option>
                        </select>
                    </p>
                </div>

                <div class = "form-row">
                    <p>Select Date : <input type = "date" name="date" required value=""></p>
                </div>

                <div class = "form-row">
                    <p>Seat Number : <input type = "text" placeholder="Seat Number (58 seats Available)" name="seatNumber" required value=""></p>
                </div>
                
                <div class = "form-row">
                    <p>Name : <input type = "text" placeholder="Name" name="name" required value=""></p>
                </div>

                <div class = "form-row">
                    <p>NIC : <input type = "text" placeholder="NIC" name="nic" required value=""></p>
                </div>

                <div class = "form-row">
                    <p>Contact No : <input type = "text" placeholder="Contact No" name="phone" required value=""></p>
                </div>

                <div class="bu"><button type="submit" name="submit" class="but">Book</button></div>

            </form>

        </div>
        




</body>
</html>