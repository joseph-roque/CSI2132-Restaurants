<!DOCTYPE html>
<?php 
	session_start();
	$name = "";
	$userid = "";
	if(array_key_exists('name', $_SESSION) && array_key_exists('userid', $_SESSION)){
		$name = $_SESSION['name'];
		$userid = $_SESSION['userid'];
	}
		
?>
<html lang="en">
<head>
	<?php $page_title = "Home" ?>
	<?php include("includes/resources.php");?>
</head>

<body background="bg.png">
<div class="container">
	<div class="row clearfix">
		<?php include("includes/header.php");?>
		<?php include("includes/navbar.php");?>
		<div class="col-md-12 column">
			<h3 class="text-center text-muted">
				Your one-stop shop for dank-ass restaurant reviews
			</h3>
		
						
			<!-- Most Popular Restaurants -->
			<div class="most-popular">
				<h1 class="text-center text-success">
					Most Popular Restaurants
				</h1>
				
				<!-- One -->
				<div class="col-md-4">
					<div class="thumbnail">
					
					<?php
						require('connect.php');
						$query = "SELECT *
								FROM Restaurant R
								WHERE R.restaurant_id = 1";
						$result = pg_query($query) or die('Query failed: ' . pg_last_error());
						
						$row = pg_fetch_assoc($result);
						
						$name = $row['name'];
						$id = $row['restaurant_id'];
						
						echo "
							<a href='restaurant.php?id=$id'>"
							?>
							

							<div class='cropped-img' style='background-image:url("http://afghanchopan.com/wp-content/uploads/2013/08/garden-salad.jpg")' /> </div>

							<div class='caption'>
					
							<?php
							echo "<h2>$name</a></h2>";
							?>
					
						<p>
							<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = 'SELECT R.name FROM restaurant R WHERE restaurant_id=8';
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}	
							?>
						</p>
					</div>
				</div>
			</div>
				<!-- Two -->
				<div class="col-md-4">
					<div class="thumbnail">
					<a href="#">
					<div class="cropped-img" style="background-image:url('http://i.telegraph.co.uk/multimedia/archive/01718/steak_1718547b.jpg')" /> </div>

					<div class="caption">
					<h2>
					<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = "SELECT R.name
									FROM Restaurant R
									WHERE R.restaurant_id = 2";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}
					?>
						</a>
						</h2>
						<p>
							[comments]
						</p>
					</div>
				</div>
				</div>
				<!-- Three -->
				<div class="col-md-4">
					<div class="thumbnail">
					<a href="#">
					<div class="cropped-img" style="background-image:url('http://upload.wikimedia.org/wikipedia/commons/a/a2/Asian_Style_Italian_Pasta.jpg')" /> </div>
						
					<div class="caption">
						<h2>
							<?php
								//Query to be ran will be changed when we implement ratings
								//The DB should already be connected at this point
								$query = "SELECT R.name
									FROM Restaurant R
									WHERE R.restaurant_id = 3";
								$result = pg_query($query) or die('Query failed: ' . pg_last_error());
								//Fetch the results and print them
								while ($row = pg_fetch_row($result)) {
									echo "$row[0]";
									echo "<br/>\n";
								}
					?>
							</a>
						</h2>
						<p>
							[comments]
						</p>

					</div>
				</div>
	</div>

	<div class="row clearfix">
		<!-- Cuisines -->
		<div class="cuisines">
			<div class="col-md-3 column">
				<h3>Cuisines
				</h3>
				<ul>
					<li>
						<a href=''>Amurrican (25)</a>
					</li>
					<li>
						<a href=''>Asian (5)</a>
					</li>
					<li>
						<a href=''>Coffee (18)</a>
					</li>
					<li>
						<a href=''>Italian (14)</a>
					</li>
					<li>
						<a href=''>Middle Eastern (4)</a>
					</li>
					<li>
						<a href=''>Sandwiches (11)</a>
					</li>
					<li>
						<a href=''>Vegetarian (0)</a>
					</li>
				</ul>
			</div>
		</div>
		
		<!-- Recent Reviews -->
		<div class="recent-reviews">
			<div class="col-md-9 column">
				<h2 class="text-info text-center">
					Most Recent Review
				</h2>
				<?php
					$query = " SELECT * 
					FROM Rating R
					WHERE R.post_date IN (SELECT MAX(post_date) FROM Rating )";
							
					$result = pg_query($query) or die('Query failed: ' . pg_last_error());
					
					//Fetch the results and print them
					$result = pg_fetch_assoc($result);
					//start off with basic results an achieve actual results from queries
					$rName = $result['location_id'];
					$uName = $result['user_id'];
					$comment = $result['comments'];
					$food = $result['food'];
					$mood = $result['mood'];
					$price = $result['price'];
					$staff = $result['staff'];


					$result = pg_query("SELECT R.name, R.restaurant_id FROM Restaurant R, Location L
					 WHERE L.restaurant_id = R.restaurant_id AND L.location_id = $rName 
					 ");
					$result = pg_fetch_assoc($result);

					$rName = $result['name'];
					//restaurant ID
					$rId = $result['restaurant_id'];

					$result = pg_query("SELECT R.name, R.type_id FROM Rater R
					 WHERE R.user_id = $uName
					 ");
					$result = pg_fetch_assoc($result);
					$uName = $result['name'];
					$type = $result['type_id'];

					if($type == "1")
						$type = "Casual";
					else if($type == 2)
						$type = "Blogger";
					else if($type == 3)
						$type = "Verified Critic";
					else if($type == 0)
						$type = "Other";
					
			echo "	<h2>
					$rName
				</h2> 
				<h4>
				by <a href='profile.php?name=$uName'>$uName</a>
			    | $type
				</h4>
				<p>
					$comment
				</p>
				<strong>Price: </strong> $price | <strong>Food: </strong> $food | <strong>Mood: </strong> $mood | <strong>Staff: </strong> $staff
				<p>
					<a class='btn' href='restaurant.php?id=$rId'>Read review</a>
				</p>
				";
				?>
			</div>
		</div>

	</div>

</body>
</html>