<?php 

	session_start();
	if (isset($_POST['submit'])) {
		$username = $_POST ['username'];

		$password = $_POST['password'];
	}


$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

mysqli_select_db($con, "store");

$rname = mysqli_query (
	$con, "SELECT name FROM users WHERE name = '$username'");
	$checkname = mysqli_num_rows ($rname);

if ($checkname == 0){
?>
	
	<script>
		alert("Incorrect login credebtials");
		window.location.assign("login.html");
	</script>

<?php
}else{

	$rpassword = mysqli_query (
		$con, "SELECT password FROM users WHERE password = '$password'");
		$checkpassword = mysqli_num_rows ($rpassword);

	if ($checkpassword == 0){
	?>
	
		<script>
			alert("Incorrect login credebtials");
			window.location.assign("login.html");
		</script>

	<?php

	}else{
		$curUserId = "";
		$results = mysqli_query ($con, "SELECT * FROM users WHERE password = '$password'");

		while ($row = mysqli_fetch_array($results)){

			$curUserId= $row['id'];
		}
		$_SESSION["curUserId"] = $curUserId;
	?>
		
		<script>
			window.location.assign("choose.html");
		</script>

	<?php


	}

}
?>