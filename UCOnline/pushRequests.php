<?php 
	if (isset($_POST['submit'])) {

		session_start();
		$receiverId = $_POST ['id'];

		$name = $_POST['name'];

		$origin = $_POST['origin'];

		$sentDate = date("Y-m-d");

		$curUserId = $_SESSION["curUserId"];

		$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");
		$result =0;

		mysqli_select_db($con, "store");

		mysqli_query ($con, "INSERT INTO requests (
		sender_id, receiver_id, sent, result, name) values ('$curUserId', '$receiverId', '$sentDate',  '$result', '$name')");


		?>

			<script>
				alert("Request send to <?php echo $name; ?>");
				window.location.assign("choose.html");
			</script>

		<?php
	}

?>