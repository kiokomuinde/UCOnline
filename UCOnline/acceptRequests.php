<?php 

	session_start();

	$curUserId = $_SESSION["curUserId"];

	$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");
	?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/JPEG" href="images/mig1.png">
    <title>Your Requests|UCOnline</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="locationStyle.css">
</head>
<body>

<section class="container content-section col-md-10 col-xm-4 ">
  <header class="main-header">
    <hr>
        <h1 class="band-name band-name-large" style="font-size: 6.5vw;">UCOnline</h1>   
</nav>
</header>
</section>


<script type="text/javascript">console.log(localStorage.getItem("name"));</script>
<script type="text/javascript">console.log(localStorage.getItem("kioko"));</script>



<section class="container content-section col-md-10 col-xm-4 ">
  <h2 class="formhead">Your Requests</h2>

<form class="needs-validation" onsubmit="return required()" 
ENCTYPE="multipart/form-data" method = "post" action = "accepted.php"  novalidate>

<table class="table">

	<thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Sent</th>
      <th scope="col">Accept</th>
      <th scope="col">Ignore</th>
    </tr>
 </thead>
<tbody>

	<?php

	$i = 0;

	mysqli_select_db($con, "store");
	$results = mysqli_query ($con, "SELECT * FROM requests WHERE receiver_id = '$curUserId'" );
	while ($row = mysqli_fetch_array($results)){

		$result = $row['result'];

		if ($result == 0) {
			
			$id = $row['sender_id'];
			$date = $row['sent'];
			$i++;


			mysqli_select_db($con, "store");
			$results = mysqli_query ($con, "SELECT * FROM users WHERE id = '$id'" );
			while ($row = mysqli_fetch_array($results)){

				$name = $row['name'];
			}

			?>

				<tr>
	    	
			      <th scope="row"><input type="text" name="id" value="<?php echo $id ?>" style="border: none;"></th>
			      <td><input type="text" name="name" value="<?php echo $name ?>" style="border: none;"></td>
			      <td><input type="text" name="date" value="<?php echo $date ?>" style="border: none;"></td>
			      <td><input class="btn btn-success" type="submit" name="accept" value="Accept"></td>
			      <td><input class="btn btn-danger" type="submit" name="ignore" value="Ignore"></td>
			    </tr>

			<?php
			$_SESSION["curUserId"] = $curUserId;

		}
	}

	if ($i == 0) {?>

		<p style="color: red;"> Sorry! You got no requests!</p>

	<?php
	}
	?>