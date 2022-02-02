<?php
	session_start();
	if (isset($_POST['accept'])) {

		$curUserId = $_SESSION["curUserId"];

		$name = $_POST["name"];
		$answeredDate = date("Y-m-d");

		$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

		mysqli_select_db($con, "store");

		mysqli_query ($con, "UPDATE requests  SET 
		result = 1, answered = '$answeredDate' WHERE receiver_id = '$curUserId'");

		?>
	
			<script>
				alert("You are now book buddies with <?php echo $name; ?>");
				window.location.assign("choose.html");
			</script>

		<?php

	}else if (isset($_POST['ignore'])) {

		$curUserId = $_SESSION["curUserId"];

		$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

		mysqli_select_db($con, "store");

		mysqli_query ($con, "DELETE FROM requests 
		WHERE receiver_id = '$curUserId'");


		?>
	
			<script>
				window.location.assign("choose.html");
			</script>

		<?php


		
	}

?>