<?php

if (isset($_POST['submit'])) {
session_start();

$name = $_POST ['name'];

$password= $_POST['passowrd'];

$cpassword = $_POST['cpassowrd'];

$age = $_POST['age'];

$gender= $_POST['gender'];

$origin = $_POST['origin'];

$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

mysqli_select_db($con, "store");

if (strcmp($password, $cpassword) ==0) {
		
	mysqli_query ($con, "INSERT INTO users (
		name, password, age, gender, origin) values ('$name', '$password', '$age', '$gender', '$origin')");
?>
	
	<script>
		alert("Registration was successful");
		window.location.assign("login.html");
	</script>

<?php

}else{

	?>

	<script>
		alert("Passwords dont match");
		window.location.assign("userSignup.html");
	</script>

<?php
}

}

?>