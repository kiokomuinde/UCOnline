<?php
if (isset($_POST['submit'])) {
	session_start();

	$rating = (int)$_POST["rating"];
	$id = $_SESSION["id"];

	$type = $_SESSION["type"];

	$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

	mysqli_select_db($con, "store");

	$ratings = mysqli_query ($con, "SELECT * FROM $type WHERE id = '$id'");

		$rate = 0;
		while ($row = mysqli_fetch_array($ratings)){

			$rate = $row['rating'];

			if($rate == 0){

				$rate = $rating;
			}else{

				$rate = ($rate + $rating)/2;

				?>

	<?php
			}

		}

	mysqli_query ($con, "UPDATE $type  SET 
		rating = $rate WHERE id = '$id'");


	?>
	
		<script>
			alert("Thank you for the purchase");
			window.location.assign("choose.html");
		</script>

	<?php
}

?>