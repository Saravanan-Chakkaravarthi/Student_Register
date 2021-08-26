<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Thanks for Registering to My School</title>
</head>
<body>
	<?php

	$name = $_POST['name'];
	$father_name = $_POST['father_name'];
	$mother_name = $_POST['mother_name'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$dist = $_POST['dist'];
	$state = $_POST['state'];
	$ph1 = $_POST['ph1'];

	if (!empty($name)|| !empty($father_name) || !empty($mother_name) || !empty($gender) || !empty($age) || !empty($date) || !empty($address) || !empty($dist) || !empty($state)) {
		$host = "localhost";
		$dbusername = "root";
		$password = "";
		$dbname = "my_school";

		$conn = mysqli_connect($host, $dbusername, $password, $dbname);


		if (mysqli_connect_error()) {
			die('Connect Error ('.mysqli_connect_errno() .') '.mysqli_connect_error());
		}
		else{
			$SELECT = "SELECT email FROM stud_regist WHERE email = ? Limit 1";

			$INSERT = "INSERT INTO stud_regist(name, father_name, mother_name, email, gender, age, dob, address, dist, state, ph1) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

			//prepare statements
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;

			//checking email 
			if ($rnum==0) {
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("sssssssssss",$name, $father_name, $mother_name, $email, $gender, $age, $dob, $address, $dist, $state, $ph1);
				$stmt->execute();

				echo "New record inserted successfully";
			}
			else{
				echo "Someone already registered using this email";
			}
			$stmt->close();
			$conn->close();
		}
	}
	else{
		echo "All fields are required";
	}
?>
<br><br>
<a href="#">Home</a>
</body>
</html>