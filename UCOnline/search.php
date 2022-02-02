<?php 


if (isset($_POST['submit'])) {
	session_start();

	$media= $_POST['media'];

	$field = $_POST['field'];

	$value = $_POST['value'];

	$artistCheck = "";

	$con= mysqli_connect("localhost", "root", "") or die ("we couldnt connect!");

	mysqli_select_db($con, "store");

	if (strcmp($field, "author") ==0) {

		$check = mysqli_query ($con, "SELECT * FROM authors WHERE name = '$value'");

		while ($row = mysqli_fetch_array($check)){

			$value = $row['id'];
		}

	}else if (strcmp($field, "publisher") ==0) {

		$check = mysqli_query ($con, "SELECT * FROM publisher WHERE name = '$value'");

		while ($row = mysqli_fetch_array($check)){

			$value = $row['id'];
		}


	}else if (strcmp($field, "artist_id") ==0) {

		$check = mysqli_query ($con, "SELECT * FROM artists WHERE name = '$value'");

		while ($row = mysqli_fetch_array($check)){

			$value = $row['id'];
			$artistCheck = "solo";
		}


	}else if (strcmp($field, "groupp") ==0) {

		$check = mysqli_query ($con, "SELECT * FROM groupp WHERE name = '$value'");

		while ($row = mysqli_fetch_array($check)){

			$value = $row['id'];
			$artistCheck = "groupp";
		}


	}else if (strcmp($field, "record_label") ==0) {

		$check = mysqli_query ($con, "SELECT * FROM record_label WHERE name = '$value'");

		while ($row = mysqli_fetch_array($check)){

			$value = $row['id'];
		}


	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/JPEG" href="images/mig1.png">
    <title>Choose book/music|UCOnline</title>
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

<form class="needs-validation" onsubmit="return required()" 
ENCTYPE="multipart/form-data" method = "post" action = "orders.php"  novalidate>

<table class="table">
	<?php 
	if (strcmp($media, "books") == 0) {
		$results = mysqli_query ($con, "SELECT * FROM books WHERE $field = '$value'");

		?>
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">ch</th>
			      <th scope="col">id</th>
			      <th scope="col">Title</th>
			      <th scope="col">Category</th>
			      <th scope="col">Pages</th>
			      <th scope="col">Edition</th>
			      <th scope="col">Author</th>
			      <th scope="col">Publisher</th>
			      <th scope="col">Price($)</th>
			    </tr>
			 </thead>
			<tbody>
		<?php

		$rname = mysqli_query (
		$con, "SELECT title FROM books WHERE $field = '$value'");
		$checkname = mysqli_num_rows ($rname);

		if ($checkname == 0){

		?>
	
			<script>
				alert("Sorry! No records to show!");
				window.location.assign("choose.html");
			</script>

		<?php

		}



		while ($row = mysqli_fetch_array($results)){
			$authorName ="";
			echo $checkname." results found!";
			$id= $row['id'];
			$title= $row['title'];
			$category= $row['category'];
			$pages= $row['page_count'];
			$edition = $row['edition'];
			$author= $row['author'];
			$publisher= $row['publisher'];
			$price= $row['price'];

			$authors = mysqli_query ($con, "SELECT name FROM authors WHERE $id = '$author'");

			while ($row = mysqli_fetch_array($authors)){

				$authorName = $row['name'];

			}

			$publishers = mysqli_query ($con, "SELECT name FROM publisher WHERE $id = '$publisher'");

			while ($row = mysqli_fetch_array($publishers)){

				$publisherName = $row['name'];

			}

			$_SESSION["id"] = $id;
			$_SESSION["type"] = "books";


			?>

			<tr>
    	
		      <th scope="row"><input type="radio" id="html" name="id" value="<?php echo $id ?>"></th>
		      <td><?php echo $id ?></td>
		      <td><?php echo $title ?></td>
		      <td><?php echo $category ?></td>
		      <td><?php echo $pages ?></td>
		      <td><?php echo $edition ?></td>
		      <td><?php echo $authorName ?></td>
		      <td><?php echo $publisherName ?></td>
		      <td>$ <?php echo $price ?></td>
		    </tr>



   	<?php
		}
	}else if (strcmp($media, "songs") ==0) {

		$results = mysqli_query ($con, "SELECT * FROM songs WHERE $field = '$value'");

		?>
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">ch</th>
			      <th scope="col">id</th>
			      <th scope="col">Title</th>
			      <th scope="col">Category</th>
			      <th scope="col">Type</th>
			      <th scope="col">Version</th>
			      <th scope="col">Artist</th>
			      <th scope="col">Record Label</th>
			      <th scope="col">Price($)</th>
			    </tr>
			 </thead>
			<tbody>
		<?php

		$rname = mysqli_query (
		$con, "SELECT title FROM songs WHERE $field = '$value'");
		$checkname = mysqli_num_rows ($rname);


		if ($checkname == 0){

		?>
	
			<script>
				alert("Sorry! No records to show! <?php echo $value; ?>");
				window.location.assign("choose.html");
			</script>

		<?php

		}



		while ($row = mysqli_fetch_array($results)){
			$artistName ="";
			$recordLabelName = "";
			echo $checkname." results found!";
			$id= $row['id'];
			$title= $row['title'];
			$category= $row['category'];
			$type= $row['type'];
			$version = $row['version'];
			$artist= $row['artist_id'];
			$recordLabel= $row['record_label'];
			$price= $row['price'];

			$artistType = $row['artist'];

			$artistTable = "";

			if (strcmp($artistCheck, "solo") ==0) {
				$artistTable = "artists";
			}else{

				$artistTable = "groupp";
			}
			$artists = mysqli_query ($con, "SELECT * FROM $artistTable WHERE id = '$artist'");

			while ($row = mysqli_fetch_array($artists)){

				$artistName = $row['name'];

			}

			$recordLabels = mysqli_query ($con, "SELECT * FROM record_label WHERE id = '$recordLabel'");

			while ($row = mysqli_fetch_array($recordLabels)){

				$recordLabelName = $row['name'];

			}

			$_SESSION["id"] = $id;
			$_SESSION["type"] = "songs";


			?>

			<tr>
    	
		      <th scope="row"><input type="radio" id="html" name="id" value="<?php echo $id ?>"></th>
		      <td><?php echo $id ?></td>
		      <td><?php echo $title ?></td>
		      <td><?php echo $category ?></td>
		      <td><?php echo $type ?></td>
		      <td><?php echo $version ?></td>
		      <td><?php echo $artistName ?></td>
		      <td><?php echo $recordLabelName ?></td>
		      <td>$ <?php echo $price ?></td>
		    </tr>



   	<?php
		}
	}else{

	?>
	
		<script>
			alert("Sorry! No records to show!" );
			window.location.assign("choose.html");
		</script>

	<?php

	}

 	?>
  </tbody>
</table>

<button class="btn btn-success" type="submit" name="submit">Purchase</button>
</form>
<?php
}
?>