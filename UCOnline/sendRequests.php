<?php 

	session_start();

	$curUserId = $_SESSION["curUserId"];

	$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

	mysqli_select_db($con, "store");
	$users = mysqli_query ($con, "SELECT * FROM users");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/JPEG" href="images/mig1.png">
    <title>Send Requests|UCOnline</title>
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

<section class="container content-section col-md-10 col-xm-4 ">
  <h2 class="formhead">Send Requests to Others Users</h2>

<form class="needs-validation" onsubmit="return required()" 
ENCTYPE="multipart/form-data" method = "post" action = "pushRequests.php"  novalidate>

<table class="table">

	<thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Origin</th>
      <th scope="col">Requests</th>
    </tr>
 </thead>
<tbody>



<?php
	
	while ($row = mysqli_fetch_array($users)){


		$id = $row['id'];
		$name = $row['name'];
		$origin = $row['origin'];

		$requests = mysqli_query ($con, "SELECT * FROM requests");

		$friends = 0;

		while ($row = mysqli_fetch_array($requests)){

			$friendId = $row['receiver_id'];
			$yourId = $row['sender_id'];

			if ($friendId == $id && $yourId == $curUserId) {
				
				$friends = 1;
			}

			$friendId = $row['sender_id'];
			$yourId = $row['receiver_id'];

			if ($friendId == $id && $yourId == $curUserId) {
				
				$friends = 1;
			}

		}

		
		if ($curUserId == $id || $friends == 1) {
			
		}else{

			?>

			<tr>
    	
		      <th scope="row"><input type="text" name="id" value="<?php echo $id ?>" style="border: none;"></th>
		      <td><input type="text" name="name" value="<?php echo $name ?>" style="border: none;"></td>
		      <td><input type="text" name="origin" value="<?php echo $origin ?>" style="border: none;"></td>
		      <td><input class="btn btn-success" type="submit" name="submit" value="Send"></td>
		    </tr>

			<?php
			$_SESSION["curUserId"] = $curUserId;

		}
	}
?>