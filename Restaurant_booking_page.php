<?php
    include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Booking</title>
	<link rel="stylesheet" href="Restaurant_booking_page.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700,900" rel="stylesheet">
</head>
<body>

<div class="wrapper">
	<div class="container">
		    <?php
			    $email =  $_GET['vname'];
				// echo $email;
			    $sql_query = "select * from restaurant where restaurant_email = '$email'";
				$result = mysqli_query($conn, $sql_query);
				$row = mysqli_fetch_assoc($result);
				echo '
				<div class="container-time">
				<h2 class="heading">'.$row['restaurant_name'].'</h2>
				<h4 class="heading-days">Closed Days</h4>
				<p>'.$row['close_day'].'</p>
				<h3 class="heading-days">Opening Time</h3>
				<p>'.$row['open_time'].'</p>
				<h3 class="heading-days">Closing Time</h3>
				<p>'.$row['close_time'].'</p>
				<hr>
				<h4 class="heading-phone">Call Us:'.$row['restaurant_number'].'</h4></div>';
			?>

		<div class="container-form">
				<form action="final_paymentPage.php">
					<h2 class="heading heading-yellow">Reservation Online</h2>

					<div class="form-field">
						<p>Your Name</p>
						<input type="text" placeholder="Your Name" required>
					</div>
					<div class="form-field">
						<p>Your email</p>
						<input type="email" placeholder="Your email" required>
					</div>
					<div class="form-field">
						<p>Date</p>
						<input type="date" required>
					</div>
					<div class="form-field">
						<p>Time</p>
						<input type="time" required>
					</div>
					<div class="form-field">
						<p>How many people?</p>
						<select name="select" id="#">
							<option value="1">1 person</option>
							<option value="2">2 persons</option>
							<option value="3">3 persons</option>
							<option value="4">4 persons</option>
							<option value="5">5 persons</option>
							<option value="5+">5+ persons</option>
						</select>
					</div>
					<button class="btn" name="submit" >Submit</button>
				</form>
		</div>
	</div>
</div>	
</body>
</html>