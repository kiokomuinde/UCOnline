<?php
if (isset($_POST['submit'])) {
	session_start();

	$id = $_POST["id"];

	$type = $_SESSION["type"];

	$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

	mysqli_select_db($con, "store");



	$results = mysqli_query ($con, "SELECT * FROM $type WHERE id = '$id'");

	$id = "";
	$title = "";
	$price = "" ;
	while ($row = mysqli_fetch_array($results)){

		$id = $row['id'];
		$title = $row['title'];
		$price = $row['price'];
	}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/JPEG" href="images/mig1.png">
    <title>Choose music/music|UCOnline</title>
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
  <h2 class="formhead">Search Results</h2>

  <div class="jumbotron">
  <h1 class="display-4">Your Purchase!</h1>
  <p class="lead"><?php echo $type ?></p>
  <hr class="my-4">
  <p><?php echo $title ?></p>
  <p>Price: $<?php echo $price ?></p>
  <form class="needs-validation" onsubmit="return required()" 
ENCTYPE="multipart/form-data" method = "post" action = "rating.php"  novalidate>

<div class="col-md-3 mb-3">
      <label for="rate">Please give this a rating</label>

      <select class="form-control" name ="rating" id="validationCustom04"placeholder="Gender" required>
        <option value="one">1</option>
        <option value="two">2</option>
        <option value="three">3</option>
        <option value="Four">4</option>
        <option value="Five">5</option>

      </select>
    </div>
  <p class="lead">
  	<button class="btn btn-primary btn-lg" type="submit" name="submit">Complete Purchase</button>
  </p>
</form>
</div>

<?php 
	
	$_SESSION["id"] = $id;
	$_SESSION["type"] = $type;


} ?>